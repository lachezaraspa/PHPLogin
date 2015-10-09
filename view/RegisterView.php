<?php

/**
 * Description of RegisterView
 *
 * @author Lacho
 */
class RegisterView {

    private static $register = 'RegisterView::Register';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $repassword = 'RegisterView::PasswordRepeat';
    private static $messageId = 'RegisterView::Message';
    private $showRegistration = false;
    private $message = "";
    private $regSuccess = false;

    public function generateRegistrationForm() {
        $this->showRegistration = true;
        return '
            <h2>Register new user</h2>
			<form method="post" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . $this->message . '</p>

					<br>
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />
                                        <br>   
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
                                        <br>
					<label for="' . self::$repassword . '">Repeat password :</label>
					<input type="password" id="' . self::$repassword . '" name="' . self::$repassword . '" />
					<br>
					<input type="submit" name="' . self::$register . '" value="Register" />
				</fieldset>
			</form>
		';
    }

    public function generateMessage() {
   
        if (!$this->regSuccess) {

            if (strlen($this->getName()) < 3) {
                $this->message .= "Username has too few characters, at least 3 characters.<br>";
            }elseif (strlen($this->getPass()) < 6) {
                $this->message .= "Password has too few characters, at least 6 characters<br>";
            }elseif ($this->getPass() != $this->getRePass()) {
                $this->message .= "Password do not match<br>";
            }else{
                $this->message .= "User exists, pick another username."; 
        
            }
        } 
    }

    public function isShowingRegistration() {
        return $this->showRegistration;
    }

    public function getName() {
        $name = null;
        if (isset($_POST[self::$name])) {
            $name = $_POST[self::$name];
        }
        return $name;
    }

    //Get the posted password
    public function getPass() {
        $pass = null;
        if (isset($_POST[self::$password])) {
            $pass = $_POST[self::$password];
        }
        return $pass;
    }

    public function getRePass() {
        $repass = null;
        if (isset($_POST[self::$repassword])) {
            $repass = $_POST[self::$repassword];
        }
        return $repass;
    }

    //Check if the login button is pressed
    public function isRegisterPressed() {
        return isset($_POST[self::$register]);
    }

    public function registrationFail() {
        $this->regSuccess = false;
    }

    public function registrationSuccess() {
        $this->regSuccess = true;
    }

}

//<p id="' . self::$messageId . '">' . $this->message . '</p>
//' . $this->getName() . '