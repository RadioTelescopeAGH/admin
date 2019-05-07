<?php
class Form {

    public $valid = true;
    public $data = [];

    public function check(&$value, $filtr){
        if(!$this->valid) return;
        $secArra = Validator::secInput($value, $filtr);
        if(!$secArra['ok']){
            $this->valid = false;
            return;
        }
        $value = $secArra['var'];
    }

    public function validIndex($data, $indexAll){
        foreach($indexAll as $index){
            if(!isset($data[$index])){ 
                $this->valid = false;
                return;
            }
        }
    }

    public function parseData($data, $indexAll){
        foreach($indexAll as $item){
            $this->data[$item] = $data[$item];
        }
        $this->data = (object)$this->data;
    }

}
?>