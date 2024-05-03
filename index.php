<?php
//BRENDEN HASKINS 4/13/24: PHP controller, defines basic routes, dependencies, and starts f3.

//start session
session_start();

//error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//requirements
require_once('vendor/autoload.php');
require 'model/validate.php';

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
        $validFirstName = validName($_POST['fname']);
        $validLastName = validName($_POST['lname']);
        $validEmail = validEmail($_POST['email']);
        $validPhone = validPhone($_POST['phone']);


        $f3->set('SESSION.errorPresent', true);
        $errorMessages = array();
        if(!$validFirstName){
            $errorMessages[] = "First name cannot contain digits.";
        } else if(!$validLastName){
            $errorMessages[] = "Last name cannot contain digits.";
        } else if(!$validEmail){
            $errorMessages[] = "Email is invalid.";
        } else if(!$validPhone){
            $errorMessages[] = "Phone number must be 10 or 11 numbers.";
        }else {
            $f3->set('SESSION.errorPresent', false);

            $f3->set('SESSION.fname',$_POST['fname']);
            $f3->set('SESSION.lname',$_POST['lname']);
            $f3->set('SESSION.state',$_POST['state']);
            $f3->set('SESSION.email',$_POST['email']);
            $f3->set('SESSION.phone',$_POST['phone']);

            $f3->reroute("experience");
        }

        if($f3->get('SESSION.errorPresent')) {
            $f3->set('SESSION.errorMessages',$errorMessages);
            $f3->reroute("personal");
        }

    }else {
        $view = new Template();
        echo $view->render('views/personal.html');
    }
});

$f3->route('GET|POST /experience', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $validExperience = validExperience($_POST['exp']);
        $validLink = validLink($_POST['linkedIn']);

        $f3->set('SESSION.errorPresent', true);
        $errorMessages = array();
        if(!$validExperience){
            $errorMessages[] = "Experience invalid.";
        } else if(!$validLink){
            $errorMessages[] = "LinkedIn URL invalid.";
        } else {
            $f3->set('SESSION.errorPresent', false);


            $f3->set('SESSION.bio', $_POST['bio']);
            $f3->set('SESSION.linkedIn', $_POST['linkedIn']);
            $f3->set('SESSION.exp', $_POST['exp']);
            $f3->set('SESSION.relocate', $_POST['relocate']);

            $f3->reroute("openings");
        }

        if($f3->get('SESSION.errorPresent')) {
            $f3->set('SESSION.errorMessages',$errorMessages);
            $f3->reroute("experience");
        }



    }
    else {
        $view = new Template();
        echo $view->render('views/experience.html');
    }
});

$f3->route('GET|POST /openings', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $f3->set('SESSION.positions',$_POST['positions']);

        $f3->reroute("summary");
    }else {
        $view = new Template();
        echo $view->render('views/openings.html');
    }
});

$f3->route('GET|POST /summary', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $f3->set('SESSION.positions',$_POST['positions']);

        $f3->reroute("summary");
    }else {
        $view = new Template();
        echo $view->render('views/summary.html');
    }
});

$f3->route('GET /home', function(){
        $view = new Template();
        echo $view->render('views/home.html');

});
//run fat free
$f3->run();