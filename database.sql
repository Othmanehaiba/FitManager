CREATE DATABASE breif_db;

CREATE TABLE Cour (
    idCour INT PRIMARY KEY AUTO_INCREMENT,
    nomCour VARCHAR(50) NOT NULL,
    categorie VARCHAR(50) NOT NULL,
    dateCour DATE NOT NULL,
    heure TIME NOT NULL,
    durée INT NOT NULL,
    nbrMax INT NOT NULL
);

CREATE TABLE Equipement (
    idEquipement INT PRIMARY KEY AUTO_INCREMENT,
    nomEquipement VARCHAR(50) NOT NULL,
    typeEquipement VARCHAR(50) NOT NULL,
    qtsDispo INT NOT NULL,
    etat VARCHAR(50) NOT NULL
);

CREATE TABLE cour_equipement (
    idCour INT NOT NULL,
    idEquipement INT NOT NULL,
    PRIMARY KEY (idCour, idEquipement),
    FOREIGN KEY (idCour) REFERENCES Cour(idCour),
    FOREIGN KEY (idEquipement) REFERENCES Equipement(idEquipement)
);

CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    mdp VARCHAR(50) NOT NULL,
    firstName VARCHAR(20) NOT NULL,
    lastName VARCHAR(20) NOT NULL
);


