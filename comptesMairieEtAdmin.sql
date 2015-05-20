INSERT INTO utilisateur (pseudo, mot_de_passe, type_user)
VALUES ('admininistrateur', 'upark', 'administrateur');
INSERT INTO utilisateur (pseudo, mot_de_passe, type_user)
VALUES ('mairie', 'lyon', 'mairie');

INSERT INTO rolepage VALUES('1','administrateur');
INSERT INTO rolepage VALUES('2','administrateur');
INSERT INTO rolepage VALUES('2','client');
INSERT INTO rolepage VALUES('3','administrateur');
INSERT INTO rolepage VALUES('3','mairie');
INSERT INTO rolepage VALUES('4','administrateur');
INSERT INTO rolepage VALUES('4','mairie');
INSERT INTO rolepage VALUES('4','client');
INSERT INTO rolepage VALUES('5','administrateur');
INSERT INTO rolepage VALUES('5','mairie');
INSERT INTO rolepage VALUES('5','client');
INSERT INTO rolepage VALUES('6','administrateur');
INSERT INTO rolepage VALUES('6','mairie');
INSERT INTO rolepage VALUES('6','client');

INSERT INTO page(nom_page) VALUES('admin.php');
INSERT INTO page(nom_page) VALUES('client.php');
INSERT INTO page(nom_page) VALUES('mairies.php');
INSERT INTO page(nom_page) VALUES('mairiesmodif.php');
INSERT INTO page(nom_page) VALUES('deconnexion.php');
INSERT INTO page(nom_page) VALUES('index.php');