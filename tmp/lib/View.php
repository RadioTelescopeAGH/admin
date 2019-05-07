<?php

class View {

    public static $app;

    public static function render($templatePath, $exit = true){
        echo self::$app->twig->render($templatePath.'.twig');
        if($exit) exit;
    }

}