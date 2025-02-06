CREATE DATABASE VielleHub;
USE VielleHub;

-- Table user
CREATE TABLE user (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Formateur', 'Apprenant') NOT NULL
);

-- Table calendrier
CREATE TABLE calendrier (
    id_calendrier INT PRIMARY KEY AUTO_INCREMENT,
    date_de_presentation DATE NOT NULL
);

-- Table presentation
CREATE TABLE presentation (
    id_presentation INT PRIMARY KEY AUTO_INCREMENT,
    date_realisation DATE NOT NULL,
    lien_presentation VARCHAR(255) NOT NULL,
    status ENUM('A venir', 'passé') NOT NULL,
    titre VARCHAR(255) NOT NULL,
    id_calendrier INT,
    FOREIGN KEY (id_calendrier) REFERENCES calendrier(id_calendrier) 
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table notification
CREATE TABLE notification (
    id_notification INT PRIMARY KEY AUTO_INCREMENT,
    date_envoi DATE NOT NULL,
    message TEXT NOT NULL
);

-- Table etudiant
CREATE TABLE etudiant (
    id_etudiant INT PRIMARY KEY,
    FOREIGN KEY (id_etudiant) REFERENCES user(id_user) 
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table enseignant
CREATE TABLE enseignant (
    id_enseignant INT PRIMARY KEY,
    FOREIGN KEY (id_enseignant) REFERENCES user(id_user) 
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table sujet
CREATE TABLE sujet (
    id_sujet INT PRIMARY KEY AUTO_INCREMENT,
    description TEXT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    status ENUM('Proposé', 'Validé', 'Rejeté') NOT NULL
);

ALTER TABLE sujet 
ADD COLUMN IF NOT EXISTS id_student INT;


ALTER TABLE sujet
ADD CONSTRAINT fk_student_user
FOREIGN KEY (id_student) REFERENCES user(id_user)
ON DELETE CASCADE;


-- Relation entre enseignant et sujets (valider)
CREATE TABLE enseignant_sujet (
    id_enseignant INT,
    id_sujet INT,
    PRIMARY KEY (id_enseignant, id_sujet),
    FOREIGN KEY (id_enseignant) REFERENCES enseignant(id_enseignant) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_sujet) REFERENCES sujet(id_sujet) 
        ON DELETE CASCADE ON UPDATE CASCADE
);