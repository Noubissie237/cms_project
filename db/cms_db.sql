-- ----------------- |Création de la base de données    

CREATE TABLE clients (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255),
    email VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(15) NOT NULL
);

CREATE TABLE consultants (
    id_consultant INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    specialite VARCHAR(100),
    email VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(15) NOT NULL
);

CREATE TABLE projets (
    id_projet INT AUTO_INCREMENT PRIMARY KEY,
    nom_projet VARCHAR(100) NOT NULL,
    description TEXT,
    id_client INT NOT NULL,
    date_debut DATE,
    date_fin DATE,
    statut ENUM('en cours', 'terminé', 'annulé') DEFAULT 'en cours',
    FOREIGN KEY (id_client) REFERENCES clients(id_client) ON DELETE CASCADE
);

CREATE TABLE factures (
    id_facture INT AUTO_INCREMENT PRIMARY KEY,
    id_projet INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    date_emission DATE NOT NULL,
    statut ENUM('payée', 'non payée') DEFAULT 'non payée',
    FOREIGN KEY (id_projet) REFERENCES projets(id_projet) ON DELETE CASCADE
);

CREATE TABLE consultants_projets (
    id_consultant INT NOT NULL,
    id_projet INT NOT NULL,
    role VARCHAR(100),
    PRIMARY KEY (id_consultant, id_projet),
    FOREIGN KEY (id_consultant) REFERENCES consultants(id_consultant) ON DELETE CASCADE,
    FOREIGN KEY (id_projet) REFERENCES projets(id_projet) ON DELETE CASCADE
);

CREATE INDEX idx_client_email ON clients (email);
CREATE INDEX idx_consultant_email ON consultants (email);
CREATE INDEX idx_projet_statut ON projets (statut);


-- ----------------- |Insertion des données initiales

-- Insertion de clients
INSERT INTO clients (nom, adresse, email, telephone) 
VALUES 
('Entreprise Alpha', 'Yaoundé, Bastos', 'contact@alpha.com', '690000000'),
('Entreprise Beta', 'Bepanda, Douala', 'contact@beta.com', '670000000');

-- Insertion de consultants
INSERT INTO consultants (nom, specialite, email, telephone) 
VALUES 
('Consultant A', 'Stratégie', 'consultantA@exemple.com', '691111111'),
('Consultant B', 'Finance', 'consultantB@exemple.com', '671111111');

-- Insertion de projets
INSERT INTO projets (nom_projet, description, id_client, date_debut, date_fin, statut) 
VALUES 
('Projet 1', 'Description du projet 1', 1, '2024-01-01', '2024-06-01', 'en cours'),
('Projet 2', 'Description du projet 2', 2, '2023-05-01', '2023-11-01', 'terminé');

-- Insertion de factures
INSERT INTO factures (id_projet, montant, date_emission, statut) 
VALUES 
(1, 5000.00, '2024-02-01', 'non payée'),
(2, 10000.00, '2023-06-01', 'payée');

-- Insertion de consultants sur des projets
INSERT INTO consultants_projets (id_consultant, id_projet, role) 
VALUES 
(1, 1, 'Chef de projet'),
(2, 2, 'Consultant principal');
