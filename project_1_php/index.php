<?php

use App\Core\Database;
use App\Core\Router;

require_once __DIR__  .'/vendor/autoload.php';
require_once __DIR__  .'/app/Core/Router.php';
require_once __DIR__  .'/app/Core/Controller.php';
require_once __DIR__  .'/app/Core/Database.php';
require_once __DIR__  .'/helpers/helpers.php';

// AutoLoad 

spl_autoload_register(function($class){
    $class = str_replace('App\\','', $class);
    $path = __DIR__ . '/app/' . str_replace('\\', '/', $class) . '.php';
    if(file_exists($path)){
        require_once $path;
    }
});

// DB connection singleton 
$config = require __DIR__ . '/config.php';
Database::init($config);

//load API Routes 
$router = new Router();

$routerLoader = require __DIR__ . '/routes/api.php';
$routerLoader($router);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



