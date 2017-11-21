<?php

/**
 * 本地攻略数据转换器
 */
class Convertor_Poi extends Convertor_Base {

    /**
     * 分类列表转换器
     * @param array $list
     * @return array
     */
    public function typeListConvertor($list) {
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
     * 标签列表转换器
     * @param array $list
     * @return array
     */
    public function tagListConvertor($list) {
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
     * 列表转换器
     * @param array $list
     * @return array
     */
    public function getListConvertor($list) {
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
                $dataTemp['nameLang1'] = $value['name_lang1'];
                $dataTemp['nameLang2'] = $value['name_lang2'];
                $dataTemp['nameLang3'] = $value['name_lang3'];
                $dataTemp['addressLang1'] = $value['address_lang1'];
                $dataTemp['addressLang2'] = $value['address_lang2'];
                $dataTemp['addressLang3'] = $value['address_lang3'];
                $dataTemp['introductLang1'] = $value['introduct_lang1'];
                $dataTemp['introductLang2'] = $value['introduct_lang2'];
                $dataTemp['introductLang3'] = $value['introduct_lang3'];
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['tel'] = $value['tel'];
                $dataTemp['lat'] = $value['lat'];
                $dataTemp['lng'] = $value['lng'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('ascott', 'enable') : Enum_Lang::getPageText('ascott', 'disable');
                $dataTemp['typeid'] = $value['typeId'];
                $dataTemp['typeShow'] = $value['typeName_lang1'];
                $dataTemp['tagid'] = $value['tagId'];
                $dataTemp['tagShow'] = $value['tagName_lang1'];
                $dataTemp['createtime'] = $value['createTime'] ? date('Y-m-d H:i:s', $value['createTime']) : '';
                $dataTemp['updatetime'] = $value['updateTime'] ? date('Y-m-d H:i:s', $value['updateTime']) : '';
                $dataTemp['sort'] = $value['sort'];
                $dataTemp['pdf'] = $value['pdf'] ? Enum_Img::getPathByKeyAndType($value['pdf']) : '';
                $dataTemp['videoShow'] = $value['video'] ? Enum_Img::getPathByKeyAndType($value['video']) : '';
                $dataTemp['video'] = $value['video'];
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
}

?>