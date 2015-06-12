<?php 
	session_start();
	$parking = $_POST['supprparking'];
	try
	{
		$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
	}

	$id = $_SESSION['membreid'];
	$immat = $_POST['immatriculation'];
	$ancienneImmat = $_POST['immatAncienne'];
	$marque = $_POST['marque'];
	$typeVeh = $_POST['typeVehicule'];
	$dateFab = $_POST['dateFab'];

	$reponse1 = $bdd->query("SELECT immatriculation FROM vehicule WHERE immatriculation = '$immat'");
	$donnees1 = $reponse1->fetch();
	//echo $donnees1['immatriculation'];
	if ($donnees1 == NULL) {
		if ($immat != NULL) {
			$reponse = $bdd->query("UPDATE  vehicule SET immatriculation = '$immat' WHERE immatriculation = '$ancienneImmat'");
		}
		if ($marque != NULL) {
			$reponse = $bdd->query("UPDATE  vehicule SET marque = '$marque' WHERE immatriculation = '$ancienneImmat'");
		}
		if ($typeVeh != NULL) {
			$reponse = $bdd->query("UPDATE  vehicule SET type_veh = '$typeVeh' WHERE immatriculation = '$ancienneImmat'");
		}
		if ($dateFab != NULL) {
			$reponse = $bdd->query("UPDATE  vehicule SET date_fabrication = '$dateFab' WHERE immatriculation = '$ancienneImmat'");
		}	
		$reponse->closeCursor();
	}
	$reponse1->closeCursor();	
	header("Location: client.php");
	exit;
?>