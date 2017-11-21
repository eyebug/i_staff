<?php

/**
 * 客房管理Model
 */
class RoomModel extends \BaseModel {

    /**
     * 获取房间物品列表
     */
    public function getRoomResList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = $paramList['id'] : false;
                $paramList['icon'] ? $params['icon'] = $paramList['icon'] : false;
                $paramList['name'] ? $params['name'] = $paramList['name'] : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('R001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑房间物品信息
     */
    public function saveRoomResDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['icon'] ? $params['icon'] = $paramList['icon'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['name_lang1'] ? $params['name_lang1'] = $paramList['name_lang1'] : false;
            $paramList['name_lang2'] ? $params['name_lang2'] = $paramList['name_lang2'] : false;
            $paramList['name_lang3'] ? $params['name_lang3'] = $paramList['name_lang3'] : false;
            $paramList['introduct_lang1'] ? $params['introduct_lang1'] = $paramList['introduct_lang1'] : false;
            $paramList['introduct_lang2'] ? $params['introduct_lang2'] = $paramList['introduct_lang2'] : false;
            $paramList['introduct_lang3'] ? $params['introduct_lang3'] = $paramList['introduct_lang3'] : false;
            $paramList['sort'] ? $params['sort'] = $paramList['sort'] : false;
            $paramList['video'] ? $params['video'] = $paramList['video'] : false;
            !is_null($paramList['status']) ? $params['status'] = intval($paramList['status']) : false;

            if (empty($params['name_lang1']) || empty($params['icon'])) {
                break;
            }

            if ($paramList['pic']) {
                $uploadResult = $this->uploadFile($paramList['pic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = '图片上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pic'] = $uploadResult['data']['picKey'];
            }
            if ($paramList['pdf']) {
                $uploadResult = $this->uploadFile($paramList['pdf'], Enum_Oss::OSS_PATH_PDF);
                if ($uploadResult['code']) {
                    $result['msg'] = 'pdf上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pdf'] = $uploadResult['data']['picKey'];
            }

            $interfaceId = $params['id'] ? 'R003' : 'R002';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getRoomResList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 获取房型列表
     */
    public function getRoomTypeList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = $paramList['id'] : false;
                $paramList['title'] ? $params['title'] = $paramList['title'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('R004', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑房型
     */
    public function saveRoomTypeDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            isset($paramList['title_lang1']) ? $params['title_lang1'] = $paramList['title_lang1'] : false;
            isset($paramList['title_lang2']) ? $params['title_lang2'] = $paramList['title_lang2'] : false;
            isset($paramList['title_lang3']) ? $params['title_lang3'] = $paramList['title_lang3'] : false;
            isset($paramList['size']) ? $params['size'] = $paramList['size'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $params['panoramic'] = $paramList['panoramic'];
            isset($paramList['bedtype_lang1']) ? $params['bedtype_lang1'] = $paramList['bedtype_lang1'] : false;
            isset($paramList['bedtype_lang2']) ? $params['bedtype_lang2'] = $paramList['bedtype_lang2'] : false;
            isset($paramList['bedtype_lang3']) ? $params['bedtype_lang3'] = $paramList['bedtype_lang3'] : false;
            isset($paramList['roomcount']) ? $params['roomcount'] = $paramList['roomcount'] : false;
            isset($paramList['personcount']) ? $params['personcount'] = $paramList['personcount'] : false;

            if (empty($params['title_lang1'])) {
                break;
            }
            unset($params['pic']);
            if ($paramList['pic']) {
                $uploadResult = $this->uploadFile($paramList['pic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = '图片上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pic'] = $uploadResult['data']['picKey'];
            }

            $interfaceId = $params['id'] ? 'R006' : 'R005';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getRoomTypeList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 更新房型物品
     */
    public function saveRoomTypeRes($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['id'])) {
                break;
            }
            $result = $this->rpcClient->getResultRaw('R006', $params);
        } while (false);
        return $result;
    }

    /**
     * 获取房间列表
     */
    public function getRoomList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['room'] ? $params['room'] = $paramList['room'] : false;
            $paramList['typeid'] ? $params['typeid'] = $paramList['typeid'] : false;
            $paramList['floor'] ? $params['floor'] = $paramList['floor'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('R007', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑房间
     */
    public function saveRoomDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['room'] ? $params['room'] = $paramList['room'] : false;
            $paramList['typeid'] ? $params['typeid'] = $paramList['typeid'] : false;
            $paramList['floor'] ? $params['floor'] = $paramList['floor'] : false;
            $paramList['size'] ? $params['size'] = $paramList['size'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;

            $checkParams = Enum_Room::getRoomMustInput();
            foreach ($checkParams as $checkParamOne) {
                $checkParamOne = str_replace('Lang', '_lang', $checkParamOne);
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }

            $interfaceId = $params['id'] ? 'R009' : 'R008';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    /**
     * 获取账单列表
     */
    public function getUserBillList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['room'] ? $params['room'] = $paramList['room'] : false;
            $paramList['date'] ? $params['date'] = $paramList['date'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('R010', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑账单
     */
    public function saveUserBillDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['room'] ? $params['room'] = $paramList['room'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            $paramList['date'] ? $params['date'] = $paramList['date'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;

            if ($paramList['pdf']) {
                $uploadResult = $this->uploadFile($paramList['pdf'], Enum_Oss::OSS_PATH_PDF);
                if ($uploadResult['code']) {
                    $result['msg'] = 'pdf上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pdf'] = $uploadResult['data']['picKey'];
            }

            $checkParams = Enum_Room::getBillMustInput();
            foreach ($checkParams as $checkParamOne) {
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }

            $interfaceId = $params['id'] ? 'R012' : 'R011';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    /**
     * 删除账单
     */
    public function deleteUserBill($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;

            if (empty($params['id'])) {
                break;
            }
            $result = $this->rpcClient->getResultRaw('R012', $params);
        } while (false);
        return $result;
    }
}
