<?php

/**
 * User class
 * Simple class that represents a user
 * @author Lachezar
 */
class User {
    
    //Constructor for User class
    private $name;
    private $password;
    
    
    //Constructor for the User class
    function __construct($name, $password) {
        $this->name = $name;
        $this->password = $password;
    }
    
    //Return method for the user name
    public function getName(){
        return $this->name;
    }
    
    //Return method for the user password
    public function getPass(){
        return $this->password;
    }
    
}
