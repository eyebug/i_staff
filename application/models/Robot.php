<?php

/**
 * 体验购物Model
 */
class ShoppingModel extends \BaseModel {


    /**
     * Call robot to the specified destination
     *
     * @param $paramList
     * @return array
     */
    public function callRobot($paramList)
    {
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $params['hotelid'] = intval($paramList['hotelid']);
            if ($params['hotelid'] <= 0) {
                break;
            }

            $params['dest'] = intval($paramList['dest']);
            if ($params['dest'] <= 0) {
                break;
            }

            $params['userid'] = intval($paramList['userid']);
            if ($params['userid'] <= 0) {
                break;
            }

            $result = $this->rpcClient->getResultRaw('GS010', $params);
        } while (false);
        return (array)$result;
    }


    /**
     * Call robot to deliver the products to the guest's room
     *
     * @param $paramList
     * @return array
     */
    public function deliverRobot($paramList)
    {
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $params['hotelid'] = intval($paramList['hotelid']);
            if ($params['hotelid'] <= 0) {
                break;
            }

            if(!is_array($paramList['itemlist']) || count($paramList['itemlist']) <= 0) break;
            foreach ($paramList['itemlist'] as &$item) {
                $orderId = intval($item);
                if ($orderId <= 0) {
                    break 2;
                } else {
                    $item = $orderId;
                }
            }
            $params['itemlist'] = json_encode($paramList['itemlist']);

            $params['start'] = intval($paramList['start']);
            if ($params['start'] <= 0) {
                break;
            }

            $params['userid'] = intval($paramList['userid']);
            if ($params['userid'] <= 0) {
                break;
            }

            $result = $this->rpcClient->getResultRaw('GS011', $params);
        } while (false);

        return (array)$result;
    }


    /**
     * 新建和编辑tag信息数据
     */
    public function savePosition($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['position']) || empty($params['robot_position']) || empty($params['type'])) {
                break;
            }
            $interfaceId = $params['id'] ? 'GS005' : 'GS004';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getTagList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }



    /**
     * @param int $hotelid
     * @return array|null
     */
    public static function getRobotDest(int $hotelid){
        $info = array(
            1 => array(
                1 => '仓库1',
                2 => '仓库2',
                3 => '前台',
            ),
            6 => array(
                1 => '仓库1',
                2 => '仓库2',
                3 => '前台',
            ),
        );
        return $info[intval($hotelid)];
    }
}
