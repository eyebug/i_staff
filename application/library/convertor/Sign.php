<?php

/**
 * Sign date convertor
 */
class Convertor_Sign extends Convertor_Base
{
    const TITLE = array(
        'ID',
        '日期',
        '房间号',
        '人数',
        '锁号码',
        '开始时间',
        '结束时间',
    );

    /**
     * 预约看房订单列表
     */
    public function signListConvertor($list)
    {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {

            $data['data']['list'] = $list['data']['list'];
            $data['data']['pageData']['page'] = intval($list['data']['page']);
            $data['data']['pageData']['rowNum'] = intval($list['data']['total']);
            if ($list['data']['limit'] > 0) {
                $data['data']['pageData']['pageNum'] = ceil($list['data']['total'] / $list['data']['limit']);
            }
        }
        return $data;
    }

    /**
     * @param $list
     * @param $params
     * @return array
     */
    public function signListExportConvertor($list, $params)
    {
        $data = array();
        $data['list'] = array();
        $type = $params['type'];
        $title = self::TITLE;
        foreach (SignController::SPORTS[$type] as $key => $name) {
            $title[] = $key;
        }
        $title[] = Enum_Lang::getPageText('sign', 'name');
        $data['title'] = $title;

        foreach ($list['data']['list'] as $row) {
            $item = array();
            $item['id'] = $row['id'];
            $item['created_at'] = $row['created_at'];
            $item['room_no'] = strval($row['room_no']);
            $item['num'] = $row['num'];
            $item['lock_no'] = $row['lock_no'];
            $item['start_time'] = $row['start_time'];
            $item['end_time'] = $row['end_time'];

            $sports = explode(',', $row['sports']);
            foreach (SignController::SPORTS[$type] as $key => $name) {
                if (in_array($name, $sports)) {
                    $item[$name] = 'yes';
                } else {
                    $item[$name] = '';
                }
            }
            $item['lastname'] = $row['lastname'];
            $data['list'][] = $item;
        }

        return $data;

    }
}

?>