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
        $query = "SELECT s.*, GROUP_CONCAT(u.nom) as student_names, GROUP_CONCAT(u.id_user) as student_ids
            FROM sujet s
            LEFT JOIN user u ON s.id_student = u.id_user
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
        }

        return $sujets;
    } catch (PDOException $e) {
        error_log("Erreur de récupération des sujets: " . $e->getMessage());
        return [];
    }
}

public function assignStudentsToSujet($sujetId, $studentIds) {
    try {
       
        $deleteQuery = "DELETE FROM etudiant_sujet WHERE id_sujet = :sujet_id";
        $stmt = $this->conn->prepare($deleteQuery);
        $stmt->bindParam(':sujet_id', $sujetId);
        $stmt->execute();

       
        $insertQuery = "INSERT INTO etudiant_sujet (id_etudiant, id_sujet) VALUES (:student_id, :sujet_id)";
        $stmt = $this->conn->prepare($insertQuery);

        foreach ($studentIds as $studentId) {
            $stmt->bindParam(':student_id', $studentId);
            $stmt->bindParam(':sujet_id', $sujetId);
            $stmt->execute();
        }

        return true;
    } catch (PDOException $e) {
        error_log("Erreur d'assignation des étudiants: " . $e->getMessage());
        return false;
    }
}

}
