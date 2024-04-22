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

//associate javascript
$f3->set('js_file','scripts/scripts.js');

//define default route
$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /personal', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $f3->set('SESSION.fname',$_POST['fname']);
        $f3->set('SESSION.lname',$_POST['lname']);
        $f3->set('SESSION.state',$_POST['state']);
        $f3->set('SESSION.email',$_POST['email']);
        $f3->set('SESSION.phone',$_POST['phone']);

        $f3->reroute("experience");
    }else {
        $view = new Template();
        echo $view->render('views/personal.html');
    }
});

$f3->route('GET|POST /experience', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $f3->set('SESSION.fname',$_POST['fname']);
        $f3->set('SESSION.lname',$_POST['lname']);
        $f3->set('SESSION.state',$_POST['state']);
        $f3->set('SESSION.email',$_POST['email']);
        $f3->set('SESSION.phone',$_POST['phone']);

        $f3->reroute("experience");
    }else {
        $view = new Template();
        echo $view->render('views/experience.html');
    }
});
//run fat free
$f3->run();