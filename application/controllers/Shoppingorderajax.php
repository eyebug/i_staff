<?php

/**
 * Class ShoppingOrderAjaxController
 */
class ShoppingOrderAjaxController extends \BaseController
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
     * Update shopping order
     */
    public function updateShoppingOrderAction()
    {
        $paramList = array();
        $paramList['id'] = intval($this->getPost('ordersproductsid'));
        $paramList['adminid'] = $this->userInfo['id'];
        $paramList['memo'] = trim($this->getPost('memo'));
        $paramList['status'] = intval($this->getPost('productstatus'));
        $result = $this->shoppingModel->updateShoppingOrder($paramList);
        $this->echoJson($result);
    }

}
