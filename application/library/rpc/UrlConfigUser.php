<?php

class Rpc_UrlConfigUser
{

    private static $config = array(
        'U001' => array(
            'name' => '获取入住用户列表',
            'method' => 'getUserList',
            'auth' => true,
            'url' => '/User/getUserList',
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
        'U002' => array(
            'name' => '签到',
            'method' => 'signFacilities',
            'auth' => true,
            'url' => '/User/signFacilities',
            'param' => array(
                'lock_no' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'num' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'room_no' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'lastname' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'start_time' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'end_time' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'type' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'sports' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'U003' => array(
            'name' => '获取签到列表',
            'method' => 'getSignList',
            'auth' => true,
            'url' => '/sign/getSignList',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'start' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'end' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'type' => array(
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
    public static function getConfig($interfaceId, $configKey = '')
    {
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
