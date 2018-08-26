<?php


class UserajaxController extends \BaseController {

    /**
     * @var UserModel
     */
    private $userModel;


    /**
     * @var Convertor_User
     */
    private $userConvertor;


    public function init()
    {
        parent::init();
        $this->userModel = new UserModel();
        $this->userConvertor = new Convertor_User();
    }

    /**
     * Get user list
     */
    public function getUserListAction()
    {
        $params = array();
        $params['id'] = intval($this->getPost('id'));
        $params['room'] = trim($this->getPost('room'));
        $params['lastname'] = trim($this->getPost('lastname'));
        $params['hotelid'] = $this->getHotelId();
        $this->getPageParam($params);

        $list = $this->userModel->getList($params);
        $data = $this->userConvertor->userListConvertor($list);
        $this->echoJson($data);
    }

    public function resetPinAction()
    {
        $params = array();

        $params['token'] = $this->getToken();
        $params['user_id'] = intval($this->getPost('user_id'));

        $staffModel = new StaffModel();
        $response = $staffModel->resetPin($params);

        $this->echoJson($response);

    }
}
