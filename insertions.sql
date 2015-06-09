----------Insertions Client----------------------------

INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('dup', 'dupont', 'dupp', 'personne', 30, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('kro', 'kromwel', 'krop', 'personne', 0, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('wan', 'wang', 'wanp', 'personne', 0, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('voi', 'voinier', 'voip', 'personne', 40, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('tal', 'talouka', 'talp', 'personne', 10, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('rai', 'rain', 'raip', 'personne', 0, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('wi', 'weill', 'weip', 'personne', 0, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('coh', 'cohen', 'cohp', 'personne', 0, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('mic', 'michel', 'micp', 'personne', 0, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('dan', 'daniel', 'danp', 'personne', 10, 'client', false);
/*INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('pui', 'puiffe', 'puip', 'personne', 30);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('des', 'despierres', 'desp', 'personne', 30);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('dem', 'dempure', 'demp', 'personne', 20);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('bau', 'bauchet', 'baup', 'personne', 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('gui', 'guillemot', 'guip', 'personne', 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('hua', 'huang', 'huap', 'personne', 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('pel', 'pellerin', 'pelp', 'personne', 40);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('pic', 'pichou', 'picp', 'personne', 10);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('vua', 'vuatrin', 'vuap', 'personne', 50);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction)
VALUES ('dio', 'dionisi', 'diop', 'personne', 0); */
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('nes', 'nespoli', 'ness', 'societe', 20, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('gla', 'glass', 'glas', 'societe', 40, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('gav', 'gavametal', 'gavs', 'societe', 30, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('exc', 'excellium', 'excs', 'societe', 10, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('mir', 'mirometrics', 'mirs', 'societe', 0, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('pro', 'prodel', 'pros', 'societe', 0, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('cet', 'cetim', 'cets', 'societe', 50, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('sol', 'solvakem', 'sols', 'societe', 20, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('met', 'metallerie', 'mets', 'societe', 20, 'client', false);
INSERT INTO client (login, nom, mot_de_passe, typeP, taux_de_reduction, role_client, abonne)
VALUES ('tec', 'technotrans', 'tecs', 'societe', 10, 'client', false);

----------Insertions Role----------------------------------------------
INSERT INTO Role (type_role) 
VALUES
('administrateur'),
('client');


----------Insertions Administrateur----------------------------

INSERT INTO Administrateur (login, nom, mot_de_passe, role_admin)
VALUES 
('lyo', 'lyon', 'lyos', 'administrateur'),
('upa', 'upark', 'upas', 'administrateur'),
('dou', 'doudou', 'doup', 'administrateur')
;


----------Insertions Type_vehicule----------------------------

INSERT INTO Type_vehicule (nb_roues )
VALUES ('2');
INSERT INTO Type_vehicule (nb_roues )
VALUES ('4');
INSERT INTO Type_vehicule (nb_roues )
VALUES ('8');



----------Insertions Zones----------------------------

INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('La Duchère', 3, 200);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Saint Rambert', 4, 250);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Vaise', 2, 100);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Champvert - Gorge du Loup', 6, 600);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Champvert - Point du Jour - Jeunet', 3, 200);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Ménival - Battières - La Plaine', 3, 200);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Saint Just - Saint Irénée - Fourvière', 9, 950);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Vieux Lyon', 4, 250);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Pentes de la Croix-Rousse', 4, 250);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Croix-Rousse', 6, 600);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Tete d''Or', 4, 250);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Brotteaux - Bellecombe', 6, 600);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Mutualité - Préfecture', 4, 250);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Guillotière',2, 100);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Voltaire - Part Dieu', 3, 200);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Jean Macé',2, 100);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('La Mouche', 4, 250);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Gerland', 3, 200);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Grand Trou - Moulin à vent', 3, 200);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Etats-Unis',6, 600);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Monplaisir',2, 100);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Sans souci - Dauphiné', 3, 200);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Monchat',2, 100);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Bachut - Transvaal', 3, 200);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('La Plaine Santy',6, 600);
INSERT INTO zone (nom_zone, prix_h_zone, prix_m_zone)
VALUES ('Laennec Mermoz', 3, 200);


----------Insertions Vehicule----------------------------

INSERT INTO Vehicule (immatriculation, date_fabrication, marque, proprietaire, type_veh)
VALUES 
('AB-344-JJ',20140406,'renault','dup','2'),
('AA-678-AA',20120712,'bmw','kro','2'),
('CB-365-RE',20101228,'citroen','kro','4'),
('GF-956-IR',20140905,'suzuki','wan','2'),
('JG-453-UT',20130727,'renault','voi','4'),
('OR-845-JT',20130517,'peugeot','tal','4'),
('KF-862-HR',20090414,'mercedes','rai','4'),
('KF-143-HT',20051225,'mercedes','wi','4'),
('HF-647-VT',20090918,'suzuki','coh','2'),
('KT-142-JE',20100806,'audi','mic','4'),
('TR-263-JR',20140408,'dacia','mic','8'),
('TR-749-LE',20140304,'renault','mic','8'),
('OT-738-HD',20130116,'bmw','dan','2'),
('AB-248-PR',20120119,'renault','nes','8'),
('OT-974-QH',20110220,'bmw','gla','4'),
('PO-648-EK',20110712,'mercedes','gla','4'),
('TD-534-JG',20140621,'ford','gav','4'),
('GD-624-KE',20011107,'audi','exc','4'),
('PO-174-JG',20111203,'yamaha','mir','2'),
('HF-847-JR',20141101,'renault','pro','4'),
('CB-537-JW',20150327,'yamaha','pro','2'),
('KG-284-NR',20100925,'honda','pro','8'),
('HF-628-JT',20100406,'hyandai','cet','4'),
('JG-846-KE',20110805,'mercedes','cet','4'),
('JG-254-NR',20110808,'harley-davidson','sol','2'),
('KT-647-HR',20120309,'renault','sol','4'),
('LD-365-KG',20120928,'peugeot','sol','4'),
('LD-164-HD',20121020,'renault','sol','8'),
('NC-364-DJ',20140726,'mercedes','met','4'),
('NC-734-JJ',20140525,'ford','tec','4'),
('AB-465-HS',20090130,'renault','tec','8')
;



----------Insertions Parking----------------------------

INSERT INTO Parking (nom_park, zone_park, nbplaces_park, free_places)
VALUES 
('marche','La Duchère', 500, 400),
('guy','Champvert - Gorge du Loup', 120, 50),
('vinci','Vaise', 200, 80),
('hey','Champvert - Point du Jour - Jeunet', 300, 300),
('hello','Vieux Lyon', 150, 33),
('how','Croix-Rousse', 260, 157),
('salut','Tete d''Or', 600, 340),
('coucou','Mutualité - Préfecture', 500, 388),
('dommage','Guillotière', 260, 164),
('piscine','Jean Macé', 400, 59),
('plage','Gerland', 240, 139),
('mer','La Mouche', 160, 80),
('base','Monplaisir', 450, 400),
('donnee','Monchat', 100, 33),
('editeur','Bachut - Transvaal', 390, 270),
('message','La Plaine Santy', 130, 4),
('sortie','Laennec Mermoz', 200, 95),
('entree','Etats-Unis', 560, 430),
('fichier','Voltaire - Part Dieu', 80, 5),
('edition','Brotteaux - Bellecombe', 250, 25)
;



----------Insertions Place----------------------------

INSERT INTO Place (num_place, park_place, type_place, type_veh)
VALUES 
(1, 'marche', 'couvert', '2'),
(2, 'marche', 'dehors', '4'),
(3, 'marche', 'couvert', '4'),
(4, 'marche', 'dehors', '4'),
(5, 'marche', 'dehors', '8'),
(1, 'guy', 'couvert', '2'),
(2, 'guy', 'dehors', '4'),
(3, 'guy', 'couvert', '4'),
(4, 'guy', 'dehors', '4'),
(5, 'guy', 'dehors', '8'),
(1, 'vinci', 'couvert', '2'),
(2, 'vinci', 'dehors', '4'),
(3, 'vinci', 'couvert', '4'),
(4, 'vinci', 'dehors', '4'),
(5, 'vinci', 'dehors', '8'),
(1, 'hey', 'couvert', '2'),
(2, 'hey', 'dehors', '4'),
(3, 'hey', 'couvert', '4'),
(4, 'hey', 'dehors', '4'),
(5, 'hey', 'dehors', '8'),
(1, 'hello', 'couvert', '2'),
(2, 'hello', 'dehors', '4'),
(3, 'hello', 'couvert', '4'),
(4, 'hello', 'dehors', '4'),
(5, 'hello', 'dehors', '8'),
(1, 'how', 'couvert', '2'),
(2, 'how', 'dehors', '4'),
(3, 'how', 'couvert', '4'),
(4, 'how', 'dehors', '4'),
(5, 'how', 'dehors', '8'),
(1, 'salut', 'couvert', '2'),
(2, 'salut', 'dehors', '4'),
(3, 'salut', 'couvert', '4'),
(4, 'salut', 'dehors', '4'),
(5, 'salut', 'dehors', '8'),
(1, 'coucou', 'couvert', '2'),
(2, 'coucou', 'dehors', '4'),
(3, 'coucou', 'couvert', '4'),
(4, 'coucou', 'dehors', '4'),
(5, 'coucou', 'dehors', '8'),
(1, 'dommage', 'couvert', '2'),
(2, 'dommage', 'dehors', '4'),
(3, 'dommage', 'couvert', '4'),
(4, 'dommage', 'dehors', '4'),
(5, 'dommage', 'dehors', '8'),
(1, 'piscine', 'couvert', '2'),
(2, 'piscine', 'dehors', '4'),
(3, 'piscine', 'couvert', '4'),
(4, 'piscine', 'dehors', '4'),
(5, 'piscine', 'dehors', '8'),
(1, 'plage', 'couvert', '2'),
(2, 'plage', 'dehors', '4'),
(3, 'plage', 'couvert', '4'),
(4, 'plage', 'dehors', '4'),
(5, 'plage', 'dehors', '8'),
(1, 'mer', 'couvert', '2'),
(2, 'mer', 'dehors', '4'),
(3, 'mer', 'couvert', '4'),
(4, 'mer', 'dehors', '4'),
(5, 'mer', 'dehors', '8'),
(1, 'base', 'couvert', '2'),
(2, 'base', 'dehors', '4'),
(3, 'base', 'couvert', '4'),
(4, 'base', 'dehors', '4'),
(5, 'base', 'dehors', '8'),
(1, 'donnee', 'couvert', '2'),
(2, 'donnee', 'dehors', '4'),
(3, 'donnee', 'couvert', '4'),
(4, 'donnee', 'dehors', '4'),
(5, 'donnee', 'dehors', '8'),
(1, 'editeur', 'couvert', '2'),
(2, 'editeur', 'dehors', '4'),
(3, 'editeur', 'couvert', '4'),
(4, 'editeur', 'dehors', '4'),
(5, 'editeur', 'dehors', '8'),
(1, 'message', 'couvert', '2'),
(2, 'message', 'dehors', '4'),
(3, 'message', 'couvert', '4'),
(4, 'message', 'dehors', '4'),
(5, 'message', 'dehors', '8'),
(1, 'sortie', 'couvert', '2'),
(2, 'sortie', 'dehors', '4'),
(3, 'sortie', 'couvert', '4'),
(4, 'sortie', 'dehors', '4'),
(5, 'sortie', 'dehors', '8'),
(1, 'entree', 'couvert', '2'),
(2, 'entree', 'dehors', '4'),
(3, 'entree', 'couvert', '4'),
(4, 'entree', 'dehors', '4'),
(5, 'entree', 'dehors', '8'),
(1, 'fichier', 'couvert', '2'),
(2, 'fichier', 'dehors', '4'),
(3, 'fichier', 'couvert', '4'),
(4, 'fichier', 'dehors', '4'),
(5, 'fichier', 'dehors', '8'),
(1, 'edition', 'couvert', '2'),
(2, 'edition', 'dehors', '4'),
(3, 'edition', 'couvert', '4'),
(4, 'edition', 'dehors', '4'),
(5, 'edition', 'dehors', '8')
;





