<?php

class Rpc_UrlConfigShopping {

    private static $config = array(
        'GS001' => array(
            'name' => '获取购物列表',
            'method' => 'getShoppingList',
            'auth' => true,
            'url' => '/shopping/getList',
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
                'tagid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
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
                ),
                'nopage' => array(
                    'format' => 'bool',
                    'style' => 'interface'
                ),
            )
        ),
        'GS002' => array(
            'name' => '获取购物报名列表',
            'method' => 'getShoppingOrderList',
            'auth' => true,
            'url' => '/shoppingOrder/getShoppingOrderList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'name' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'phone' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'groupid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'shoppingid' => array(
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
        'GS003' => array(
            'name' => '获取购物TAG列表',
            'method' => 'getShoppingTagList',
            'auth' => true,
            'url' => '/ShoppingTag/getShoppingTagList',
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
        'GS004' => array(
            'name' => '新建购物TAG',
            'method' => 'addShoppingTag',
            'auth' => true,
            'url' => '/ShoppingTag/addShoppingTag',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'title_lang1' => array(
                    'required' => true,
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
            )
        ),
        'GS005' => array(
            'name' => '更新购物TAG',
            'method' => 'updateShoppingTagById',
            'auth' => true,
            'url' => '/ShoppingTag/updateShoppingTagById',
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
                'title_lang1' => array(
                    'required' => true,
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
            )
        ),
        'GS006' => array(
            'name' => '新建购物',
            'method' => 'addShopping',
            'auth' => true,
            'url' => '/shopping/addShopping',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'tagid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang1' => array(
                    'required' => true,
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
                'price' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'sort' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
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
            )
        ),
        'GS007' => array(
            'name' => '更新购物',
            'method' => 'updateShoppingById',
            'auth' => true,
            'url' => '/shopping/updateShoppingById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'tagid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
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
                'price' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'sort' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
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
            )
        ),
        'GS008' => array(
            'name' => '获取购物报名列表',
            'method' => 'getShoppingOrderList',
            'auth' => true,
            'url' => '/shoppingOrder/getOrderList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'shoppingid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'userid' => array(
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

        'GS009' => array(
            'name' => 'Get user list from shopping order table',
            'method' => 'getShoppingUserOrderList',
            'auth' => true,
            'url' => '/shoppingOrder/getOrderFilterList',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),

        'GS010' => array(
            'name' => 'Call robot to the position',
            'method' => 'callRobot',
            'auth' => true,
            'url' => '/service/callRobot',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'dest' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'type' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),

        'GS011' => array(
            'name' => 'Send the robot to deliver',
            'method' => 'deliverRobot',
            'auth' => true,
            'url' => '/service/deliverRobot',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'start' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'dest' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'itemlist' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface',
                ),
            )
        ),

        'GS012' => array(
            'name' => 'Send the robot to deliver',
            'method' => 'deliverRobot',
            'auth' => true,
            'url' => '/Shoppingorder/updateShoppingOrderById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'adminid' => array(
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
        )
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
