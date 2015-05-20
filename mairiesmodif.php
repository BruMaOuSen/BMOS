<?php
	try
	{
		$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
	}		
	$prixAChanger = $_POST['typeTarif'];
	if($prixAChanger == "prix à l'heure"){
		$prixAChanger = 'prix_h_zone';
	}
	else if($prixAChanger == "prix au mois"){
		$prixAChanger = 'prix_m_zone';
	}
 	$bdd->query('UPDATE zone SET prix_m_zone = 10 WHERE nom_zone = "Bachut - Transvaal"');
	header('Location: mairies.php');
?>
	