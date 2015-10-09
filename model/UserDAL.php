<?php

/**
 * Description of UserDAL
 *
 * @author Lacho
 */
class UserDAL {

    private $dbconn;
    private $username;
    private $password;
    private static $table = "Users";
    

    function __construct(mysqli $db) {
        $this->dbconn = $db;
    }

    public function getUserByName($name) {

        $stmt = ("SELECT * FROM `".self::$table."` WHERE `name` LIKE '" . $name . "'");


        $results = mysqli_query($this->dbconn, $stmt);




        while ($row = mysqli_fetch_array($results)) {

            $this->username = $row['name'];
            $this->password = $row['password'];
        }

        if (!empty($this->username) && !empty($this->password)) {
            $user = new UserCredent($this->username, $this->password);
            return $user;
        } else {
            throw new Exception("User does not exist");
        }

        mysqli_free_result($results);
    }

    public function addUser($username, $password) {

        $stmt = "INSERT INTO `".self::$table."`(`name`, `password`) VALUES ('" . $username . "','" . $password . "')";

        if ($this->dbconn->query($stmt) === TRUE) {
            echo "New record created successfully";
        } else {
            throw new Exception("Error: " . $stmt . "<br>" . $this->dbconn->error);
        }
    }

}
