<?php 
require_once(__DIR__.'/../config/db.php');
class Sujet extends db {

public function __construct()
{
    parent::__construct();
}


public function addUserSujet($id_user , $id_sujet){

    try {
        $query = "INSERT INTO etudiant_sujet(id_etudiant,id_sujet) VALUES (:id_etud , :id_sujet)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_etud', $id_user);
        $stmt->bindParam(':id_sujet', $id_sujet);
        
        $stmt->execute();   

        $result = $this->conn->lastInsertId();

    } catch (PDOException $e) {
        error_log("Erreur d'ajout de catégorie: " . $e->getMessage());
        return false;
    }

}

public function addSujet($user_id , $description , $title , $status){
    
    try {
        $query = "INSERT INTO sujet (description , titre , status , id_student) VALUES (:description , :title , :status , :id_std)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_std', $user_id);
        
        $stmt->execute();

    } catch (PDOException $e) {
        error_log("Erreur d'ajout de catégorie: " . $e->getMessage());
        return false;
    }
}

public function getAllSujets($id) {
    try {
        $query = "SELECT * FROM sujet where id_student = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id" , $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de récupération des sujets: " . $e->getMessage());
        return [];
    }
}

public function getSujetById($id) {
    try {
        $query = "SELECT * FROM sujet where id_sujet = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id" , $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de récupération des sujets: " . $e->getMessage());
        return [];
    }
}

public function deleteSujet($id) {
    try {
        $query = "DELETE FROM sujet WHERE id_sujet = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erreur de suppression de catégorie: " . $e->getMessage());
        return false;
    }
}

public function getAllSujetsWithStudents() {
    try {
        $query = "SELECT s.*, u.nom as student_name, u.email as student_email 
                 FROM sujet s 
                 LEFT JOIN user u ON s.id_student = u.id_user 
                 ORDER BY s.id_sujet DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de récupération des sujets: " . $e->getMessage());
        return [];
    }
}

public function updateSujetStatus($id_sujet, $status) {
    try {
        $query = "UPDATE sujet SET status = :status WHERE id_sujet = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id_sujet);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erreur de mise à jour du statut: " . $e->getMessage());
        return false;
    }
}

public function getSujetsWithAssignedStudents() {
    try {
        $query = "SELECT s.*, 
                  GROUP_CONCAT(DISTINCT u.nom) as student_names,
                  GROUP_CONCAT(DISTINCT u.id_user) as student_ids,
                  sa.status as presentation_status
                  FROM sujet s
                  LEFT JOIN subject_assignments sa ON s.id_sujet = sa.sujet_id
                  LEFT JOIN user u ON sa.student_id = u.id_user
                  WHERE s.status = 'Validé'
                  GROUP BY s.id_sujet";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $sujets = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Formater les données des étudiants
        foreach ($sujets as &$sujet) {
            if ($sujet['student_names']) {
                $names = explode(',', $sujet['student_names']);
                $ids = explode(',', $sujet['student_ids']);
                $sujet['assigned_students'] = array_map(function($id, $name) {
                    return ['id_user' => $id, 'nom' => $name];
                }, $ids, $names);
            } else {
                $sujet['assigned_students'] = [];
            }
            
            // Définir un statut par défaut si null
            if (!isset($sujet['presentation_status'])) {
                $sujet['presentation_status'] = 'pending';
            }
        }

        return $sujets;
    } catch (PDOException $e) {
        error_log("Erreur de récupération des sujets: " . $e->getMessage());
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

public function getAssignedStudents($sujetId) {
    try {
        $query = "SELECT u.*, sa.status as assignment_status, sa.presentation_date 
                 FROM subject_assignments sa
                 JOIN user u ON sa.student_id = u.id_user
                 WHERE sa.sujet_id = :sujet_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sujet_id', $sujetId);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de récupération des étudiants assignés: " . $e->getMessage());
        return [];
    }
}

public function getRecentSujets($limit = 5) {
    try {
        $query = "SELECT s.*, u.nom as student_name 
                 FROM sujet s
                 LEFT JOIN user u ON s.id_student = u.id_user
                 ORDER BY s.id_sujet DESC
                 LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de récupération des sujets récents: " . $e->getMessage());
        return [];
    }
}

public function getTotalSujets() {
    try {
        $query = "SELECT COUNT(*) as total FROM sujet";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch (PDOException $e) {
        error_log("Erreur de comptage des sujets: " . $e->getMessage());
        return 0;
    }
}

}
