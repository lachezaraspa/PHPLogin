<?php

class LayoutView {

    private static $urlRegister = "registration";
    private static $urlLogin = "?";

    public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $rv, $isRegistered) {
        echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Assignment 2</title>
        </head>
        <body>
          <h1>Assignment 2</h1> 
          ' . $this->renderHref($isLoggedIn, $isRegistered) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          <div class="container"> 
             ' . $this->renderForm($rv, $v, $isLoggedIn, $isRegistered) . '
              ' . $dtv->show() . '   
                  
          </div>
         </body>
      </html>
    ';
    }

    private function renderHref($isLoggedIn, $isRegistered) {
        $link = "";
        
        if(!$isLoggedIn){
                $link = '<a href ="?' . self::$urlRegister . '">Register a new user</a>';

            if (!$isRegistered && isset( $_GET[self::$urlRegister])) {
                $link = '<a href ="' . self::$urlLogin . '">Back to login</a>';
            }
        }
        return $link;
    }

    public function renderForm(RegisterView $rv, LoginView $v, $isLoggedIn, $isRegistered) { //Show registration or login form depending on user input
        
       if (!$isRegistered && !$isLoggedIn && isset( $_GET[self::$urlRegister])) {
           return $rv->generateRegistrationForm(); //If a user wants to view the registration form
           
        } elseif($isRegistered && isset( $_GET[self::$urlRegister])) {
            header('Location: ' . self::$urlLogin, true); //If the registration is successfull return to login page
            return $v->response();
        }else{
            return $v->response();//In the other cases show the login page
        }
    }

    private function renderIsLoggedIn($isLoggedIn) {
        if ($isLoggedIn) {
            return '<h2>Logged in</h2>';
        } else {
            return '<h2>Not logged in</h2>';
        }
    }

}
