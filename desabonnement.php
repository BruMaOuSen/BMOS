<?php
	session_start();
      
    try
    {
      $bdd = new PDO('pgsql:host=tuxa.sme.utc;dbname=dbnf17p136', 'nf17p136', '6hQyKlYO');
    }
    catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
    
    $login = $_SESSION['membreid'];

    $reponse = $bdd->query("UPDATE client SET abonne = 'FALSE' WHERE login ='$login'");
    $reponse->closeCursor();
    $reponse1 = $bdd->query("DELETE FROM transac WHERE type_t = 'abonnement'");
    $reponse->closeCursor();
    header('Location: gestionAbonnement.php');
    exit;
?>