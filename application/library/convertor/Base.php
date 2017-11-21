<?php

/**
 * 基础数据转换器
 */
class Convertor_Base {

    public function __construct() {
    }

    public function commonConvertor(array $result, $errorLangKey = '') {
        $data = array();
        $data['code'] = $result['code'];
        if (isset($result['code']) && !$result['code']) {
            $data['data'] = $result['data'];
        } else {
            $data['code'] = empty($result['code']) ? 1 : $result['code'];
            if ($errorLangKey) {
                $data['msg'] = Enum_Lang::getErrorText($errorLangKey, $data['code']);
            }
            $data['msg'] = $data['msg'] ? $data['msg'] : $result['msg'];
        }
        return $data;
    }

    public function statusConvertor(array $result) {
        $data = array();
        $data['code'] = $result['code'];
        if (isset($result['code']) && !$result['code']) {
            $data['data'] = $result['data'];
        } else {
            $data['code'] = empty($result['code']) ? 1 : $result['code'];
            $data['msg'] = $result['msg'];
        }
        return $data;
    }
}

?>