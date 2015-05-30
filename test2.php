<?php 
	session_start();
	try
	{
		$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
	}
	
	$nomZone = $_SESSION['nomZone'];	
	$nomParking = $_POST['nomParking'];
	$RC2 = $_POST['RC2'];
	$RD2 = $_POST['RD2'];
	$RC4 = $_POST['RC4'];
	$RD4 = $_POST['RD4'];
	$RC8 = $_POST['RC8'];
	$RD8 = $_POST['RD8'];
	$total = $RC2 + $RD2 + $RC4 + $RD4 + $RC8 + $RD8;
	
	$reponse = $bdd->query("INSERT INTO parking (nom_park, zone_park, nbplaces_park, free_places) 
							VALUES ('$nomParking', '$nomZone', '$total', '$total')");
	$reponse->closeCursor();
	
	for($compteur = 1; $compteur<=$RC2; $compteur++){
		$reponse = $bdd->query("INSERT INTO place (num_place, park_place, type_place, type_veh) 
							VALUES ('$compteur', '$nomParking', 'couvert', '2')");
		$reponse->closeCursor();
	}
	for($compteur = $RC2 + 1; $compteur<=$RC2 + $RD2; $compteur++){
		$reponse1 = $bdd->query("INSERT INTO place (num_place, park_place, type_place, type_veh) 
							VALUES ('$compteur', '$nomParking', 'dehors', '2')");
		$reponse1->closeCursor();
	}
	for($compteur = $RC2 + $RD2 + 1; $compteur<= $RC2 + $RD2 + $RC4; $compteur++){
		$reponse2 = $bdd->query("INSERT INTO place (num_place, park_place, type_place, type_veh) 
							VALUES ('$compteur', '$nomParking', 'couvert', '2')");
		$reponse2->closeCursor();
	}
	for($compteur = $RC2 + $RD2 + $RC4 + 1; $compteur<= $RC2 + $RD2 + $RC4 + $RD4; $compteur++){
		$reponse3 = $bdd->query("INSERT INTO place (num_place, park_place, type_place, type_veh) 
							VALUES ('$compteur', '$nomParking', 'dehors', '4')");
		$reponse3->closeCursor();
	}
	for($compteur = $RC2 + $RD2 + $RC4 + $RD4 + 1; $compteur<= $RC2 + $RD2 + $RC4 + $RD4 + $RC8; $compteur++){
		$reponse4 = $bdd->query("INSERT INTO place (num_place, park_place, type_place, type_veh) 
							VALUES ('$compteur', '$nomParking', 'couvert', '8')");
		$reponse4->closeCursor();
	}
	for($compteur = $RC2 + $RD2 + $RC4 + $RD4 + $RC8 + 1; $compteur<= $RC2 + $RD2 + $RC4 + $RD4 + $RC8 + $RD8; $compteur++){
		$reponse5 = $bdd->query("INSERT INTO place (num_place, park_place, type_place, type_veh) 
							VALUES ('$compteur', '$nomParking', 'dehors', '8')");
		$reponse5->closeCursor();
	}
	

	
	header("Location: adminStats.php");
	exit;
?>