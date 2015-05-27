<?php session_start();?>
<?php
	// Connexion, sélection de la base de données
	try
	{
		$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
	}
	
	
	$login = $_POST['login'];
	$nom = $_POST['nom'];
	$typeP = $_POST['typeP'];
	$mdp = $_POST['motdepasse'];
	
	$reponse = $bdd->query("INSERT INTO client (login, nom, typep, taux_de_reduction, mot_de_passe, role_client) 
							VALUES ('$login', '$nom', '$typeP', '0', '$mdp', 'client')");
	
	$_SESSION['membreid'] = $login;
	$_SESSION['authentification'] = TRUE;
	$_SESSION['roleutil'] = 'client';
	
	$reponse->closeCursor();
		
	header("Location: client.php");

?>	
