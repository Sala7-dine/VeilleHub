<?php 
require_once (__DIR__.'/../models/User.php'); 
require_once (__DIR__.'/../models/Sujet.php'); 
require_once (__DIR__.'/../models/Presentation.php');

class ApprenantController extends BaseController {
 
    private $UserModel;
    private $SujetModel;
    private $PresentationModel;

    public function __construct(){

        $this->UserModel = new User();
        $this->SujetModel = new Sujet();
        $this->PresentationModel = new Presentation();

    }


    public function checkSubmtion(){

        if (empty($_SESSION["user_id"])) {

            header("Location: /login");
            exit;
        }

    }

    public function getRoleUser(){

        $user_id = $_SESSION["user_id"];

        $user = $this->UserModel->getUser($user_id);

        $role = $user["role"];

        return $role;
        
    }

    public function getUserStatus(){

        $user_id = $_SESSION["user_id"];

        $user = $this->UserModel->getUser($user_id);

        $status = $user["status"];

        return $status;
        
    }

    public function showTeacherDashboard(){

        $this->checkSubmtion();

        if(empty($_SESSION["user_id"])){          

            header("Location: /login");
        
        }else if($this->getUserStatus() === "inactive"){

            $this->render("layouts/notActive"); 

        }else if($this->getRoleUser() === "Apprenant"){

            $studentId = $_SESSION["user_id"];
        
            $stats = $this->PresentationModel->getStudentStats($studentId);
            $recentPresentations = $this->PresentationModel->getEtudiantRecentPresentations($studentId , 3);

            $data = [
                'stats' => $stats,
                'recentPresentations' => $recentPresentations
            ];

            $this->render("Etudiant/dashboard", $data);

        }else {

            $this->render("layouts/page404");

        }

    }


    public function showEtudiantSujet(){

        $this->checkSubmtion();

        if(empty($_SESSION["user_id"])){          

            header("Location: /login");

        }else if($this->getUserStatus() === "inactive"){

            $this->render("layouts/notActive"); 
            
        }else if($this->getRoleUser() === "Apprenant"){

            $user_id = $_SESSION['user_id'];

            $sujets = $this->SujetModel->getAllSujets($user_id);


            $data = [

                "sujets" => $sujets

            ];


            $this->render("Etudiant/sujet" , $data);
            
        }else {

            $this->render("layouts/page404");

        }
        

    }
    public function showEtudiantCalendrier(){

        $this->checkSubmtion();

        if(empty($_SESSION["user_id"])){          

            header("Location: /login");

        }else if($this->getUserStatus() === "inactive"){

            $this->render("layouts/notActive"); 
            
        }else if($this->getRoleUser() === "Apprenant"){



            $this->render("Etudiant/calendrier");
            
        }else {

            $this->render("layouts/page404");

        }
        

    }

    public function addSujet() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

            $user_id = $_SESSION["user_id"];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            
            if ($this->SujetModel->addSujet($user_id , $description , $titre , "Proposé")){
                header('Location: /dashboard/etudiant/sujet');
                exit();
            } else {
                echo "<script>alert('Erreur lors de l\'ajout du Sujet');</script>";
                header('Location: /dashboard/etudiant/sujet');
                exit();
            }
        }
        header('Location: /dashboard/etudiant/sujet');
        exit();
    }

    public function deleteSujet(){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sujet_id'])) {

            $Id = $_POST['sujet_id'];
        
            if ($this->SujetModel->deleteSujet($Id)) {
                header('Location: /dashboard/etudiant/sujet');
                exit;
            } else {
                header('Location: /dashboard/teacher/cours?error=delete_failed');
                exit;
            }
           
        }
    }

    public function showEtudiantPresentation(){
        $this->checkSubmtion();

        if(empty($_SESSION["user_id"])){          
            header("Location: /login");
        } else if($this->getUserStatus() === "inactive"){
            $this->render("layouts/notActive"); 
        } else if($this->getRoleUser() === "Apprenant"){
            $user_id = $_SESSION['user_id'];
            
            $upcomingPresentations = $this->PresentationModel->getUpcomingPresentations($user_id);
            $pastPresentations = $this->PresentationModel->getPastPresentations($user_id);

            $data = [
                "upcoming" => $upcomingPresentations,
                "past" => $pastPresentations
            ];

            $this->render("Etudiant/presentation", $data);
        } else {
            $this->render("layouts/page404");
        }
    }

    public function getStudentPresentations() {
        if(empty($_SESSION["user_id"])) {
            http_response_code(401);
            echo json_encode(['error' => 'Non autorisé']);
            return;
        }

        $studentId = $_SESSION["user_id"];
        $presentations = $this->PresentationModel->getStudentPresentations($studentId);
        
        header('Content-Type: application/json');
        echo json_encode($presentations);
    }

    public function showCalendar() {
        if(empty($_SESSION["user_id"])) {
            header("Location: /login");
            exit;
        }

        $this->render("Etudiant/calendrier");
    }

}
