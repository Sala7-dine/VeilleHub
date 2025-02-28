<?php 
require_once (__DIR__.'/../models/User.php');
require_once (__DIR__.'/../models/Sujet.php');
require_once (__DIR__.'/../models/Presentation.php');
require_once (__DIR__.'/../models/Formateur.php');


class AdminController extends BaseController {
    
    private $FormateurModel;
    private $SujetModel;
    private $PresentationModel;

    public function __construct(){

        $this->SujetModel = new Sujet();
        $this->PresentationModel = new Presentation();
        $this->FormateurModel = new Formateur();
        
    }

    public function checkSubmtion(){

        if (empty($_SESSION["user_id"])) {

            header("Location: /login");
            exit;
        }

    }

    public function getRoleUser(){

        $user_id = $_SESSION["user_id"];

        $user = $this->FormateurModel->getUser($user_id);

        $role = $user["role"];

        return $role;
        
    }

    public function getUserStatus(){

        $user_id = $_SESSION["user_id"];

        $user = $this->FormateurModel->getUser($user_id);

        $status = $user["status"];

        return $status;
        
    }

    public function showDashboard() {
        
        
        $this->checkSubmtion();
        
        if(empty($_SESSION["user_id"])){          

            header("Location: /login");

        }else if($this->getUserStatus() === "inactive"){

            $this->render("layouts/notActive"); 
            
        }else if($this->getRoleUser() === "Formateur"){

            // Récupération des statistiques
            $totalUsers = $this->FormateurModel->getTotalUsers();
            $totalStudents = $this->FormateurModel->getTotalStudents();
            $totalPresentations = $this->PresentationModel->getTotalPresentations();
            $totalSujets = $this->SujetModel->getTotalSujets();

            // Récupération des données récentes
            $recentPresentations = $this->PresentationModel->getRecentPresentations();
            $recentSujets = $this->SujetModel->getRecentSujets();

            $data = [
                'totalUsers' => $totalUsers,
                'totalStudents' => $totalStudents,
                'totalPresentations' => $totalPresentations,
                'totalSujets' => $totalSujets,
                'recentPresentations' => $recentPresentations,
                'recentSujets' => $recentSujets
            ];

            $this->render("admin/dashboard", $data);

        }else {

            $this->render("layouts/page404");

        }

    }

    public function showUsers(){

        $this->checkSubmtion();


        if(empty($_SESSION["user_id"])){          

            header("Location: /login");

        }else if($this->getUserStatus() === "inactive"){

            $this->render("layouts/notActive"); 
            
        }else if($this->getRoleUser() === "Formateur"){
            
            $users = $this->FormateurModel->getAllUsers();
        
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
        }else if($this->getUserStatus() === "inactive"){

            $this->render("layouts/notActive"); 

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
        }else if($this->getUserStatus() === "inactive"){

            $this->render("layouts/notActive"); 
            
        } else if($this->getRoleUser() === "Formateur") {
           
            $sujets = $this->SujetModel->getSujetsWithAssignedStudents();
            $students = $this->FormateurModel->getAllStudents();
            
            $data = [
                'sujets' => $sujets,
                'students' => $students
            ];
            
            $this->render("admin/assignments", $data);
        } else {
            $this->render("layouts/page404");
        }
    }


    public function showCalendrier(){
        $this->checkSubmtion();

        if(empty($_SESSION["user_id"])) {          
            header("Location: /login");
        }else if($this->getUserStatus() === "inactive"){

            $this->render("layouts/notActive"); 
            
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
            if ($this->FormateurModel->deleteUser($userId)) {
                
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
            
            if ($this->FormateurModel->updateStatus($userId, $newStatus)) {
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


    public function assignPresentation($studentInfo, $sujetInfo) {
        try {
     
                $presentationDetails = [
                    'titre' => $sujetInfo['titre'],
                    'description' => $sujetInfo['description']
                ];
                
                // Instancier le Mailer
                $mailer = new Mailer();
                
                // Envoyer l'email
                $emailSent = $mailer->sendPresentationAssignmentEmail(
                    $studentInfo['email'],
                    $studentInfo['nom'],
                    $presentationDetails
                );
                
                if (!$emailSent) {
                    error_log("Erreur lors de l'envoi de l'email de notification");
                }
                
                return [
                    'success' => true,
                    'message' => 'Présentation assignée avec succès'
                ];
            
            
            return [
                'success' => false,
                'message' => "Erreur lors de l'assignation de la présentation"
            ];
            
        } catch (Exception $e) {
            error_log("Erreur d'assignation: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Une erreur est survenue lors de l'assignation"
            ];
        }
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

            $result = $this->SujetModel->assignStudentsToSujet($sujetId, $studentIds);
            //$result = $this->PresentationModel->assignStudentsToSujet($sujetId, $studentIds);
        
            if ($result['success']){
                $_SESSION['success'] = "Étudiants assignés avec succès";

                $sujetInfo = $this->SujetModel->getSujetById($sujetId);

                foreach($studentIds as $studentId){

                    $studentInfo = $this->FormateurModel->getUser($studentId);
                    $this->assignPresentation($studentInfo , $sujetInfo);
                }

            

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
            // Formater les noms des étudiants
            $studentNames = explode(',', $presentation['student_names']);
            $formattedStudents = implode(', ', array_map(function($name) {
                return trim($name);
            }, $studentNames));

            return [
                'id' => $presentation['id'],
                'titre' => htmlspecialchars($presentation['titre']),
                'student_names' => htmlspecialchars($formattedStudents),
                'presentation_date' => $presentation['presentation_date'],
                'id_sujet' => $presentation['id_sujet']
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
        header('Location: /dashboard/Calendrier');
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

    public function updatePresentationStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sujetId = $_POST['sujet_id'];
            $status = $_POST['status'];
            
            if ($this->PresentationModel->updatePresentationStatus($sujetId, $status)) {
                $_SESSION['success'] = "Statut mis à jour avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du statut";
            }
        }
        header('Location: /dashboard/presentations');
        exit();
    }
}

