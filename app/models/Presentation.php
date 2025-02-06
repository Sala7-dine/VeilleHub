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
} 