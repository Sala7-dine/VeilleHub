<?php 
require_once(__DIR__.'/../config/db.php');
class Etudiant extends db {

public function __construct()
{
    parent::__construct();
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

}