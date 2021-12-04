
/* Création et sélection de la base des données*/
CREATE DATABASE db;
USE db;

/* Drop tables : ceci permet de supprimer les tables afin de les récréer si elles existent*/
DROP TABLE IF EXISTS vol_aeroport;
DROP TABLE IF EXISTS pilote_depart;
DROP TABLE IF EXISTS pilote;
DROP TABLE IF EXISTS membre_equipage_depart;
DROP TABLE IF EXISTS membre_equipage;
DROP TABLE IF EXISTS billet;
DROP TABLE IF EXISTS depart;
DROP TABLE IF EXISTS vol;
DROP TABLE IF EXISTS passager;
DROP TABLE IF EXISTS utilisateur_role;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS avion;
DROP TABLE IF EXISTS aeroport;


/*Table airoport */
-- La table permet de creer l'entité airoport
-- Les aéroports sont identifiés par un nom et un code de 3 lettres : ce couple est un primary key
CREATE TABLE aeroport (
    nom_aeroport varchar(45) NOT NULL,
    code varchar(3) NOT NULL,
    localisation varchar(45) NOT NULL,
    PRIMARY KEY (nom_aeroport,code)
);

/*Table utilisateur */
-- Un utilisateur est un compte d'une personne dans le site
-- Ceci permet d'avoir une authentification Dans le site
CREATE TABLE utilisateur (
      idUtilisateur int(11) NOT NULL AUTO_INCREMENT,
      nom varchar(45) NOT NULL,
      prenom varchar(45) NOT NULL,
      email varchar(45) NOT NULL,
      mot_de_passe varchar(45) DEFAULT NULL,
      PRIMARY KEY (idUtilisateur),
      UNIQUE KEY email_UNIQUE (email)
);

/* Table roles */
-- Permet de définir les roles por les utilisateurs 
-- Ceci va se faire grâce à  la table intermédiaire utilisateur_role
--  Une telle table permet de ne pas avoir des roles non connus : Ceci permet d'assurer l'intégrité des données
CREATE TABLE roles (
    id_role int(1) NOT NULL,
    user_role varchar(15) NOT NULL,
    PRIMARY KEY (id_role)
);


/*Table utilisateur_role */
-- Cette table sert de liaison : elle associe à chaque utilisateur son role dans la BD
CREATE TABLE utilisateur_role (
    idutilisateur int(9) NOT NULL,
    id_role int(11) NOT NULL,
    PRIMARY KEY (idutilisateur,id_role),
    KEY role_idx (id_role),
    CONSTRAINT id_role FOREIGN KEY (id_role) REFERENCES roles (id_role),
    CONSTRAINT idutilisateur FOREIGN KEY (idutilisateur) REFERENCES utilisateur (idutilisateur)
);


