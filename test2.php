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
	
	$reponse4 = $bdd->query("INSERT INTO parking (nom_park, zone_park, nbplaces_park, free_places) 
							VALUES ('$nomParking', '$nomZone', '$total', '$total')");
	
	$reponse4->closeCursor();
	header("Location: adminStats.php");
	exit;
?>