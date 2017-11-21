<?php

class Rpc_UrlConfigNews {

    private static $config = array(
        'NT001' => array(
            'name' => '获取列表',
            'method' => 'getList',
            'auth' => true,
            'url' => '/news/getnewsList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'title' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'tagid' => array(
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
        'NT002' => array(
            'name' => '获取tag列表',
            'method' => 'getTagList',
            'auth' => true,
            'url' => '/newstag/getadmintaglist',
            'param' => array(
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
        'NT003' => array(
            'name' => '获取tag详情',
            'method' => 'getTagInfo',
            'auth' => true,
            'url' => '/newstag/gettagdetail',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'NT004' => array(
            'name' => '修改tag详情',
            'method' => 'updateTagInfo',
            'auth' => true,
            'url' => '/newstag/updatenewstagbyId',
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
            )
        ),
        'NT005' => array(
            'name' => '新增tag详情',
            'method' => 'addTagInfo',
            'auth' => true,
            'url' => '/newstag/addnewstag',
            'param' => array(
                'hotelid' => array(
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
            )
        ),
        'NT006' => array(
            'name' => '更新生活详情',
            'method' => 'get',
            'auth' => true,
            'url' => '/news/updatenewsbyid',
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
                'tagid' => array(
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
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'createtime' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'updatetime' => array(
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
            )
        ),
        'NT007' => array(
            'name' => '新增详情',
            'method' => 'addInfo',
            'auth' => true,
            'url' => '/news/addnews',
            'param' => array(
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
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'createtime' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'updatetime' => array(
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
