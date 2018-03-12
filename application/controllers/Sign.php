<?php

/**
 * Sign system
 */
class SignController extends \BaseController
{

    const GYMS = array(
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
    );

    const SWIMMINGS = array(
        'Swimming pool' => 'swimming_pool',
        'Children\'s pool' => 'children_pool',
        'Jacuzzi' => 'jacuzzi',
        'Sauna' => 'sauna',
    );

    /**
     * Index page
     */
    public function indexAction()
    {
        $this->_view->display('sign/index.phtml');
    }


    public function swimmingAction()
    {
        $this->_view->assign('gyms', self::SWIMMINGS);
        $this->_view->display('sign/gym.phtml');
    }

    public function gymAction()
    {
        $this->_view->assign('gyms', self::GYMS);
        $this->_view->display('sign/gym.phtml');
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
        foreach (self::SWIMMINGS as $gym => $key) {
            if (!is_null($this->getPost($key))) {
                $sports[] = $key;
                $params['type'] = 'swimming';
            }
        }
        foreach (self::GYMS as $gym => $key) {
            if (!is_null($this->getPost($key))) {
                $sports[] = $key;
                $params['type'] = 'gym';
            }
        }
        $params['sports'] = implode(',', $sports);

        $result = $model->sign($params);
        $this->echoJson($result);
    }
}
