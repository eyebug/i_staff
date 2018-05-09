<?php

class Enum_Robot
{
    const ROBOT_WAITING = 1;
    const ROBOT_GOING = 2;
    const ROBOT_ARRIVED = 3;
    const ROBOT_FINISHED = 4;
    const ROBOT_GUEST_NOT_PUT = 5;
    const ROBOT_CANCELLED = 6;
    const ROBOT_BEGIN = 7;

    private static $sendRobotStatusList = array(
        self::ROBOT_WAITING => '待处理',
        self::ROBOT_GOING => '机器人已出发',
        self::ROBOT_ARRIVED => '到达客户房间',
        self::ROBOT_FINISHED => '已送达',
        self::ROBOT_GUEST_NOT_PUT => '客户未放入物品',
        self::ROBOT_CANCELLED => '取消送货',
        self::ROBOT_BEGIN => '任务派发',
    );

    public static function getStatusList()
    {
        return self::$sendRobotStatusList;
    }

}
