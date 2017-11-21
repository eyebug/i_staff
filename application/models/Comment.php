<?php

/**
 * 评论Model
 */
class CommentModel extends \BaseModel {

    /**
     * 获取评论类型列表
     */
    public function getTypeList($paramList = array(), $cacheTime = 0) {
        do {
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('C001', $paramList, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * 获取评论列表
     */
    public function getCommentList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['datatype'] ? $params['datatype'] = $paramList['datatype'] : false;
            $paramList['dataid'] ? $params['dataid'] = $paramList['dataid'] : false;
            $paramList['roomno'] ? $params['roomno'] = $paramList['roomno'] : false;
            $paramList['status'] ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('C002', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * 编辑评论信息
     */
    public function saveCommentDataInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['id']) || empty($params['status'])) {
                break;
            }
            $result = $this->rpcClient->getResultRaw('C003', $params);
        } while (false);
        return $result;
    }

}
