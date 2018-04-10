<?php

/**
 * Class SignModel
 */
class SignModel extends \BaseModel
{


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Get sign category list
     */
    public function getSignCategoryList($paramList = array(), $cacheTime = 0)
    {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['id'] ? $params['id'] = intval($paramList['id']) : false;
            !is_null($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            if ($cacheTime == 0) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('S001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * Create or update sign category
     */
    public function saveCategory($params = array())
    {
        try {
            if (empty($params['title_lang1']) && empty($params['title_lang2'])) {
                $this->throwException("Lack of param", 1);
            }
            if (!is_null($params['pic'])) {
                $uploadResult = $this->uploadFile($params['pic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $errorMsg = '图上传失败:' . $uploadResult['msg'];
                    $this->throwException($errorMsg, $uploadResult['code']);
                }
                $params['pic'] = $uploadResult['data']['picKey'];
            }
            $interfaceId = $params['id'] ? 'S003' : 'S002';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } catch (Exception $e) {
            $result['code'] = $e->getCode();
            $result['msg'] = $e->getMessage();
        }
        return $result;
    }


    /**
     * Get sign item list
     */
    public function getItemList($paramList = array(), $cacheTime = 0)
    {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = intval($paramList['id']) : false;
                $paramList['category_id'] ? $params['category_id'] = intval($paramList['category_id']) : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('S004', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * Create or update sign item
     */
    public function saveItem($params = array())
    {
        try {
            if (empty($params['title_lang1']) && empty($params['title_lang2'])) {
                $this->throwException("Lack of param", 1);
            }
            if (empty($params['category_id'])) {
                $this->throwException("Lack of category_id", 1);
            }
            if (empty($params['hotelid'])) {
                $this->throwException("Lack of hotelid", 1);
            }

            $interfaceId = $params['id'] ? 'S006' : 'S005';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } catch (Exception $e) {
            $result['code'] = $e->getCode();
            $result['msg'] = $e->getMessage();
        }
        return $result;
    }

}
