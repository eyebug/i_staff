<?php

/**
 * 预约看房Model
 */
class ShowingModel extends \BaseModel {

    /**
     * 获取预约看房订单列表
     */
    public function getOrderList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            $paramList['phone'] ? $params['phone'] = $paramList['phone'] : false;
            $paramList['status'] ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GSH001', $params);
        } while (false);
        return (array)$result;
    }
}
