<?php

/**
 * User data convertor
 */
class Convertor_User extends Convertor_Base
{


    /**
     * @param array $list
     * @param array $params
     * @return array
     */
    public function userListConvertor(array $list) : array
    {

        $result = $list;
        $userList = array();

        foreach ($list['data']['list'] as $item){
            $tmpItem = array();
            $tmpItem['id'] = $item['id'];
            $tmpItem['room_no'] = $item['room_no'];
            $tmpItem['fullname'] = $item['fullname'];
            $tmpItem['updated_at'] = date("Y-m-d H:i:s", $item['lastlogintime']);
            $userList[] = $tmpItem;
        }
//        array_multisort(array_column($userList, 'room_no'), $userList,SORT_STRING);
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