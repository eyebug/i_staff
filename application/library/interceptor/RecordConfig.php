<?php

class Interceptor_RecordConfig {

    private static $config = array(
        'Loginajax' => array(
            'moduleType' => 1,
            'action' => array(
                'dologin' => 1,
                'changepass' => 2
            )
        ),
        'Hotelajax' => array(
            'moduleType' => 2,
            'action' => array(
                'updatehotel' => 1,
                'createfloor' => 2,
                'updatefloor' => 3,
                'createfacilities' => 4,
                'updatefacilities' => 5,
                'createtraffic' => 6,
                'updatetraffic' => 7,
                'createpanoramic' => 8,
                'updatepanoramic' => 9,
                'createpic' => 10,
                'updatepic' => 11,
                'createtitle' => 12,
                'updatetitle' => 13,
            )
        ),
        'Activityajax' => array(
            'moduleType' => 3,
            'action' => array(
                'createtag' => 1,
                'updatetag' => 2,
                'createactivity' => 3,
                'updateactivity' => 4,
            )
        ),
        'Ascottajax' => array(
            'moduleType' => 4,
            'action' => array(
                'createtag' => 1,
                'updatetag' => 2,
                'create' => 3,
                'update' => 4,
            )
        ),
        'Poiajax' => array(
            'moduleType' => 5,
            'action' => array(
                'createtag' => 1,
                'updatetag' => 2,
                'create' => 3,
                'update' => 4,
            )
        ),
        'Promotionajax' => array(
            'moduleType' => 6,
            'action' => array(
                'createtag' => 1,
                'updatetag' => 2,
                'create' => 3,
                'update' => 4,
            )
        ),
        'Roomajax' => array(
            'moduleType' => 7,
            'action' => array(
                'createroomres' => 1,
                'updateroomres' => 2,
                'createroomtype' => 3,
                'updateroomtype' => 4,
                'updateroomtyperes' => 5,
                'createuserbill' => 6,
                'updateuserbill' => 7,
                'deleteuserbill' => 8,
            )
        ),
        'Shoppingajax' => array(
            'moduleType' => 8,
            'action' => array(
                'createtag' => 1,
                'updatetag' => 2,
                'createshopping' => 3,
                'updateshopping' => 4,
            )
        ),
        'Telajax' => array(
            'moduleType' => 9,
            'action' => array(
                'createteltype' => 1,
                'updateteltype' => 2,
                'createtel' => 3,
                'updatetel' => 4,
            )
        ),
        'Newsajax' => array(
            'moduleType' => 10,
            'action' => array(
                'createtag' => 1,
                'updatetag' => 2,
                'create' => 3,
                'update' => 4,
            )
        ),
        'Noticajax' => array(
            'moduleType' => 11,
            'action' => array(
                'createtag' => 1,
                'updatetag' => 2,
                'create' => 3,
                'update' => 4,
            )
        ),
        'Feedbackajax' => array(
            'moduleType' => 12,
            'action' => array(
                'createquestion' => 1,
                'updatequestion' => 2,
                'updateoption' => 3,
            )
        ),
        'Appajax' => array(
            'moduleType' => 13,
            'action' => array(
                'createpush' => 1,
                'createshortcut' => 2,
                'updateshortcut' => 3,
                'updateshare' => 4,
            )
        ),
    );

    /**
     * 获取拦截器配置
     *
     * @return array
     */
    public static function getConfig() {
        return self::$config;
    }
}

?>
