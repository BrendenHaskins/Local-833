<?php

require_once ('vendor/autoload.php');
require 'model/validate.php';



//Controller class, handles methods called from the router.

class Controller
{
    private $_f3; // f3 router

    function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->_f3->set('js_file', 'scripts/scripts.js');
    }

    function home() : void {
            $view = new Template();
            echo $view->render('views/home.html');
    }

    function personal() : void {
        $f3 = $this->_f3;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validFirstName = validName($_POST['fname']);
                $validLastName = validName($_POST['lname']);
                $validEmail = validEmail($_POST['email']);
                $validPhone = validPhone($_POST['phone']);


                $this->_f3->set('SESSION.errorPresent', true);
                $errorMessages = array();
                if (!$validFirstName) {
                    $errorMessages[] = "First name cannot contain digits.";
                } else if (!$validLastName) {
                    $errorMessages[] = "Last name cannot contain digits.";
                } else if (!$validEmail) {
                    $errorMessages[] = "Email is invalid.";
                } else if (!$validPhone) {
                    $errorMessages[] = "Phone number must be 10 or 11 numbers.";
                } else {
                    $f3->set('SESSION.errorPresent', false);
                    $f3->set('SESSION.mailing', $_POST['mailing']);

                    $applicantIsMailing = ($f3->get('SESSION.mailing') == 'mailing');

                    if($applicantIsMailing) {
                        $f3->set('SESSION.object', new Applicant_Mailing(
                            $_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['state'],$_POST['phone'],
                            '','','','',array(),array())
                        );
                    } else {
                        $f3->set('SESSION.object', new Applicant(
                                $_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['state'],$_POST['phone'],
                                '','','',''
                            )
                        );
                    }

                    $f3->set('SESSION.showVerticals', $applicantIsMailing);
                    $f3->reroute("experience");
                }

                if ($f3->get('SESSION.errorPresent')) {
                    $f3->set('SESSION.errorMessages', $errorMessages);
                    $f3->reroute("personal");
                }

            } else {
                $view = new Template();
                echo $view->render('views/personal.html');
            }
    }

    function experience() : void {
        $f3 = $this->_f3;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validExperience = validExperience($_POST['exp']);
                $validLink = validLink($_POST['linkedIn']);

                $f3->set('SESSION.errorPresent', true);
                $errorMessages = array();
                if (!$validExperience) {
                    $errorMessages[] = "Experience invalid.";
                } else if (!$validLink) {
                    $errorMessages[] = "LinkedIn URL invalid.";
                } else {
                    $f3->set('SESSION.errorPresent', false);

                    $applicant = $f3->get('SESSION.object');

                    if($f3->get('SESSION.showVerticals')){
                        $applicant->setBio($_POST['bio']);
                        $applicant->setLink($_POST['linkedIn']);
                        $applicant->setExperience($_POST['exp']);
                        $applicant->setRelocate($_POST['relocate']);
                    } else {
                        $applicant->setBio($_POST['bio']);
                        $applicant->setLink($_POST['linkedIn']);
                        $applicant->setExperience($_POST['exp']);
                        $applicant->setRelocate($_POST['relocate']);
                    }

                    if($f3->get('SESSION.showVerticals')) {
                        $f3->reroute("openings");
                    } else {
                        $f3->reroute('summary');
                    }

                }

                if ($f3->get('SESSION.errorPresent')) {
                    $f3->set('SESSION.errorMessages', $errorMessages);
                    $f3->reroute("experience");
                }


            } else {
                $view = new Template();
                echo $view->render('views/experience.html');
            }
    }

    function openings() : void {
        $f3 = $this->_f3;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $applicant = $f3->get('SESSION.object');
                $applicant->setSelectionsVerticals($_POST['verticals']);
                $applicant->setSelectionsJobs($_POST['positions']);


                $f3->reroute("summary");
            } else {
                $view = new Template();
                echo $view->render('views/openings.html');
            }
    }

    function summary() : void {
        $f3 = $this->_f3;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $f3->set('SESSION.positions', $_POST['positions']);

                $f3->reroute("summary");
            } else {
                $view = new Template();
                echo $view->render('views/summary.html');
            }
    }

    function homeReroute() : void {
            $view = new Template();
            echo $view->render('views/home.html');
    }
}