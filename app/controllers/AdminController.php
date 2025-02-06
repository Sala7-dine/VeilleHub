<?php 
require_once (__DIR__.'/../models/User.php');
require_once (__DIR__.'/../models/Sujet.php');
require_once (__DIR__.'/../models/Presentation.php');


class AdminController extends BaseController {
 
    private $UserModel;
    private $CategorieModel;
    private $TagModel;
    private $CoursModel;
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


    public function showDashboard() {
        
        
        $this->checkSubmtion();
        
        if(empty($_SESSION["user_id"])){          

            header("Location: /login");
            
        }else if($this->getRoleUser() === "Formateur"){

            $users = $this->UserModel->getAllUsers();
            // $totalCours = $this->CoursModel->getTotalCours();
            // $totalEnseignant = $this->CoursModel->totalEnsegnants();
            // $totalInscrits = $this->CoursModel->getTotalInscrits();
            // $topEneignant = $this->CoursModel->topEnseignants();

            $data = [
                'users' => $users
                // 'totalCours' => $totalCours,
                // 'totalEnseignant' => $totalEnseignant,
                // 'totalInscrits' => $totalInscrits,
                // 'topEneignant' => $topEneignant
            ];

            $this->render('admin/dashboard' , $data);

        }else {

            $this->render("layouts/page404");

        }

       

       

    }

    public function showUsers(){

        $this->checkSubmtion();


        if(empty($_SESSION["user_id"])){          

            header("Location: /login");
            
        }else if($this->getRoleUser() === "Formateur"){
            
            $users = $this->UserModel->getAllUsers();
        
            $data = [
                'users' => $users
            ];

            $this->render("admin/users" , $data);

        }else {

            $this->render("layouts/page404");

        }

    }

    public function showSujet(){
        $this->checkSubmtion();

        if(empty($_SESSION["user_id"])) {          
            header("Location: /login");
        } else if($this->getRoleUser() === "Formateur") {
            $sujets = $this->SujetModel->getAllSujetsWithStudents();
            $data = [
                'sujets' => $sujets
            ];
            $this->render("admin/sujet", $data);
        } else {
            $this->render("layouts/page404");
        }
    }

    public function showPresentations() {
        $this->checkSubmtion();

        if(empty($_SESSION["user_id"])) {          
            header("Location: /login");
        } else if($this->getRoleUser() === "Formateur") {
            // Récupérer tous les sujets validés avec leurs étudiants assignés
            $sujets = $this->SujetModel->getSujetsWithAssignedStudents();
            // Récupérer tous les étudiants disponibles
            $students = $this->UserModel->getAllStudents();
            
            $data = [
                'sujets' => $sujets,
                'students' => $students
            ];
            
            $this->render("admin/presentation", $data);
        } else {
            $this->render("layouts/page404");
        }
    }


    public function showCalndrier(){
        $this->checkSubmtion();

        if(empty($_SESSION["user_id"])) {          
            header("Location: /login");
        } else if($this->getRoleUser() === "Formateur") {
            $sujets = $this->SujetModel->getSujetsWithAssignedStudents();
            $data = [
                'sujets' => $sujets
            ];
            $this->render("admin/calendrier", $data);
        } else {
            $this->render("layouts/page404");
        }
    }

    public function deleteUser() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            if ($this->UserModel->deleteUser($userId)) {
                
                header('Location: /dashboard');
                exit();
            } else {
                
                echo "<script>alert('Erreur lors de la suppression de l\'utilisateur');</script>";
            }
        }
        header('Location: /dashboard');
        exit();
    }

    public function updateUserStatus() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['status'])) {
            $userId = $_POST['user_id'];
            $newStatus = $_POST['status'];
            
            if ($this->UserModel->updateStatus($userId, $newStatus)) {
                header('Location: /dashboard/users');
                exit();
            } else {
                echo "<script>alert('Erreur lors de la mise à jour du statut');</script>";
                header('Location: /dashboard/users');
                exit();
            }
        }
        header('Location: /dashboard/users');
        exit();
    }

    public function updateSujetStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sujet_id']) && isset($_POST['status'])) {
            $sujetId = $_POST['sujet_id'];
            $newStatus = $_POST['status'];
            
            if ($this->SujetModel->updateSujetStatus($sujetId, $newStatus)) {
                $_SESSION['success'] = "Statut du sujet mis à jour avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du statut";
            }
        }
        header('Location: /dashboard/sujet');
        exit();
    }

    public function deleteSujet() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sujet_id'])) {
            $sujetId = $_POST['sujet_id'];
            
            if ($this->SujetModel->deleteSujet($sujetId)) {
                $_SESSION['success'] = "Sujet supprimé avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de la suppression du sujet";
            }
        }
        header('Location: /dashboard/sujet');
        exit();
    }

    public function assignStudentsToSujet() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
            isset($_POST['sujet_id']) && 
            isset($_POST['student_ids']) && 
            is_array($_POST['student_ids'])) {
            
            $sujetId = $_POST['sujet_id'];
            $studentIds = $_POST['student_ids'];

    
            if (count($studentIds) < 2) {
                $_SESSION['error'] = "Veuillez sélectionner au moins 2 étudiants";
                header('Location: /dashboard/presentations');
                exit();
            }
            
            if ($this->SujetModel->assignStudentsToSujet($sujetId, $studentIds)) {
                $_SESSION['success'] = "Étudiants assignés avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de l'assignation des étudiants";
            }
        }
        
        header('Location: /dashboard/presentations');
        exit();
    }

    public function getPresentations() {
        $presentations = $this->PresentationModel->getAllPresentations();
        $events = array_map(function($presentation) {
            return [
                'id' => $presentation['id'],
                'title' => $presentation['titre'] . ' - ' . $presentation['student_names'],
                'start' => $presentation['presentation_date'],
                'sujetId' => $presentation['id_sujet']
            ];
        }, $presentations);
        
        header('Content-Type: application/json');
        echo json_encode($events);
    }

    public function savePresentation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sujetId = $_POST['sujet_id'];
            $presentationDate = $_POST['presentation_date'];
            
            if ($this->PresentationModel->savePresentationDate($sujetId, $presentationDate)) {
                $_SESSION['success'] = "Présentation planifiée avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de la planification";
            }
        }
        header('Location: /dashboard/calendrier');
        exit();
    }

    public function updatePresentationDate() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $success = $this->PresentationModel->updatePresentationDate(
            $data['event_id'],
            $data['new_date']
        );
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $success]);
    }
}

