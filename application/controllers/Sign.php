<?php

/**
 * Sign system
 */
class SignController extends \BaseController
{
    /**
     * @var Convertor_Sign
     */
    private $_signConvertor;

    /**
     * @var SignModel
     */
    private $_signModel;

    const SWITCH_LANG = array(
        Enum_Lang::LANG_KEY_CHINESE => 'Switch Language',
        Enum_Lang::LANG_KEY_ENGLISH => '切换语言'
    );

    public function init()
    {
        parent::init();
        $this->initHotelList($this->userInfo);
        $this->_signConvertor = new Convertor_Sign();
        $this->_signModel = new SignModel();
        $this->_view->assign('switchLang', static::SWITCH_LANG[Enum_Lang::getSystemLang()]);
    }

    private function _getHotelId()
    {
        $result = intval($this->getGet('hotelid'));
        if ($result <= 0) {
            $result = intval($this->getPost('hotelid'));
        }
        if ($result <= 0) {
            $propertyId = intval($this->getGet('propertyid'));
            $model = new HotelModel();
            $list = $model->getHotelList(array('propertyinterfid' => $propertyId));
            foreach ($list['data']['list'] as $row) {
                if ($row['groupid'] != 3) {//skip test groups
                    $result = $row['id'];
                    break;
                }
            }
        }
        if ($result <= 0) {
            $result = $this->getHotelId();
        }
        return $result <= 0 ? -1 : $result;
    }

    /**
     * Index page
     */
    public function indexAction()
    {
        $params = array(
            'hotelid' => $this->_getHotelId(),
            'status' => 0,
            'limit' => 0
        );

        $signCategories = $this->_signModel->getSignCategoryList($params);
        $categories = $this->_signConvertor->signCategoryConvertor($signCategories);

        $hotelModel = new HotelModel();
        $hotel = $hotelModel->getHotelDetail($this->_getHotelId());
        $hotelName = $hotel['data']['list'][0]['name_lang'.Enum_Lang::getSystemLang(true)];

        $this->_view->assign('categories', $categories);
        $this->_view->assign('hotelid', $this->_getHotelId());
        $this->_view->assign('hotelName', $hotelName);
        $this->_view->display('sign/index.phtml');
    }

    public function itemAction()
    {
        $params = array();
        $params['category_id'] = intval($this->getGet('id'));
        $params['hotelid'] = $this->_getHotelId();
        $params['status'] = 0;
        $params['limit'] = 0;
        $data = $this->_signModel->getItemList($params);
        $items = $this->_signConvertor->signItemConvertor($data);

        $hotelModel = new HotelModel();
        $hotel = $hotelModel->getHotelDetail($this->_getHotelId());
        $hotelName = $hotel['data']['list'][0]['name_lang'.Enum_Lang::getSystemLang(true)];

        $this->_view->assign('category_id', intval($params['category_id']));
        $this->_view->assign('hotelid', $this->_getHotelId());
        $this->_view->assign('hotelName', $hotelName);

        $this->_view->assign('items', $items);
        $this->_view->display('sign/gym.phtml');
    }

    public function reportAction()
    {
        $data = $this->_signModel->getSignCategoryList(array(
            'hotelid' => $this->getHotelId(),
            'status' => 0,
            'limit' => 0
        ));
        $categories = $this->_signConvertor->signCategoryConvertor($data);
        $this->_view->assign('categories', $categories);
        $this->_view->display('sign/report.phtml');
    }


    public function doSignAction()
    {

        $model = new UserModel();
        $params = array();
        $params['lock_no'] = trim($this->getPost('lock'));
        $params['num'] = intval($this->getPost('num'));
        $params['room_no'] = trim($this->getPost('room'));
        $params['lastname'] = trim($this->getPost('lastname'));
        $params['start_time'] = trim($this->getPost('start_time'));
        $params['end_time'] = trim($this->getPost('end_time'));
        $params['type'] = intval($this->getPost('type'));
        $params['sports'] = $this->getPost('items');

        $params['hotelid'] = $this->_getHotelId();
        $params['groupid'] = $this->getGroupId();

        $result = $model->sign($params);
        $this->echoJson($result);
    }

    public function getSignListAction()
    {
        $model = new UserModel();
        $paramList = array(
            'hotelid' => intval($this->getHotelId()),
            'start' => trim($this->getPost('start')),
            'end' => trim($this->getPost('end')),
            'type' => intval($this->getPost('type')),
        );
        $this->getPageParam($paramList);
        $data = $model->getSignList($paramList);
        $items = $this->_signModel->getItemList(array('hotelid' => $this->getHotelId()));
        $categories = $this->_signModel->getSignCategoryList(array('hotelid' => $this->getHotelId()));
        $result = $this->_signConvertor->signListConvertor($data, $items['data']['list'], $categories['data']['list']);
        $this->echoJson($result);
    }

    public function exportAction()
    {
        $model = new UserModel();
        $signConvertor = new Convertor_Sign();
        $paramList = array(
            'hotelid' => intval($this->getHotelId()),
            'start' => trim($this->getGet('start')),
            'end' => trim($this->getGet('end')),
            'type' => trim($this->getGet('type')),
            'limit' => 0,
        );

        $data = $model->getSignList($paramList);
        $items = $this->_signModel->getItemList(array(
            'hotelid' => $this->getHotelId(),
            'status' => 0,
            'category_id' => $paramList['type'],
            'limit' => 0
        ));
        $categories = $this->_signModel->getSignCategoryList(array(
            'hotelid' => $this->getHotelId(),
            'id' => $paramList['type'],
            'limit' => 0
        ));
        $result = $signConvertor->signListExportConvertor($data, $items['data']['list'], $categories['data']['list']);

        $fileName = 'hotelSignUpReport';
        $fileNameParams = array();
        $paramList['type'] && $fileNameParams[] = $paramList['type'];
        $paramList['start'] && $fileNameParams[] = $paramList['start'];
        $paramList['end'] && $fileNameParams[] = $paramList['end'];
        $fileName .= ($fileNameParams ? '_' . implode("_", $fileNameParams) : '');
        Util_Tools::csv_export($result['list'], $result['title'], $fileName);
    }
}
