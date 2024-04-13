<?php
//BRENDEN HASKINS 4/13/24: PHP controller, defines basic routes, dependencies, and starts f3.

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
//run fat free
$f3->run();