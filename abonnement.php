<?php
	session_start();
    if(!isset($_SESSION['authentification'])){
        header("Location: index.php");  
    }
    else
    {
        if($_SESSION['roleutil']!='client'){
            header("Location: index.php");
            exit;   
        }
    }  
    try
    {
      $bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
    }
    catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
    
    //$login = $_SESSION['membreid'];

    //$reponse = $bdd->query("UPDATE client SET abonne = 'TRUE' WHERE login ='$login'");
    //$reponse->closeCursor();
    //header('Location: gestionAbonnement.php');
    //exit;
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
      <link href="style.css" rel="stylesheet">
      <meta charset="utf-8">
        <title>UPARK | Abonnement <?php echo $_SESSION['membreid'];?></title>
    </head>
    <body>
      <!--INSERTION DU HEADER-->
      <?php include ('header.php'); ?> 

      <!--INSERTION DU MENU-->     
      <?php include('menuAdmin.php');?>           
      
      <!--CORPS DE LA PAGE D'ABONNEMENT-->     
    <div class="container">
        <div id="alertChoixZone"class="alert btn-primary alert-dismissable col-md-offset-2 col-md-8" style="display: none">
            <button type="button" class="close" id="closeChoixZone">×</button>
            <form method="post" action="adminStats.php">
                <h3 class="panel-title">Choisir une zone</h3>
                <select name="zone"class="selectpicker">
                <?php
                    while ($donnees1 = $reponse1->fetch())
                    {
                ?>
                        <option ><?php echo $donnees1['nom_zone'];?></option>
                <?php
                    }
                    $reponse1->closeCursor();
                ?>
                </select>
                <button type="submit" class="btn btn-primary"> Valider </button>
            </form> 
        </div>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <button type="submit" class="btn btn-primary" id="afficherChoixZone">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;choisir une zone
        </button>
    </div>
   <script src="bootstrap/js/jquery.js"></script> 
    <!--SCRIPTS FONCTiONNELS POUR TOUS LES BOUTONS DE LA PAGE-->
    <script>  
        $(function (){
          $("#afficherChoixZone").click(function() {
              $("#afficherChoixZone").hide();
              $("#supprPark").hide();
              $("#ajoutPark").hide();
              $("#modifPark").hide();
              $("#alertChoixZone").show("slow");
          }); 
          $("#closeChoixZone").click(function() {
              $("#alertChoixZone").hide("slow");
              $("#afficherChoixZone").show();
              $("#supprPark").show();
              $("#ajoutPark").show();
              $("#modifPark").show();
          }); 
        }); 
    </script>
</body>
</html>

   