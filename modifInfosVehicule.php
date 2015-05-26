<?php 
	session_start();
?>
<?php
	try
	{
		$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
	}		
	$immat = $_POST['immatriculation'];
	$datefab = $_POST['dateFabrication'];
	$marque = $_POST['marque'];
	$typeVeh = $_POST['typeVehicule'];
	$id = $_SESSION['membreid'];
	
	$reponse = $bdd->query("UPDATE vehicule SET immatriculation = '$immat', 
												date_fabrication = '$datefab', 
												marque = '$marque',
												type_veh = '$typeVeh' 
												WHERE proprietaire = '$id'");
	header("Location: client.php");
	$reponse->closeCursor();
	exit;
?>
	