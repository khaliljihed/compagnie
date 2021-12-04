use db;
/*Procedures a ajouter*/

 
/*Affecter un pilote a un depart*/
DELIMITER $$
$$ 
DROP procedure if exists affecter_pilote_depart$$
CREATE PROCEDURE affecter_pilote_depart(IN numero_SS INT, IN id_depart INT)
BEGIN
insert into pilote_depart values(numero_SS,id_depart);
END
$$
 
/*Affecter un membre de l'equipage a un depart*/
DELIMITER $$
$$ 
DROP procedure if exists affecter_membre_depart$$
CREATE PROCEDURE affecter_membre_depart(IN numero_SS INT, IN id_depart INT)
BEGIN
insert into membre_equipage_depart values(numero_SS,id_depart);
END
$$


/* Ajouter un nouveau passager à la table passager*/
DELIMITER $$
$$ 
DROP procedure if exists nouveau_passager$$
CREATE PROCEDURE nouveau_passager( IN passeport_passager varchar(45), IN prenom varchar(45), IN nom varchar(45), IN adresse varchar(45), IN id_utilisateur INT, IN identifiant_depart INT)
BEGIN
call places(identifiant_depart);
insert ignore into passager values(passeport_passager,prenom,nom,adresse,id_utilisateur);
insert into billet values(numero_billet,date(now()),identifiant_depart,passeport_passager);
END 
$$ 


/* Faire sortir les vols disponibles à partir de la ville de depart et destination à partir de la date precisee*/
DELIMITER $$
$$ 
DROP procedure if exists mon_vol$$
CREATE PROCEDURE mon_vol(IN ville_depart varchar(45), IN ville_destination varchar(45), IN date_voyage DATE)
BEGIN

DROP TABLE if exists Aeroports_departs;
DROP TABLE if exists Aeroports_destinations;

CREATE TEMPORARY TABLE Aeroports_departs(nom_aeroport_depart varchar(45));
CREATE TEMPORARY TABLE Aeroports_destinations(nom_aeroport_destination varchar(45));

Insert into Aeroports_departs select nom_aeroport from aeroport where localisation=ville_depart;
Insert into Aeroports_destinations select nom_aeroport from aeroport where localisation=ville_destination;

Select nom_aeroport_depart, nom_aeroport_destination, date_depart, heure_depart, heure_arrivee, id_depart
From vol inner join depart using (numero_vol) inner join vol_aeroport using (numero_vol)  
Where place_libre>0 and 
      date_depart>=date_voyage and 
      numero_vol in (select numero_vol 
					 from vol_aeroport inner join (Aeroports_departs cross join Aeroports_destinations) using (nom_aeroport_depart,nom_aeroport_destination));
END 
$$

/* Afficher le personnel d'un vol (pilote et membre_equipage) pour l'administrateur à partir id_depart.*/
DELIMITER $$
$$ 
DROP procedure if exists consulter_personnel$$
CREATE PROCEDURE consulter_personnel(IN identifiant_depart INT)
BEGIN
DROP TABLE if exists id_pilote;
DROP TABLE if exists id_membre;

CREATE TEMPORARY TABLE id_pilote Select prenom AS prenom_pilote, nom AS nom_pilote
 								 From pilote 
                                 Where numero_SS in (Select numero_SS 
					                                 From pilote_depart  
					                                 Where id_depart=identifiant_depart);

CREATE TEMPORARY TABLE id_membre Select prenom AS prenom_membre_equipage, nom AS nom_membre_equipage 
                                 From membre_equipage 
                                 Where numero_SS in (Select numero_SS 
													 From membre_equipage_depart 
												     Where id_depart=identifiant_depart);
END 
$$

/* Decrementer places libres à chaque emission de billet pour un vol donne*/
DELIMITER $$
$$ 
DROP procedure if exists places$$
CREATE PROCEDURE places(IN identifiant_depart INT)
BEGIN
     update depart set place_libre=place_libre-1, place_occupee= place_occupee+1 where id_depart=identifiant_depart;
END 
$$

/* Ajouter un nouvel utilisateur à la table utilisateur et lui affecter un rôle*/
DELIMITER $$
$$ 
DROP procedure if exists nouvel_utilisateur$$
CREATE PROCEDURE nouvel_utilisateur(IN nom varchar(45), IN prenom varchar(45), IN email_u varchar(45), IN mot_de_passe varchar(45), IN id_role INT)
BEGIN
DECLARE id_utilisateur varchar(45);
insert ignore into utilisateur values (idUtilisateur, nom, prenom, email_u, mot_de_passe);
SET id_utilisateur := (Select idUtilisateur from utilisateur where email=email_u);
IF id_role=0 OR id_role=1 THEN
/* L'utilisateur est l'administateur (id_rôle=0) ou quelqu'un du personnel (id_rôle=1)*/
insert ignore into utilisateur_roles values (id_utilisateur,id_role);

ELSE
/* L'utilisateur est un passager par defaut -> id_rôle=10*/
insert ignore into utilisateur_roles values (id_utilisateur,10); 
END IF;
END 
$$

/*Verifie que le mot de passe correspond à l'email de l'utilisateur*/
DELIMITER $$
$$ 
DROP procedure if exists identification$$
CREATE PROCEDURE identification( IN mail varchar(45),IN mdp varchar(45),OUT valide INT)
BEGIN
Declare mot varchar(45);
Set valide=0;
SET mot := (Select mot_de_passe from utilisateur where email=mail);
IF mot=mdp THEN 
Set valide=1;

/*Recuperer l'identifiant de l'utilisateur*/
Select idUtilisateur from utilisateur where email=mail;
END IF;
END 
$$

/*Recuperer toutes les informations concernant un depart*/
DELIMITER $$
$$ 
DROP procedure if exists info_billet$$
CREATE PROCEDURE info_billet(IN identifiant_depart INT)
BEGIN
Declare nom varchar(45);
Declare v varchar(45);
Declare v1 varchar(45);

DROP TABLE if exists liaison;

CREATE TEMPORARY TABLE liaison(ville_depart varchar(45),ville_destination varchar(45),id_depart int);
 
SET nom=(select nom_aeroport_depart from vol_aeroport inner join depart using(numero_vol) where id_depart=identifiant_depart);
SET v=(select localisation from aeroport where nom_aeroport=nom);

SET nom:=(select nom_aeroport_destination from vol_aeroport inner join depart using(numero_vol) where id_depart=identifiant_depart);
SET v1:=(select localisation from aeroport where nom_aeroport=nom);
Insert into liaison values (v,v1,identifiant_depart);

Select date_emission, nom_aeroport_depart, ville_depart, nom_aeroport_destination, ville_destination, prix, heure_depart, heure_arrivee 
from billet inner join depart using (id_depart) 
			inner join vol using (numero_vol) 
			inner join vol_aeroport using (numero_vol)
            inner join liaison using (id_depart)
where id_depart=identifiant_depart;
END 
$$