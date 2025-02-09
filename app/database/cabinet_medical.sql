-- Création de la base de données
CREATE DATABASE IF NOT EXISTS cabinet_medical;
USE cabinet_medical;

-- Table des rôles
CREATE TABLE IF NOT EXISTS roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL UNIQUE
);

-- Table des utilisateursA
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_role INT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_role) REFERENCES roles(id)
);

-- Table des informations des médecins
CREATE TABLE IF NOT EXISTS infos_medecin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    speciality VARCHAR(100) NOT NULL,
    experience INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id)
);

-- Table des rendez-vous
CREATE TABLE IF NOT EXISTS rendez_vous (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_medecin INT NOT NULL,
    id_patient INT NOT NULL,
    date_rdv DATETIME NOT NULL,
    status_rdv ENUM('En Attente', 'Confirmé', 'Annulé') DEFAULT 'En Attente',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_medecin) REFERENCES users(id),
    FOREIGN KEY (id_patient) REFERENCES users(id)
);

-- Insertion des rôles de base
INSERT INTO roles (nom) VALUES 
('medecin'),
('patient')
ON DUPLICATE KEY UPDATE nom = VALUES(nom);

-- Insertion d'un médecin de test
INSERT INTO users (nom, prenom, email, password, id_role) VALUES
('Dupont', 'Jean', 'docteur@test.com', '$2y$10$8SOZe0Z0DXE/ZYZzWXPgE.FR/yNHw6JyG9dmC8pwRvECHbWMk8.Aq', 1)
ON DUPLICATE KEY UPDATE email = VALUES(email);

-- Récupérer l'ID du médecin inséré
SET @medecin_id = LAST_INSERT_ID();

-- Insertion des informations du médecin
INSERT INTO infos_medecin (id_user, speciality, experience) VALUES
(@medecin_id, 'Généraliste', 10)
ON DUPLICATE KEY UPDATE speciality = VALUES(speciality);

-- Insertion d'un patient de test
INSERT INTO users (nom, prenom, email, password, id_role) VALUES
('Martin', 'Sophie', 'patient@test.com', '$2y$10$8SOZe0Z0DXE/ZYZzWXPgE.FR/yNHw6JyG9dmC8pwRvECHbWMk8.Aq', 2)
ON DUPLICATE KEY UPDATE email = VALUES(email);
