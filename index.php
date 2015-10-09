<?php


//INCLUDE THE FILES NEEDED...
require_once ('view/LoginView.php');
require_once ('view/DateTimeView.php');
require_once ('view/LayoutView.php');
require_once ('view/RegisterView.php');
require_once ('model/UserCredent.php');
require_once ('model/LoginModel.php');
require_once ('model/RegisterModel.php');

require_once ('controller/LoginController.php');
require_once ('controller/RegisterContoller.php');
require_once ('model/UserDAL.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');


//CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();
$rv = new RegisterView();


session_set_cookie_params(0);
session_name();
session_start();

if(!isset($_SESSION['LogIn'])){ //If the session is not set, set it to false
    $_SESSION['LogIn'] = false;
}

if(!isset($_SESSION['newUser'])){ //If the session is not set, set it to false
    $_SESSION['newUser'] = false;
}

$regmodel = new RegisterModel();
$logmodel = new LoginModel();

        

$controller = new LoginController($v, $logmodel); //Set up the controller
$regcontroller = (new RegisterContoller($regmodel, $rv,$lv, $v));

$controller->control(); //Use the contoller to log in
$regcontroller->control();




$lv->render($logmodel->isLoged(), $v, $dtv, $rv, $regmodel->isRegistered());
