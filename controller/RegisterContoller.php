<?php

/**
 * Description of RegisterContoller
 *
 * @author Lacho
 */
class RegisterContoller {

    private $view;
    private $model;
    private $conn;
    private $dal;
    private $lv;
    private $lgv;
            
    function __construct(RegisterModel $model, RegisterView $view, LayoutView $lv, LoginView $lgv) {
        $this->model = $model;
        $this->view = $view;
        $this->lv = $lv;
        $this->lgv = $lgv;
        //$this->conn = new mysqli("mysql3.000webhost.com", "a3768997_root", "123qwe", "a3768997_users");        
        $this->conn = new \mysqli("localhost", "root", "root", "userdb");

        // Check connection
        if ($this->conn->connect_error) {
            throw new Exception($this->conn->connect_error);
        }
        $this->dal = new UserDAL($this->conn);
    }

    public function control() {

        if ($this->view->isRegisterPressed()) {
            
            $this->model->register($this->view->getName(), $this->view->getPass(), $this->view->getRePass(),  $this->dal); //Try to register new user
            
            if (!$this->model->isRegistered()) {
                $this->view->registrationFail();
                $this->view->generateMessage($this->lv);
            } else {
                $_SESSION['newUser'] = true;
                $this->view->registrationSuccess();
                $this->lgv->populateName($this->view->getName());
                $this->lv->renderForm($this->view, $this->lgv, false, $this->model->isRegistered());
            }
        }
        $this->conn->close();
    }

}
