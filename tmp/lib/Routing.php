<?php

class Routing {

    public static function redirect($mod, array $param, $exit = false){
        $var = http_build_query($param);
        $url = Config::$rootAddr.$mod.'.php';
        if($var != ''){
            $url .= '?'.$var;
        }
        header('Location: '.$url);
        if($exit) exit;
    }

}