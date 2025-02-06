<?php 
require_once (__DIR__.'/../models/User.php'); 
require_once (__DIR__.'/../models/Sujet.php'); 

class ApprenantController extends BaseController {
 
    private $UserModel;
    private $SujetModel;

    public function __construct(){

        $this->UserModel = new User();
        $this->SujetModel = new Sujet();

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

            // $user_id = $_SESSION["user_id"];

            // $courses = $this->CoursModel->getAllCours($user_id);
            // $categories = $this->CategorieModel->getAllCategories();
            // $etudiants = $this->UserModel->getStudentsByTeacher($user_id);     

            // $totalCours = $this->CoursModel->getTotalCoursByUserId($user_id);
            // $totalInscrits = $this->CoursModel->getTotalInscrit($user_id);
            
            // $data = [
            //     'cours' => $courses,
            //     'categories' => $categories,
            //     'etudiants' => $etudiants,
            //     "totalCours" => $totalCours,
            //     "totalInscrits" => $totalInscrits
            // ];

            $this->render("Etudiant/dashboard");

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



   

}
