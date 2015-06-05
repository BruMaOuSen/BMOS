<?php 
  session_start();
  if(!isset($_SESSION['authentification'])){
    header("Location: index.php");  
  }
  else
  {
    //if($_SESSION['roleutil']!='administrateur'){
    //  header("Location: index.php");
     // exit;   
    //}
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
      <link href="style.css" rel="stylesheet">
      <meta charset="utf-8">
        <title>UPARK | Admin <?php echo $_SESSION['membreid'];?></title>
    </head>
    <body>
      <!--INSERTION DU HEADER-->
      <?php include ('header.php'); ?>      
      
      <!--CORPS DE LA PAGE D'INDEX-->     
        <?php
      try
      {
        $bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
        
      }
      catch (Exception $e)
      {
            die('Erreur : ' . $e->getMessage());
      }

///////////////////// Choix d'une zone pour afficher les parkings qui la contiennent

      $reponse1 = $bdd->query("SELECT DISTINCT login FROM client ORDER BY typep");
      
    ?>

    <div class="container">
        <div id="alertChoixZone"class="alert btn-primary alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeChoixZone">×</button>
        <form method="post" action="adminCreation.php">
          <h3 class="panel-title">Choisir un type de client </h3>
            <select name="typeP"class="selectpicker">
            <?php
            while ($donnees1 = $reponse1->fetch())
            {
          ?>
                <option ><?php echo $donnees1['typep'] ;?></option>
            <?php
            }
            
            $reponse1->closeCursor();
            $typep = $_POST['typep'];
          ?>
            </select>
            <h3 class="panel-title">Choisir une <?php '$typep' ?> </h3>
            <select name="nom"class="selectpicker">
            <?php
            $reponse2 = $bdd->query("SELECT DISTINCT login FROM client where typep='typep' ORDER BY numero_compte, nom");
            while ($donnees2 = $reponse2->fetch())
            {
          ?>
                <tr>
                    <td><center><?php echo $donnees2['nom']; ?></center></td>
                    <td><center><?php echo $donnees2['numero_compte']; ?> places </center></td>
                  </tr>
            <?php
            }
            
            $reponse2->closeCursor();
          ?>
            </select>
 
              <button type="submit" class="btn btn-primary"> Valider </button>
        </form> 
        </div>
        <div class="col-md-offset-3 col-md-6">
          <button type="submit" class="btn btn-primary" id="afficherChoixZone">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;choisir un client
          </button>
        </div>
    </div>