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
    $periodeAbonnement = $_POST['periodeAbonnement'];
    $paiement = $_POST['modePaiement'];
    $tauxDeReduction;
    $prix;
    $dateDeFin;
    if($periodeAbonnement == '1 mois'){
        $tauxDeReduction = 5;
        $prix = 200;
        @$dateDeFin = date('Y-m-d H:i', strtotime('+1 month'));
    }
    else if($periodeAbonnement == '3 mois'){
        $tauxDeReduction = 10;
        $prix = 175;
        @$dateDeFin = date('Y-m-d H:i', strtotime('+3 month'));
    }
    else if($periodeAbonnement == '6 mois'){
        $tauxDeReduction = 15;
        $prix = 150;
        @$dateDeFin = date('Y-m-d H:i', strtotime('+6 month'));
    }
    else if($periodeAbonnement == '1 an'){
        $tauxDeReduction = 25;
        $prix = 100;
        @$dateDeFin = date('Y-m-d H:i', strtotime('+12 month'));
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
    
    $reponse2 = $bdd->query("INSERT INTO transac (prix, type_t, moyen_p, client, date_debut, date_fin, date_achat) 
    VALUES('$prix', 'abonnement', '$moyenP', '$login', now(), '$dateDeFin'::timestamp, now())");
    $reponse2->closeCursor();

    header('Location: gestionAbonnement.php');
    exit;
?>