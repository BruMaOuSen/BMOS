
-- Création des types

CREATE TYPE nbRoues AS enum ('2','4','8');
CREATE TYPE typePlace AS enum ('couvert' , 'dehors');
CREATE TYPE typePersonne AS enum ('personne', 'societe');
CREATE TYPE moyenP AS enum ('carte', 'monnaie');
CREATE TYPE typeTransac as enum ('ticket', 'abonnement'); 


-- Table: zone

-- DROP TABLE zone;

CREATE TABLE zone
(
  nom_zone character varying(50) NOT NULL,
  prix_h_zone integer,
  prix_m_zone integer,
  CONSTRAINT zone_pkey PRIMARY KEY (nom_zone),
  CONSTRAINT check_prix CHECK (prix_m_zone > prix_h_zone)
);

-- Table: role

-- DROP TABLE role;

CREATE TABLE role
(
  type_role character varying(50) NOT NULL,
  CONSTRAINT role_pkey PRIMARY KEY (type_role)
);

-- Table: client

-- DROP TABLE client;

CREATE TABLE client
(
  login character varying(25) NOT NULL,
  nom character varying(25) NOT NULL,
  typep typepersonne NOT NULL,
  mot_de_passe character varying(25) NOT NULL,
  role_client character varying(50) NOT NULL,
  abonne boolean,
  CONSTRAINT client_pkey PRIMARY KEY (login),
  CONSTRAINT client_role_client_fkey FOREIGN KEY (role_client)
      REFERENCES role (type_role) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

-- Table: compte

-- DROP TABLE compte;

CREATE TABLE compte
(
  numero_de_compte serial NOT NULL,
  taux_de_reduction double precision,
  loginc character varying(25) NOT NULL,
  date_creation timestamp with time zone NOT NULL,
  CONSTRAINT compte_pkey PRIMARY KEY (numero_de_compte),
  CONSTRAINT compte_loginc_fkey FOREIGN KEY (loginc)
      REFERENCES client (login) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT compte_loginc_key UNIQUE (loginc),
  CONSTRAINT check_tdr CHECK (taux_de_reduction >= 0::double precision AND taux_de_reduction <= 100::double precision)
);


-- Table: administrateur

-- DROP TABLE administrateur;

CREATE TABLE administrateur
(
  login character varying(25) NOT NULL,
  nom character varying(25) NOT NULL,
  mot_de_passe character varying(25) NOT NULL,
  role_admin character varying(50) NOT NULL,
  CONSTRAINT administrateur_pkey PRIMARY KEY (login),
  CONSTRAINT administrateur_role_admin_fkey FOREIGN KEY (role_admin)
      REFERENCES role (type_role) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);


-- Table: type_vehicule

-- DROP TABLE type_vehicule;

CREATE TABLE type_vehicule
(
  nb_roues nbroues NOT NULL,
  CONSTRAINT type_vehicule_pkey PRIMARY KEY (nb_roues)
);


-- Table: vehicule

-- DROP TABLE vehicule;

CREATE TABLE vehicule
(
  immatriculation character varying(25) NOT NULL,
  date_fabrication integer,
  marque character varying(25),
  proprietaire character varying(25) NOT NULL,
  type_veh nbroues NOT NULL,
  CONSTRAINT vehicule_pkey PRIMARY KEY (immatriculation),
  CONSTRAINT vehicule_proprietaire_fkey FOREIGN KEY (proprietaire)
      REFERENCES client (login) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT vehicule_type_veh_fkey FOREIGN KEY (type_veh)
      REFERENCES type_vehicule (nb_roues) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE parking
(
  nom_park character varying(50) NOT NULL,
  zone_park character varying(50) NOT NULL,
  nbplaces_park integer NOT NULL,
  free_places integer,
  CONSTRAINT parking_pkey PRIMARY KEY (nom_park),
  CONSTRAINT parking_zone_park_fkey FOREIGN KEY (zone_park)
      REFERENCES zone (nom_zone) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT check_nbplaces0 CHECK (nbplaces_park > 0),
  CONSTRAINT check_nbplacesfree CHECK (nbplaces_park >= free_places),
  CONSTRAINT check_nbplacesfree0 CHECK (free_places >= 0)
);


-- Table: autorise

-- DROP TABLE autorise;

CREATE TABLE autorise
(
  parking character varying(50) NOT NULL,
  type_veh_a nbroues NOT NULL,
  CONSTRAINT autorise_pkey PRIMARY KEY (parking, type_veh_a),
  CONSTRAINT autorise_parking_fkey FOREIGN KEY (parking)
      REFERENCES parking (nom_park) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT autorise_type_veh_a_fkey FOREIGN KEY (type_veh_a)
      REFERENCES type_vehicule (nb_roues) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);


-- Table: place

-- DROP TABLE place;

CREATE TABLE place
(
  num_place integer NOT NULL,
  park_place character varying(50) NOT NULL,
  type_place typeplace,
  type_veh nbroues,
  CONSTRAINT place_pkey PRIMARY KEY (num_place, park_place),
  CONSTRAINT place_park_place_fkey FOREIGN KEY (park_place)
      REFERENCES parking (nom_park) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT place_type_veh_fkey FOREIGN KEY (type_veh)
      REFERENCES type_vehicule (nb_roues) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);



-- Table: occupe

-- DROP TABLE occupe;

CREATE TABLE occupe
(
  immatriculation character varying(25) NOT NULL,
  nom_park character varying(50) NOT NULL,
  numero integer NOT NULL,
  date_debut timestamp with time zone NOT NULL,
  date_fin timestamp with time zone NOT NULL,
  CONSTRAINT occupe_pk PRIMARY KEY (immatriculation, nom_park, numero, date_debut, date_fin),
  CONSTRAINT occupe_immatriculation_fkey FOREIGN KEY (immatriculation)
      REFERENCES vehicule (immatriculation) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT occupe_nom_park_fkey FOREIGN KEY (nom_park, numero)
      REFERENCES place (park_place, num_place) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT check_dates CHECK (date_debut < date_fin)
);

-- Table: page

-- DROP TABLE page;

CREATE TABLE page
(
  id_page serial NOT NULL,
  nom_page character varying(50) NOT NULL,
  CONSTRAINT page_pkey PRIMARY KEY (id_page)
);



-- Table: transac

-- DROP TABLE transac;

CREATE TABLE transac
(
  numero_transac serial NOT NULL,
  date_achat timestamp with time zone NOT NULL,
  date_debut timestamp with time zone NOT NULL,
  date_fin timestamp with time zone NOT NULL,
  prix double precision NOT NULL,
  type_t typetransac NOT NULL,
  numero_paiement integer,
  moyen_p moyenp NOT NULL,
  client character varying(25),
  nom_park character varying(50),
  numero_place integer,
  CONSTRAINT transac_pkey PRIMARY KEY (numero_transac),
  CONSTRAINT transac_client_fkey FOREIGN KEY (client)
      REFERENCES client (login) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT transac_nom_park_fkey FOREIGN KEY (nom_park, numero_place)
      REFERENCES place (park_place, num_place) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);


-- Table: rolepage

-- DROP TABLE rolepage;

CREATE TABLE rolepage
(
  numero_page integer,
  role_page character varying(50),
  CONSTRAINT rolepage_numero_page_fkey FOREIGN KEY (numero_page)
      REFERENCES page (id_page) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT rolepage_role_page_fkey FOREIGN KEY (role_page)
      REFERENCES role (type_role) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
); 

/*
CREATE TRIGGER placesrestantes
AFTER DELETE OR INSERT ON place
FOR EACH ROW
BEGIN 
	IF DELETING THEN
		UPDATE parking SET free_places=free_places+1 WHERE parking.nom = :new.park_places;
	ELSEIF INSERTING THEN
		UPDATE parking SET free_places=free_places-1 WHERE parking.nom = :new.park_places;
	END IF;
END;
*/










