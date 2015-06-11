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

	//$reponse = $bdd->query("INSERT INTO vehicule VALUES('$immat', '$dateFab', '$marque', '$id', '$typeVeh')");
	$reponse->closeCursor();
	header("Location: client.php");
	exit;
?>