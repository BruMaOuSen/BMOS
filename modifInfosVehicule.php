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
	$compteur = $_POST[]{strlen($mot)-1};	
	$immat = $_POST['immatriculation'.$compteur];
	$datefab = $_POST['dateFabrication'.$compteur];
	$marque = $_POST['marque'.$compteur];
	$typeVeh = $_POST['typeVehicule'.$compteur];
	$id = $_SESSION['membreid'];
	
	echo $immat;
	echo $datefab;
	echo $marque;
	echo $typeVeh;
	
	
	$reponse = $bdd->query("SELECT * FROM vehicule WHERE proprietaire = '$id'");
	$donnees = $reponse->fetch();

	if($donnees){
	if($immat != NULL){
		$reponse = $bdd->query("UPDATE vehicule SET immatriculation = '$immat' WHERE immatriculation = '$mmat'");
	}
	if($datefab != NULL){
		$reponse = $bdd->query("UPDATE vehicule SET date_fabrication = '$datefab' WHERE immatriculation = '$mmat'");
	}
	if($marque != NULL){
		$reponse = $bdd->query("UPDATE vehicule SET marque = '$marque' WHERE immatriculation = '$mmat'");
	}
	if($typeVeh != NULL){
		$reponse = $bdd->query("UPDATE vehicule SET type_veh = '$typeVeh' WHERE immatriculation = '$mmat'");
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
	//header("Location: client.php");
	//exit;
?>
	