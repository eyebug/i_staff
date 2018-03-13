<?php

/**
 * Sign system
 */
class SignController extends \BaseController
{

    const SPORTS = array(
        'gym' => array(
            'Chest Press' => 'chest_press',
            'Shoulder Press' => 'shoulder_press',
            'Lat Pulldown' => 'lat_pulldown',
            'Leg Extension' => 'leg_extension',
            'Seated Leg Curl' => 'seated_leg_curl',
            'AB Crunch Bench' => 'ab_crunch_bench',
            'Fitness Bench' => 'fitness_bench',
            'Hammer Strength' => 'hammer_strength',
            'Total Body Trainer' => 'total_body_trainer',
            'Shock Absorption System' => 'shock_absorption_system',
            'Cycle Machine' => 'cycle_machine',
        ),

        'swimming' => array(
            'Swimming pool' => 'swimming_pool',
            'Children\'s pool' => 'children_pool',
            'Jacuzzi' => 'jacuzzi',
            'Sauna' => 'sauna',
        )
    );

    /**
     * @var Convertor_Sign
     */
    private $_signConvertor;

    public function init()
    {
        parent::init();
        $this->_signConvertor = new Convertor_Sign();
    }

    /**
     * Index page
     */
    public function indexAction()
    {
        $this->_view->display('sign/index.phtml');
    }


    public function swimmingAction()
    {
        $this->_view->assign('gyms', self::SPORTS['swimming']);
        $this->_view->display('sign/gym.phtml');
    }

    public function gymAction()
    {
        $this->_view->assign('gyms', self::SPORTS['gym']);
        $this->_view->display('sign/gym.phtml');
    }

    public function reportAction()
    {
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

        $params['hotelid'] = $this->getHotelId();
        $params['groupid'] = $this->getGroupId();

        $sports = array();
        foreach (self::SPORTS as $type => $items) {
            foreach (array_values($items) as $key) {
                if (!is_null($this->getPost($key))) {
                    $sports[] = $key;
                    $params['type'] = $type;
                }
            }
        }
        $params['sports'] = implode(',', $sports);

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
            'type' => trim($this->getPost('type')),
        );
        $this->getPageParam($paramList);
        $data = $model->getSignList($paramList);
        $result = $this->_signConvertor->signListConvertor($data);
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
        $result = $signConvertor->signListExportConvertor($data, $paramList);

        $fileName = 'hotelSignUpReport';
        $fileNameParams = array();
        $paramList['type'] && $fileNameParams[] = $paramList['type'];
        $paramList['start'] && $fileNameParams[] = $paramList['start'];
        $paramList['end'] && $fileNameParams[] = $paramList['end'];
        $fileName .= ($fileNameParams ? '_' . implode("_", $fileNameParams) : '');
        Util_Tools::csv_export($result['list'], $result['title'], $fileName);
    }
}
