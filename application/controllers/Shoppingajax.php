<?php

/**
 * 体验购物请求控制器
 */
class ShoppingajaxController extends \BaseController {

    /**
     * @var ShoppingModel
     */
    private $shoppingModel;

    /**
     * @var Convertor_Shopping
     */
    private $shoppingConvertor;

    public function init() {
        parent::init();
        $this->shoppingModel = new ShoppingModel();
        $this->shoppingConvertor = new Convertor_Shopping();
    }

    /**
     * 获取tag列表
     */
    public function getTagListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $result = $this->shoppingModel->getTagList($paramList);
        $result = $this->shoppingConvertor->shoppingTagListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑tag信息数据
     */
    private function handlerTagSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    /**
     * 新建tag信息
     */
    public function createTagAction() {
        $paramList = $this->handlerTagSaveParams();
        $result = $this->shoppingModel->saveTagDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新tag信息
     */
    public function updateTagAction() {
        $paramList = $this->handlerTagSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->shoppingModel->saveTagDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 获取体验购物列表
     */
    public function getShoppingListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['tagid'] = intval($this->getPost('tag'));
        $paramList['title'] = $this->getPost('title');
        $status = $this->getPost('status');
        $status !== 'all' && !is_null($status) ? $paramList['status'] = intval($status) : false;
        $result = $this->shoppingModel->getShoppingList($paramList);
        $result = $this->shoppingConvertor->shoppingListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑体验购物信息
     */
    private function handlerShoppingSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['introduct_lang1'] = trim($this->getPost("introductLang1"));
        $paramList['introduct_lang2'] = trim($this->getPost("introductLang2"));
        $paramList['introduct_lang3'] = trim($this->getPost("introductLang3"));
        $paramList['price'] = intval($this->getPost("price"));
        $paramList['tagid'] = intval($this->getPost("tagid"));
        $paramList['pic'] = $_FILES['pic'];
        $paramList['hotelid'] = intval($this->getHotelId());
        $paramList['pdf'] = $_FILES['pdf'];
        $paramList['video'] = trim($this->getPost("video"));
        $paramList['sort'] = intval($this->getPost("sort"));
        $paramList['status'] = intval($this->getPost("status"));
        return $paramList;
    }

    /**
     * 新建体验购物
     */
    public function createShoppingAction() {
        $paramList = $this->handlerShoppingSaveParams();
        $result = $this->shoppingModel->saveShoppingDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新体验购物
     */
    public function updateShoppingAction() {
        $paramList = $this->handlerShoppingSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->shoppingModel->saveShoppingDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 获取体验购物订单列表
     */
    public function getOrderListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['limit'] = $this->getPost('limit');
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['shoppingid'] = intval($this->getPost('shoppingid'));
        $paramList['userid'] = intval($this->getPost('userid'));
        $paramList['status'] = intval($this->getPost('status'));
        $paramList['hotelid'] = intval($this->getHotelId());
        $result = $this->shoppingModel->getOrderList($paramList);
        $result = $this->shoppingConvertor->orderListConvertor($result, false);
        $this->echoJson($result);
    }
}
