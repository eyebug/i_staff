<?php

class Enum_Room {

    public static function getRoomResMustInput() {
        return array(
            'icon',
            'titleLang1',
        );
    }

    public static function getRoomTypeMustInput() {
        return array(
            'titleLang1',
            'size',
        );
    }

    public static function getRoomMustInput() {
        return array(
            'room',
            'size',
        );
    }

    public static function getBillMustInput() {
        return array(
            'room',
            'name',
            'pdf',
            'date'
        );
    }
}

?>