<?php 

class AuthController extends BaseController {


    public function showLogin(){

        $this->render("login");
        
    }


    public function showRegister(){

        $this->render("auth/register");
        
    }   




}

?>