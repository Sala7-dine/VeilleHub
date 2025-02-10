<?php 
require_once(__DIR__.'/../config/db.php');
class Formateur extends db {

public function __construct()
{
    parent::__construct();
}

public function getAllUsers() {
    try {
        $query = "SELECT * FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

public function getUser($id){

    try {
        $query = "SELECT * FROM user where id_user = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id" , $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}

public function deleteUser($id) {

    try {
        $query = "DELETE FROM user WHERE id_user = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    } catch (PDOException $e) {
        error_log("Erreur de suppression d'utilisateur: " . $e->getMessage());
        return false;
    }
}

public function updateStatus($userId, $newStatus) {
    try {
        $query = "UPDATE user SET status = :status WHERE id_user = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $newStatus, PDO::PARAM_STR);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erreur de mise à jour du statut: " . $e->getMessage());
        return false;
    }
}

public function getAllStudents() {
    try {
        $query = "SELECT * FROM user WHERE role = 'Apprenant'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de récupération des étudiants: " . $e->getMessage());
        return [];
    }
}

public function getTotalUsers() {
    try {
        $query = "SELECT COUNT(*) as total FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch (PDOException $e) {
        error_log("Erreur de comptage des utilisateurs: " . $e->getMessage());
        return 0;
    }
}

public function getTotalStudents() {
    try {
        $query = "SELECT COUNT(*) as total FROM user WHERE role = 'Apprenant'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch (PDOException $e) {
        error_log("Erreur de comptage des étudiants: " . $e->getMessage());
        return 0;
    }
}

}