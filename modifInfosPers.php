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
	
	//echo $nom;
	//echo $identification;
	//echo $numCompte;
	//echo $id;
	$reponse = $bdd->query("UPDATE client SET nom = $nom AND typep = $identification AND numero_compte = $numCompte
							 WHERE login = '$id'");
 	//$bdd->exec("UPDATE zone SET" .$prixAChanger. "=" .$_POST['prix']. "WHERE 
 	//			nom_zone LIKE" .$_POST['zone']"");
	header("Location: client.php");
	$reponse->closeCursor();
	exit;
?>
	