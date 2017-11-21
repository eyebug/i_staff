<?php

/**
 * 入住用户Model
 */
class UserModel extends \BaseModel {

    /**
     * 获取表单列表
     */
    public function getList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('U001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }
}
