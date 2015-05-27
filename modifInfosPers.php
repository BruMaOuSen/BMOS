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
	$numCompte = $_POST['numCompte'];
	$id = $_SESSION['membreid'];
	
	if($nom != NULL){
	$reponse = $bdd->query("UPDATE client SET nom = '$nom' WHERE login = '$id'");
	}
	if($identification != NULL){
	$reponse = $bdd->query("UPDATE client SET typep = '$identification' WHERE login = '$id'");
	}
	if($numCompte){
	$reponse = $bdd->query("UPDATE client SET numero_compte = '$numCompte' WHERE login = '$id'");
	}

	header("Location: client.php");
	$reponse->closeCursor();
	exit;
?>
	