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

	$id = $_SESSION['membreid'];
	$immat = $_POST['immat'];
	$marque = $_POST['marque'];
	$typeVeh = $_POST['typeVeh'];
	$dateFab = $_POST['dateFab'];
	
	$reponse = $bdd->query("INSERT INTO vehicule VALUES('$immat', '$dateFab', '$marque', '$id', '$typeVeh')");
	$reponse->closeCursor();
	header("Location: client.php");
	exit;
?>