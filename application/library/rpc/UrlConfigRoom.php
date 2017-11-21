<?php

class Rpc_UrlConfigRoom {

    private static $config = array(
        'R001' => array(
            'name' => '获取物品列表',
            'method' => 'getRoomResList',
            'auth' => true,
            'url' => '/RoomRes/getRoomResList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'icon' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'name' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'page' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'limit' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                )
            )
        ),
        'R002' => array(
            'name' => '新增物品',
            'method' => 'addRoomRes',
            'auth' => true,
            'url' => '/RoomRes/addRoomRes',
            'param' => array(
                'icon' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'sort' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'pdf' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'video' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'name_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'name_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'name_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'introduct_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'introduct_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'introduct_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'R003' => array(
            'name' => '更新物品',
            'method' => 'updateRoomResById',
            'auth' => true,
            'url' => '/RoomRes/updateRoomResById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'icon' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'sort' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pdf' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'video' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'name_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'name_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'name_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'introduct_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'introduct_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'introduct_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'detail_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'detail_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'detail_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'R004' => array(
            'name' => '获取房型列表',
            'method' => 'getRoomResList',
            'auth' => true,
            'url' => '/RoomType/getRoomTypeList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'title' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'page' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'limit' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                )
            )
        ),
        'R005' => array(
            'name' => '新建房型',
            'method' => 'addRoomtype',
            'auth' => true,
            'url' => '/RoomType/addRoomtype',
            'param' => array(
                'title_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'size' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'panoramic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'bedtype_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'bedtype_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'bedtype_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'roomcount' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'personcount' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'R006' => array(
            'name' => '更新房型',
            'method' => 'updateRoomtypeById',
            'auth' => true,
            'url' => '/RoomType/updateRoomtypeById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'title_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'size' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'panoramic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'bedtype_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'bedtype_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'bedtype_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'detail_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'detail_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'detail_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'resid_list' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'roomcount' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'personcount' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'R007' => array(
            'name' => '获取酒店房间列表',
            'method' => 'getRoomList',
            'auth' => true,
            'url' => '/Room/getRoomList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'room' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'typeid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'floor' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'page' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'limit' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                )
            )
        ),
        'R008' => array(
            'name' => '添加酒店房间信息',
            'method' => 'addRoom',
            'auth' => true,
            'url' => '/Room/addRoom',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'room' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'typeid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'floor' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'size' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'R009' => array(
            'name' => '根据id修改酒店房间信息',
            'method' => 'updateRoomById',
            'auth' => true,
            'url' => '/Room/updateRoomById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'room' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'typeid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'floor' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'size' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'R010' => array(
            'name' => '获取账单列表',
            'method' => 'getUserBillList',
            'auth' => true,
            'url' => '/UserBill/getUserBillList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'room' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'date' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'page' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'limit' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                )
            )
        ),
        'R011' => array(
            'name' => '添加账单',
            'method' => 'addUserBill',
            'auth' => true,
            'url' => '/UserBill/addUserBill',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'room' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'name' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'pdf' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'date' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'R012' => array(
            'name' => '根据id修改账单',
            'method' => 'updateUserBillById',
            'auth' => true,
            'url' => '/UserBill/updateUserBillById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pdf' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'date' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
    );

    /**
     * 根据接口编号获取接口配置
     *
     * @param string $interfaceId
     * @param string $configKey
     * @return multitype:multitype:string multitype:multitype:boolean string
     *         |boolean
     */
    public static function getConfig($interfaceId, $configKey = '') {
        if (isset(self::$config[$interfaceId])) {
            if (strlen($configKey) && isset(self::$config[$interfaceId][$configKey])) {
                return self::$config[$interfaceId][$configKey];
            } else {
                return self::$config[$interfaceId];
            }
        } else {
            return false;
        }
    }
}
