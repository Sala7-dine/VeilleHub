<?php
require_once(__DIR__.'/../config/db.php');

class Presentation extends db {
    public function __construct() {
        parent::__construct();
    }

    public function getAllPresentations() {
        try {
            $query = "SELECT sa.id, s.titre, sa.presentation_date, s.id_sujet,
                             GROUP_CONCAT(u.nom) as student_names
                      FROM subject_assignments sa
                      JOIN sujet s ON sa.sujet_id = s.id_sujet
                      JOIN user u ON sa.student_id = u.id_user
                      WHERE sa.presentation_date IS NOT NULL
                      GROUP BY sa.sujet_id, sa.presentation_date";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération des présentations: " . $e->getMessage());
            return [];
        }
    }

    public function getAllPresentationss() {
        try {
            $query = "SELECT sa.id, s.titre, sa.presentation_date, s.id_sujet,
                             GROUP_CONCAT(u.nom) as student_names
                      FROM subject_assignments sa
                      JOIN sujet s ON sa.sujet_id = s.id_sujet
                      JOIN user u ON sa.student_id = u.id_user
                      WHERE sa.presentation_date IS NOT NULL
                      GROUP BY sa.sujet_id, sa.presentation_date";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $presentations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Formater les données pour FullCalendar
            return array_map(function($presentation) {
                return [
                    'id' => $presentation['id'],
                    'title' => $presentation['titre'],
                    'start' => $presentation['presentation_date'],
                    'students' => $presentation['student_names'],
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#2563eb',
                    'textColor' => '#ffffff'
                ];
            }, $presentations);
    
        } catch (PDOException $e) {
            error_log("Erreur de récupération des présentations: " . $e->getMessage());
            return [];
        }
    }

    public function savePresentationDate($sujetId, $presentationDate) {

        try {

            $query = "UPDATE subject_assignments SET presentation_date = :date WHERE sujet_id = :sujet_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':date', $presentationDate);
            $stmt->bindParam(':sujet_id', $sujetId);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur de sauvegarde de la date: " . $e->getMessage());
            return false;
        }
    }

    public function updatePresentationDate($presentationId, $newDate) {

        try {
            $query = "UPDATE subject_assignments 
                     SET presentation_date = :date 
                     WHERE id = :id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':date', $newDate);
            $stmt->bindParam(':id', $presentationId);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur de mise à jour de la date: " . $e->getMessage());
            return false;
        }
        
    }

    public function getStudentPresentations($studentId) {
        try {
            $query = "SELECT sa.id, s.titre, sa.presentation_date, 
                             GROUP_CONCAT(u.nom SEPARATOR ', ') as students,
                             s.description
                      FROM subject_assignments sa
                      JOIN sujet s ON sa.sujet_id = s.id_sujet
                      JOIN user u ON FIND_IN_SET(u.id_user, sa.student_id)
                      WHERE sa.student_id = :student_id
                      AND sa.presentation_date IS NOT NULL
                      GROUP BY sa.id, s.titre, sa.presentation_date
                      ORDER BY sa.presentation_date ASC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
            $stmt->execute();
            
            $presentations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Formater les données pour le calendrier
            return array_map(function($presentation) {
                return [
                    'id' => $presentation['id'],
                    'title' => $presentation['titre'],
                    'start' => $presentation['presentation_date'],
                    'students' => $presentation['students'],
                    'description' => $presentation['description']
                ];
            }, $presentations);
            
        } catch (PDOException $e) {
            error_log("Erreur de récupération des présentations: " . $e->getMessage());
            return [];
        }
    }

    public function getUpcomingPresentations($studentId) {
        try {
            $currentDate = date('Y-m-d H:i:s');
            $query = "SELECT sa.id, s.titre, sa.presentation_date, s.description,
                             sa.status, GROUP_CONCAT(u.nom) as student_names
                      FROM subject_assignments sa
                      JOIN sujet s ON sa.sujet_id = s.id_sujet
                      JOIN user u ON sa.student_id = u.id_user
                      WHERE (sa.student_id = :student_id OR sa.sujet_id IN 
                            (SELECT sujet_id FROM subject_assignments WHERE student_id = :student_id2))
                      AND sa.presentation_date > :current_date
                      GROUP BY sa.sujet_id, sa.presentation_date
                      ORDER BY sa.presentation_date ASC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->bindParam(':student_id2', $studentId);
            $stmt->bindParam(':current_date', $currentDate);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération des présentations: " . $e->getMessage());
            return [];
        }
    }

    public function getPastPresentations($studentId) {
        try {
            $currentDate = date('Y-m-d H:i:s');
            $query = "SELECT sa.id, s.titre, sa.presentation_date, s.description,
                             sa.status, GROUP_CONCAT(u.nom) as student_names
                      FROM subject_assignments sa
                      JOIN sujet s ON sa.sujet_id = s.id_sujet
                      JOIN user u ON sa.student_id = u.id_user
                      WHERE (sa.student_id = :student_id OR sa.sujet_id IN 
                            (SELECT sujet_id FROM subject_assignments WHERE student_id = :student_id2))
                      AND sa.presentation_date <= :current_date
                      GROUP BY sa.sujet_id, sa.presentation_date
                      ORDER BY sa.presentation_date DESC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->bindParam(':student_id2', $studentId);
            $stmt->bindParam(':current_date', $currentDate);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération des présentations: " . $e->getMessage());
            return [];
        }
    }

    public function updatePresentationStatus($sujetId, $status) {
        try {
            $query = "UPDATE subject_assignments 
                     SET status = :status 
                     WHERE sujet_id = :sujet_id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':sujet_id', $sujetId);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur de mise à jour du statut: " . $e->getMessage());
            return false;
        }
    }

    public function getSujetsWithStatus() {
        try {
            $query = "SELECT s.*, sa.status as presentation_status,
                             GROUP_CONCAT(u.nom) as student_names
                      FROM sujet s
                      LEFT JOIN subject_assignments sa ON s.id_sujet = sa.sujet_id
                      LEFT JOIN user u ON sa.student_id = u.id_user
                      WHERE s.status = 'Validé'
                      GROUP BY s.id_sujet";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération des sujets: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalPresentations() {
        try {
            $query = "SELECT COUNT(*) as total FROM subject_assignments WHERE presentation_date IS NOT NULL";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            error_log("Erreur de comptage des présentations: " . $e->getMessage());
            return 0;
        }
    }

    public function getStudentStats($studentId) {
        try {
            // Total des présentations
            $query = "SELECT 
                        COUNT(*) as total_presentations,
                        SUM(CASE WHEN presentation_date < NOW() THEN 1 ELSE 0 END) as completed_presentations,
                        SUM(CASE WHEN presentation_date > NOW() THEN 1 ELSE 0 END) as upcoming_presentations
                     FROM subject_assignments 
                     WHERE student_id = :student_id 
                     AND presentation_date IS NOT NULL";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération des statistiques: " . $e->getMessage());
            return [
                'total_presentations' => 0,
                'completed_presentations' => 0,
                'upcoming_presentations' => 0
            ];
        }
    }
    

    public function getRecentPresentations($limit = 5) {
        try {
            $query = "SELECT sa.*, s.titre, GROUP_CONCAT(u.nom) as student_names 
                     FROM subject_assignments sa
                     JOIN sujet s ON sa.sujet_id = s.id_sujet
                     JOIN user u ON sa.student_id = u.id_user
                     WHERE sa.presentation_date IS NOT NULL
                     GROUP BY sa.id
                     ORDER BY sa.presentation_date DESC
                     LIMIT :limit";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération des présentations récentes: " . $e->getMessage());
            return [];
        }
    }

    public function getEtudiantRecentPresentations($studentId, $limit = 3){
        try {
            $query = "SELECT sa.*, s.titre, s.description
                     FROM subject_assignments sa
                     JOIN sujet s ON sa.sujet_id = s.id_sujet
                     WHERE sa.student_id = :student_id 
                     AND sa.presentation_date IS NOT NULL
                     ORDER BY sa.presentation_date DESC
                     LIMIT :limit";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur de récupération des présentations récentes: " . $e->getMessage());
            return [];
        }
    }

    public function assignStudentsToSujet($sujetId, $studentIds) {
        try {
            // Supprimer les anciennes assignations
            $deleteQuery = "DELETE FROM subject_assignments WHERE sujet_id = :sujet_id";
            $stmt = $this->conn->prepare($deleteQuery);
            $stmt->bindParam(':sujet_id', $sujetId);
            $stmt->execute();

            // Récupérer la date de présentation du sujet
            $dateQuery = "SELECT presentation_date FROM subject_assignments 
                         WHERE sujet_id = :sujet_id 
                         LIMIT 1";
            $stmtDate = $this->conn->prepare($dateQuery);
            $stmtDate->bindParam(':sujet_id', $sujetId);
            $stmtDate->execute();
            $presentationDate = $stmtDate->fetchColumn();

            // Insérer les nouvelles assignations
            $insertQuery = "INSERT INTO subject_assignments (sujet_id, student_id, status, presentation_date) 
                           VALUES (:sujet_id, :student_id, 'pending', :presentation_date)";
            $stmt = $this->conn->prepare($insertQuery);

            foreach ($studentIds as $studentId) {
                $stmt->bindParam(':sujet_id', $sujetId);
                $stmt->bindParam(':student_id', $studentId);
                $stmt->bindParam(':presentation_date', $presentationDate);
                $stmt->execute();
            }

            return [
                'success' => true,
                'presentation_date' => $presentationDate
            ];

        } catch (PDOException $e) {
            error_log("Erreur d'assignation des étudiants: " . $e->getMessage());
            return [
                'success' => false,
                'presentation_date' => null
            ];
        }
    }
} 