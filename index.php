<?php
//BRENDEN HASKINS 4/13/24: PHP controller, defines basic routes, dependencies, and starts f3.

//start session
session_start();

//error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//requirements
require_once('vendor/autoload.php');

//instantiate base F3 base class
$f3 = Base::instance();

//define default route
$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /personal', function(){
    $view = new Template();
    echo $view->render('views/personal.html');
});
//run fat free
$f3->run();