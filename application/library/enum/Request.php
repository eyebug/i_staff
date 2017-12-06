<?php

/**
 * 用户枚举
 * @author ZXM
 * 2015年7月13日
 */
class Enum_Request {

    const RPC_REQUEST_UA = "Iservice/1.0(iam;)";

    public static function getUrlConfigById($interfaceId) {
        $config = array(
            'B' => 'Rpc_UrlConfigBase',
            'AU' => 'Rpc_UrlConfigAdmin',
            'GH' => 'Rpc_UrlConfigHotel',
            'GA' => 'Rpc_UrlConfigActivity',
            'APP' => 'Rpc_UrlConfigApp',
            'LI' => 'Rpc_UrlConfigLife',
            'R' => 'Rpc_UrlConfigRoom',
            'GS' => 'Rpc_UrlConfigShopping',
            'GSH' => 'Rpc_UrlConfigShowing',
            'F' => 'Rpc_UrlConfigFeedback',
            'T' => 'Rpc_UrlConfigTel',
            'P' => 'Rpc_UrlConfigPromotion',
            'PT' => 'Rpc_UrlConfigPoi',
            'NT' => 'Rpc_UrlConfigNews',
            'N' => 'Rpc_UrlConfigNotic',
            'U' => 'Rpc_UrlConfigUser',
            'C' => 'Rpc_UrlConfigComment',
            'RT' => 'Rpc_UrlConfigRobot',
            'SF' => 'Rpc_UrlConfigStaff',
        );
        $fileKey = preg_replace('/\d+/', '', $interfaceId);
        $fileNameKey = $config[$fileKey];
        if (empty($fileNameKey)) {
            return false;
        }
        $interfaceConfig = $fileNameKey::getConfig($interfaceId);
        if ($interfaceConfig) {
            return $interfaceConfig;
        } else {
            return false;
        }
    }
}
