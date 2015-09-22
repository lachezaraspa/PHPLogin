<?php

/**
 * @author Lachezar
 */
class LoginController {

    private $user;
    private $view;
    private $lv;
    private $dtv;

    function __construct(LoginView $view, User $user, LayoutView $lv, DateTimeView $dtv) {
        $this->view = $view;
        $this->user = $user;
        $this->lv = $lv;
        $this->dtv = $dtv;
    }

    public function doLogin() {
        $msg = null;

        //Checks when the login button is pressed
        if ($this->view->isLoginPressed()) {
           
        //If the POST is resent set the message to null
            if ($_SESSION['LogIn'] != true) {
                
                //If the credentials provided are correct 
                if ($this->user->getName() === $this->view->getName() && $this->view->getPass() === $this->user->getPass()) {
                        $msg = "Welcome";
                        $_SESSION['LogIn'] = true;

                } elseif ($this->view->getName() === "") { //If no username is provided
                    $_SESSION['LogIn'] = false;
                    $msg = "Username is missing";
                } elseif ($this->view->getPass() === "") { //If no password is provided
                    $_SESSION['LogIn'] = false;
                    $msg = "Password is missing";
                } else {                                  //In any other case when username or pass are wrong
                    $_SESSION['LogIn'] = false;
                    $msg = "Wrong name or password";
                }
            }
        } elseif ($this->view->isLogOutPressed()) { //When logout button is pressed
            $msg = null;
            
            if ($_SESSION['LogIn'] != false) { //Checks for resubition of logout post
                $msg = "Bye bye!";
                $_SESSION['LogIn'] = false; 
                session_destroy();
            }
        
            
        }
        $this->lv->render($_SESSION['LogIn'], $this->view, $this->dtv, $msg);
    }
    
     
    
}
