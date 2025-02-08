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
            $query = "SELECT sa.id, s.titre, sa.presentation_date, s.description,
                             sa.status, GROUP_CONCAT(u.nom) as student_names
                      FROM subject_assignments sa
                      JOIN sujet s ON sa.sujet_id = s.id_sujet
                      JOIN user u ON sa.student_id = u.id_user
                      WHERE (sa.student_id = :student_id OR sa.sujet_id IN 
                            (SELECT sujet_id FROM subject_assignments WHERE student_id = :student_id2))
                      AND sa.presentation_date IS NOT NULL
                      GROUP BY sa.sujet_id, sa.presentation_date
                      ORDER BY sa.presentation_date DESC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->bindParam(':student_id2', $studentId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
} 