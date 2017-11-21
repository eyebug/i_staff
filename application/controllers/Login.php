<?php

/**
 * 登录控制器
 */
class LoginController extends \BaseController {

    /**
     * 登陆页面
     */
    public function indexAction() {
        if (Auth_Login::checkLogin()) {
            Util_Tools::redirect("/");
        }
        $hotelModel = new HotelModel();
        $hotelList = $hotelModel->getHotelList(array(
            'status' => 1,
            'groupid' => array(1,3),
        ));
        $this->_view->assign('hotelList', $hotelList['data']['list']);
        $this->_view->display('login/index.phtml');
    }

    /**
     * 退出登陆
     */
    public function logoutAction() {
        $loginModel = new LoginModel();
        if ($loginModel->loginOut()) {
            Util_Tools::scriptRedirect('/Login');
        } else {
            Util_Tools::alert('退出登陆失败！');
        }
    }

    /**
     * 修改密码
     */
    public function changePassAction() {
        $this->_view->assign('userId', $this->userInfo['id']);
        $this->_view->display('login/changePass.phtml');
    }
}
