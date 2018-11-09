<?php

/**
 * 活动管理数据转换器
 */
class Convertor_Activity extends Convertor_Base {

    /**
     * 活动标签
     */
    public function activityTagListConvertor($list) {
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
     * 活动列表
     */
    public function activityListConvertor($list) {
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
                $dataTemp['articleLang1'] = $value['article_lang1'];
                $dataTemp['articleLang2'] = $value['article_lang2'];
                $dataTemp['articleLang3'] = $value['article_lang3'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('activity', 'enable') : Enum_Lang::getPageText('activity', 'disable');
                $dataTemp['tagid'] = $value['tagid'];
                $dataTemp['tagShow'] = $value['tagName'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['updatetime'] = $value['updatetime'] ? date('Y-m-d H:i:s', $value['updatetime']) : '';
                $dataTemp['sort'] = $value['sort'];
                $dataTemp['pdf'] = $value['pdf'] ? Enum_Img::getPathByKeyAndType($value['pdf']) : '';
                $dataTemp['videoShow'] = $value['video'] ? Enum_Img::getPathByKeyAndType($value['video']) : '';
                $dataTemp['pic'] = $value['pic'] ? Enum_Img::getPathByKeyAndType($value['pic']) : '';
                $dataTemp['ordercount'] = $value['ordercount'];
                $dataTemp['fromdate'] = $value['fromdate'] ? date('Y-m-d', $value['fromdate']) : '';
                $dataTemp['todate'] = $value['todate'] ? date('Y-m-d', $value['todate']) : '';
                $dataTemp['video'] = $value['video'];
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
     * 提交活动订单列表
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
                $dataTemp['userName'] = $value['userName'];
                $dataTemp['name'] = $value['name'];
                $dataTemp['phone'] = $value['phone'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['hotelid'] = $value['hotelid'];
                $dataTemp['hotelName'] = $value['hotelName'];
                $dataTemp['activityid'] = $value['activityid'];
                $dataTemp['activityName'] = $value['activityName'];
                $dataTemp['ordercount'] = $value['orderCount'];
                $dataTemp['remark'] = $value['remark'];
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            if ($result['limit'] == 0) {
                $data['data']['pageData']['pageNum'] = 1;
            }
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }
}

?>