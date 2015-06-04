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

	$immatriculation = $_POST['immatriculation'];
	//echo $immatriculation;
	
	$reponse = $bdd->query("DELETE FROM vehicule WHERE immatriculation = '$immatriculation'");
	$reponse->closeCursor();
	header("Location: client.php");
	exit;
?>