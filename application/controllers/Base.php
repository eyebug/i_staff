<?php

/**
 * 基础控制器
 */
class BaseController extends \Yaf_Controller_Abstract {

    /**
     * 登录管理员信息
     */
    protected $userInfo;

    public function init() {
        $this->setPageWebConfig();
        $this->userInfo = Yaf_Registry::get('loginInfo');
        $this->setPageHeaderInfo($this->userInfo);
        $this->setPermission($this->userInfo);
        $this->setHotelLanguage($this->userInfo);
    }

    /**
     * Get hotel ID
     */
    protected function getHotelId()
    {
        $result = intval($this->userInfo['staff_web_hotel_id']);
        if ($result == 0) {
//            $this->jump404();
            return -1;
        } else {
            return $result;
        }
    }

    /**
     * 获取集团ID
     */
    protected function getGroupId() {
        return $this->userInfo['groupid'];
    }

    /**
     * 设置页面变量
     */
    private function setPageWebConfig() {
        $sysConfig = Yaf_Registry::get('sysConfig');
        $webConfig['layoutPath'] = $sysConfig->application->layout->directory;
        $webConfig['domain'] = $sysConfig->web->domain;
        $webConfig['imgDomain'] = $sysConfig->web->img_domain;
        $webConfig['assertPath'] = $sysConfig->web->assert_path;
        $webConfig['defaultIcon'] = $sysConfig->web->img_domain . 'img/temp/noImageIcon.jpg';
        $this->getView()->assign('webConfig', $webConfig);
    }

    /**
     * 设置头部信息
     */
    private function setPageHeaderInfo($loginInfo) {
        $headerInfo['userName'] = $loginInfo['lname'] ? $loginInfo['lname'] : "";
        $headerInfo['adminPermission'] = $loginInfo['createAdmin'] ? 0 : 1;
        $useLangugae = Enum_Lang::getSystemLang();
        $languageNameList = Enum_Lang::getLangeNameList();
        $headerInfo['useLanguage'] = $useLangugae;
        $headerInfo['useLanguageShow'] = $languageNameList[$useLangugae];
        $this->getView()->assign('headerInfo', $headerInfo);
    }

    /**
     * 设置权限
     */
    private function setPermission($loginInfo) {
        $permissionList = explode(",", $loginInfo['permission']);
        $this->_view->assign('permssionList', $permissionList);
    }

    /**
     * 设置物业语言
     */
    private function setHotelLanguage($loginInfo) {
        $this->_view->assign('hotelLanguageList', explode(',', $loginInfo['hotelLanguage']));
    }

    /**
     * Set staff's hotel list and last login hotel id
     *
     * @param $loginInfo
     */
    protected function initHotelList($loginInfo)
    {
        $lang = Enum_Lang::getSystemLang(true);
        $lang = 'name_lang' . $lang;
        $userHotelList = array();
        $userHotel = array();
        $hotelModel = new HotelModel();
        $hotelList = $hotelModel->getHotelList(array('limit' => 0), 6 * 3600);
        if (is_array($hotelList['data']['list'])) {
            foreach ($hotelList['data']['list'] as $row) {
                if (is_array($loginInfo['hotel_list']) && in_array($row['id'], $loginInfo['hotel_list'])) {
                    $item = array(
                        'id' => $row['id'],
                        'name' => $row[$lang]
                    );
                    if ($row['id'] == $loginInfo['staff_web_hotel_id']) {
                        $userHotel['id'] = $row['id'];
                        $userHotel['name'] = $row[$lang];
                    }
                    $userHotelList[] = $item;
                }
            }
        }

        $this->_view->assign('userHotel', $userHotel);
        $this->_view->assign('userHotelList', $userHotelList);
    }

    /**
     * 输出json
     *
     * @param array $data
     */
    public function echoJson($data) {
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json');
        $response->setBody(json_encode($data));
    }

    /**
     * 获取分页参数
     *
     * @param array $paramList
     *            传入引用
     */
    public function getPageParam(&$paramList) {
        $page = $this->_request->getPost('page');
        $limit = $this->_request->getPost('limit');
        $paramList['page'] = empty($page) ? 1 : $page;
        $paramList['limit'] = empty($limit) ? 5 : $limit;
    }

    /**
     * @param $code
     * @param $msg
     * @param $data
     * @param null $debugInfo
     */
    public function echoAndExit($code, $msg, $data, $debugInfo = null) {
        @header ( "Content-type:application/json" );
        $data = $this->clearNullNew ( $data );
        if (is_null ( $data ) && ! is_numeric ( $data )) {
            $data = array ();
        }
        $echoList = array ('code' => $code,'msg' => $msg,'data' => $data );
        $sysConfig = Yaf_Registry::get ( 'sysConfig' );
        if ($sysConfig->api->debug) {
            $echoList ['debugInfo'] = is_null ( $debugInfo ) ? ( object ) array () : $debugInfo;
        }
        $this->getResponse ()->setBody ( json_encode ( $echoList ) );
    }

    public function clearNullNew($data) {
        foreach ( $data as $key => $value ) {
            $keyTemp = lcfirst ( $key );
            if ($keyTemp != $key) {
                unset ( $data [$key] );
                $data [$keyTemp] = $value;
                $key = $keyTemp;
            }
            if (is_array ( $value ) || is_object ( $value )) {
                if (is_object ( $data )) {
                    $data->$key = $this->clearNullNew ( $value );
                } else {
                    $data [$key] = $this->clearNullNew ( $value );
                }
            } else {
                if (is_null ( $value ) && ! is_numeric ( $value )) {
                    $value = "";
                }
                if (is_numeric ( $value )) {
                    $value = strval ( $value );
                }
                $data [$key] = $value;
            }
        }
        return $data;
    }

    /**
     * 跳转404
     */
    protected function jump404() {
        header('Location:/error/notfound');
        exit();
    }

    /**
     * 获取GET
     *
     * @param string $key
     *            GET的key，为空返回整个$_GET
     * @param string $isJsonStr
     *            是否为json字符串，json字符串还原防注入的转译
     */
    protected function getGet($key = "", $isJsonStr = false) {
        if ($key) {
            if ($this->getRequest()->getParam($key)) {
                return $this->getRequest()->getParam($key);
            }
            if ($isJsonStr) {
                return Util_Http::revertInject($_GET[$key]);
            }
            return $_GET[$key];
        } else {
            return $_GET;
        }
    }

    /**
     * 获取POST
     *
     * @param string $key
     *            POST的key，为空返回整个$_POST
     * @param string $isJsonStr
     *            是否为json字符串，json字符串还原防注入的转译
     */
    protected function getPost($key = "", $isJsonStr = false) {
        if ($key) {
            if ($isJsonStr) {
                return Util_Http::revertInject($_POST[$key]);
            }
            return $_POST[$key];
        } else {
            return $_POST;
        }
    }

    /**
     * 设置允许上传文件类型
     */
    protected function setAllowUploadFileType($type, $pageKey) {
        $baseModel = new BaseModel();
        $allowType = $baseModel->getAllowUploadFileType($type);
        $this->_view->assign($pageKey, array_keys($allowType['data']['list']));
    }

    public function makeOssKeyAction() {
        $ossModel = new OssModel();
        $ossKey = $ossModel->makeOssKey();
        echo json_encode($ossKey);
    }
}
