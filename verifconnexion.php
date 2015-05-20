<?php session_start();?>
<?php
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
    	// Paramètres de connexion à la base de données
		$_SESSION['membreid']= $id;
		
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