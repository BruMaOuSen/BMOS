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

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
 			<table class="table table-bordered table-striped">
   				<caption>
   					<h4 style="text-align: center">Profits de tous les parkings</h4>
   				</caption>
   				<thead>
     				<tr>
       					<th style="text-align: center">Mensuels</th>
       					<th style="text-align: center">Annuels</th>
     				</tr>
   				</thead>
+				<tbody>
+				<?php $reponse1A = $bdd->query("SELECT SUM(prix) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY')||'-01-01', 'YYYY-MM-DD') AND Now()") ;
+				$reponse1M = $bdd->query("SELECT SUM(prix) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM')||'-01', 'YYYY-MM-DD') AND Now()");
+				$donnees1A = $reponse1A->fetch();
+				$donnees1M = $reponse1M->fetch()
+				?>
+				<tr>
+				<td><center><?php echo $donnees1M['sum'] ?></center></td>
+				<td><center><?php echo $donnees1A['sum'] ?></center></td>
+				<?php $reponse1A->closeCursor(); 
+				$reponse1M->closeCursor();
+				?>
+        			</tr>
+				</tbody>
 			
 			</table>			    
 </section>
///////////////////// Choix d'une zone pour afficher les parkings qui la contiennent

      $reponse1 = $bdd->query('SELECT * FROM zone ORDER BY nom_zone');
    ?>

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
            <h4 style="text-align: center">Les Profits des parkings de <?php echo $nomzone;?></h4>
          </caption>
          <thead>
            <tr>
                <th style="text-align: center">Nom du parking</th>
                <th style="text-align: center">Mensuels</th>
                <th style="text-align: center">Annuels</th>
            </tr>
          </thead>
          <tbody> 
          <?php
						$reponse = $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone'");
						while ($donnees = $reponse->fetch())
						{ 
						$park=$donnees['nom_park'];
					?>
    						<tr>
        						<td><?php echo $donnees['nom_park']; ?></td>
							<?php $reponse2 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM')||'-01', 'YYYY-MM-DD') AND Now() AND nom_park='$park'"); 
							$donnees2 = $reponse2->fetch(); ?>
							<td><?php echo $donnees2['sommen']; ?>€</td>
							<?php $reponse3 = $bdd->query("SELECT SUM(prix) AS somannu FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY')||'-01-01', 'YYYY-MM-DD') AND Now() AND nom_park = '$park'");
							$donnees3 = $reponse3->fetch();	?>
							<td><?php echo $donnees3['somannu']; ?>€</td>
      						</tr>
					<?php
						}
						$reponse->closeCursor(); // Termine le traitement de la requête
					?>
        </tbody>
      </table>          
</section>


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
