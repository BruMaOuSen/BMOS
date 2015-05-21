CREATE TYPE nbRoues AS enum ('2','4','8');
CREATE TYPE typePlace AS enum ('couvert' , 'dehors');
CREATE TYPE typePersonne AS enum ('personne', 'societe');
CREATE TYPE moyenP AS enum ('carte', 'monnaie');
create type typeTransac as enum ('ticket', 'abonnement');

CREATE TABLE Zone ( 
nom_zone varchar (50) UNIQUE NOT NULL, 
prix_h_zone int , 
prix_m_zone int, 
PRIMARY KEY (nom_zone)
);

create table Client(
	login varchar(25) primary key,
	nom varchar(25) NOT NULL,
	typeP typePersonne NOT NULL,
	numero_compte integer UNIQUE NOT NULL,
	taux_de_reduction float,
	mot_de_passe varchar(25)
);

create table Administrateur(
	login varchar(25) primary key,
	nom varchar(25) NOT NULL,
	mot_de_passe varchar(25)
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
	FOREIGN KEY (type_veh) REFERENCES Type_vehicule(nb_roues),
	FOREIGN KEY (proprietaire) REFERENCES Client(login)
);
create table Parking(
	nom_park varchar(50) UNIQUE NOT NULL, 
	zone_park varchar (50) UNIQUE NOT NULL, 
	nbplaces_park int NOT NULL, 
	free_places int, 
	FOREIGN KEY (zone_park) REFERENCES Zone(nom_zone)
);

CREATE TABLE Autorise ( --ETRANGE QUE CA SOIT UNE TABLE
	parking varchar (50) NOT NULL, 
	type_veh_a nbRoues, 
	PRIMARY KEY(parking, type_veh_a),
	FOREIGN KEY (parking) REFERENCES parking (nom_park),
	FOREIGN KEY (type_veh_a) REFERENCES type_vehicule(nb_roues)
);

CREATE TABLE Place (
	num_place int UNIQUE NOT NULL, 
	park_place varchar (50) UNIQUE NOT NULL, 
	zone_place varchar (50) UNIQUE NOT NULL, 
	type_place typePlace, 
	type_veh nbRoues, 
	PRIMARY KEY(num_place, park_place, zone_place ), 
	FOREIGN KEY (park_place) REFERENCES Parking(nom_park), 
	FOREIGN KEY (type_veh) REFERENCES Type_vehicule(nb_roues),
	FOREIGN KEY (zone_place) REFERENCES Parking(zone_park)
);
CREATE TABLE Occupe (
	immatriculation varchar(25) UNIQUE NOT NULL, 
	nom_park varchar (25) UNIQUE NOT NULL, 
	numero integer UNIQUE NOT NULL, 
	date_debut integer NOT NULL, 
	date_fin integer NOT NULL, 
	PRIMARY KEY(immatriculation, nom_park, numero),
	FOREIGN KEY (immatriculation) REFERENCES Vehicule(immatriculation), 
	FOREIGN KEY (nom_park) REFERENCES Place(park_place),
	FOREIGN KEY (numero) REFERENCES Place(num_place)
	--CHECK ( verifier que vehiculeType = placeType)
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
	client varchar(25) REFERENCES Client(login),
	nom_park varchar(25) REFERENCES Place(park_place),
	numero_place integer REFERENCES Place(num_place)
);

-- CREATION DES BASES UTILISATEUR, ROLE ET PAGE POUR LA CONNEXION
create table Role (
	type_role varchar(50) PRIMARY KEY
);

create table utilisateur (
	pseudo varchar(50) PRIMARY KEY NOT NULL,
	mot_de_passe varchar(50),
	type_user varchar(50) REFERENCES Role(type_role)
);

create table Page (
	ID_page SERIAL PRIMARY KEY,
	nom_page varchar(50) 
);
create table RolePage (
	numero_page int REFERENCES Page(ID_page),
	role_page varchar(50) REFERENCES Role(type_role)
);