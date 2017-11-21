<?php

/**
 * 物业管理数据转换器
 */
class Convertor_Hotel extends Convertor_Base {

    /**
     * 楼层列表
     */
    public function floorListConvertor($list) {
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
                $dataTemp['floor'] = $value['floor'];
                $dataTemp['pic'] = Enum_Img::getPathByKeyAndType($value['pic']);
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('hotel', 'enable') : Enum_Lang::getPageText('hotel', 'disable');
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
     * 物业设施列表
     */
    public function facilitiesListConvertor($list) {
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
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('hotel', 'enable') : Enum_Lang::getPageText('hotel', 'disable');
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['introductLang1'] = $value['introduct_lang1'];
                $dataTemp['introductLang2'] = $value['introduct_lang2'];
                $dataTemp['introductLang3'] = $value['introduct_lang3'];
                $dataTemp['pdf'] = $value['pdf'] ? Enum_Img::getPathByKeyAndType($value['pdf']) : '';
                $dataTemp['videoShow'] = $value['video'] ? Enum_Img::getPathByKeyAndType($value['video']) : '';
                $dataTemp['video'] = $value['video'];
                $dataTemp['pic'] = $value['pic'] ? Enum_Img::getPathByKeyAndType($value['pic']) : '';
                $dataTemp['sort'] = $value['sort'];
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
     * 交通列表
     */
    public function trafficListConvertor($list) {
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
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['introductLang1'] = $value['introduct_lang1'];
                $dataTemp['introductLang2'] = $value['introduct_lang2'];
                $dataTemp['introductLang3'] = $value['introduct_lang3'];
                $dataTemp['sort'] = $value['sort'];
                $dataTemp['pdf'] = $value['pdf'] ? Enum_Img::getPathByKeyAndType($value['pdf']) : '';
                $dataTemp['videoShow'] = $value['video'] ? Enum_Img::getPathByKeyAndType($value['video']) : '';
                $dataTemp['video'] = $value['video'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('hotel', 'enable') : Enum_Lang::getPageText('hotel', 'disable');
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
     * 全景管理
     */
    public function PanoramicListConvertor($list) {
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
                $dataTemp['panoramic'] = $value['panoramic'];
                $dataTemp['titleLang1'] = $value['title_lang1'];
                $dataTemp['titleLang2'] = $value['title_lang2'];
                $dataTemp['titleLang3'] = $value['title_lang3'];
                $dataTemp['pic'] = Enum_Img::getPathByKeyAndType($value['pic']);
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('hotel', 'enable') : Enum_Lang::getPageText('hotel', 'disable');
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
     * 物业图片列表
     */
    public function PicListConvertor($list) {
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
                $dataTemp['sort'] = $value['sort'];
                $dataTemp['pic'] = Enum_Img::getPathByKeyAndType($value['pic']);
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
     * APP多语言标题列表
     */
    public function titleListConvertor($list) {
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
                $dataTemp['key'] = $value['key'];
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
}

?>