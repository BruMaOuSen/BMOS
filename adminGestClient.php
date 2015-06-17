<?php 
  session_start();
  if(!isset($_SESSION['authentification'])){
    header("Location: index.php");  
  }
  else
  {
    if($_SESSION['roleutil']!='administrateur'){
      header("Location: index.php");
      exit;   
    }
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
      <?php include('menuAdmin.php');?>     
        <?php
      try
      {
        $bdd = new PDO('pgsql:host=localhost;dbname=dbnf17p136', 'nf17p136', '6hQyKlYO');
        
      }
      catch (Exception $e)
      {
            die('Erreur : ' . $e->getMessage());
      }

///////////////////// Choix d'un type de client////////////////////////////////////

      $reponse1 = $bdd->query("SELECT DISTINCT typep FROM client ORDER BY typep");
      
    ?>

    <div class="container">
        <div id="alertChoixType"class="alert btn-primary alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeChoixType">×</button>
        <form method="post" action="adminGestClient.php">
          <h3 class="panel-title">Choisir un type de client </h3>
          <div class="form-group">
            <select name="type"class="selectpicker form-control">
            <?php
            while ($donnees1 = $reponse1->fetch())
            {
          ?>
                <option ><?php echo $donnees1['typep'] ;?></option>
            <?php
            }
            
            $reponse1->closeCursor();
          ?>
            </select>
            </div>  
      <div class="form-group">  
              <button type="submit" class="btn btn-primary form-control"> Valider </button>
          </div>  
        </form> 
        </div>
        <div class="col-md-offset-3 col-md-6">
          <button type="submit" class="btn btn-primary" id="afficherChoixType">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;Choisir un type de client
          </button>
        </div>
    </div>

<!--///////////////////Affichage des clients du type selectionné/////////////-->

<?php 
  if(isset($_POST['type'])){
          $type = $_POST['type'];
  }
?>

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
      <table class="table table-bordered table-striped">
          <caption>
            <h4 style="text-align: center">Les clients de type <?php if(isset($_POST['type'])){echo $type;}?></h4>
          </caption>
          <thead>
            <tr>
                <th style="text-align: center">Login du client</th>
                <th style="text-align: center">Nom du client</th>
            </tr>
          </thead>
          <tbody> 
  <?php
    if(isset($_POST['type'])){
            $reponse2 = $bdd->query("SELECT login, nom FROM client where typep='$type' ORDER BY login, nom");
            while ($donnees2 = $reponse2->fetch())
            {
          ?>
                <tr>
                    <td><center><?php echo $donnees2['login']; ?></center></td>
                    <td><center><?php echo $donnees2['nom']; ?></center></td>
                  </tr>
            <?php
            }
            
            $reponse2->closeCursor();
    }
  ?>
            </tbody>
      </table>          
</section>
 
<!--///////////////////Suppression d'un client selectionné/////////////-->

<div class="container">
        <div id="alertSupprClient" class="alert btn-danger alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeSupprClient">×</button>
        <form method="post" action="adminGestClient.php">
          <h3 class="panel-title">Choisir un client </h3>
          <div class="form-group">
            <select name="clientsuppr"class="selectpicker form-control">
            <?php
    if(isset($_POST['type'])){
              $reponse3= $bdd->query("SELECT login FROM client where typep='$type' ORDER BY login");
            while ($donnees3 = $reponse3->fetch())
            {
          ?>
                <option ><?php if(isset($_POST['type'])){echo $donnees3['login'];}?></option>
            <?php
            }
            
            $reponse3->closeCursor();
    }
   ?>
            </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary form-control">Supprimer</button>
            </div>  
        </form> 
        </div>

<?php
  if(isset($_POST['clientsuppr'])){
    $client = $_POST['clientsuppr'];
    $reponse4 = $bdd->query("DELETE FROM client WHERE login = '$client'");
    $reponse4->closeCursor();
  }
?>


        <div class="col-md-offset-2 col-md-8"> 
          <div class="btn-group"  role="group">
                <button type="submit" class="btn btn-danger" id="supprClient">
                  <span class="glyphicon glyphicon-remove"></span>&nbsp;Supprimer un client
                </button>
            </div>
        </div>
</div>

              
<script src="bootstrap/js/jquery.js"></script> 
    <!--SCRIPTS FONCTiONNELS POUR TOUS LES BOUTONS DE LA PAGE-->
    <script>  
        $(function (){
          $("#afficherChoixType").click(function() {
              $("#afficherChoixType").hide();
              $("#supprClient").hide();
              $("#alertChoixType").show("slow");
          }); 
          $("#closeChoixType").click(function() {
              $("#alertChoixType").hide("slow");
              $("#afficherChoixType").show();
              $("#supprPark").show();
          }); 
        }); 
    </script>   
    <script>  
        $(function (){
          $("#supprClient").click(function() {
              $("#supprClient").hide();
              $("#afficherChoixType").hide();
              $("#alertSupprClient").show("slow");
          }); 
          $("#closeSupprClient").click(function() {
              $("#alertSupprClient").hide("slow");
              $("#supprClient").show();
              $("#afficherChoixType").show();
          }); 
        }); 
    </script> 

          <!--INSERTION DU FOOTER-->
    <!--<?php include ('footer.php'); ?>-->
    </body>
</html>
