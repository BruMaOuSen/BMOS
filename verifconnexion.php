<?php
    // Script faisant appel aux sessions
    session_start();

    // Paramètres de connexion à la base de données
    try
	{
		$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
	}

    $id         = $_POST['pseudo'];
    $motDePasse = $_POST['motdepasse'];
	//echo $id;
	//echo $motDePasse;    
    
    $reponse = $bdd->query('SELECT * FROM utilisateur WHERE pseudo = \''.$id.'\' AND mot_de_passe = \''.$motDePasse.'\'');
    $donnees = $reponse->fetch();
    
    if ($donnees) {
        // Si une ligne a été trouvée c'est que le couple
        // (identifant, mot de passe) est valide
        //$_SESSION["membre"] = TRUE;
        //$_SESSION["membreid"] = $id;
        //echo "Bien connecté";
        if($donnees['type_user']=="mairie")
        {
        	header("Location: mairies.php");
        	exit;
        }
        else if($donnees['type_user']=="client")
        {
        	header("Location: client.php");
        	exit;
        }
        else if($donnees['type_user']=="administrateur")
        {
        	header("Location: admin.php");
        	exit;
        }
    } else {
        //$_SESSION["membre"] = FALSE;
        header("Location: index.php");
		exit;
    }
?>