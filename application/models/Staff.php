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
}
