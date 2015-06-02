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
        <div id="alertChoixZone"class="alert btn-primary alert-dismissable col-md-offset-2 col-md-8" style="display: none">
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
            
 
              <button type="submit" class="btn btn-primary"> Valider </button>
        </form> 
        </div>
        <div class="col-md-offset-3 col-md-6">
          <button type="submit" class="btn btn-primary" id="afficherChoixZone">
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
            $reponse2 = $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone' ORDER BY nom_park");
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
        <div id="alertSupprPark" class="alert btn-danger alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeSupprPark">×</button>
        <form method="post" action="adminCreation.php">
          <h3 class="panel-title">Choisir un parking</h3>
            <select name="parkingsuppr"class="selectpicker">
            <?php
              $reponse3= $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone' ORDER BY nom_park");
            while ($donnees3 = $reponse3->fetch())
            {
          ?>
                <option ><?php echo $donnees3['nom_park'];?></option>
            <?php
            }
            
            $reponse3->closeCursor();
          ?>
            </select>
            
 
              <button type="submit" class="btn btn-danger">Supprimer</button>
        </form> 
        </div>

<?php
    $parking = $_POST['parkingsuppr'];
    $reponse4 = $bdd->query("DELETE FROM parking WHERE nom_park = '$parking'");
    $reponse4->closeCursor();
    
?>
<!--/////////// Modification des infos d'un des parkings de la zone -->
        
        <div id="alertModifPark" class="alert btn-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeModifPark">×</button>
        <form method="post" action="adminCreation.php">
          <h3 class="panel-title">Choisir le parking et la zone de transfert</h3>
            <select name="parkingmodif"class="selectpicker">
          <?php
              $reponse5= $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone' ORDER BY nom_park");
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
              $reponse6 = $bdd->query("SELECT nom_zone FROM zone EXCEPT (SELECT nom_zone FROM zone WHERE nom_zone = '$nomzone' )ORDER BY nom_zone");
            while ($donnees6 = $reponse6->fetch())
            {
          ?>
                <option><?php echo $donnees6['nom_zone'];?></option>
          <?php
            }
            $reponse5->closeCursor();
          ?>

            </select>
              <button type="submit" class="btn btn-info">Transférer</button>
        </form> 
        </div>

<?php
    $parkingmodif = $_POST['parkingmodif'];
    $zonetransfert = $_POST['zonetransfert'];
    $reponse7 = $bdd->query(" UPDATE parking SET zone_park = '$zonetransfert' WHERE nom_park = '$parkingmodif'");
    $reponse7->closeCursor();
        
?>
      
<!--////////////////Ajouter un parking dasn la zone selectionnee -->

<?php $_SESSION['nomZone'] = $nomzone;?>
        <div id="alertAjoutPark" class="alert btn-success alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeAjoutPark">×</button>
        <form method="post" action="test2.php">
          <h3 class="panel-title">Ajouter un parking dans la zone <?php echo $nomzone;?></h3>
            <div class="form-group">
                <input id="nomParking" name="nomParking" type="text" placeholder="Nom du parking" class="form-control">
            </div>
          <div class="form-group">
                <input id="RC2"  name="RC2" type="text" placeholder="Nombres de places COUVERTES pour les 2 roues" class="form-control">
            </div>
            <div class="form-group">
                <input id="RD2" name="RD2" type="text" placeholder="Nombres de places DEHORS pour les 2 roues" class="form-control">
            </div>
            <div class="form-group">
                <input id="RC4"  name="RC4" type="text" placeholder="Nombres de places COUVERTES pour les 4 roues" class="form-control">
            </div>
            <div class="form-group">
                <input id="RD4" name="RD4" type="text" placeholder="Nombres de places DEHORS pour les 4 roues" class="form-control">
            </div><div class="form-group">
                <input id="RC8"  name="RC8" type="text" placeholder="Nombres de places COUVERTES pour les 8 roues" class="form-control">
            </div>
            <div class="form-group">
                <input id="8RD" name="RD8" type="text" placeholder="Nombres de places DEHORS pour les 8 roues" class="form-control">
            </div>
              <button type="submit" class="btn btn-success">Ajouter</button>
        </form> 
        </div>
      
       	<div class="col-md-offset-2 col-md-8"> 
       		<div class="btn-group btn-group-justified" role="group"> 
        		<div class="btn-group"  role="group">
        		  <button type="submit" class="btn btn-success" id="ajoutPark">
        		    <span class="glyphicon glyphicon-ok"></span>&nbsp;Ajouter un parking
          		</button>                                                                        
     	 	</div>
     	 	<div class="btn-group"  role="group">
         		 <button type="button" class="btn btn-info" id="modifPark">
            		<span class="glyphicon glyphicon-pencil"></span>&nbsp;Transférer un parking
          		 </button>
        	</div>
     	 	<div class="btn-group"  role="group">
          		<button type="submit" class="btn btn-danger" id="supprPark">
            		<span class="glyphicon glyphicon-remove"></span>&nbsp;Supprimer un parking
          		</button>
        	</div>
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
    <script>  
        $(function (){
          $("#supprPark").click(function() {
              $("#supprPark").hide();
              $("#ajoutPark").hide();
              $("#afficherChoixZone").hide();
              $("#modifPark").hide();
              $("#alertSupprPark").show("slow");
          }); 
          $("#closeSupprPark").click(function() {
              $("#alertSupprPark").hide("slow");
              $("#supprPark").show();
              $("#ajoutPark").show();
              $("#afficherChoixZone").show();
          $("#modifPark").show();
          }); 
        }); 
    </script> 
    <script>  
        $(function (){
          $("#ajoutPark").click(function() {
              $("#ajoutPark").hide();
              $("#supprPark").hide();
              $("#afficherChoixZone").hide();
              $("#modifPark").hide();
              $("#alertAjoutPark").show("slow");
          }); 
          $("#closeAjoutPark").click(function() {
              $("#alertAjoutPark").hide("slow");
              $("#ajoutPark").show();
              $("#supprPark").show();
              $("#afficherChoixZone").show();
              $("#modifPark").show();
          }); 
        }); 
    </script>
    <script>  
        $(function (){
          $("#modifPark").click(function() {
              $("#ajoutPark").hide();
              $("#supprPark").hide();
              $("#afficherChoixZone").hide();
              $("#modifPark").hide();
              $("#alertModifPark").show("slow");
          }); 
          $("#closeModifPark").click(function() {
              $("#alertModifPark").hide("slow");
              $("#ajoutPark").show();
              $("#supprPark").show();
              $("#afficherChoixZone").show();
              $("#modifPark").show();
          }); 
        }); 
    </script>
      
      <!--INSERTION DU FOOTER-->
    <!--<?php include ('footer.php'); ?>-->
    </body>
</html>