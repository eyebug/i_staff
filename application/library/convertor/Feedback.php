<?php

/**
 * 问卷调查数据转换器
 */
class Convertor_Feedback extends Convertor_Base {

    /**
     * 问卷调查表单列表
     */
    public function listConvertor($list) {
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
                $dataTemp['name'] = $value['name'];
                $dataTemp['option'] = $value['option'];
                $dataTemp['sort'] = $value['sort'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('feedback', 'enable') : Enum_Lang::getPageText('feedback', 'disable');
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
     * 问卷调查问题列表
     */
    public function questionListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            $nameKeyList = Enum_Feedback::getFeedbackQuestionTypeNameKey();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['question'] = $value['question'];
                $dataTemp['type'] = $value['type'];
                $dataTemp['typeShow'] = Enum_Lang::getPageText('feedback', $nameKeyList[$value['type']]);
                $dataTemp['option'] = $value['option'];
                $dataTemp['sort'] = $value['sort'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('feedback', 'enable') : Enum_Lang::getPageText('feedback', 'disable');
                $dataTemp['listid'] = $value['listid'];
                $dataTemp['listShow'] = $value['listName'];
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
     * 提交的问卷调查列表
     */
    public function resultListConvertor($list) {
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
                $dataTemp['answer'] = $value['answer'];
                $dataTemp['userid'] = $value['userid'];
                $dataTemp['username'] = $value['username'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
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