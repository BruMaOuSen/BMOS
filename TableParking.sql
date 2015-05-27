CREATE TYPE nbRoues AS enum ('2','4','8');
CREATE TYPE typePlace AS enum ('couvert' , 'dehors');
CREATE TYPE typePersonne AS enum ('personne', 'societe');
CREATE TYPE moyenP AS enum ('carte', 'monnaie');
create type typeTransac as enum ('ticket', 'abonnement');


CREATE TABLE Zone ( 
nom_zone varchar (50) PRIMARY KEY, 
prix_h_zone int , 
prix_m_zone int 
);

create table Client(
	login varchar(25) primary key,
	nom varchar(25) NOT NULL,
	typeP typePersonne NOT NULL,
	numero_compte SERIAL NOT NULL,
	taux_de_reduction float,
	mot_de_passe varchar(25),
	role_client varchar(50) NOT NULL,
	FOREIGN KEY (role_client) REFERENCES Role(type_role) ON DELETE CASCADE ON UPDATE CASCADE
);

create table Administrateur(
	login varchar(25) primary key,
	nom varchar(25) NOT NULL,
	mot_de_passe varchar(25)
	role_admin varchar(50) NOT NULL,
	FOREIGN KEY (role_admin) REFERENCES Role(type_role) ON DELETE CASCADE ON UPDATE CASCADE
);



create table Type_vehicule(
	nb_roues nbRoues primary key
);

create table Vehicule(
	immatriculation varchar(25) primary key,
	date_fabrication integer NOT NULL,
	marque varchar(25),
	proprietaire varchar(25) NOT NULL,
	type_veh nbRoues NOT NULL,
	FOREIGN KEY (type_veh) REFERENCES Type_vehicule(nb_roues) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (proprietaire) REFERENCES Client(login) ON DELETE CASCADE ON UPDATE CASCADE
);

create table Parking(
	nom_park varchar(50) PRIMARY KEY, 
	zone_park varchar (50) UNIQUE NOT NULL, 
	nbplaces_park int NOT NULL, 
	free_places int, 
	FOREIGN KEY (zone_park) REFERENCES Zone(nom_zone)
);

CREATE TABLE Autorise ( 
	parking varchar (50) NOT NULL, 
	type_veh_a nbRoues, 
	PRIMARY KEY(parking, type_veh_a),
	FOREIGN KEY (parking) REFERENCES Parking (nom_park) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (type_veh_a) REFERENCES Type_vehicule(nb_roues) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Place (
	num_place int NOT NULL, 
	park_place varchar (50),  
	type_place typePlace, 
	type_veh nbRoues, 
	PRIMARY KEY(num_place, park_place), 
	FOREIGN KEY (park_place) REFERENCES Parking(nom_park) ON DELETE CASCADE ON UPDATE CASCADE, 
	FOREIGN KEY (type_veh) REFERENCES Type_vehicule(nb_roues) ON DELETE CASCADE ON UPDATE CASCADE	
);

CREATE TABLE Occupe (
	immatriculation varchar(25), 
	nom_park varchar (50), 
	numero int, 
	date_debut integer NOT NULL, 
	date_fin integer NOT NULL, 
	PRIMARY KEY(immatriculation, nom_park, numero),
	FOREIGN KEY (immatriculation) REFERENCES Vehicule(immatriculation) ON DELETE CASCADE ON UPDATE CASCADE, 
	FOREIGN KEY (nom_park, numero) REFERENCES Place(park_place, num_place) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Transac (
	numero_transac int PRIMARY KEY,
	date_achat integer NOT NULL,
	date_debut integer NOT NULL,
	date_fin integer NOT NULL,
	prix float NOT NULL,
	type_t typeTransac NOT NULL,
	numero_paiement integer NOT NULL,
	moyen_p moyenP NOT NULL,
	client varchar(25) REFERENCES Client(login) ON DELETE CASCADE ON UPDATE CASCADE,
	nom_park varchar(50),
	numero_place integer,
	FOREIGN KEY (nom_park, numero_place) REFERENCES Place(park_place, num_place) ON DELETE CASCADE ON UPDATE CASCADE
);

-- CREATION DES BASES UTILISATEUR, ROLE ET PAGE POUR LA CONNEXION
create table Role (
	type_role varchar(50) PRIMARY KEY
);

create table utilisateur (
	pseudo varchar(50) PRIMARY KEY NOT NULL,
	mot_de_passe varchar(50),
	type_user varchar(50) REFERENCES Role(type_role) ON DELETE CASCADE ON UPDATE CASCADE
);

create table Page (
	ID_page SERIAL PRIMARY KEY,
	nom_page varchar(50) 
);
create table RolePage (
	numero_page int REFERENCES Page(ID_page) ON DELETE CASCADE ON UPDATE CASCADE,
	role_page varchar(50) REFERENCES Role(type_role) ON DELETE CASCADE ON UPDATE CASCADE
);