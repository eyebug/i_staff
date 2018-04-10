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
     * @param $list
     * @param array $items
     * @param array $categories
     * @return array
     */
    public function signListConvertor(array $list, array $items, array $categories)
    {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $lang = Enum_Lang::getSystemLang(true);
            $categoryMap = array();
            $itemMap = array();
            foreach ($categories as $category) {
                $categoryMap[$category['id']] = $category['title_lang' . $lang];
            }
            foreach ($items as $item) {
                $itemMap[$item['id']] = $item['title_lang' . $lang];
            }
            foreach ($list['data']['list'] as &$row) {
                $row['type'] = $categoryMap[$row['type']];
                $sports = explode(',', $row['sports']);
                $tmp = array();
                foreach ($sports as $sport) {
                    $tmp[] = $itemMap[$sport];
                }
                $row['sports'] = implode(',', $tmp);
            }
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
    public function signListExportConvertor(array $list, array $items, array $categories)
    {
        $data = array();
        $data['list'] = array();
        $lang = Enum_Lang::getSystemLang(true);
        $itemMap = array();
        foreach ($items as $item) {
            $itemMap[$item['id']] = $item['title_lang' . $lang];
        }

        $title = array_merge(self::TITLE, array_values($itemMap));
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
            foreach ($itemMap as $key => $name) {
                if (in_array($key, $sports)) {
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

    /**
     * @param $list
     * @return array
     */
    public function signItemConvertor($list)
    {
        $data = array();
        if (isset($list['code']) && !$list['code']) {
            $lang = Enum_Lang::getSystemLang(true);
            foreach ($list['data']['list'] as &$row) {
                $row['title'] = $row['title_lang' . $lang];
            }
            $data = $list['data']['list'];
        }
        return $data;
    }

    public function signCategoryConvertor($list)
    {
        $data = array();
        if (isset($list['code']) && !$list['code']) {
            $lang = Enum_Lang::getSystemLang(true);
            foreach ($list['data']['list'] as &$row) {
                $row['title'] = $row['title_lang' . $lang];
            }
            $data = $list['data']['list'];
        }
        return $data;
    }
}

?>