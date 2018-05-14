<?php

class Rpc_UrlConfigRobot {

    private static $config = array(

        'RT001' => array(
            'name' => '新建地点',
            'method' => 'addPosition',
            'auth' => true,
            'url' => '/Service/addPosition',
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
                'type' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'position' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'robot_position' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'RT002' => array(
            'name' => '更新地点',
            'method' => 'updatePositionById',
            'auth' => true,
            'url' => '/Service/updatePositionById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'type' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'position' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'robot_position' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'RT003' => array(
            'name' => '获取点位列表',
            'method' => 'getPositionList',
            'auth' => true,
            'url' => '/Service/getPositionList',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'type' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),

            )
        ),
        'RT004' => array(
            'name' => '发起取物任务',
            'method' => 'robotSend',
            'auth' => true,
            'url' => '/Service/robotSend',
            'param' => array(
                'userid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'token' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'to' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'start' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'dest' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'RT005' => array(
            'name' => '获取取物机器人任务列表',
            'method' => 'getRobotSendList',
            'auth' => true,
            'url' => '/Service/getRobotSendList',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'room_no' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'status' => array(
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
