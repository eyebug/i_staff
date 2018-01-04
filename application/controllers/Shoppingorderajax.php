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
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['adminid'] = intval($this->getPost('adminid'));
        $paramList['status'] = intval($this->getPost('status'));
        $result = $this->shoppingModel->updateShoppingOrder($paramList);
        $this->echoJson($result);
    }

}
