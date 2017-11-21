<?php

class Enum_Lang {

    /**
     * 中文key
     */
    const LANG_KEY_CHINESE = 'zh';
    /**
     * 英文key
     */
    const LANG_KEY_ENGLISH = 'en';

    /**
     * 获取语言名称列表
     */
    public static function getLangeNameList() {
        $langNameList = array(
            self::LANG_KEY_CHINESE => '中文',
            self::LANG_KEY_ENGLISH => 'English',
        );
        return $langNameList;
    }

    /**
     * 获取当前使用的语言
     */
    public static function getSystemLang() {
        $language = self::LANG_KEY_CHINESE;
        $cookieLanguage = Util_Http::getCookie('systemLang');
        $cookieLanguage && $language = $cookieLanguage;
        return $language;
    }

    /**
     * 设置使用的语言
     */
    public static function setSystemLang($language) {
        $expire = time() + 86400 * 365;
        return Util_Http::setCookie('systemLang', $language, $expire);
    }

    private static $languageFileCache = array();

    /**
     * 从语言文件获取文本信息
     */
    private static function getConstantText($language, $page, $key) {
        $languageFile = "Lang_" . ucwords($language) . '_' . ucwords($page);
        if (!self::$languageFileCache[$languageFile]) {
            $sysConfig = Yaf_Registry::get('sysConfig');
            $filePath = $sysConfig->application->directory . "/library/lang/{$language}/" . ucwords($page) . '.php';
            if (file_exists($filePath)) {
                $languageClass = new ReflectionClass($languageFile);
                self::$languageFileCache[$languageFile] = $languageClass->getConstants();
            }
        }
        $text = self::$languageFileCache[$languageFile][$key];
        return strval($text);
    }

    /**
     * 获取页面展示文本信息
     */
    public static function getPageText($page, $key) {
        $key = strtoupper($key);
        $language = self::getSystemLang();
        $text = self::getConstantText($language, $page, $key);
        if (empty($text) && $language != self::LANG_KEY_CHINESE) {
            $text = self::getConstantText(self::LANG_KEY_CHINESE, $page, $key);
        }
        $text = $text ? $text : '';
        return $text;
    }

    /**
     * 错误信息配置
     */
    private static $errorText = array(
        'login' => array(
            4 => 'login_namepasserror'
        ),
    );

    /**
     * 获取错误信息文本
     */
    public static function getErrorText($errorLangKey, $code) {
        if ($code == 1) {
            $errorText = self::getPageText('system', 'systemError');
        } else {
            $errorInfo = self::$errorText[$errorLangKey][$code];
            if ($errorInfo) {
                $errorInfoList = explode('_', $errorInfo);
                $errorText = self::getPageText($errorInfoList[0], $errorInfoList[1]);
            }
        }
        return $errorText;
    }
}