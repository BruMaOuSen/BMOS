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
	
	$reponse = $bdd->query("INSERT INTO client (login, nom, typep, mot_de_passe, role_client, abonne) 
							VALUES ('$login', '$nom', '$typeP', '$mdp', 'client', '0')");	
	$reponse->closeCursor();

	$reponse1 = $bdd->query("INSERT INTO compte (taux_de_reduction, loginC, date_creation) VALUES('0', '$login', now())");
	$reponse1->closeCursor();

	
	$_SESSION['membreid'] = $login;
	$_SESSION['authentification'] = TRUE;
	$_SESSION['roleutil'] = 'client';	
				
	header("Location: client.php");
	exit;
?>	
