<?php

/**
 * 评论数据转换器
 */
class Convertor_Comment extends Convertor_Base {

    /**
     * 评论列表
     */
    public function CommentListConvertor($list) {
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
                $dataTemp['roomno'] = $value['roomno'];
                $dataTemp['fullname'] = $value['fullname'];
                $dataTemp['value'] = $value['value'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['status'] = $value['status'];
                switch ($dataTemp['status']) {
                    case 1:
                        $dataTemp['statusShow'] = Enum_Lang::getPageText('comment', 'statusonline');
                        break;
                    case 2:
                        $dataTemp['statusShow'] = Enum_Lang::getPageText('comment', 'statusreview');
                        break;
                    case 3:
                        $dataTemp['statusShow'] = Enum_Lang::getPageText('comment', 'statusdelete');
                        break;
                }
                $dataTemp['ip'] = $value['ip'] ? Util_Tools::ntoip($value['ip']) : '';
                $dataTemp['datatype'] = $value['datatype'];
                $dataTemp['dataid'] = $value['dataid'];
                $dataTemp['datatitle'] = $value['datatitle'];
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