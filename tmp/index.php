<?php
include __DIR__.'/loader.php';

$app = new App();

$action = isset($_GET['p']) ? $_GET['p'] : null;

switch($action){

    case 'login':{    
        if(Session::is('admin')){
            Routing::redirect('index', ['p' => 'dashboard']);
        } else {
            View::render('login');
        }
    }break;

    case 'dashboard':{
        if(Session::is('admin')){
            View::render('dashboard');
        } else {
            Routing::redirect('index', ['p' => 'login']);
        }
    }break;

}