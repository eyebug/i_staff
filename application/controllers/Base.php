<?php

/**
 * 基础控制器
 */
class BaseController extends \Yaf_Controller_Abstract {

    /**
     * 登录管理员信息
     */
    protected $userInfo;

    public function init() {
        $this->setPageWebConfig();
        $this->userInfo = Yaf_Registry::get('loginInfo');
        $this->setPageHeaderInfo($this->userInfo);
        $this->setPermission($this->userInfo);
        $this->setHotelLanguage($this->userInfo);
    }

    /**
     * 获取物业Id
     */
    protected function getHotelId() {
        return $this->userInfo['hotelid'];
    }

    /**
     * 获取集团ID
     */
    protected function getGroupId() {
        return $this->userInfo['groupid'];
    }

    /**
     * 设置页面变量
     */
    private function setPageWebConfig() {
        $sysConfig = Yaf_Registry::get('sysConfig');
        $webConfig['layoutPath'] = $sysConfig->application->layout->directory;
        $webConfig['domain'] = $sysConfig->web->domain;
        $webConfig['imgDomain'] = $sysConfig->web->img_domain;
        $webConfig['assertPath'] = $sysConfig->web->assert_path;
        $webConfig['defaultIcon'] = $sysConfig->web->img_domain . 'img/temp/noImageIcon.jpg';
        $this->getView()->assign('webConfig', $webConfig);
    }

    /**
     * 设置头部信息
     */
    private function setPageHeaderInfo($loginInfo) {
        $headerInfo['userName'] = $loginInfo['lname'] ? $loginInfo['lname'] : "";
        $headerInfo['adminPermission'] = $loginInfo['createAdmin'] ? 0 : 1;
        $useLangugae = Enum_Lang::getSystemLang();
        $languageNameList = Enum_Lang::getLangeNameList();
        $headerInfo['useLanguage'] = $useLangugae;
        $headerInfo['useLanguageShow'] = $languageNameList[$useLangugae];
        $this->getView()->assign('headerInfo', $headerInfo);
    }

    /**
     * 设置权限
     */
    private function setPermission($loginInfo) {
        $permissionList = explode(",", $loginInfo['permission']);
        $this->_view->assign('permssionList', $permissionList);
    }

    /**
     * 设置物业语言
     */
    private function setHotelLanguage($loginInfo) {
        $this->_view->assign('hotelLanguageList', explode(',', $loginInfo['hotelLanguage']));
    }

    /**
     * 输出json
     *
     * @param array $data
     */
    public function echoJson($data) {
        $response = $this->getResponse();
        $response->setHeader('Content-type', 'application/json');
        $response->setBody(json_encode($data));
    }

    /**
     * 获取分页参数
     *
     * @param array $paramList
     *            传入引用
     */
    public function getPageParam(&$paramList) {
        $page = $this->_request->getPost('page');
        $limit = $this->_request->getPost('limit');
        $paramList['page'] = empty($page) ? 1 : $page;
        $paramList['limit'] = empty($limit) ? 5 : $limit;
    }

    /**
     * 跳转404
     */
    protected function jump404() {
        header('Location:/error/notfound');
        exit();
    }

    /**
     * 获取GET
     *
     * @param string $key
     *            GET的key，为空返回整个$_GET
     * @param string $isJsonStr
     *            是否为json字符串，json字符串还原防注入的转译
     */
    protected function getGet($key = "", $isJsonStr = false) {
        if ($key) {
            if ($this->getRequest()->getParam($key)) {
                return $this->getRequest()->getParam($key);
            }
            if ($isJsonStr) {
                return Util_Http::revertInject($_GET[$key]);
            }
            return $_GET[$key];
        } else {
            return $_GET;
        }
    }

    /**
     * 获取POST
     *
     * @param string $key
     *            POST的key，为空返回整个$_POST
     * @param string $isJsonStr
     *            是否为json字符串，json字符串还原防注入的转译
     */
    protected function getPost($key = "", $isJsonStr = false) {
        if ($key) {
            if ($isJsonStr) {
                return Util_Http::revertInject($_POST[$key]);
            }
            return $_POST[$key];
        } else {
            return $_POST;
        }
    }

    /**
     * 设置允许上传文件类型
     */
    protected function setAllowUploadFileType($type, $pageKey) {
        $baseModel = new BaseModel();
        $allowType = $baseModel->getAllowUploadFileType($type);
        $this->_view->assign($pageKey, array_keys($allowType['data']['list']));
    }

    public function makeOssKeyAction() {
        $ossModel = new OssModel();
        $ossKey = $ossModel->makeOssKey();
        echo json_encode($ossKey);
    }
}
