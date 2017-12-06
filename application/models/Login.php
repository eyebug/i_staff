<?php

/**
 * 登录Model
 */
class LoginModel extends \BaseModel {

    const STAFF_WEB_IDENTIFY = 'staff_login_from_web';

    /**
     * 获取登陆用户信息
     * @param $username 用户名
     * @param $password 密码
     * @return array
     */
    public function getUserInfo($paramList) {
        $params = $this->initParam($paramList);

        do {
            $params['username'] = trim($paramList['username']);
            $params['password'] = trim($paramList['password']);

            if (!$params['username'] || !$params['password']) {
                $result = array(
                    'code' => 1,
                    'msg' => '用户名或密码不能为空！'
                );
                break;
            }
            $params['password'] = Enum_Login::getMd5Pass($params['password']);
            $params['ip'] = Util_Http::getIP();
            $result = $this->rpcClient->getResultRaw('AU001', $params);
        } while (false);
        return $result;
    }

    /**
     * 执行登录
     * @param array $paramList
     * @return Ambigous <multitype:number string , multitype:>
     */
    public function doLogin($paramList) {
        do {
            $result = $this->getUserInfo($paramList);
            if ($result['code']) {
                break;
            }
            $userInfo = $result['data'];
            $errorResult = array(
                'code' => 1,
                'msg' => '登录失败'
            );
            if (empty($userInfo['id'])) {
                $result = $errorResult;
                break;
            }

            $hotelModel = new HotelModel();
            $hotelInfo = $hotelModel->getHotelDetail($userInfo['hotelId']);
            $userInfo['hotelLanguage'] = $hotelInfo['data']['list']['0']['lang_list'];

            $auth = Auth_Login::genSIdAndAId($userInfo['id']);
            $userInfo['sId'] = $auth['sId'];
            $key = Auth_Login::genLoginMemKey($auth['sId'], $auth['aId']);
            $cache = Cache_Redis::getInstance();
            if (!$cache->set($key, json_encode($userInfo), Enum_Login::LOGIN_TIMEOUT)) {
                $result = $errorResult;
                break;
            }
            $cookieTime = time() + Enum_Login::LOGIN_TIMEOUT;
            if (!Util_Http::setCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_AID, $auth['aId'], $cookieTime)) {
                $result = $errorResult;
                break;
            }
            if (!Util_Http::setCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_SID, $auth['sId'], $cookieTime)) {
                $result = $errorResult;
                break;
            }
            $result['data']['insertId'] = $result['data']['id'];
            Enum_Record::setRecordData('adminId', $result['data']['id']);
            Enum_Record::setRecordData('hotelId', $result['data']['hotelId']);
        } while (false);
        return $result;
    }

    public function doStaffLogin($paramList) {
        $params['identity'] = self::STAFF_WEB_IDENTIFY;
        $paramList['hotelid'] ? $params['hotelid'] = intval($paramList['hotelid']): false;
        $paramList['groupid'] ? $params['groupid'] = intval($paramList['groupid']): false;
        $paramList['username'] ? $params['lname'] = trim($paramList['username']): false;
        $paramList['password'] ? $params['pwd'] = $paramList['password']: false;
        $params['ad'] = intval($paramList['isad']);
        $result = $this->rpcClient->getResultRaw('GH022', $params);
        $errorResult = array(
            'code' => 1,
            'msg' => '登录失败'
        );

        if($result['code'] == 0){

            $user = $result['data'];
            $user['hotelLanguage'] = 'zh,en,jp'; //to do
            $auth = Auth_Login::genSIdAndAId($user['id']);

            $user['sId'] = $auth['sId'];
            $key = Auth_Login::genLoginMemKey($auth['sId'], $auth['aId']);
            $cache = Cache_Redis::getInstance();
            if (!$cache->set($key, json_encode($user), Enum_Login::LOGIN_TIMEOUT)) {
                return $errorResult;
            }
            $cookieTime = time() + Enum_Login::LOGIN_TIMEOUT;
            if (!Util_Http::setCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_AID, $auth['aId'], $cookieTime)) {
                return $errorResult;
            }
            if (!Util_Http::setCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_SID, $auth['sId'], $cookieTime)) {
                return $errorResult;
            }
        }
        return $result;
    }

    /**
     * 退出登录
     * @return boolean
     */
    public function loginOut() {
        if ($loginInfo = Auth_Login::checkLogin()) {
            $sId = Util_Http::getCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_SID);
            $aId = Util_Http::getCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_AID);
            if ($sId && $aId) {
                $memKey = Auth_Login::genLoginMemKey($sId, $aId);
                Cache_Redis::getInstance()->delete($memKey);
            }
            Util_Http::setCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_SID, '', time());
            Util_Http::setCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_AID, '', time());
            return true;
        }
    }

    /**
     * 修改用户密码
     * @param $oldPass 原密码
     * @param $newPass 新密码
     * @return array
     */
    public function changePass($paramList) {
        $params = $this->initParam($paramList);

        do {
            $params['userid'] = intval($paramList['userId']);
            $params['oldpass'] = trim($paramList['oldPass']);
            $params['newpass'] = trim($paramList['newPass']);

            if (!$params['userid'] || !$params['oldpass'] || !$params['newpass']) {
                $result = array(
                    'code' => 1,
                    'msg' => '参数错误'
                );
                break;
            }
            $params['oldpass'] = Enum_Login::getMd5Pass($params['oldpass']);
            $params['newpass'] = Enum_Login::getMd5Pass($params['newpass']);
            $result = $this->rpcClient->getResultRaw('AU003', $params);
        } while (false);
        return $result;
    }

    /**
     * Change staff's hotel id
     *
     * @param int $staffId
     * @param int $hotelId
     * @return array
     */
    public function changeHotel(int $staffId, int $hotelId): array
    {
        $result = array(
            'code' => 0,
            'msg' => 'success'
        );
        try {
            $sId = Util_Http::getCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_SID);
            $aId = Util_Http::getCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_AID);
            if (!$sId || !$aId || !Auth_Login::checkLogin()) {
                $this->throwException("Session expire", 1);
            }
            $memKey = Auth_Login::genLoginMemKey($sId, $aId);
            $userInfoStr = Cache_Redis::getInstance()->get($memKey);
            if ($userInfoStr) {
                $userInfoArr = json_decode($userInfoStr, true);
                if (in_array($hotelId, $userInfoArr['hotel_list'])) {
                    $userInfoArr['staff_web_hotel_id'] = intval($hotelId);
                    $newUserInfoStr = json_encode($userInfoArr);
                    Cache_Redis::getInstance()->set($memKey, $newUserInfoStr);
                } else {
                    $this->throwException("Param Error", 1);
                }
            } else {
                $this->throwException("Session expire", 1);
            }

            $params = array(
                'id' => $staffId,
                'staff_web_hotel_id' => $hotelId
            );
            $result = $this->rpcClient->getResultRaw('GH023', $params);
            $cookieTime = time() + Enum_Login::LOGIN_TIMEOUT;
            Util_Http::setCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_AID, $aId, $cookieTime);
            Util_Http::setCookie(Enum_Login::LOGIN_INFO_COOKIE_KEY_SID, $sId, $cookieTime);
        } catch (Exception $e) {
            $result['code'] = $e->getCode();
            $result['msg'] = $e->getMessage();
        }
        return $result;
    }

}
