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
	
	
	$reponse = $bdd->query("SELECT * FROM vehicule WHERE proprietaire = '$id'");
	$donnees = $reponse->fetch();

	if($donnees){
	if($immat != NULL){
		$reponse = $bdd->query("UPDATE vehicule SET immatriculation = '$immat' WHERE proprietaire = '$id'");
	}
	if($datefab != NULL){
		$reponse = $bdd->query("UPDATE vehicule SET date_fabrication = '$datefab' WHERE proprietaire = '$id'");
	}
	if($marque != NULL){
		$reponse = $bdd->query("UPDATE vehicule SET marque = '$marque' WHERE proprietaire = '$id'");
	}
	if($typeVeh != NULL){
		$reponse = $bdd->query("UPDATE vehicule SET type_veh = '$typeVeh' WHERE proprietaire = '$id'");
	}
	$reponse->closeCursor();
	}
	
	if($donnees == NULL){
		//echo "papa";
		$reponse2 = $bdd->query("SELECT * FROM vehicule WHERE immatriculation ='$immat'");
		$donnees = $reponse2->fetch();
		
		if($donnees){
			header("Location: client.php");
		}
		else{
			$reponse3 = $bdd->query("INSERT INTO vehicule (immatriculation, date_fabrication, marque, proprietaire, type_veh)
									 VALUES ('$immat', '$datefab', '$marque', '$id', '$typeVeh')");
			$reponse3->closeCursor();
		}
	}
	$reponse->closeCursor();
	//else{
	//	$reponse = $bdd("INSERT INTO Vehicule
	//					 VALUES('$immat', '$datefab', '$marque', '$id', '$typeVeh')");
	//	$reponse->closeCursor();
	//}		
	header("Location: client.php");
	exit;
?>
	