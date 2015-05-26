<?php session_start();?>
<?php
	// Connexion, sélection de la base de données
	$dbconn = pg_connect("host=localhost dbname=parkingProject user=admin password=admin")
    	or die('Connexion impossible : ' . pg_last_error());
    
    // Exécution de la requête SQL
	$query = "INSERT INTO utilisateur (pseudo, mot_de_passe, type_user) 
			VALUES ('$_POST[login]', '$_POST[motdepasse]', 'client')";
	$result = pg_query($query) or die('Echec de la requête : ' . pg_last_error());
	
	$_SESSION['membreid']= $_POST['login'];
	$_SESSION['authentification'] = TRUE;
	$_SESSION['roleutil'] = 'client';
	
	header("Location: client.php");

?>	
