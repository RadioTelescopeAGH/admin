<?php
class LoginForm extends Form{

    public function __construct(&$data){
        $indexAll = ['login', 'password'];
        $this->validIndex($data, $indexAll);
        $this->check($data['login'], ['filtr' => '0', 'min' => 1, 'max' => 255]);
        $this->check($data['password'], ['filtr' => '0', 'min' => 1, 'max' => 255]);
        $this->parseData($data, $indexAll);
    }

}
?>