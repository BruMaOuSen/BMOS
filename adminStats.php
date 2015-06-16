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
				<tbody>
				<?php $reponse1A = $bdd->query("SELECT SUM(prix) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY')||'-01-01', 'YYYY-MM-DD') AND Now()");
				$reponse1M = $bdd->query("SELECT SUM(prix) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM')||'-01', 'YYYY-MM-DD') AND Now()");
				$donnees1A = $reponse1A->fetch();
				$donnees1M = $reponse1M->fetch();?>
				<tr>
				<td><center><?php echo $donnees1M['sum'] ;?>€</center></td>
				<td><center><?php echo $donnees1A['sum'] ;?>€</center></td>
				<?php $reponse1A->closeCursor(); 
				$reponse1M->closeCursor();?>
        			</tr>
				</tbody>
 			
 			</table>			    
 </section>

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
 			<table class="table table-bordered table-striped">
   				<caption>
   					<h4 style="text-align: center">Nb de réservations sur l'ensemble des parkings</h4>
   				</caption>
   				<thead>
     				<tr>
       					<th style="text-align: center">Mensuels</th>
       					<th style="text-align: center">Annuels</th>
     				</tr>
   				</thead>
				<tbody>
				<?php $reponse4A = $bdd->query("SELECT count(*) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY')||'-01-01', 'YYYY-MM-DD') AND Now()");
				$reponse4M = $bdd->query("SELECT count(*) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM')||'-01', 'YYYY-MM-DD') AND Now()");
				$donnees4A = $reponse4A->fetch();
				$donnees4M = $reponse4M->fetch();?>
				<tr>
				<td><center><?php echo $donnees4M['count'] ;?></center></td>
				<td><center><?php echo $donnees4A['count'] ;?></center></td>
				<?php $reponse4A->closeCursor(); 
				$reponse4M->closeCursor();?>
        			</tr>
				</tbody>
 			
 			</table>			    
 </section>

