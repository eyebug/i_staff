<?php

/**
 * 体验购物数据转换器
 */
class Convertor_Shopping extends Convertor_Base {

    /**
     * 体验购物标签列表
     */
    public function shoppingTagListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['titleLang1'] = $value['title_lang1'];
                $dataTemp['titleLang2'] = $value['title_lang2'];
                $dataTemp['titleLang3'] = $value['title_lang3'];
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    /**
     * 体验购物列表
     */
    public function shoppingListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['titleLang1'] = $value['title_lang1'];
                $dataTemp['titleLang2'] = $value['title_lang2'];
                $dataTemp['titleLang3'] = $value['title_lang3'];
                $dataTemp['introductLang1'] = $value['introduct_lang1'];
                $dataTemp['introductLang2'] = $value['introduct_lang2'];
                $dataTemp['introductLang3'] = $value['introduct_lang3'];
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['pic'] = Enum_Img::getPathByKeyAndType($value['pic']);
                $dataTemp['tagid'] = $value['tagid'];
                $dataTemp['tagShow'] = $value['tagName'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['sort'] = $value['sort'];
                $dataTemp['pdf'] = $value['pdf'] ? Enum_Img::getPathByKeyAndType($value['pdf']) : '';
                $dataTemp['videoShow'] = $value['video'] ? Enum_Img::getPathByKeyAndType($value['video']) : '';
                $dataTemp['video'] = $value['video'];
                $dataTemp['price'] = floatval($value['price']);
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('news', 'enable') : Enum_Lang::getPageText('news', 'disable');
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    /**
     * 体验购物订单列表
     */
    public function orderListConvertor($list, $excludeFinished = false) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                if ($excludeFinished && $value['statusName'] == ShoppingModel::SHOPPING_ORDER_FINISH) {
                    continue;
                }
                $dataTemp['id'] = $value['idShow'];
                $dataTemp['ordersProductsId'] = $value['orders_products_id'];
                $dataTemp['userid'] = $value['userid'];
                $dataTemp['userRoom'] = $value['userInfo']['room'];
                $dataTemp['count'] = $value['count'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['status'] = $value['statusName'];
                $dataTemp['statusid'] = $value['status'];
                $dataTemp['shopping'] = $value['shoppingName'];
                $dataTemp['admin'] = $value['adminName'];
                $dataTemp['adminid'] = $value['adminid'];
                $dataTemp['memo'] = $value['memo'];
                $dataTemp['robotstatus'] = $value['robotStatus'];
                $dataTemp['robotstatusname'] = $value['robotStatusName'];
                $dataTemp['productstatus'] = $value['productStatus'];
                $dataTemp['productstatusname'] = $value['productStatusName'];
                $dataTemp['price'] = $value['price'];
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }
}

?>