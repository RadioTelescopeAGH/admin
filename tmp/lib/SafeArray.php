<?php

class SafeArray{

    public static function get(&$array, $index, $default = null){
        if(!is_array($index)){
            $index = (array)$index;
        }
        $chunk = &$array;
        foreach($index as $item){
            if(isset($chunk[$item])){
                $chunk = &$chunk[$item];
            } else {
                return $default;
            }
        }
        
        return $chunk;
    }

    public static function set(&$array, $index, $val = ''){
        if(!is_array($index)){
            $index = (array)$index;
        }
        if(!is_array($array)){
            $array = (array)$array;
        }
        $chunk = &$array;
        foreach($index as $item){
            $chunk[$item] = null;
            $chunk = &$chunk[$item];
        }
        $chunk = $val;
    }

    public static function remove(&$array, $index){
        if(!is_array($index)){
            $index = (array)$index;
        }
        if(!is_array($array)){
            $array = (array)$array;
        }
        $chunk = &$array;
        $stop = count($index);
        $last = &$array;
        $last2 = [];
        for($i = 0; $i < $stop; $i++){
            $last2 = &$last;
            $last = &$chunk;
            $chunk = &$chunk[$index[$i]];
        }

        $last2[$index[$stop - 1]] = [];
        unset($last2[$index[$stop - 1]]);
    }

    public static function exist(&$array, $index){
        if(!is_array($index)){
            $index = (array)$index;
        }
        $chunk = &$array;
        foreach($index as $item){
            if(isset($chunk[$item])){
                $chunk = &$chunk[$item];
            } else {
                return false;
            }
        }

        return true;
    }

}