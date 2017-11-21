<?php

/**
 * 客房管理数据转换器
 */
class Convertor_Room extends Convertor_Base {

    /**
     * 客房物品列表
     */
    public function roomResListConvertor($list) {
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
                $dataTemp['icon'] = $value['icon'];
                $dataTemp['nameLang1'] = $value['name_lang1'];
                $dataTemp['nameLang2'] = $value['name_lang2'];
                $dataTemp['nameLang3'] = $value['name_lang3'];
                $dataTemp['introductLang1'] = $value['introduct_lang1'];
                $dataTemp['introductLang2'] = $value['introduct_lang2'];
                $dataTemp['introductLang3'] = $value['introduct_lang3'];
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('room', 'enable') : Enum_Lang::getPageText('room', 'disable');
                $dataTemp['sort'] = $value['sort'];
                $dataTemp['pdf'] = $value['pdf'] ? Enum_Img::getPathByKeyAndType($value['pdf']) : '';
                $dataTemp['pic'] = $value['pic'] ? Enum_Img::getPathByKeyAndType($value['pic']) : '';
                $dataTemp['videoShow'] = $value['video'] ? Enum_Img::getPathByKeyAndType($value['video']) : '';
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
     * 房型列表
     */
    public function roomTypeListConvertor($list) {
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
                $dataTemp['size'] = $value['size'];
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['panoramic'] = $value['panoramic'];
                $dataTemp['bedtypeLang1'] = $value['bedtype_lang1'];
                $dataTemp['bedtypeLang2'] = $value['bedtype_lang2'];
                $dataTemp['bedtypeLang3'] = $value['bedtype_lang3'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['residList'] = $value['resid_list'];
                $dataTemp['roomcount'] = $value['roomCount'];
                $dataTemp['personcount'] = $value['personCount'];
                $dataTemp['pic'] = $value['pic'] ? Enum_Img::getPathByKeyAndType($value['pic']) : '';
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
     * 房间列表
     */
    public function roomListConvertor($list) {
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
                $dataTemp['room'] = $value['room'];
                $dataTemp['size'] = $value['size'];
                $dataTemp['typeid'] = $value['typeId'];
                $dataTemp['typeShow'] = $value['typeName'];
                $dataTemp['floor'] = $value['floor'];
                $dataTemp['floorShow'] = $value['floorName'];
                $dataTemp['createtime'] = $value['createTime'] ? date('Y-m-d H:i:s', $value['createTime']) : '';
                $dataTemp['lastUser'] = array();
                if ($value['lastUser']) {
                    $dataTemp['lastUser']['fullname'] = $value['lastUser'] ? $value['lastUser']['fullname'] : '';
                    $dataTemp['lastUser']['lastLoginTime'] = $value['lastUser']['lastlogintime'] ? date('Y-m-d H:i:s', $value['lastUser']['lastlogintime']) : '';
                }

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
     * 账单列表
     */
    public function userBillListConvertor($list) {
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
                $dataTemp['hotelid'] = $value['hotelid'];
                $dataTemp['room'] = $value['room_no'];
                $dataTemp['name'] = $value['name'];
                $dataTemp['userid'] = $value['userid'];
                $dataTemp['pdf'] = Enum_Img::getPathByKeyAndType($value['pdf']);
                $dataTemp['date'] = $value['date'] ? date('Y-m-d', $value['date']) : '';
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['updatetime'] = $value['updatetime'] ? date('Y-m-d H:i:s', $value['updatetime']) : '';
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