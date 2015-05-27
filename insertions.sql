----------Insertions Client----------------------------

INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('dup', 'dupont', 'dupp', 'personne', 01, 30);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('kro', 'kromwel', 'krop', 'personne', 02, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('wan', 'wang', 'wanp', 'personne', 03, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('voi', 'voinier', 'voip', 'personne', 04, 40);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('tal', 'talouka', 'talp', 'personne', 05, 10);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('rai', 'rain', 'raip', 'personne', 06, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('wi', 'weill', 'weip', 'personne', 07, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('coh', 'cohen', 'cohp', 'personne', 08, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('mic', 'michel', 'micp', 'personne', 09, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('dan', 'daniel', 'danp', 'personne', 10, 10);
/*INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('pui', 'puiffe', 'puip', 'personne', 11, 30);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('des', 'despierres', 'desp', 'personne', 12, 30);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('dem', 'dempure', 'demp', 'personne', 13, 20);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('bau', 'bauchet', 'baup', 'personne', 14, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('gui', 'guillemot', 'guip', 'personne', 15, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('hua', 'huang', 'huap', 'personne', 16, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('pel', 'pellerin', 'pelp', 'personne', 17, 40);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('pic', 'pichou', 'picp', 'personne', 18, 10);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('vua', 'vuatrin', 'vuap', 'personne', 19, 50);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('dio', 'dionisi', 'diop', 'personne', 20, 0); */
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('nes', 'nespoli', 'ness', 'societe', 21, 20);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('gla', 'glass', 'glas', 'societe', 22, 40);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('gav', 'gavametal', 'gavs', 'societe', 23, 30);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('exc', 'excellium', 'excs', 'societe', 24, 10);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('mir', 'mirometrics', 'mirs', 'societe', 25, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('pro', 'prodel', 'pros', 'societe', 26, 0);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('cet', 'cetim', 'cets', 'societe', 27, 50);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('sol', 'solvakem', 'sols', 'societe', 28, 20);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('met', 'metallerie', 'mets', 'societe', 29, 20);
INSERT INTO client (login, nom, mot_de_passe, typeP, numero_compte, taux_de_reduction)
VALUES ('tec', 'technotrans', 'tecs', 'societe', 30, 10);



----------Insertions Type_vehicule----------------------------

INSERT INTO Type_vehicule (nb_roues )
VALUES ('2');
INSERT INTO Type_vehicule (nb_roues )
VALUES ('4');
INSERT INTO Type_vehicule (nb_roues )
VALUES ('8');



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

INSERT INTO Place (num_place, park_place, zone_place, type_place, type_veh)
VALUES 
(1, 'marche', 'La Duchère', 'couvert', '2'),
(2, 'marche', 'La Duchère', 'dehors', '4'),
(3, 'marche', 'La Duchère', 'couvert', '4'),
(4, 'marche', 'La Duchère', 'dehors', '4'),
(5, 'marche', 'La Duchère', 'dehors', '8'),
(1, 'guy', 'Champvert - Gorge du Loup', 'couvert', '2'),
(2, 'guy', 'Champvert - Gorge du Loup', 'dehors', '4'),
(3, 'guy', 'Champvert - Gorge du Loup', 'couvert', '4'),
(4, 'guy', 'Champvert - Gorge du Loup', 'dehors', '4'),
(5, 'guy', 'Champvert - Gorge du Loup', 'dehors', '8'),
(1, 'vinci', 'Vaise', 'couvert', '2'),
(2, 'vinci', 'Vaise', 'dehors', '4'),
(3, 'vinci', 'Vaise', 'couvert', '4'),
(4, 'vinci', 'Vaise', 'dehors', '4'),
(5, 'vinci', 'Vaise', 'dehors', '8'),
(1, 'hey', 'Champvert - Point du Jour - Jeunet', 'couvert', '2'),
(2, 'hey', 'Champvert - Point du Jour - Jeunet', 'dehors', '4'),
(3, 'hey', 'Champvert - Point du Jour - Jeunet', 'couvert', '4'),
(4, 'hey', 'Champvert - Point du Jour - Jeunet', 'dehors', '4'),
(5, 'hey', 'Champvert - Point du Jour - Jeunet', 'dehors', '8'),
(1, 'hello', 'Vieux Lyon', 'couvert', '2'),
(2, 'hello', 'Vieux Lyon', 'dehors', '4'),
(3, 'hello', 'Vieux Lyon', 'couvert', '4'),
(4, 'hello', 'Vieux Lyon', 'dehors', '4'),
(5, 'hello', 'Vieux Lyon', 'dehors', '8'),
(1, 'how', 'Croix-Rousse', 'couvert', '2'),
(2, 'how', 'Croix-Rousse', 'dehors', '4'),
(3, 'how', 'Croix-Rousse', 'couvert', '4'),
(4, 'how', 'Croix-Rousse', 'dehors', '4'),
(5, 'how', 'Croix-Rousse', 'dehors', '8'),
(1, 'salut', 'Tete d''Or', 'couvert', '2'),
(2, 'salut', 'Tete d''Or', 'dehors', '4'),
(3, 'salut', 'Tete d''Or', 'couvert', '4'),
(4, 'salut', 'Tete d''Or', 'dehors', '4'),
(5, 'salut', 'Tete d''Or', 'dehors', '8'),
(1, 'coucou', 'Mutualité - Préfecture', 'couvert', '2'),
(2, 'coucou', 'Mutualité - Préfecture', 'dehors', '4'),
(3, 'coucou', 'Mutualité - Préfecture', 'couvert', '4'),
(4, 'coucou', 'Mutualité - Préfecture', 'dehors', '4'),
(5, 'coucou', 'Mutualité - Préfecture', 'dehors', '8'),
(1, 'dommage', 'Guillotière', 'couvert', '2'),
(2, 'dommage', 'Guillotière', 'dehors', '4'),
(3, 'dommage', 'Guillotière', 'couvert', '4'),
(4, 'dommage', 'Guillotière', 'dehors', '4'),
(5, 'dommage', 'Guillotière', 'dehors', '8'),
(1, 'piscine', 'Jean Macé', 'couvert', '2'),
(2, 'piscine', 'Jean Macé', 'dehors', '4'),
(3, 'piscine', 'Jean Macé', 'couvert', '4'),
(4, 'piscine', 'Jean Macé', 'dehors', '4'),
(5, 'piscine', 'Jean Macé', 'dehors', '8'),
(1, 'plage', 'Gerland', 'couvert', '2'),
(2, 'plage', 'Gerland', 'dehors', '4'),
(3, 'plage', 'Gerland', 'couvert', '4'),
(4, 'plage', 'Gerland', 'dehors', '4'),
(5, 'plage', 'Gerland', 'dehors', '8'),
(1, 'mer', 'La Mouche', 'couvert', '2'),
(2, 'mer', 'La Mouche', 'dehors', '4'),
(3, 'mer', 'La Mouche', 'couvert', '4'),
(4, 'mer', 'La Mouche', 'dehors', '4'),
(5, 'mer', 'La Mouche', 'dehors', '8'),
(1, 'base', 'Monplaisir', 'couvert', '2'),
(2, 'base', 'Monplaisir', 'dehors', '4'),
(3, 'base', 'Monplaisir', 'couvert', '4'),
(4, 'base', 'Monplaisir', 'dehors', '4'),
(5, 'base', 'Monplaisir', 'dehors', '8'),
(1, 'donnee', 'Monchat', 'couvert', '2'),
(2, 'donnee', 'Monchat', 'dehors', '4'),
(3, 'donnee', 'Monchat', 'couvert', '4'),
(4, 'donnee', 'Monchat', 'dehors', '4'),
(5, 'donnee', 'Monchat', 'dehors', '8'),
(1, 'editeur', 'Bachut - Transvaal', 'couvert', '2'),
(2, 'editeur', 'Bachut - Transvaal', 'dehors', '4'),
(3, 'editeur', 'Bachut - Transvaal', 'couvert', '4'),
(4, 'editeur', 'Bachut - Transvaal', 'dehors', '4'),
(5, 'editeur', 'Bachut - Transvaal', 'dehors', '8'),
(1, 'message', 'La Plaine Santy', 'couvert', '2'),
(2, 'message', 'La Plaine Santy', 'dehors', '4'),
(3, 'message', 'La Plaine Santy', 'couvert', '4'),
(4, 'message', 'La Plaine Santy', 'dehors', '4'),
(5, 'message', 'La Plaine Santy', 'dehors', '8'),
(1, 'sortie', 'Laennec Mermoz', 'couvert', '2'),
(2, 'sortie', 'Laennec Mermoz', 'dehors', '4'),
(3, 'sortie', 'Laennec Mermoz', 'couvert', '4'),
(4, 'sortie', 'Laennec Mermoz', 'dehors', '4'),
(5, 'sortie', 'Laennec Mermoz', 'dehors', '8'),
(1, 'entree', 'Etats-Unis', 'couvert', '2'),
(2, 'entree', 'Etats-Unis', 'dehors', '4'),
(3, 'entree', 'Etats-Unis', 'couvert', '4'),
(4, 'entree', 'Etats-Unis', 'dehors', '4'),
(5, 'entree', 'Etats-Unis', 'dehors', '8'),
(1, 'fichier', 'Voltaire - Part Dieu', 'couvert', '2'),
(2, 'fichier', 'Voltaire - Part Dieu', 'dehors', '4'),
(3, 'fichier', 'Voltaire - Part Dieu', 'couvert', '4'),
(4, 'fichier', 'Voltaire - Part Dieu', 'dehors', '4'),
(5, 'fichier', 'Voltaire - Part Dieu', 'dehors', '8'),
(1, 'edition', 'Brotteaux - Bellecombe', 'couvert', '2'),
(2, 'edition', 'Brotteaux - Bellecombe', 'dehors', '4'),
(3, 'edition', 'Brotteaux - Bellecombe', 'couvert', '4'),
(4, 'edition', 'Brotteaux - Bellecombe', 'dehors', '4'),
(5, 'edition', 'Brotteaux - Bellecombe', 'dehors', '8')
;





