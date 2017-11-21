<?php

/**
 * 预约看房数据转换器
 */
class Convertor_Showing extends Convertor_Base {

    /**
     * 预约看房订单列表
     */
    public function orderListConvertor($list) {
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
                $dataTemp['userid'] = $value['userid'];
                $dataTemp['name'] = $value['contact_name'];
                $dataTemp['phone'] = $value['contact_mobile'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['status'] = $value['statusName'];
                $dataTemp['admin'] = $value['adminName'];
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