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


public function resetPassword($email) {
    try {
    
        $query = "SELECT id_user, nom, email FROM user WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Aucun utilisateur trouvé avec cet email'
            ];
        }


        $newPassword = $this->generateRandomPassword();
        
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $updateQuery = "UPDATE user SET password = :password WHERE id_user = :id";
        $updateStmt = $this->conn->prepare($updateQuery);
        $updateStmt->bindParam(':password', $hashedPassword);
        $updateStmt->bindParam(':id', $user['id_user']);
        $updateStmt->execute();
        
        $mailer = new Mailer();
        $emailSent = $mailer->sendPasswordResetEmail($user['email'], $user['nom'], $newPassword);
        
        if (!$emailSent) {
            return [
                'success' => false,
                'message' => "Erreur lors de l'envoi de l'email"
            ];
        }
        
        return [
            'success' => true,
            'message' => 'Un nouveau mot de passe a été envoyé à votre adresse email'
        ];
        
    } catch (PDOException $e) {
        error_log("Erreur de réinitialisation du mot de passe: " . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Une erreur est survenue'
        ];
    }
}

private function generateRandomPassword($length = 12) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    $password = '';
    
    $password .= $chars[rand(0, 25)]; // minuscule
    $password .= $chars[rand(26, 51)]; // majuscule
    $password .= $chars[rand(52, 61)]; // chiffre
    $password .= $chars[rand(62, strlen($chars)-1)]; // caractère spécial

    for($i = strlen($password); $i < $length; $i++) {
        $password .= $chars[rand(0, strlen($chars)-1)];
    }
    
    return str_shuffle($password);
}

}