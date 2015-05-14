CREATE TABLE Zone ( 
	nom_zone varchar (50) UNIQUE NOT NULL, 
	prix_h_zone int , 
	prix_m_zone int, 
	PRIMARY KEY (nom_zone)
);

CREATE TABLE Parking (
	nom_park varchar(50) UNIQUE NOT NULL, 
	zone_park varchar (50) NOT NULL, 
	nbplaces_park int NOT NULL, 
	free_places int, 
	FOREIGN KEY (zone_park) REFERENCES Zone(nom)
);

CREATE TABLE Place (
	num_place int UNIQUE NOT NULL, 
	park_place varchar (50) NOT NULL, 
	zone_place varchar (50) NOT NULL, 
	type_place enum ('couvert' , 'dehors'), 
	type_veh enum (2, 4, 8), 
	PRIMARY KEY(num_place, park_place, zone_place ), 
	FOREIGN KEY (park_place) REFERENCES parking(nom_park), 
	FOREIGN KEY (type_veh) REFERENCES type_veh(nb_roues),
	FOREIGN KEY (zone_place) REFERENCES parking(zone_park)
);

CREATE TABLE Type_veh (
	nb_roues enum {2,4,8}
);
 
CREATE TABLE Autorise ( --ETRANGE QUE CA SOIT UNE TABLE
	parking varchar (50) NOT NULL, 
	type_veh_a enum (2, 4, 8), 
	PRIMARY KEY(parking, type_veh_a),
	FOREIGN KEY (parking) REFERENCES parking (nom_park),
	FOREIGN KEY (type_veh_a) REFERENCES type_veh(nb_roues)
);

CREATE TABLE Vehicule (
	immatriculation int UNIQUE NOT NULL, 
	type_veh enum (2, 4, 8), 
	marque_veh varchar(25) NOT NULL, 
	date_fab_veh int NOT NULL, 
	proprietaire_a int, 
	proprietaire_o int,
	PRIMARY KEY(immatriculation),
	FOREIGN KEY (type_veh) REFERENCES type_veh(nb_roues),
	FOREIGN KEY (proprietaire_a) REFERENCES abonne(num_compte),
	FOREIGN KEY (proprietaire_o) REFERENCES occasionnel(ID)
);

CREATE TABLE Abonne ( -- Pourquoi c'est pas un héritage par classe mère pour Abonne et Occasionnel ? (voir) Simple_o simple_a
	num_compte int UNIQUE NOT NULL, 
	nom varchar(25) NOT NULL, 
	typeA ENUM ('personne', 'societe'), 
	date_abonnement date NOT NULL, 
	reduction int,
	PRIMARY KEY (num_compte)
	
) ;
--la réduction est un COUNT ( SELECT num_transac FROM Compte WHERE compte.num_compte=abonné.num_compte) With (nom, type) KEY

CREATE TABLE Occasionnel (
	ID int UNIQUE NOT NULL, 
	nom varchar(25) NOT NULL, 
	typeO ENUM ('personne', 'societe'),
	PRIMARY KEY (ID)
);


CREATE TABLE Compte (
	num_compte int UNIQUE NOT NULL,
	mois int NOT NULL, 
	année int NOT NULL, 
	num_transac int UNIQUE NOT NULL,
	PRIMARY KEY (num_compte) REFERENCES Abonne (num_compte) --il faut mettre aussi en clé étrangère mais je sais pas comment faire
	FOREIGN KEY (num_transac) REFERENCES reservation (num_transac)
);

CREATE TABLE Simple_o(-- equivalent à simple_a seule la méthode de calcul diffère, je suis pas certaine que ca nécessite 2 classes
	num_transac_so int UNIQUE NOT NULL, 
	client int UNIQUE NOT NULL, 
	place int NOT NULL,  
	date_transac date NOT NULL, 
	heure_transac int NOT NULL,  
	nb_heure int NOT NULL,
	Mpaiement enum ('carte', 'monnaie'),  
	prix_so float NOT NULL,
	PRIMARY KEY(num_transac_so , date_transac),
	FOREIGN KEY (client) REFERENCES occasionnel(ID),
	FOREIGN KEY (place) REFERENCES place(num_place),
	FOREIGN KEY (MPaiement) REFERENCES MPaiement(num)
); 
--méthode Setprice_so qui calcule le prix d’une réservation à l’heure effecuée par un occasionnel : elle est fonction du nombre d’heure et de prix_h_zone.
CREATE TABLE Simple_a(
	num_transac_sa int UNIQUE NOT NULL, 
	client int UNIQUE NOT NULL, 
	place int NOT NULL,   
	date_transac date NOT NULL, 
	heure_transac int NOT NULL,  
	nb_heure int NOT NULL, 
	Mpaiement enum ('carte', 'monnaie'), 
	prix_sa float NOT NULL, 
	PRIMARY KEY(num_transac_sa, date_transac),
	FOREIGN KEY (client) REFERENCES abonne(num_compte),
	FOREIGN KEY (place) REFERENCES place(num_place),
	FOREIGN KEY (MPaiement) REFERENCES MPaiement(num)
);
--méthode Setprice_sa qui calcule le prix d’une réservation à l’heure effecuée par un abonné : elle est fonction du nombre d’heure, de prix_h_zone ET du taux du réduction de l’abonné.

CREATE TABLE Reservation_a( 
	num_transac_ra int UNIQUE NOT NULL, 
	client int UNIQUE NOT NULL, 
	place int NOT NULL,
	mois int NOT NULL,   
	date_transac date NOT NULL, 
	heure_transac int NOT NULL, 
	Mpaiement enum ('carte', 'monnaie'), 
	prix_ra float NOT NULL, 
	PRIMARY KEY(num_transac_ra, date_transac),
	FOREIGN KEY (client) REFERENCES abonné(num_compte),
	FOREIGN KEY (place) REFERENCES place(num_place),
	FOREIGN KEY (Mpaiement) REFERENCES MPaiement(num)
);
--méthode Setprice_ra qui calcule le prix d’une réservation au mois effecuée par un abonné : elle est fonction du prix de prix_m_zone ET du taux du réduction de l’abonné.

MPaiement (
	num int UNIQUE NOT NULL, 
	type_paiement enum ('carte', 'monnaie'),
	PRIMARY KEY (num)
);
