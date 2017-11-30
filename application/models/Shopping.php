<?php

/**
 * 体验购物Model
 */
class ShoppingModel extends \BaseModel {

    const SHOPPING_ORDER_FINISH = "已完成";

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
            $result = $this->rpcClient->getResultRaw('GS003', $params, $isCache, $cacheTime);
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
            $interfaceId = $params['id'] ? 'GS005' : 'GS004';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getTagList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 获取体验购物列表
     */
    public function getShoppingList($paramList, $cacheTime = 0) {
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
            if($paramList['nopage']){
                $params['nopage'] = true;
                unset($params['limit']);
                unset($params['page']);
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('GS001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * Get user list from shopping order list.
     *
     * @param $paramList
     * @param int $cacheTime
     * @return array
     */
    public function getShoppingOrderFilterList($paramList, $cacheTime = 0) {

        $params['hotelid'] = $paramList['hotelid'];
        $isCache = $cacheTime != 0 ? true : false;
        $result = $this->rpcClient->getResultRaw('GS009', $params, $isCache, $cacheTime);
        return (array)$result;
    }

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
            $params['type'] = $paramList['type'];
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

            $params['dest'] = intval($paramList['dest']);

            $result = $this->rpcClient->getResultRaw('GS011', $params);
        } while (false);

        return (array)$result;
    }


    /**
     * 新建和编辑体验购物信息
     */
    public function saveShoppingDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['title_lang1'] ? $params['title_lang1'] = $paramList['title_lang1'] : false;
            $paramList['title_lang2'] ? $params['title_lang2'] = $paramList['title_lang2'] : false;
            $paramList['title_lang3'] ? $params['title_lang3'] = $paramList['title_lang3'] : false;
            $paramList['introduct_lang1'] ? $params['introduct_lang1'] = $paramList['introduct_lang1'] : false;
            $paramList['introduct_lang2'] ? $params['introduct_lang2'] = $paramList['introduct_lang2'] : false;
            $paramList['introduct_lang3'] ? $params['introduct_lang3'] = $paramList['introduct_lang3'] : false;
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['tagid'] ? $params['tagid'] = $paramList['tagid'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['sort'] ? $params['sort'] = $paramList['sort'] : false;
            $paramList['video'] ? $params['video'] = $paramList['video'] : false;
            $paramList['price'] ? $params['price'] = $paramList['price'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;

            if (empty($params['title_lang1'])) {
                break;
            }

            if ($paramList['pic']) {
                $uploadResult = $this->uploadFile($paramList['pic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $result['msg'] = '图上传失败:' . $uploadResult['msg'];
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
            $interfaceId = $params['id'] ? 'GS007' : 'GS006';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getShoppingList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    /**
     * 获取体验购物订单列表
     */
    public function getOrderList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['shoppingid'] ? $params['shoppingid'] = $paramList['shoppingid'] : false;
            $paramList['userid'] ? $params['userid'] = $paramList['userid'] : false;
            $paramList['status'] ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GS008', $params);
        } while (false);
        return (array)$result;
    }
}
