<?php

/**
 * Class ServiceAjaxController
 */
class ServiceAjaxController extends \BaseController
{

    /**
     * @var ShoppingModel
     */
    private $shoppingModel;


    public function init()
    {
        parent::init();
        $this->shoppingModel = new ShoppingModel();
    }

    /**
     * Send robot back to charging point
     */
    public function robotBackAction()
    {

        $productId = $this->getPost('productid');

        try {
            $paramList = array(
                'hotelid' => $this->getHotelId(),
                'userid' => $this->userInfo['id'],
                'productid' => $productId
            );

            $result = $this->shoppingModel->robotBack($paramList);
            if ($result['code'] == 0) {
                $result['data']['msg'] = Enum_Lang::getPageText('shopping', 'robotBack');
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

    public function robotSendAction()
    {
        $params = array();
        $params['start'] = $this->getPost('start');
        $params['dest'] = $this->getPost('dest');

        try {
            $model = new RobotModel();
            $result = $model->robotSend($params);
        } catch (Exception $e) {
            $result = array(
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'data' => array()
            );
        }
        $this->echoJson($result);
    }

    public function getRobotSendListAction()
    {
        $params = array();
        $params['id'] = $this->getPost('id');
        $params['room_no'] = trim($this->getPost('room'));
        $params['hotelid'] = $this->getHotelId();
        $params['status'] = $this->getPost('status');
        if ($params['status'] == 'all') {
            unset($params['status']);
        }
        $params['page'] = intval($this->getPost('page'));
        $params['limit'] = intval($this->getPost('limit'));

        try {
            $model = new RobotModel();
            $convertor = new Convertor_Robot;
            $data = $model->getRobotSendList($params);
            $result = $convertor->robotSendList($data);
        } catch (Exception $e) {
            $result = array(
                'code' => $e->getCode(),
                'msg' => $e->getMessage(),
                'data' => array()
            );
        }
        $this->echoJson($result);
    }

}
