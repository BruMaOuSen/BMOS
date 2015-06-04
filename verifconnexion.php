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
	
    $reponse = $bdd->query("SELECT * FROM Client WHERE login = '$id' AND mot_de_passe = '$motDePasse'");
    $donnees = $reponse->fetch();
    
    if ($donnees){
    	// Paramètres de connexion à la base de données
		$_SESSION['membreid']= $id;
		$_SESSION['authentification'] = TRUE;
		$_SESSION['roleutil'] = $donnees['role_client'];
				
		if($_SESSION['roleutil']=="client")
        {
        	header("Location: client.php");
        	$reponse->closeCursor();
        	exit;
        }
    }     
    else{
		//Si personne n'est trouvé dans les bases clients et admin
    	$reponse->closeCursor();
    	//header("Location: index.php");
		//exit;
    }
	
    $reponse = $bdd->query("SELECT * FROM administrateur WHERE login = '$id' AND mot_de_passe = '$motDePasse'");
    $donnees = $reponse->fetch();
    
    if ($donnees){
    	// Paramètres de connexion à la base de données
		$_SESSION['membreid']= $id;
		$_SESSION['authentification'] = TRUE;
		$_SESSION['roleutil'] = $donnees['role_admin'];
				
       if($_SESSION['roleutil']=="administrateur")
        {
        	header("Location: admin.php");
        	$reponse->closeCursor();
        	exit;
        }
    }     
    else{
		//Si personne n'est trouvé dans les bases clients et admin
    	$reponse->closeCursor();
    	header("Location: index.php");
		exit;
    }	
?>