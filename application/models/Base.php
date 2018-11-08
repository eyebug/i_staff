<?php

class BaseModel {

    protected $rpcClient;

    protected $limit;

    protected $partnerId;

    public function __construct() {
        $this->rpcClient = Rpc_HttpDao::getInstance();
        $this->limit = 5;
        $userInfo = Yaf_Registry::get('loginInfo');
        $this->partnerId = $userInfo['partnerId'];
    }

    protected function initParam($paramList = array()) {
        return $paramList;
    }

    /**
     * 设置分页
     *
     * @param array $param
     * @param int $page
     * @param int $limit
     * @param number $limitDefault
     */
    protected function setPageParam(&$params, $page, $limit, $limitDefault = 4) {
        if ($limit !== 0) {
            $limit = intval($limit);
            $params['limit'] = $limit ? $limit : $limitDefault;
            $params['page'] = empty($page) ? 1 : intval($page);
        } else {
            $params['limit'] = 0;
        }
    }

    /**
     * 抛出异常
     * @param $name
     * @param $code
     * @throws Exception
     */
    protected function throwException($name, $code) {
        throw new Exception($name, $code);
    }

    /**
     * 获取可用的语言列表
     * @return array
     */
    public function getLanguageList() {
        $result = $this->rpcClient->getResultRaw('B001', array(), true, 3600 * 12);
        $languageList = $result['code'] ? array() : $result['data']['list'];
        return $languageList;
    }

    /**
     * Handle file
     *
     * @param array|string $file
     * @param string $path file type
     * @param string $oldFileKey
     * @return mixed
     */
    public function uploadFile($file, $path, $oldFileKey = '') {
        $result['code'] = 1;
        if (is_string($file) && !empty($file)) {
            //means remove the file
            $result = $this->deleteFile($file);
            if ($result['code'] == 0) {
                $result['data']['picKey'] = '';
            }
        } else {
            if ($file['error']) {
                switch ($file['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        $result['msg'] = '上传的文件超过大小限制：' . ini_get('upload_max_filesize');
                        break;
                }
            } else {
                $result = $this->rpcClient->getResultRaw('B003', array('uploadfile' => $file, 'type' => $path, 'oldfilekey' => $oldFileKey), false, -1, true, 100);
            }
        }
        return $result;
    }

    /**
     * Delete oss file
     *
     * @param $oldFileKey
     * @return mixed
     */
    public function deleteFile($oldFileKey)
    {
        $result['code'] = 1;
        $result = $this->rpcClient->getResultRaw('B006', array('filekey' => $oldFileKey));
        return $result;
    }

    /**
     * 获取允许上传的扩展名
     * @param $type 待上传的文件类型
     * @return array
     */
    public function getAllowUploadFileType($type) {
        $result = $this->rpcClient->getResultRaw('B004', array('type' => $type), true, 3600 * 3);
        return $result;
    }

    /**
     * 获取设备列表
     * @return array
     */
    public function getPlatformList() {
        $result = $this->rpcClient->getResultRaw('B005', array(), true, 3600 * 12);
        $languageList = $result['code'] ? array() : $result['data']['list'];
        return $languageList;
    }
}

?>