<?php

/**
 * Staff data convertor
 */
class Convertor_Staff extends Convertor_Base
{


    public function staffListConvertor(array $list) : array
    {

        $result = $list;
        $userList = array();

        foreach ($list['data']['list'] as $item){
            $tmpItem = array();
            $tmpItem['id'] = $item['id'];
            $tmpItem['name'] = $item['lname'];
            $tmpItem['schedule'] = $item['schedule'];
            $tmpItem['washing'] = $item['washing_push'];
            $userList[] = $tmpItem;
        }
        $result['data']['list'] = $userList;
        $result['data']['pageData']['page'] = intval($list['data']['page']);
        $result['data']['pageData']['rowNum'] = intval($list['data']['total']);
        $result['data']['pageData']['pageNum'] = ceil($list['data']['total'] / $list['data']['limit']);

        return $result;
    }

    public function resetPinConvertor(array $response) : array {

    }

}

?>