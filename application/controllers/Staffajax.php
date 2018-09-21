<?php


class StaffajaxController extends \BaseController
{

    /**
     * @var StaffModel
     */
    private $staffModel;


    /**
     * @var Convertor_Staff
     */
    private $staffConvertor;


    public function init()
    {
        parent::init();
        $this->staffModel = new StaffModel();
        $this->staffConvertor = new Convertor_Staff();
    }

    public function getStaffListAction()
    {
        $result = $this->staffModel->getStaffList(array(
            'id' => $this->getPost('id'),
            'limit' => $this->getPost('limit'),
            'page' => intval($this->getPost('page')),
        ));
        $result = $this->staffConvertor->staffListConvertor($result);
        $this->echoJson($result);
    }

    public function updateStaffScheduleAction()
    {
        $params = array();
        $params['id'] = $this->getPost('id');
        $params['schedule'] = $this->getPost('timelist');
        $params['washing_push'] = $this->getPost('washing');

        $result = $this->staffModel->updateStaffSchedule($params);
        $this->echoJson($result);
    }

    /**
     * 获取房间推送列表
     */
    public function getRoomPushListAction()
    {
        $appModel = new AppModel();
        $appConvertor = new Convertor_App();
        $paramList['id'] = $this->getPost('id');
        $paramList['page'] = $this->getPost('page');
        $paramList['limit'] = $this->getPost('limit');
        $paramList['staff_id'] = intval($this->getPost('id'));
        $paramList['type'] = Enum_App::PUSH_TYPE_STAFF;
        $paramList['content_type'] = Enum_App::PUSH_CONTENT_TYPE_URL;
        $paramList['dataid'] = intval($this->getStaffId());
        $result = $this->getPost('result');
        $result !== 'all' && !is_null($result) ? $paramList['result'] = intval($result) : false;
        $platform = $this->getPost('platform');
        $platform !== 'all' && !is_null($platform) ? $paramList['platform'] = intval($platform) : false;
        $result = $appModel->getPushList($paramList);
        $result = $appConvertor->staffPushListConvertor($result, $paramList['staff_id']);
        $this->echoJson($result);
    }
}