/* Table passager */
-- Un passager est identifié par un numéro (qu'on a confondu avec son passeport), un nom, un prénom et une adresse.
-- Un passager peut avoir un compte utilisateur ou pas (le 'id_utilisateur' est par défaut Nul)
CREATE TABLE passager (
    passeport_passager varchar(10) NOT NULL,
    prenom varchar(45) NOT NULL,
    nom varchar(45) NOT NULL,
    adresse varchar(45) NOT NULL,
    IdUtilisateur int(9),
    PRIMARY KEY (passeport_passager),
    KEY ID_utilisateur_idx (IdUtilisateur),
    CONSTRAINT ID_utilisateur FOREIGN KEY (IdUtilisateur) REFERENCES utilisateur (idUtilisateur)
);

/*Table avion*/
-- La table a été créer afin de pouvoir identifier l'avion d'un vol et 
-- de maintenir les dates de controle et de début de service de l'avion en qeustion 
CREATE TABLE avion (
    numero_immatriculation varchar(10) NOT NULL,
    type_avion varchar(10) NOT NULL,
    date_debut_service date NOT NULL,
    date_controle date NOT NULL,
    PRIMARY KEY (numero_immatriculation)
);


/*Table vol*/
-- Un vol est donnée par son numéro, sa période, son arrivée et son départ 
-- ainsi que par l'avion (définie à partir de son immatriculation (Table avion))
CREATE TABLE vol (
    numero_vol int(7) NOT NULL AUTO_INCREMENT,
    debut_periode date NOT NULL,
    fin_periode date NOT NULL,
    heure_depart time NOT NULL,
    heure_arrivee time NOT NULL,
    numero_inmatriculation varchar(10) NOT NULL,
    PRIMARY KEY (numero_vol),
    KEY numero_inmatriculation_idx (numero_inmatriculation),
    CONSTRAINT num_inmatriculation FOREIGN KEY (numero_inmatriculation) REFERENCES avion (numero_immatriculation)
);

/*Table depart*/
-- Un départ est défini par un numéro de vol et une date de départ. A un
-- départ sont associés un ou deux pilotes et deux membres d’équipage. Un départ
-- est également caractérisé par un nombre de places libres et un nombre de places
-- occupées. Une place occupée est une place ayant donné lieu à une réservation
-- avec émission d’un billet.
-- 
CREATE TABLE depart (
    id_depart int(8) NOT NULL AUTO_INCREMENT,
    place_libre int(4) DEFAULT NULL,
    place_occupee int(4) DEFAULT NULL,
    date_depart date NOT NULL,
    numero_vol int(7) NOT NULL,
    prix int(4) NOT NULL,
    PRIMARY KEY (id_depart),
    KEY numero_vol_idx (numero_vol),
    CONSTRAINT numero_vol FOREIGN KEY (numero_vol) REFERENCES vol (numero_vol) ON DELETE CASCADE
);

/*Table billet*/
-- Un billet est repéré par son numéro. Il comporte une date d’émission et un prix.
-- Un billet référence un départ et un seul. On suppose aussi qu’un billet concerne
-- un client et un seul.
CREATE TABLE billet (
    numero_billet int(10) NOT NULL AUTO_INCREMENT,
    date_emission date NOT NULL,
    id_depart int(11) NOT NULL,
    passeport_passager varchar(10) NOT NULL,
    PRIMARY KEY (numero_billet),
    KEY Id_depart_idx (id_depart),
    KEY passeport_passager_idx (passeport_passager),
    CONSTRAINT Id_depart FOREIGN KEY (id_depart) REFERENCES depart (id_depart),
    CONSTRAINT passeport_passager FOREIGN KEY (passeport_passager) REFERENCES passager (passeport_passager)
);

/*Table membre_equipage */
CREATE TABLE membre_equipage (
    numero_ss int(13) NOT NULL,
    fonction varchar(45) NOT NULL,
    heures_vol int(11) DEFAULT NULL,
    prenom varchar(45) NOT NULL,
    nom varchar(45) NOT NULL,
    adresse varchar(45) DEFAULT NULL,
    salaire varchar(45) DEFAULT NULL,
    PRIMARY KEY (numero_SS)
);


/*Table membre_equipage_depart*/
-- Permet de faire un mapping entre table départ et table membre_equipage
CREATE TABLE membre_equipage_depart (
  numero_SS int(11) NOT NULL,
  id_depart int(11) DEFAULT NULL,
  KEY numero_SS2_idx (numero_SS),
  KEY id_depart3_idx (id_depart),
  CONSTRAINT id_depart3 FOREIGN KEY (id_depart) REFERENCES depart (id_depart),
  CONSTRAINT numero_SS2 FOREIGN KEY (numero_SS) REFERENCES membre_equipage (numero_SS) ON DELETE CASCADE
);

/* Table pilote */
CREATE TABLE pilote (
  numero_SS int(13) NOT NULL,
  numero_license int(11) DEFAULT NULL,
  heures_vol int(11) DEFAULT NULL,
  prenom varchar(45) DEFAULT NULL,
  nom varchar(45) DEFAULT NULL,
  adresse varchar(45) DEFAULT NULL,
  salaire int(11) DEFAULT NULL,
  PRIMARY KEY (numero_SS)
);


/*Table pilote_depart'*/
-- Table intermédiaire qui assoicie à chaque départ un pilote
CREATE TABLE pilote_depart (
  numero_SS int(13) NOT NULL,
  id_depart int(11) NOT NULL,
  KEY id_depart_idx (id_depart),
  KEY numero_SS3_idx (numero_SS),
  CONSTRAINT id_depart2 FOREIGN KEY (id_depart) REFERENCES depart (id_depart) ON DELETE CASCADE,
  CONSTRAINT numero_SS3 FOREIGN KEY (numero_SS) REFERENCES pilote (numero_SS) ON DELETE CASCADE
);




/*Table vol_aeroport */
CREATE TABLE vol_aeroport (
  numero_vol int(11) NOT NULL,
  nom_aeroport_depart varchar(45) DEFAULT NULL,
  code_depart varchar(45) DEFAULT NULL,
  nom_aeroport_destination varchar(45) DEFAULT NULL,
  code_destination varchar(45) DEFAULT NULL,
  KEY numero_vol2_idx (numero_vol),
  KEY aerport_depart_idx (nom_aeroport_depart,code_depart),
  KEY aeroport_destination_idx (nom_aeroport_destination,code_destination),
  CONSTRAINT aeroport_destination FOREIGN KEY (nom_aeroport_destination, code_destination) REFERENCES aeroport (nom_aeroport, code) ON DELETE CASCADE,
  CONSTRAINT aeroport_depart FOREIGN KEY (nom_aeroport_depart, code_depart) REFERENCES aeroport (nom_aeroport, code) ON DELETE CASCADE,
  CONSTRAINT numero_vol2 FOREIGN KEY (numero_vol) REFERENCES vol (numero_vol) ON DELETE CASCADE
);


/*Remplissage de la base des données*/
INSERT INTO aeroport (nom_aeroport, code , localisation)
    VALUES 
    ('Guangzhou Baiyun International Airport','CAN', 'Guangdong' ),
    ('Hartsfield–Jackson International Airport', 'ATL', 'Georgia'),
    ('Indira Gandhi International Airport', 'DEL', 'Delhi'),
    ('Charles de Gaulle','CDG','Paris'),
    ('Madrid-Barajas','MAD','Madrid'),
    ('Frankfurt Airport','FRA','Frankfurt'),
    ('Saint-Exupery','LYS','Lyon'),
    ('Orly','ORY', 'Paris');


INSERT INTO utilisateur (idutilisateur, nom, prenom, email, mot_de_passe ) 
    VALUES 
    (1,'Dupin','Margaux','margaux@example.com','mdp_margaux'),
    (2,'Alex','Pechard','alex@example.com','mdp_alex'),
    (3,'Erwan','Pascal','erwan@example.com','mdp_erwan'),
    (4,'Julien','Martin','julien@example.com','mdp_julien' );

INSERT INTO roles (id_role, user_role)
    VALUES
    (1,'Administrateur'),
    (2,'Personnel'),
    (3,'Passager');

INSERT INTO utilisateur_role (idutilisateur, id_role)
    VALUES 
    (1,1),
    (2,2),
    (3,3),
    (4,1);

INSERT INTO passager (passeport_passager, prenom, nom, adresse, idutilisateur)
    VALUES 
    ('X12345','Ghassen','Lassoued','Lyon', NULL),
    ('X12346', 'Erwan', 'Pascal', 'Lille', 3),
    ('X12347','Gaia','Bouchet','Lyon', NULL),
    ('X12348', 'Claire', 'Fralle', 'Lille', NULL);

INSERT INTO avion (numero_immatriculation, type_avion, date_debut_service, date_controle)
    VALUES
    ('F12345','A340', '2004-01-22', '2020-01-22'),
    ('G12345','B747','2005-03-02','2021-11-12'),
    ('T12345','B737','2006-09-30','2021-11-20');

INSERT INTO vol (debut_periode,fin_periode,heure_depart,heure_arrivee,numero_inmatriculation) 
    VALUES
    ('2020-11-01','2020-12-01','08:30:00','09:45:00','F12345'),
    ('2020-11-01','2020-12-01','18:30:00','19:45:00','G12345'),
    ('2020-11-01','2020-12-01','12:30:00','14:00:00','T12345');

INSERT INTO depart (id_depart, place_libre, place_occupee, date_depart, numero_vol, prix )
    VALUES 
    (1,178,2,'2021-10-01',1,105),
    (2,0,180,'2021-10-08',2,205),
    (3,180,0,'2021-10-15',3,97),
    (4,180,0,'2021-10-22',2,90);

INSERT INTO billet (numero_billet, date_emission, id_depart, passeport_passager)
    VALUES 
    (1,'2021-10-01',1,'x12345'),
    (2,'2021-10-08',2,'x12346'),
    (3,'2021-10-15',3,'x12347'),
    (4,'2022-12-29',1,'x12348');

INSERT INTO membre_equipage
    VALUES
    (6900006,'hôtesse',100,'Elsa','Deroux','Toulouse','30000'),
    (6900007,'hôtesse',120,'Camille','Swift','Paris','30000'),
    (6900008,'steward',130,'Yoann','Dassanoy','Lyon','30000'),
    (6900009,'steward',140,'Christophe','Laberge','Marseille','30000');

INSERT INTO membre_equipage_depart
    VALUES
    (6900006,1),
    (6900008,1),
    (6900006,2),
    (6900008,2),
    (6900006,3),
    (6900008,3),
    (6900006,4),
    (6900008,4),
    (6900006,1),
    (6900008,2),
    (6900006,3),
    (6900008,4),
    (6900006,1),
    (6900008,2),
    (6900006,3),
    (6900008,4);

INSERT INTO pilote
    VALUES 
    (6900001,20,100,'Jean','BINET','Lyon',36000),
    (6900002,21,150,'Stephane','BLANC','Lyon',36000),
    (6900003,22,120,'Sylvie','ANGONIN','Grenoble',36000),
    (6900004,23,130,'Ludovic','LAFORET','Annecy',36000),
    (6900005,24,140,'Nathalie','MOITA','Poitiers',36000);

INSERT INTO pilote_depart
    VALUES 
    (6900001,1),
    (6900001,2),
    (6900001,3),
    (6900001,4),
    (6900001,1),
    (6900002,2),
    (6900002,3),
    (6900002,4),
    (6900002,1),
    (6900002,2),
    (6900003,3),
    (6900003,4),
    (6900003,1),
    (6900003,2),
    (6900003,3),
    (6900004,4);

INSERT INTO vol_aeroport 
    VALUES
    (3,'Saint-Exupery','LYS','Orly','ORY'),    
    (1,'Saint-Exupery','LYS','Charles de Gaulle','CDG'),
    (2,'Charles de Gaulle','CDG','Saint-Exupery','LYS');
