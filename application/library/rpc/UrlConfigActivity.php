<?php

class Rpc_UrlConfigActivity {

    private static $config = array(
        'GA001' => array(
            'name' => '获取活动列表',
            'method' => 'getActivityList',
            'auth' => true,
            'url' => '/activity/getActivityList',
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
                )
            )
        ),
        'GA002' => array(
            'name' => '获取活动报名列表',
            'method' => 'getActivityOrderList',
            'auth' => true,
            'url' => '/activityOrder/getActivityOrderList',
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
                'activityid' => array(
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
        'GA003' => array(
            'name' => '获取活动TAG列表',
            'method' => 'getActivityTagList',
            'auth' => true,
            'url' => '/ActivityTag/getActivityTagList',
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
        'GA004' => array(
            'name' => '新建活动TAG',
            'method' => 'addActivityTag',
            'auth' => true,
            'url' => '/ActivityTag/addActivityTag',
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
        'GA005' => array(
            'name' => '更新活动TAG',
            'method' => 'updateActivityTagById',
            'auth' => true,
            'url' => '/ActivityTag/updateActivityTagById',
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
        'GA006' => array(
            'name' => '新建活动',
            'method' => 'addActivity',
            'auth' => true,
            'url' => '/activity/addActivity',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'groupid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'tagid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
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
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'ordercount' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'fromdate' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'todate' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'GA007' => array(
            'name' => '更新活动',
            'method' => 'updateActivityById',
            'auth' => true,
            'url' => '/activity/updateActivityById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'sort' => array(
                    'required' => false,
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
                'article_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'article_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'article_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'ordercount' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'fromdate' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'todate' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'GA008' => array(
            'name' => '获取活动报名列表',
            'method' => 'getActivityOrderList',
            'auth' => true,
            'url' => '/activityOrder/getActivityOrderList',
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
                'activityid' => array(
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
