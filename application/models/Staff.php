<?php

/**
 * Class StaffModel
 */
class StaffModel extends \BaseModel
{

    /**
     * Get staff list
     *
     * @param $paramList
     * @return array
     */
    public function getStaffList($paramList)
    {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            if ($paramList['limit']) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit']);
            }
            $result = $this->rpcClient->getResultRaw('SF001', $params);
        } while (false);
        return (array)$result;
    }

    /**
     * @param array $paramList
     * @return array
     */
    public function resetPin(array $paramList): array
    {
        $params = array();
        !empty($paramList['token']) ? $params['token'] = $paramList['token'] : $this->throwException('请重新登录', 1);
        $paramList['user_id'] > 0 ? $params['userid'] = $paramList['user_id'] : false;
        $result = $this->rpcClient->getResultRaw('SF002', $params);
        return (array)$result;
    }
}
