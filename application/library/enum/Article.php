<?php

class Enum_Article {

    const ARTICLE_TYPE_ACTIVITY = 'activity';
    const ARTICLE_TYPE_FLOOR = 'floor';
    const ARTICLE_TYPE_FACILITIES = 'facilities';
    const ARTICLE_TYPE_TRAFFIC = 'traffic';
    const ARTICLE_TYPE_ROOMRES = 'roomRes';
    const ARTICLE_TYPE_ROOMTYPE = 'roomType';
    const ARTICLE_TYPE_SHOPPING = 'shopping';
    const ARTICLE_TYPE_ASCOTT = 'ascott';
    const ARTICLE_TYPE_POI = 'poi';
    const ARTICLE_TYPE_PROMOTION = 'promotion';
    const ARTICLE_TYPE_NEWS = 'news';
    const ARTICLE_TYPE_NOTIC = 'notic';

    private static $articleTypeList = array(
        self::ARTICLE_TYPE_ACTIVITY => array(
            'interfaceId' => 'GA007',
            'field' => 'article_lang'
        ),
        self::ARTICLE_TYPE_FLOOR => array(
            'interfaceId' => 'GH005',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_FACILITIES => array(
            'interfaceId' => 'GH008',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_TRAFFIC => array(
            'interfaceId' => 'GH011',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_ROOMRES => array(
            'interfaceId' => 'R003',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_ROOMTYPE => array(
            'interfaceId' => 'R006',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_SHOPPING => array(
            'interfaceId' => 'GS007',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_ASCOTT => array(
            'interfaceId' => 'LI006',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_POI => array(
            'interfaceId' => 'PT006',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_PROMOTION => array(
            'interfaceId' => 'P006',
            'field' => 'article_lang'
        ),
        self::ARTICLE_TYPE_NEWS => array(
            'interfaceId' => 'NT006',
            'field' => 'article_lang'
        ),
        self::ARTICLE_TYPE_NOTIC => array(
            'interfaceId' => 'N006',
            'field' => 'article_lang'
        ),
    );

    public static function getArticleTypeList() {
        return self::$articleTypeList;
    }
}

?>