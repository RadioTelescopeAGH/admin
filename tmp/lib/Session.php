<?php

class Session {

    public static function get($index){
        return SafeArray::get($_SESSION, $index);
    }

    public static function set($index, $val = ''){
        SafeArray::set($_SESSION, $index, $val);
    }

    public static function is($index){
        return SafeArray::exist($_SESSION, $index);
    }

    public static function clean(){
        session_unset();
    }

    public static function remove($index){
        SafeArray::remove($_SESSION, $index);
    }

}