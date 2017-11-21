<?php

/**
 * 物业管理Model
 */
class HotelModel extends \BaseModel {

    /**
     * 获取物业列表
     */
    public function getHotelList($paramList, $cacheTime = 0) {
        do {
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = $paramList['id'] : false;
                $paramList['name'] ? $params['name'] = $paramList['name'] : false;
                $paramList['groupid'] ? $params['groupid'] = $paramList['groupid'] : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('GH001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 获取物业信息
     */
    public function getHotelDetail($hotelId) {
        do {
            $params['id'] = intval($hotelId);
            if (empty($params['id'])) {
                $result = array(
                    'code' => 1,
                    'msg' => '物业ID不能为空',
                );
                break;
            }
            $result = $this->rpcClient->getResultRaw('GH001', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 更新物业信息
     */
    public function saveHotelDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['name_lang1'] ? $params['name_lang1'] = $params['nameLang1'] = $paramList['name_lang1'] : false;
            $paramList['name_lang2'] ? $params['name_lang2'] = $paramList['name_lang2'] : false;
            $paramList['name_lang3'] ? $params['name_lang3'] = $paramList['name_lang3'] : false;
            $paramList['cityid'] ? $params['cityid'] = $paramList['cityid'] : false;
            $paramList['propertyinterfid'] ? $params['propertyinterfid'] = $paramList['propertyinterfid'] : false;
            $paramList['lng'] ? $params['lng'] = $paramList['lng'] : false;
            $paramList['lat'] ? $params['lat'] = $paramList['lat'] : false;
            $paramList['tel'] ? $params['tel'] = $paramList['tel'] : false;
            $paramList['website'] ? $params['website'] = $paramList['website'] : false;
            $paramList['logo'] ? $params['logo'] = $paramList['logo'] : false;
            $paramList['bookurl'] ? $params['bookurl'] = $paramList['bookurl'] : false;
            $paramList['address_lang1'] ? $params['address_lang1'] = $paramList['address_lang1'] : false;
            $paramList['address_lang2'] ? $params['address_lang2'] = $paramList['address_lang2'] : false;
            $paramList['address_lang3'] ? $params['address_lang3'] = $paramList['address_lang3'] : false;
            $paramList['introduction_lang1'] ? $params['introduction_lang1'] = $paramList['introduction_lang1'] : false;
            $paramList['introduction_lang2'] ? $params['introduction_lang2'] = $paramList['introduction_lang2'] : false;
            $paramList['introduction_lang3'] ? $params['introduction_lang3'] = $paramList['introduction_lang3'] : false;
            $paramList['pdf'] ? $params['pdf'] = $paramList['pdf'] : false;
            $paramList['flighturl'] ? $params['flighturl'] = $paramList['flighturl'] : false;
            $paramList['surveyurl'] ? $params['surveyurl'] = $paramList['surveyurl'] : false;
            !is_null($paramList['status']) ? $params['status'] = $paramList['status'] : false;

            $checkParams = Enum_Hotel::getHotelMustInput();
            foreach ($checkParams as $checkParamOne) {
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }
            if ($paramList['logo']) {
                $uploadResult = $this->uploadFile($paramList['logo'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = '公寓LOGO上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['logo'] = $uploadResult['data']['picKey'];
            }
            if ($paramList['index_background']) {
                $uploadResult = $this->uploadFile($paramList['index_background'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = 'APP首页背景图上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['index_background'] = $uploadResult['data']['picKey'];
            }
            if ($paramList['localpic']) {
                $uploadResult = $this->uploadFile($paramList['localpic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = 'APP首页背景图上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['localpic'] = $uploadResult['data']['picKey'];
            }
            if ($paramList['voice_lang1']) {
                $uploadResult = $this->uploadFile($paramList['voice_lang1'], Enum_Oss::OSS_PATH_VOICE);
                if ($uploadResult['code']) {
                    $result['msg'] = '公寓语音介绍上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['voice_lang1'] = $uploadResult['data']['picKey'];
            }
            if ($paramList['voice_lang2']) {
                $uploadResult = $this->uploadFile($paramList['voice_lang2'], Enum_Oss::OSS_PATH_VOICE);
                if ($uploadResult['code']) {
                    $result['msg'] = '公寓语音介绍上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['voice_lang2'] = $uploadResult['data']['picKey'];
            }
            if ($paramList['voice_lang3']) {
                $uploadResult = $this->uploadFile($paramList['voice_lang3'], Enum_Oss::OSS_PATH_VOICE);
                if ($uploadResult['code']) {
                    $result['msg'] = '公寓语音介绍上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['voice_lang3'] = $uploadResult['data']['picKey'];
            }
            if ($paramList['pdf']) {
                $uploadResult = $this->uploadFile($paramList['pdf'], Enum_Oss::OSS_PATH_PDF);
                if ($uploadResult['code']) {
                    $result['msg'] = '客信PDF上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pdf'] = $uploadResult['data']['picKey'];
            }
            $result = $this->rpcClient->getResultRaw('GH002', $params);
        } while (false);
        return $result;
    }

    /**
     * 获取楼层列表
     */
    public function getFloorList($paramList, $cacheTime = 0) {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = $paramList['id'] : false;
                $paramList['floor'] ? $params['floor'] = $paramList['floor'] : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('GH003', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑楼层信息
     */
    public function saveFloorDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['floor'] ? $params['floor'] = $paramList['floor'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            !is_null($paramList['status']) ? $params['status'] = intval($paramList['status']) : false;
            $params['pic'] = $paramList['pic'];

            if (empty($params['id'])) {
                $checkParams = Enum_Hotel::getFloorMustInput();
                foreach ($checkParams as $checkParamOne) {
                    if (empty($params[$checkParamOne])) {
                        break 2;
                    }
                }
            }

            unset($params['pic']);
            if ($paramList['pic']) {
                $uploadResult = $this->uploadFile($paramList['pic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = '楼层图上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pic'] = $uploadResult['data']['picKey'];
            }
            $interfaceId = $params['id'] ? 'GH005' : 'GH004';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getFloorList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 获取设施列表
     */
    public function getFacilitiesList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            $paramList['icon'] ? $params['icon'] = $paramList['icon'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GH006', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑设施信息
     */
    public function saveFacilitiesDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['icon'] ? $params['icon'] = $paramList['icon'] : false;
            $paramList['name_lang1'] ? $params['name_lang1'] = $paramList['name_lang1'] : false;
            $paramList['name_lang2'] ? $params['name_lang2'] = $paramList['name_lang2'] : false;
            $paramList['name_lang3'] ? $params['name_lang3'] = $paramList['name_lang3'] : false;
            $paramList['introduct_lang1'] ? $params['introduct_lang1'] = $paramList['introduct_lang1'] : false;
            $paramList['introduct_lang2'] ? $params['introduct_lang2'] = $paramList['introduct_lang2'] : false;
            $paramList['introduct_lang3'] ? $params['introduct_lang3'] = $paramList['introduct_lang3'] : false;
            $paramList['video'] ? $params['video'] = $paramList['video'] : false;
            !is_null($paramList['status']) ? $params['status'] = intval($paramList['status']) : false;
            !is_null($paramList['sort']) ? $params['sort'] = intval($paramList['sort']) : false;

            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            $checkParams = Enum_Hotel::getFacilitiesInput();
            foreach ($checkParams as $checkParamOne) {
                $checkParamOne = str_replace('Lang', '_lang', $checkParamOne);
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
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
            if ($paramList['pdf']) {
                $uploadResult = $this->uploadFile($paramList['pdf'], Enum_Oss::OSS_PATH_PDF);
                if ($uploadResult['code']) {
                    $result['msg'] = 'pdf上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pdf'] = $uploadResult['data']['picKey'];
            }

            $interfaceId = $params['id'] ? 'GH008' : 'GH007';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    /**
     * 获取交通列表
     */
    public function getTrafficList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GH009', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑交通信息
     */
    public function saveTrafficDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['introduct_lang1'] ? $params['introduct_lang1'] = $paramList['introduct_lang1'] : false;
            $paramList['introduct_lang2'] ? $params['introduct_lang2'] = $paramList['introduct_lang2'] : false;
            $paramList['introduct_lang3'] ? $params['introduct_lang3'] = $paramList['introduct_lang3'] : false;
            $paramList['sort'] ? $params['sort'] = $paramList['sort'] : false;
            $paramList['video'] ? $params['video'] = $paramList['video'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;

            if ($paramList['pdf']) {
                $uploadResult = $this->uploadFile($paramList['pdf'], Enum_Oss::OSS_PATH_PDF);
                if ($uploadResult['code']) {
                    $result['msg'] = 'pdf上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pdf'] = $uploadResult['data']['picKey'];
            }

            $interfaceId = $params['id'] ? 'GH011' : 'GH010';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    /**
     * 获取全景列表
     */
    public function getPanoramicList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['title'] ? $params['title'] = $paramList['title'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GH012', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑全景
     */
    public function savePanoramicDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['panoramic'] ? $params['panoramic'] = $paramList['panoramic'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['title_lang1'] ? $params['title_lang1'] = $paramList['title_lang1'] : false;
            $paramList['title_lang2'] ? $params['title_lang2'] = $paramList['title_lang2'] : false;
            $paramList['title_lang3'] ? $params['title_lang3'] = $paramList['title_lang3'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;

            if (empty($params['title_lang1'])) {
                break;
            }

            if ($paramList['pic']) {
                $uploadResult = $this->uploadFile($paramList['pic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = '全景预览图上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pic'] = $uploadResult['data']['picKey'];
            }
            $interfaceId = $params['id'] ? 'GH014' : 'GH013';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    /**
     * 获取物业图片列表
     */
    public function getPicList($paramList) {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GH015', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑物业图片
     */
    public function savePicDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            !is_null($paramList['sort']) ? $params['sort'] = intval($paramList['sort']) : false;


            if (empty($paramList['pic']) && empty($paramList['id'])) {
                $result = array(
                    'code' => 1,
                    'msg' => '图片不能为空'
                );
                break;
            }

            if ($paramList['pic']) {
                $uploadResult = $this->uploadFile($paramList['pic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = '图上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pic'] = $uploadResult['data']['picKey'];
            }
            $interfaceId = $params['id'] ? 'GH017' : 'GH016';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    /**
     * 获取物业APP多语言标题列表
     */
    public function getTitleList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['key'] ? $params['key'] = $paramList['key'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GH018', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑物业APP多语言标题信息
     */
    public function saveTitleDataInfo($paramList) {
        $params = $this->initParam();
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
            $paramList['key'] ? $params['key'] = $paramList['key'] : false;

            $checkParams = Enum_Hotel::getTitleInput();
            foreach ($checkParams as $checkParamOne) {
                $checkParamOne = str_replace('Lang', '_lang', $checkParamOne);
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }
            $interfaceId = $params['id'] ? 'GH020' : 'GH019';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }


    public function test($hotelid){
        return $this->rpcClient->getResultRaw('GH021', array('hotelid' => $hotelid));
    }
}
