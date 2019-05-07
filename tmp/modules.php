<?php
include __DIR__.'/loader.php';

$app = new App();

$action = SafeArray::get($_GET, ['action']);

switch($action){
    case 'login':{
        include __DIR__.'/form/Login.php';
        $loginForm = new LoginForm($_POST);
        if($loginForm->valid == false) {
            Routing::redirect('index', ['p' => 'login']);
            exit;
        }
        $db = ORM::forTable('admin')
        ->where([
            'login' => $loginForm->data->login,
            'password' => $loginForm->data->password
            ])
            ->findOne();
        if(isset($db->id)){
            Session::set('admin');
            Routing::redirect('index', ['p' => 'dashboard']);
        } else {
            Routing::redirect('index', ['p' => 'login']);
        }
    }break;

    case 'logout':{
        Session::remove('admin');
        Routing::redirect('index', ['p' => 'login']);
    }break;

}