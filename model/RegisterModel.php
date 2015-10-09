<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisterModel
 *
 * @author Lacho
 */
class RegisterModel {
    
    private $isReg = false;
    
    
    public function register($name, $pass, $repass, UserDAL $users){
        
        
        
        if(strlen($name) >= 3 && strlen($pass) >= 6 && strlen($repass)>= 6){
            if($pass === $repass){
                try{
                    $user = (new UserCredent($name, $pass));
                    $users->addUser($name, $pass);
                    $this->isReg = true;
   
                } catch (Exception $ex) {
                    $this->isReg = false;
                }
                
            }
        }else{
            $this->isReg = false;
        } 
    }
    
    public function isRegistered(){
        return $this->isReg;
    }
    
}
