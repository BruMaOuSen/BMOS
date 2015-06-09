<?php
	session_start();
      
    try
    {
      $bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
    }
    catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
    
    $login = $_SESSION['membreid'];

    $reponse = $bdd->query("UPDATE client SET abonne = 'FALSE' WHERE login ='$login'");
    $reponse->closeCursor();
    header('Location: gestionAbonnement.php');
    exit;
?>