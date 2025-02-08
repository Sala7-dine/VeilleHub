<?php 
require_once(__DIR__.'/../config/db.php');
class User extends db {

public function __construct()
{
    parent::__construct();
}

public function register($username , $email , $password , $role , $status){

    $result = $this->conn->prepare("INSERT INTO user (email , nom , status , password , role) 
    VALUES (:email , :nom , :status , :password , :role)");

    $result->bindParam(":email" , $email);
    $result->bindParam(":nom" , $username);
    $result->bindParam(":status" , $status);
    $result->bindParam(":password" , $password);
    $result->bindParam(":role" , $role);
   
    try {
       
        $result->execute();
        return $this->conn->lastInsertId();
        
       
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

public function login($email , $password){
    
    $result = $this->conn->prepare("SELECT * FROM user WHERE email=:email");
    $result->bindParam(":email" , $email);

    try {
        $result->execute();
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password , $user["password"])){
           return $user;
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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

}