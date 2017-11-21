<?php

/**
 * 雅士阁生活Model
 */
class AscottModel extends \BaseModel {

    /**
     * 获取type列表
     */
    public function getTypeList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('LI002', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑type信息数据
     */
    public function saveTypeDataInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['title_lang1']) || empty($params['hotelid'])) {
                break;
            }
            $interfaceId = $params['id'] ? 'LI004' : 'LI005';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getTypeList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 获取雅士阁生活列表
     */
    public function getList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['typeid'] ? $params['typeid'] = $paramList['typeid'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('LI001', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 新建和编辑雅士阁生活信息
     */
    public function saveInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['name_lang1']) || empty($params['hotelid'])) {
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
            if ($paramList['pdf']) {
                $uploadResult = $this->uploadFile($paramList['pdf'], Enum_Oss::OSS_PATH_PDF);
                if ($uploadResult['code']) {
                    $result['msg'] = 'pdf上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pdf'] = $uploadResult['data']['picKey'];
            }
            $interfaceId = $params['id'] ? 'LI006' : 'LI007';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }
}
