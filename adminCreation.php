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

      $reponse1 = $bdd->query('SELECT * FROM zone ORDER BY nom_zone');
    ?>

    <div class="container">
        <div id="alertChoixZone"class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeChoixZone">×</button>
        <form method="post" action="adminCreation.php">
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
            
 
              <button type="submit"> Valider </button>
        </form> 
        </div>
        <div class="col-md-offset-3 col-md-6">
          <button type="submit" class="btn btn-info" id="afficherChoixZone">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;choisir une zone
          </button>
        </div>
    </div>




<!--///////////////// Afficher les parkings de la zone selectionee-->

<?php 
      $nomzone = $_POST['zone'];
//      $reponse2 = $bdd->query("SELECT nom_park FROM parking WHERE zone_park = '$nomzone'");
//      $donnees2 = $reponse2->fetch();
?>

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
      <table class="table table-bordered table-striped">
          <caption>
            <h4 style="text-align: center">Les parkings de <?php echo $nomzone;?></h4>
          </caption>
          <thead>
            <tr>
                <th style="text-align: center">Nom du parking</th>
                <th style="text-align: center">Total des places</th>
                <th style="text-align: center">Nombre de places libres</th>
            </tr>
          </thead>
          <tbody> 
          <?php
            $reponse2 = $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone'");
          while($donnees2 = $reponse2->fetch())
          { 
        ?>
                <tr>
                    <td><center><?php echo $donnees2['nom_park']; ?></center></td>
                    <td><center><?php echo $donnees2['nbplaces_park']; ?> places </center></td>
                    <td><center><?php echo $donnees2['free_places']; ?> places</center></td>
                  </tr>
        <?php
          }
          $reponse2->closeCursor(); // Termine le traitement de la requête
        ?>
        </tbody>
      </table>          
</section>

<!--////////////// Suppression d'un des parking de la zone selectionnee -->

    <div class="container">
        <div id="alertSupprPark" class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeSupprPark">×</button>
        <form method="post" action="adminCreation.php">
          <h3 class="panel-title">Choisir un parking</h3>
            <select name="parkingsuppr"class="selectpicker">
            <?php
              $reponse3= $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone'");
            while ($donnees3 = $reponse3->fetch())
            {
          ?>
                <option ><?php echo $donnees3['nom_park'];?></option>
            <?php
            }
            
            $reponse3->closeCursor();
          ?>
            </select>
            
 
              <button type="submit">Supprimer</button>
        </form> 
        </div>

<?php
    $parking = $_POST['parkingsuppr'];
    $reponse4 = $bdd->query("DELETE FROM parking WHERE nom_park = '$parking'");
    $reponse4->closeCursor();
    
?>
<!--/////////// Modification des infos d'un des parkings de la zone -->
        
        <div id="alertModifPark" class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeModifPark">×</button>
        <form method="post" action="adminCreation.php">
          <h3 class="panel-title">Choisir le parking et la zone de transfert</h3>
            <select name="parkingmodif"class="selectpicker">
          <?php
              $reponse5= $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone'");
            while ($donnees5 = $reponse5->fetch())
            {
          ?>
                <option ><?php echo $donnees5['nom_park'];?></option>
          <?php
            }
            
           $reponse5->closeCursor();
          ?>
            </select>
            <select name="zonetransfert"class="selectpicker">
            <?php
              $reponse6 = $bdd->query("SELECT nom_zone FROM zone");
            while ($donnees6 = $reponse6->fetch())
            {
          ?>
                <option><?php echo $donnees6['nom_zone'];?></option>
          <?php
            }
            $reponse5->closeCursor();
          ?>

            </select>
              <button type="submit">Transférer</button>
        </form> 
        </div>

<?php
    $parkingmodif = $_POST['parkingmodif'];
    $zonetransfert = $_POST['zonetransfert'];
    $reponse7 = $bdd->query(" UPDATE parking SET zone_park = '$zonetransfert' WHERE nom_park = '$parkingmodif'");
    $reponse7->closeCursor();
        
?>
      

        <div class="col-md-offset-3 col-md-2">
          <button type="submit" class="btn btn-info" id="modifPark">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;Transférer un parking
          </button>
        </div>

      <div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
          <button type="submit" class="btn btn-info" id="supprPark">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;Supprimer un parking
          </button>
        </div>

        <div class="col-md-2">
          <button type="submit" class="btn btn-info" id="afficher">
            <span class="glyphicon glyphicon-pencil"></span>&nbsp;Ajouter un parking
          </button>                                                                        
      </div>
    </div>
      




<script src="bootstrap/js/jquery.js"></script> 
    <script>  
        $(function (){
          $("#afficherChoixZone").click(function() {
              $("#afficherChoixZone").hide();
              $("#alertChoixZone").show("slow");
          }); 
          $("#closeChoixZone").click(function() {
              $("#alertChoixZone").hide("slow");
              $("#afficherChoixZone").show();
          }); 
        }); 
    </script>   
    <script>  
        $(function (){
          $("#supprPark").click(function() {
              $("#supprPark").hide();
              $("#alertSupprPark").show("slow");
          }); 
          $("#closeSupprPark").click(function() {
              $("#alertSupprPark").hide("slow");
              $("#supprPark").show();
          }); 
        }); 
    </script> 
    <script>  
        $(function (){
          $("#modifPark").click(function() {
              $("#modifPark").hide();
              $("#alertModifPark").show("slow");
          }); 
          $("#closeModifPark").click(function() {
              $("#alertModifPark").hide("slow");
              $("#modifPark").show();
          }); 
        }); 
    </script> 
      
      <!--INSERTION DU FOOTER-->
    <!--<?php include ('footer.php'); ?>-->
    </body>
</html>