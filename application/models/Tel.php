<?php

/**
 * 电话黄页Model
 */
class TelModel extends \BaseModel {

    /**
     * 获取电话黄页分类列表
     */
    public function getTelTypeList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = $paramList['id'] : false;
                $paramList['title'] ? $params['title'] = $paramList['title'] : false;
                isset($paramList['islogin']) ? $params['islogin'] = $paramList['islogin'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('T001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑分类信息
     */
    public function saveTelTypeDataInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            isset($paramList['islogin']) ? $params['islogin'] = $paramList['islogin'] : false;
            $paramList['title_lang1'] ? $params['title_lang1'] = $paramList['title_lang1'] : false;
            $paramList['title_lang2'] ? $params['title_lang2'] = $paramList['title_lang2'] : false;
            $paramList['title_lang3'] ? $params['title_lang3'] = $paramList['title_lang3'] : false;

            $checkParams = Enum_Tel::getTelTypeMustInput();
            foreach ($checkParams as $checkParamOne) {
                $checkParamOne = str_replace('Lang', '_lang', $checkParamOne);
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }
            $interfaceId = $params['id'] ? 'T003' : 'T002';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getTelTypeList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 获取电话黄页列表
     */
    public function getTelList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['typeid'] ? $params['typeid'] = $paramList['typeid'] : false;
            $paramList['title'] ? $params['title'] = $paramList['title'] : false;
            $paramList['tel'] ? $params['tel'] = $paramList['tel'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('T004', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑电话黄页列表
     */
    public function saveTelDataInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['title_lang1'] ? $params['title_lang1'] = $paramList['title_lang1'] : false;
            $paramList['title_lang2'] ? $params['title_lang2'] = $paramList['title_lang2'] : false;
            $paramList['title_lang3'] ? $params['title_lang3'] = $paramList['title_lang3'] : false;
            $paramList['tel'] ? $params['tel'] = $paramList['tel'] : false;
            $paramList['typeid'] ? $params['typeid'] = $paramList['typeid'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;

            $checkParams = Enum_Tel::getTelMustInput();
            foreach ($checkParams as $checkParamOne) {
                $checkParamOne = str_replace('Lang', '_lang', $checkParamOne);
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }
            $interfaceId = $params['id'] ? 'T006' : 'T005';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }
}
