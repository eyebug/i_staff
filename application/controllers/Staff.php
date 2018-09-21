<?php


class StaffController extends \BaseController {


    public function init()
    {
        parent::init();
        $this->initHotelList($this->userInfo);
    }

    public function scheduleAction() {

        $this->_view->assign('id', $this->getStaffId());
        $this->_view->display('app/staff.phtml');
    }

    /**
     * 体验购物管理
     */
    public function historyMessageAction() {
        $userModel = new UserModel();
        $userList = $userModel->getList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('userList', $userList['data']['list']);
        $platform = $userModel->getPlatformList();
        $this->_view->assign('platform', $platform);
        $this->_view->display('staff/staff_message.phtml');
    }

    /**
     * 体验购物订单管理
     */
    public function orderAction() {
        $shoppingModel = new ShoppingModel();
        $staffModel = new StaffModel();

        $staffList = $staffModel->getStaffList(array(
            'hotelid' => $this->getHotelId(),
        ));
        $shoppingList = $shoppingModel->getShoppingList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('shoppingList', $shoppingList['data']['list']);

        $filterList = $shoppingModel->getShoppingOrderFilterList(array('hotelid' => $this->getHotelId()), 3600);

        $this->_view->assign('staffList', $staffList['data']);
        $this->_view->assign('userId', $this->userInfo['id']);
        $this->_view->assign('userName', $this->userInfo['lname']);
        $this->_view->assign('userList', $filterList['data']['userlist']);
        $this->_view->assign('statusList', $filterList['data']['statuslist']);
        $this->_view->assign('noDeliver', false);

        $this->_view->display('shopping/order.phtml');
    }
}
