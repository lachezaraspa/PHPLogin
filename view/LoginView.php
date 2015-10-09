<?php

class LoginView {

    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $cookieName = 'LoginView::CookieName';
    private static $cookiePassword = 'LoginView::CookiePassword';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';
    private $fillName = "";
    private $message = "";
    private $loginSuccess = false;
    private $loginFail = false;
    private $logoutSuccess = false;

    /**
     * Create HTTP response
     * Should be called after a login attempt has been determine
     * @return  void BUT writes to standard output and cookies!
     */
    public function response() {

        $response = "";

        if ($_SESSION['LogIn'] === true) { //Check if the seession is valid and show the corresponding response
            $response .= $this->generateLogoutButtonHTML($this->message);
        } else {
            $response = $this->generateLoginFormHTML($this->message);
        }

        return $response;
    }

    public function setMessage() {

        if ($this->loginSuccess === true && $this->isLoginPressed()) {
            $this->message = "Welcome";
        } elseif($_SESSION['newUser']){
            $this->message = "Registered new user.";
        } elseif ($this->isLoginPressed() && $this->getName() === "") {
            $this->message = "Username is missing";
        } elseif ($this->isLoginPressed() && $this->getPass() === "") {
            $this->message = "Password is missing";
        } elseif ($this->loginFail === true) {
            $this->message = "Wrong name or password";
        } elseif ($this->logoutSuccess === true && $this->isLogOutPressed()) {
            $this->message = "Bye bye!";
        }
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLogoutButtonHTML($message) {
        return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $this->message . '</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLoginFormHTML($message) {
        return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->fillName . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
    }

//	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
//	private function getRequestUserName() {
//            
//            var_dump($_GET);
//		//RETURN REQUEST VARIABLE: USERNAME
//	}
    //Get the posted username
    public function getName() {
        $name = null;
        if (isset($_POST[self::$name])) {
            $name = $_POST[self::$name];
        }
        return $name;
    }

    public function populateName($name) {

        $this->fillName = $this->getName();
        if ($name != null) {
            $this->fillName = $name;
        }
    }

    //Get the posted password
    public function getPass() {
        $pass = null;
        if (isset($_POST[self::$password])) {
            $pass = $_POST[self::$password];
        }
        return $pass;
    }

    //Check if the login button is pressed
    public function isLoginPressed() {
        return isset($_POST[self::$login]);
    }

    //Check if the logout button is pressed
    public function isLogOutPressed() {
        return isset($_POST[self::$logout]);
    }

    public function setLoginSuccess() {
        $this->loginSuccess = true;
    }

    public function setLoginFail() {
        $this->loginFail = true;
    }

    public function setLogout() {
        $this->logoutSuccess = true;
    }

}
