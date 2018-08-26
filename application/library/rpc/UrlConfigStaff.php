<?php

class Rpc_UrlConfigStaff {

    private static $config = array(
        'SF001' => array(
            'name' => 'Get staff list',
            'method' => 'getStaffList',
            'auth' => true,
            'url' => '/Staff/getStaffList',
            'param' => array(
                'hotelid' => array(
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
        'SF002' => array(
            'name' => 'Reset pin for user',
            'method' => 'getStaffList',
            'auth' => true,
            'url' => '/Staff/resetUserPin',
            'param' => array(
                'token' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
    );

    /**
     * @param $interfaceId
     * @param string $configKey
     * @return bool|mixed
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