</section>

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
 			<table class="table table-bordered table-striped">
   				<caption>
   					<h4 style="text-align: center">Réservations des 7 derniers jours sur l'ensemble des parkings</h4>
   				</caption>
   				<thead>
     				<tr>
       					<th style="text-align: center"> </th>
       					<th style="text-align: center">J-5</th>
					<th style="text-align: center">J-4</th>
					<th style="text-align: center">J-4</th>
					<th style="text-align: center">J-3</th>
					<th style="text-align: center">J-2</th>
					<th style="text-align: center">Hier (J-1)</th>
					<th style="text-align: center">Aujourd'hui (J)</th>
     				</tr>
   				</thead>
				<tbody>

				<?php $reponse6M1 = $bdd->query("SELECT count(*) FROM transac WHERE date_debut BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM-DD')||' 00:00:00', 'YYYY-MM-DD HH24:MI:SS') AND to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM-DD')||' 12:00:00', 'YYYY-MM-DD HH24:MI:SS')");
				$reponse6A1 = $bdd->query("SELECT count(*) FROM transac WHERE date_debut BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM-DD')||' 12:00:01', 'YYYY-MM-DD HH24:MI:SS') AND to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM-DD')||' 23:59:59', 'YYYY-MM-DD HH24:MI:SS')");
				
				$hier = date('Y-m-d', strtotime('-1 day'));
				$hier1 = date('Y-m-d', strtotime('-2 day'));
				$hier2 = date('Y-m-d', strtotime('-3 day'));
				$hier3 = date('Y-m-d', strtotime('-4 day'));
				$hier4 = date('Y-m-d', strtotime('-5 day'));
				$hier5 = date('Y-m-d', strtotime('-6 day'));
				
				$reponse6M2= $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier 00:00:00'::timestamp AND '$hier 11:59:59'::timestamp");
				$reponse6A2 = $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier 12:00:00'::timestamp AND '$hier 23:59:59'::timestamp");
				$reponse6M3= $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier1 00:00:00'::timestamp AND '$hier1 11:59:59'::timestamp");
				$reponse6A3 = $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier1 12:00:00'::timestamp AND '$hier1 23:59:59'::timestamp");
				$reponse6M4= $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier2 00:00:00'::timestamp AND '$hier2 11:59:59'::timestamp");
				$reponse6A4 = $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier2 12:00:00'::timestamp AND '$hier2 23:59:59'::timestamp");
				$reponse6M5= $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier3 00:00:00'::timestamp AND '$hier3 11:59:59'::timestamp");
				$reponse6A5 = $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier3 12:00:00'::timestamp AND '$hier3 23:59:59'::timestamp");
				$reponse6M6= $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier4 00:00:00'::timestamp AND '$hier4 11:59:59'::timestamp");
				$reponse6A6 = $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier4 12:00:00'::timestamp AND '$hier4 23:59:59'::timestamp");
				$reponse6M7= $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier5 00:00:00'::timestamp AND '$hier5 11:59:59'::timestamp");
				$reponse6A7 = $bdd->query("SELECT count(*) FROM transac WHERE date_debut::timestamp BETWEEN '$hier5 12:00:00'::timestamp AND '$hier5 23:59:59'::timestamp");				
								

				$donnees6M1 = $reponse6M1->fetch();
				$donnees6A1 = $reponse6A1->fetch();
				$donnees6M2 = $reponse6M2->fetch();
				$donnees6A2 = $reponse6A2->fetch();
				$donnees6M3 = $reponse6M3->fetch();
				$donnees6A3 = $reponse6A3->fetch();
				$donnees6M4 = $reponse6M4->fetch();
				$donnees6A4 = $reponse6A4->fetch();
				$donnees6M5 = $reponse6M5->fetch();
				$donnees6A5 = $reponse6A5->fetch();
				$donnees6M6 = $reponse6M6->fetch();
				$donnees6A6 = $reponse6A6->fetch();
				$donnees6M7 = $reponse6M7->fetch();
				$donnees6A7 = $reponse6A7->fetch();
				?>
				
				<tr>
				<td><center></center>Matin</td>
				<td><center><?php echo $donnees6M7['count'] ;?></center></td>
				<td><center><?php echo $donnees6M6['count'] ;?></center></td>
				<td><center><?php echo $donnees6M5['count'] ;?></center></td>
				<td><center><?php echo $donnees6M4['count'] ;?></center></td>
				<td><center><?php echo $donnees6M3['count'] ;?></center></td>
				<td><center><?php echo $donnees6M2['count'];?></center></td>
				<td><center><?php echo $donnees6M1['count'] ;?></center></td>
        			</tr>
				<tr>
				<td><center></center>Après-midi</td>
				<td><center><?php echo $donnees6A7['count'] ;?></center></td>
				<td><center><?php echo $donnees6A6['count'] ;?></center></td>
				<td><center><?php echo $donnees6A5['count'] ;?></center></td>
				<td><center><?php echo $donnees6A4['count'] ;?></center></td>
				<td><center><?php echo $donnees6A3['count'] ;?></center></td>
				<td><center><?php echo $donnees6A2['count'] ;?></center></td>
				<td><center><?php echo $donnees6A1['count'] ;?></center></td>
				
				<?php $reponse4A->closeCursor(); 
				$reponse4M->closeCursor();?>
        			</tr>
				</tbody>
 			
 			</table>			    
 </section>

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
 			<table class="table table-bordered table-striped">
   				<caption>
   					<h4 style="text-align: center">Réservations des 7 derniers jours sur l'ensemble des parkings</h4>
   				</caption>
   				<thead>
     				<tr>
       					<th style="text-align: center"> </th>
       					<th style="text-align: center">J-5</th>
					<th style="text-align: center">J-4</th>
					<th style="text-align: center">J-4</th>
					<th style="text-align: center">J-3</th>
					<th style="text-align: center">J-2</th>
					<th style="text-align: center">Hier (J-1)</th>
					<th style="text-align: center">Aujourd'hui (J)</th>
     				</tr>
   				</thead>
				<tbody>

				<?php $reponse6M1 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM-DD')||' 00:00:00', 'YYYY-MM-DD HH24:MI:SS') AND to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM-DD')||' 12:00:00', 'YYYY-MM-DD HH24:MI:SS')");
				$reponse6A1 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM-DD')||' 12:00:01', 'YYYY-MM-DD HH24:MI:SS') AND to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM-DD')||' 23:59:59', 'YYYY-MM-DD HH24:MI:SS')");
				
				$hier = date('Y-m-d', strtotime('-1 day'));
				$hier1 = date('Y-m-d', strtotime('-2 day'));
				$hier2 = date('Y-m-d', strtotime('-3 day'));
				$hier3 = date('Y-m-d', strtotime('-4 day'));
				$hier4 = date('Y-m-d', strtotime('-5 day'));
				$hier5 = date('Y-m-d', strtotime('-6 day'));
				
				$reponse6M2= $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier 00:00:00'::timestamp AND '$hier 11:59:59'::timestamp");
				$reponse6A2 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier 12:00:00'::timestamp AND '$hier 23:59:59'::timestamp");
				$reponse6M3= $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier1 00:00:00'::timestamp AND '$hier1 11:59:59'::timestamp");
				$reponse6A3 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier1 12:00:00'::timestamp AND '$hier1 23:59:59'::timestamp");
				$reponse6M4= $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier2 00:00:00'::timestamp AND '$hier2 11:59:59'::timestamp");
				$reponse6A4 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier2 12:00:00'::timestamp AND '$hier2 23:59:59'::timestamp");
				$reponse6M5= $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier3 00:00:00'::timestamp AND '$hier3 11:59:59'::timestamp");
				$reponse6A5 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier3 12:00:00'::timestamp AND '$hier3 23:59:59'::timestamp");
				$reponse6M6= $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier4 00:00:00'::timestamp AND '$hier4 11:59:59'::timestamp");
				$reponse6A6 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier4 12:00:00'::timestamp AND '$hier4 23:59:59'::timestamp");
				$reponse6M7= $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier5 00:00:00'::timestamp AND '$hier5 11:59:59'::timestamp");
				$reponse6A7 = $bdd->query("SELECT SUM(prix) AS sommen FROM transac WHERE date_debut::timestamp BETWEEN '$hier5 12:00:00'::timestamp AND '$hier5 23:59:59'::timestamp");				
								

				$donnees6M1 = $reponse6M1->fetch();
				$donnees6A1 = $reponse6A1->fetch();
				$donnees6M2 = $reponse6M2->fetch();
				$donnees6A2 = $reponse6A2->fetch();
				$donnees6M3 = $reponse6M3->fetch();
				$donnees6A3 = $reponse6A3->fetch();
				$donnees6M4 = $reponse6M4->fetch();
				$donnees6A4 = $reponse6A4->fetch();
				$donnees6M5 = $reponse6M5->fetch();
				$donnees6A5 = $reponse6A5->fetch();
				$donnees6M6 = $reponse6M6->fetch();
				$donnees6A6 = $reponse6A6->fetch();
				$donnees6M7 = $reponse6M7->fetch();
				$donnees6A7 = $reponse6A7->fetch();
				?>
				
				<tr>
				<td><center></center>Matin</td>
				<td><center><?php echo $donnees6M7['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6M6['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6M5['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6M4['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6M3['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6M2['sommen'];?>€</center></td>
				<td><center><?php echo $donnees6M1['sommen'] ;?>€</center></td>
        			</tr>
				<tr>
				<td><center></center>Après-midi</td>
				<td><center><?php echo $donnees6A7['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6A6['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6A5['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6A4['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6A3['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6A2['sommen'] ;?>€</center></td>
				<td><center><?php echo $donnees6A1['sommen'] ;?>€</center></td>
				
				<?php $reponse4A->closeCursor(); 
				$reponse4M->closeCursor();?>
        			</tr>
				</tbody>
 			
 			</table>			    
 </section>

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


<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
      <table class="table table-bordered table-striped">
          <caption>
            <h4 style="text-align: center">Nb de réservations des parkings de <?php echo $nomzone;?></h4>
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
						$reponse5 = $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone'");
						while ($donnees5 = $reponse5->fetch())
						{ 
						$park=$donnees5['nom_park'];
					?>
    						<tr>
        						<td><?php echo $donnees5['nom_park']; ?></td>
							<?php $reponse5M = $bdd->query("SELECT COUNT(*) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM')||'-01', 'YYYY-MM-DD') AND Now() AND nom_park='$park'"); 
							$donnees5M = $reponse5M->fetch(); ?>
							<td><?php echo $donnees5M['count']; ?></td>
							<?php $reponse5A = $bdd->query("SELECT COUNT(*) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY')||'-01-01', 'YYYY-MM-DD') AND Now() AND nom_park = '$park'");
							$donnees5A = $reponse5A->fetch();	?>
							<td><?php echo $donnees5A['count']; ?></td>
      						</tr>
					<?php
						}
						$reponse5->closeCursor(); // Termine le traitement de la requête
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
