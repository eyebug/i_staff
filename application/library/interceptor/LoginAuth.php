<?php

class Interceptor_LoginAuth extends Interceptor_Base {

    /**
     * (non-PHPdoc) @see Interceptor_Base::before()
     */
    public function before(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
        if (! ($loginInfo = Auth_Login::checkLogin()) && !$this->isInWhiteList($request)) {
            if ($this->requestedWithXhr()) {
                $this->returnJson403();
            } else {
                Util_Tools::redirect('/login/');
            }
        }
    }

    // 有些外部回调可能未知agent 所以加禁用白名单
    private function isInWhiteList(Yaf_Request_Abstract $request) {
        $controllerName = strtolower($request->getControllerName());
        $actionName = strtolower($request->getActionName());

        // 多了放配置文件
        // 一定要小写
        $whiteList = array( // 方法名都小写
            'sign' => array(
                'index',
                'item',
                'dosign',
            ),
        );

        $flag = false;
        if (isset($whiteList[$controllerName]) && in_array($actionName, $whiteList[$controllerName])) {
            $flag = true;
        }

        return $flag;
    }

    /**
     * (non-PHPdoc) @see Interceptor_Base::after()
     */
    public function after(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
    }

    protected function denyAccess() {
        if ($this->requestedWithXhr()) {
            $this->returnJson403();
        } else {
            $this->returnHtml403();
        }
    }

    protected function requestedWithXhr() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
    }

    protected function returnJson403() {
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode(array(
            'code' => '403',
            'msg' => '禁止访问'
        ));
        exit();
    }

    protected function returnHtml403() {
        Util_Tools::redirect('/error/denyaccess');
    }
}

?>
