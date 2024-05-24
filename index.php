<?php
//BRENDEN HASKINS 4/13/24: PHP controller, defines basic routes, dependencies, and starts f3.

//requirements
require_once('vendor/autoload.php');

//start session
session_start();

//error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//instantiate base F3 base class
$f3 = Base::instance();

//init controller
$con = new Controller($f3);

//associate javascript
$f3->set('js_file','scripts/scripts.js');

//define default route
$f3->route('GET /', function(){
    $GLOBALS['con']->home();
});

$f3->route('GET|POST /personal', function($f3){
    $GLOBALS['con']->personal();
});

$f3->route('GET|POST /experience', function($f3){
    $GLOBALS['con']->experience();
});

$f3->route('GET|POST /openings', function($f3){
    $GLOBALS['con']->openings();
});

$f3->route('GET|POST /summary', function($f3){
    $GLOBALS['con']->summary();
});

$f3->route('GET /home', function(){
        $GLOBALS['con']->homeReroute();
});
//run fat free
$f3->run();