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

	$reponse = $bdd->query("DELETE FROM parking WHERE nom_park = '$parking'");
	$reponse->closeCursor();
	header("Location: adminStats.php");
	exit;
?>