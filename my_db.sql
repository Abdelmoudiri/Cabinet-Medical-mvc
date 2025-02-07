
CREATE TYPE user_status AS ENUM ('Actif', 'Suspendu');
CREATE TYPE rdv_status AS ENUM ('Confirmé', 'En Attente', 'Annulé');
CREATE TYPE roles AS ENUM ('medcin', 'patient');





CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_role INT NOT NULL,
    status user_status DEFAULT 'Actif',
    role roles,
    date_inscription DATE DEFAULT CURRENT_DATE
);


CREATE TABLE infos_medecin (
    id INT NOT NULL PRIMARY KEY,
    speciality VARCHAR(150) NOT NULL,
    experience INT NOT NULL CHECK (experience >= 0),
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE rendez_vous (
    id SERIAL PRIMARY KEY,
    id_medecin INT NOT NULL,
    id_patient INT NOT NULL,
    date_rdv DATE NOT NULL,
    status_rdv rdv_status DEFAULT 'En Attente',
    FOREIGN KEY (id_medecin) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_patient) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);
-- Insertion dans la table `users`
INSERT INTO users (nom, prenom, email, password, id_role, role) VALUES
('Dupont', 'Alice', 'alice.dupont@example.com', 'hashedpassword1', 1, 'medcin'),
('Martin', 'Bob', 'bob.martin@example.com', 'hashedpassword2', 2, 'patient'),
('Rousseau', 'Clara', 'clara.rousseau@example.com', 'hashedpassword3', 1, 'medcin');

-- Insertion dans la table `infos_medecin`
-- Assurez-vous que les IDs correspondent à ceux des médecins dans `users`
INSERT INTO infos_medecin (id, speciality, experience) VALUES
(1, 'Cardiologie', 10),
(3, 'Dermatologie', 5);

-- Insertion dans la table `rendez_vous`
-- Utilisez les IDs des médecins et patients insérés dans `users`
INSERT INTO rendez_vous (id_medecin, id_patient, date_rdv, status_rdv) VALUES
(1, 2, '2025-02-10', 'Confirmé'),
(3, 2, '2025-02-12', 'En Attente'),
(1, 2, '2025-02-15', 'Annulé');
