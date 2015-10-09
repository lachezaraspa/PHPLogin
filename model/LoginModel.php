<?php

/**
 * Description of LoginModel
 *
 * @author Lacho
 */
class LoginModel {

    public function isLoged() {
        if ($_SESSION['LogIn'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function doLogin($username, $pass, UserDAL $dal) {

        try {
            $user = $dal->getUserByName($username);

            if ($user->getName() === $username && $user->getPass() === $pass) {
                $_SESSION['LogIn'] = true;
                return true;
            } else {   //In any other case when username or pass are wrong
                return false;
            }
            
        } catch (Exception $e) {
            return false;
        }
    }

    public function doLogout() {
        if ($_SESSION['LogIn'] != false) { //Checks for resubition of logout post
            $_SESSION['LogIn'] = false;
            session_destroy();
        }
    }

}
