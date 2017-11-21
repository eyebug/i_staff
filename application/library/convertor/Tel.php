<?php

/**
 * 电话黄页数据转换器
 */
class Convertor_Tel extends Convertor_Base {

    /**
     * 电话黄页分类列表
     */
    public function telTypeListConvertor($list) {
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
                $dataTemp['islogin'] = $value['islogin'];
                $dataTemp['isloginShow'] = $value['islogin'] ? Enum_Lang::getPageText('tel', 'TELTYPEISLOGINENABLE') : Enum_Lang::getPageText('tel', 'TELTYPEISLOGINDISABLE');
                $dataTemp['titleLang1'] = $value['title_lang1'];
                $dataTemp['titleLang2'] = $value['title_lang2'];
                $dataTemp['titleLang3'] = $value['title_lang3'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('tel', 'enable') : Enum_Lang::getPageText('tel', 'disable');
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
     * 电话列表
     */
    public function telListConvertor($list) {
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
                $dataTemp['tel'] = $value['tel'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('tel', 'enable') : Enum_Lang::getPageText('tel', 'disable');
                $dataTemp['typeid'] = $value['typeid'];
                $dataTemp['typeName'] = $value['typeName'];
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