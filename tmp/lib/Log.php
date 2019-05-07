<?php

class Log {

    public static function save($message, $type = 'log'){
        $message = '['.date('Y/m/d H:i:s').'] '.$message."\n";
        $path = __DIR__.'/../log/'.$type.'.log';
        if(file_exists($path)){
            file_put_contents($path, $message, FILE_APPEND);
        } else {
            file_put_contents($path, $message);
        }
    }

}