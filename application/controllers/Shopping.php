<?php

/**
 * 体验购物控制器
 */
class ShoppingController extends \BaseController {

    public function tagAction() {
        $this->_view->display('shopping/tag.phtml');
    }

    /**
     * 体验购物管理
     */
    public function listAction() {
        $shoppingModel = new ShoppingModel();
        $tagList = $shoppingModel->getTagList(array('hotelid' => $this->getHotelId()), 3600 * 3);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_PDF, 'allowTypePdf');
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('shopping/shopping.phtml');
    }

    /**
     * 体验购物订单管理
     */
    public function orderAction() {
        $shoppingModel = new ShoppingModel();
        $shoppingList = $shoppingModel->getShoppingList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('shoppingList', $shoppingList['data']['list']);

        $filterList = $shoppingModel->getShoppingOrderFilterList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('userList', $filterList['data']['userlist']);
        $this->_view->assign('statusList', $filterList['data']['statuslist']);

        $this->_view->display('shopping/order.phtml');
    }
}
