<?php
/**
 * @author Lachezar
 */
class LoginController {

    private $model;
    private $view;
    private $conn;
    private $dal;

    function __construct(LoginView $view, LoginModel $model) {
        $this->view = $view;
        $this->model = $model;
        //$this->conn = new mysqli("mysql3.000webhost.com", "a3768997_root", "123qwe", "a3768997_users");
           $this->conn = new mysqli("localhost", "root", "root","userdb");

        // Check connection
        if ($this->conn->connect_error) {
            throw new Exception($this->conn->connect_error);
        }
        $this->dal = new UserDAL($this->conn);
    }

    public function control() {
        
        
        if ($this->model->isLoged()) {
            if ($this->view->isLogOutPressed()) {
                $this->model->doLogout();
                $this->view->setLogout();
                $this->view->setMessage();
            }
        } else {
            if ($this->view->isLoginPressed()) {

                $name = $this->view->getName();
                $pass = $this->view->getPass();

                if ($this->model->doLogin($name, $pass, $this->dal)) {
                    $this->view->setLoginSuccess();
                    $this->view->setMessage();
                    
                } else {
                    $this->view->setLoginFail();
                    $this->view->setMessage();
                    $this->view->populateName($name);
                }
            }
        }
        $this->conn->close();  
    }

}
