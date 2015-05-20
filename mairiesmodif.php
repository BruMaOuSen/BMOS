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
	$prixAChanger = $_POST['typeTarif'];
	if($prixAChanger == "prix à l'heure"){
		$prixAChanger = 'prix_h_zone';
	}
	else if($prixAChanger == "prix au mois"){
		$prixAChanger = 'prix_m_zone';
	}
	$tarif = $_POST['prix'];
	$zone = $_POST['zone'];
	$reponse = $bdd->query("UPDATE zone SET $prixAChanger = $tarif WHERE nom_zone = '$zone'");
 	//$bdd->exec("UPDATE zone SET" .$prixAChanger. "=" .$_POST['prix']. "WHERE 
 	//			nom_zone LIKE" .$_POST['zone']"");
	header("Location: mairies.php");
	$reponse->closeCursor();
	exit;
?>
	