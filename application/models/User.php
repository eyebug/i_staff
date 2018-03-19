<?php

/**
 * 入住用户Model
 */
class UserModel extends \BaseModel
{

    /**
     * 获取表单列表
     */
    public function getList($paramList, $cacheTime = 0)
    {
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

    public function sign($paramList)
    {

        try {
            if (empty($paramList['num']) || empty($paramList['room_no']) || empty($paramList['lastname']) || empty($paramList['sports'])
                || empty($paramList['start_time']) || empty($paramList['end_time']) || empty($paramList['hotelid']) || empty($paramList['groupid']) || empty($paramList['type'])) {
                $this->throwException('Lack of param', 1);
            }
            $result = $this->rpcClient->getResultRaw('U002', $paramList);

        } catch (Exception $e) {
            $result = array(
                'code' => $e->getCode(),
                'msg' => $e->getMessage()
            );
        }

        return $result;
    }

    /**
     * Get signUp list
     *
     * @param array $paramList
     * @param int $cacheTime
     * @return array
     */
    public function getSignList(array $paramList, $cacheTime = 0)
    {
        do {
            $params = $paramList;
            if ($cacheTime == 0) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('U003', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }
}
