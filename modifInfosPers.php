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
	$nom = $_POST['nom'];
	$identification = $_POST['identification'];
	$nbVoit = $_POST['nbVoit'];
	$id = $_SESSION['membreid'];
	
	if($nom != NULL){
	$reponse = $bdd->query("UPDATE client SET nom = '$nom' WHERE login = '$id'");
	}
	if($identification != NULL){
	$reponse = $bdd->query("UPDATE client SET typep = '$identification' WHERE login = '$id'");
	}
	if($nbVoit != NULL){
	$reponse = $bdd->query("UPDATE client SET nb_voitures = '$nbVoit' WHERE login = '$id'");
	}
	$reponse->closeCursor();

	header("Location: client.php");
	exit;
?>
	