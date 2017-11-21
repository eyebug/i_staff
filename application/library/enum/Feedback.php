<?php

class Enum_Feedback {

    const QUESTION_TYPE_INPUT = 1;
    const QUESTION_TYPE_SELECT = 2;
    const QUESTION_TYPE_MUILT = 3;

    public static function getFeedbackQuestionTypeNameKey() {
        return array(
            self::QUESTION_TYPE_INPUT => 'questiontypeinput',
            self::QUESTION_TYPE_SELECT => 'questiontypeselect',
            self::QUESTION_TYPE_MUILT => 'questiontypemuilt',
        );
    }

    public static function getFeedbackListMustInput() {
        return array(
            'name',
        );
    }

    public static function getFeedbackMustInput() {
        return array(
            'listid',
            'question',
        );
    }
}

?>