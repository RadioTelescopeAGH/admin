<?php

class App{

    public $twig;

    public function __construct(){
        $loader = new Twig_Loader_Filesystem(Config::$pathToTemplate);
        $config = [];
        if(Config::$cacheTwig){
            $config['cache'] = Config::$pathToTemplateCache;
        }
        $this->twig = new Twig_Environment($loader, $config);

        ORM::configure('mysql:host='.Config::$dbHost.';dbname='.Config::$dbName);
        ORM::configure('username', Config::$dbUser);
        ORM::configure('password', Config::$dbPass);

        View::$app = $this;
    }

}