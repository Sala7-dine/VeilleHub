<?php

class PresentationController {

    
    public function assignPresentation($studentInfo, $sujetInfo, $presentationDate) {
        try {
     
                $presentationDetails = [
                    'titre' => $sujetInfo['titre'],
                    'description' => $sujetInfo['description'],
                    'presentation_date' => $presentationDate
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
} 