<?php 
require_once (__DIR__.'/../models/User.php');
require_once (__DIR__.'/../models/Presentation.php');

class HomeController extends BaseController {
 
   private $UserModel;
   private $PresentationModel;
    
   public function __construct(){
      $this->UserModel = new User();
      $this->PresentationModel = new Presentation();
   }

   public function showHome() {
      $this->render('Accueil/index');
   }

   public function showCalendrier() {
      $presentations = $this->PresentationModel->getAllPresentationss();
      $this->render('Accueil/calendrier', ['presentations' => $presentations]);
   }
}