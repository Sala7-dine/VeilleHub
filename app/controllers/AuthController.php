<?php
 
require_once (__DIR__.'/../models/User.php');

class AuthController extends BaseController {
 
    private $UserModel;

   public function __construct(){

      $this->UserModel = new User();
      
   }

   public function showRegister() {
      
    $this->render('auth/register');
   }
   public function showleLogin() {
      
    $this->render('auth/login');
   }
   
   public function handleRegister(){

      
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
         if (isset($_POST['submit'])) {
            
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['account_type'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];
            
            if($password === $confirmpassword){

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $result = $this->UserModel->register($username , $email , $hashed_password , $role , "inactive");

                header("Location: /login");

            }else{
                echo "<script>alert('Invalid password !!!')</script>";
            }
             
         }
     }
   }
       public function handleLogin(){


        if ($_SERVER["REQUEST_METHOD"] == "POST"){

          if (isset($_POST['submit'])) {

              $email = $_POST['email'];
              $password = $_POST['password'];
              
              $user = $this->UserModel->login($email, $password);
              
              if ($user) {
        
                if($user['role'] === "Formateur"){
                    $_SESSION['user_role'] = 1;
                }else if($user['role'] === "Apprenant"){
                    $_SESSION['user_role'] = 0;
                }

                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['user_name'] = $user['nom'];
                
                if ($user['status'] === 'active') {
                    header("Location: /");
                } else if($user['status'] === 'inactive'){
                    $this->render("layouts/notActive");
                }else{
                    $this->render("layouts/banned_users");
                }
                exit();
              } else {
                echo "<script>alert('Email ou mot de passe incorrect'); window.location.href='/login';</script>";
                exit;
                  //header("Location: /login");
              }
             
          }
      }
 

   }

   public function logout() {

      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])){

        if (isset($_SESSION['user_id'])){

        unset($_SESSION['user_id']);
        session_destroy();
    
        header("Location: /");
        exit;
        
        }
     }

   }


   public function showResetPassword(){

    $this->render('auth/resetPassword');
   }
   
   public function resetPassword() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return [

            'success' => false,
            'message' => 'Méthode non autorisée'
        ];
    }

    $email = $_POST['email'] ?? '';
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'success' => false,
            'message' => 'Email invalide'
        ];
    }

    $this->UserModel->resetPassword($email);

    header("Location: /login");

    }

}