<?php

/**
 * 活动Model
 */
class AppModel extends \BaseModel {

    /**
     * 获取物业推送列表
     */
    public function getPushList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            $paramList['dataid'] ? $params['dataid'] = $paramList['dataid'] : false;
            $paramList['content_type'] ? $params['content_type'] = $paramList['content_type'] : false;
            isset($paramList['result']) ? $params['result'] = $paramList['result'] : false;
            isset($paramList['platform']) ? $params['platform'] = $paramList['platform'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('APP004', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建物业推送
     */
    public function createPush($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['platform'] ? $params['platform'] = $paramList['platform'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            $paramList['dataid'] ? $params['dataid'] = $paramList['dataid'] : false;
            $paramList['cn_title'] ? $params['cn_title'] = $paramList['cn_title'] : false;
            $paramList['cn_value'] ? $params['cn_value'] = $paramList['cn_value'] : false;
            $paramList['en_title'] ? $params['en_title'] = $paramList['en_title'] : false;
            $paramList['en_value'] ? $params['en_value'] = $paramList['en_value'] : false;
            $paramList['url'] ? $params['url'] = $paramList['url'] : false;

            $checkParams = Enum_App::getPushMustInput();
            foreach ($checkParams as $checkParamOne) {
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }
            $result = $this->rpcClient->getResultRaw('APP005', $params);
        } while (false);
        return $result;
    }

    /**
     * 获取快捷启动列表
     */
    public function getShortCutList($paramList) {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $result = $this->rpcClient->getResultRaw('APP001', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑快捷启动信息
     */
    public function saveShortcutDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['key'] ? $params['key'] = $paramList['key'] : false;
            $paramList['sort'] ? $params['sort'] = $paramList['sort'] : false;
            $paramList['title_lang1'] ? $params['title_lang1'] = $paramList['title_lang1'] : false;
            $paramList['title_lang2'] ? $params['title_lang2'] = $paramList['title_lang2'] : false;
            $paramList['title_lang3'] ? $params['title_lang3'] = $paramList['title_lang3'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;

            $checkParams = Enum_App::getShortcutMustInput();
            foreach ($checkParams as $checkParamOne) {
                $checkParamOne = str_replace('Lang', '_lang', $checkParamOne);
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }
            $interfaceId = $params['id'] ? 'APP003' : 'APP002';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    /**
     * 获取分享平台列表
     */
    public function getShareList($paramList) {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $params['limit'] = 0;
            $result = $this->rpcClient->getResultRaw('APP006', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 更新分享平台
     */
    public function updateShare($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['share'] ? $params['share'] = $paramList['share'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $result = $this->rpcClient->getResultRaw('APP007', $params);
        } while (false);
        return $result;
    }

    /**
     * 获取物业RSS列表
     */
    public function getHotelRssList($paramList) {
        $params = $this->initParam();
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['lang'] ? $params['lang'] = $paramList['lang'] : false;
            $result = $this->rpcClient->getResultRaw('APP008', $params);
        } while (false);
        return $result;
    }

    public function getRssTypeList($paramList, $cacheTime = 0) {
        do {
            if ($cacheTime == 0) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('APP009', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    public function getRssList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['typeid'] ? $params['typeid'] = $paramList['typeid'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $result = $this->rpcClient->getResultRaw('APP010', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 根据物业ID修改物业的RSS列表
     * @param $paramList
     * @return array
     */
    public function updateHotelRss($paramList) {
        do {
            $paramList['rss'] ? $params['rss'] = $paramList['rss'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $result = $this->rpcClient->getResultRaw('APP011', $params);
        } while (false);
        return (array)$result;
    }
}
