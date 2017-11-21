<?php

/**
 * 活动Model
 */
class ActivityModel extends \BaseModel {

    /**
     * 获取tag列表
     */
    public function getTagList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('GA003', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑tag信息数据
     */
    public function saveTagDataInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['title_lang1']) || empty($params['hotelid'])) {
                break;
            }
            $interfaceId = $params['id'] ? 'GA005' : 'GA004';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getTagList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 获取活动列表
     */
    public function getActivityList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = $paramList['id'] : false;
                $paramList['tagid'] ? $params['tagid'] = $paramList['tagid'] : false;
                $paramList['title'] ? $params['title'] = $paramList['title'] : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('GA001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑活动信息
     */
    public function saveActvityDataInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['title_lang1']) || empty($params['hotelid'])) {
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
            $interfaceId = $params['id'] ? 'GA007' : 'GA006';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            $this->getActivityList(array('hotelid' => $params['hotelid']), -2);
        } while (false);
        return $result;
    }

    /**
     * 获取活动参与订单列表
     */
    public function getOrderList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            $paramList['phone'] ? $params['phone'] = $paramList['phone'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['groupid'] ? $params['groupid'] = $paramList['groupid'] : false;
            $paramList['activityid'] ? $params['activityid'] = $paramList['activityid'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GA008', $params);
        } while (false);
        return (array)$result;
    }
}
