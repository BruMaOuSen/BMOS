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
    $periodeAbonnement = $_POST['periodeAbonnement'];
    $paiement = $_POST['modePaiement'];
    $tauxDeReduction;
    $prix;
    if($periodeAbonnement == '1 mois'){
        $tauxDeReduction = 5;
        $prix = 200;
    }
    else if($periodeAbonnement == '3 mois'){
        $tauxDeReduction = 10;
        $prix = 175;
    }
    else if($periodeAbonnement == '6 mois'){
        $tauxDeReduction = 15;
        $prix = 150;
    }
    else if($periodeAbonnement == '1 an'){
        $tauxDeReduction = 25;
        $prix = 100;
    }

    $reponse = $bdd->query("UPDATE compte SET taux_de_reduction = '$tauxDeReduction'");
    $reponse->closeCursor();

    $reponse1 = $bdd->query("UPDATE client SET abonne = 'TRUE' WHERE login ='$login'");
    $reponse1->closeCursor();
    
    $moyenP;
    if($paiement == 'Carte bancaire'){
        $moyenP = 'carte';
    }
    else if ($paiement == 'Liquide') {
        $moyenP = 'monnaie';
    }
    //$now = date('y-m-d', strtotime('+13 DAY'));
    //$now1 = $now;
    //echo $now;
    //$reponse2 = $bdd->query("INSERT INTO transac (prix, type_t, moyen_p, client, date_debut, date_fin, date_achat) VALUES('$prix', 'abonnement', '$moyenP', '$login', convert(datetime,'18-06-12 10:34:09 PM',5), convert(datetime,'18-06-12 10:34:09 PM',5), convert(datetime,'18-06-12 10:34:09 PM',5))");

    //header('Location: gestionAbonnement.php');
    //exit;
?>