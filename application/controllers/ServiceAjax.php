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

}
