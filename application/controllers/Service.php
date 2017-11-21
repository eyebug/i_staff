<?php

/**
 * Controller for interactive service
 */
class ServiceController extends \BaseController {

    /**
     * Get shopping order list and control panel
     */
    public function robotShoppingAction() {
        $shoppingModel = new ShoppingModel();
        $shoppingList = $shoppingModel->getShoppingList(array(
            'hotelid' => $this->getHotelId(),
            'status' => 1,
            'nopage' => true, //no pagination as we need to list all the shopping in the filter field
        ), 0);
        $filterList = $shoppingModel->getShoppingOrderFilterList(array('hotelid' => $this->getHotelId()), 3500);
        $this->_view->assign('shoppingList', $shoppingList['data']['list']);
        $this->_view->assign('userList', $filterList['data']['userlist']);
        $this->_view->assign('statusList', $filterList['data']['statuslist']);
        $this->_view->assign('descArray', $shoppingModel::getRobotDest($this->getHotelId()));
        $this->_view->display('service/order.phtml');
    }

    public function gsmOrderAction()
    {
        $userInfo = $this->userInfo;
        $this->_view->assign('serviceUrl', $userInfo['serviceUrl']);
        $this->_view->display('service/gsm_order.phtml');
    }

    public function robotGuideAction()
    {
        $this->_view->display('service/robot_guide.phtml');
    }

    public function historyMessageAction()
    {
        $this->_view->display('service/history_message.phtml');
    }

    public function robotPositionAction{
        $robotModel = new
    }

    /**
     * Call the robot to the specified destination
     */
    public function callRobotAction()
    {

        $dest = intval($this->getPost('dest'));
        $hotelId = $this->getHotelId();

        try {
            $paramList = array(
                'dest' => $dest,
                'hotelid' => $hotelId,
                'userid' => $this->userInfo['id']
            );
            $shoppingModel = new ShoppingModel();
            $result = $shoppingModel->callRobot($paramList);
            if ($result['code'] == 0) {
                $result['data']['msg'] = Enum_Lang::getPageText('shopping', 'robotontheway');
            }
        } catch (Exception $e) {
            $result = array(
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'data' => array()
            );
        }

        $this->echoJson($result);
    }

    /**
     * Deliver the items to the guest's room from the start position
     */
    public function deliverRobotAction()
    {

        $itemList = $this->getPost('itemList');
        $dest = intval($this->getPost('start'));
        $hotelId = $this->getHotelId();

        try{
            $paramList = array(
                'start' => $dest,
                'hotelid' => $hotelId,
                'itemlist' => $itemList,
                'userid' => $this->userInfo['id']
            );
            $shoppingModel = new ShoppingModel();
            $result = $shoppingModel->deliverRobot($paramList);

            if ($result['code'] == 0) {
                $result['data']['msg'] = Enum_Lang::getPageText('shopping', 'robotontheway');
            }
        }catch (Exception $e) {
            $result = array(
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'data' => array()
            );
        }

        $this->echoJson($result);
    }




}
