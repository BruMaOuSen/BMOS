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
    	
    	<!--CORPS DE LA PAGE DE STATS-->   
         <?php
			try
			{
				$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
			}
			catch (Exception $e)
			{
        		die('Erreur : ' . $e->getMessage());
			}
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
				<?php $reponse1A = $bdd->query("SELECT SUM(prix) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY')||'-01-01', 'YYYY-MM-DD') AND Now()") ;
				$reponse1M = $bdd->query("SELECT SUM(prix) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM')||'-01', 'YYYY-MM-DD') AND Now()");
				$donnees1A = $reponse1A->fetch();
				$donnees1M = $reponse1M->fetch()
				?>
				<tr>
				<td><center><?php echo $donnees1M['sum'] ?></center></td>
				<td><center><?php echo $donnees1A['sum'] ?></center></td>
				<?php $reponse1A->closeCursor(); 
				$reponse1M->closeCursor();
				?>
        			</tr>
				</tbody>
			
			</table>			    
</section>
		<div class="container">
  			<div id="alertChoixZone"class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
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
  					
 
  			  		<button type="submit">Valider</button>
				</form>	
				<?php 
				session_start();
				$nomzone = $_POST['zone']; 
				$_SESSION['nomZone'] = $nomzone;
?>

  			</div>
  			<div class="col-md-offset-3 col-md-6">
    			<button type="submit" class="btn btn-info" id="afficherChoixZone">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;choisir une zone
    			</button>
  			</div>	
		</div>


<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
			<table class="table table-bordered table-striped">
  				<caption>
  					<h4 style="text-align: center">Profits des parkings de <?php echo $_SESSION['nomZone'];?></h4>
  				</caption>
  				<thead>
    				<tr>
      					<th style="text-align: center">Mensuels</th>
      					<th style="text-align: center">Annuels</th>
    				</tr>
  				</thead>
    			
			</table>			    
</section>


<div class="container">
        <div id="alertChoixParking" class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
          <button type="button" class="close" id="closeChoixParking">×</button>
        <form method="post" action="adminStats.php">
          <h3 class="panel-title">Choisir un parking</h3>
            <select name="parking"class="selectpicker">
                        
            		<?php
				$reponse3 = $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone'");
				while ($donnees3 = $reponse3->fetch())
				{
			?>
  					<option ><?php echo $donnees3['nom_park'];?></option>
  			<?php
				}
				$reponse3->closeCursor();
			?>
			</select>
               <button type="submit">Valider</button>
	
        </form> 
        </div>
	<div class="col-md-offset-3 col-md-6">
	<button type="submit" class="btn btn-info" id="afficherChoixParking">
    		<span class="glyphicon glyphicon-pencil"></span>&nbsp;choisir un parking
    	</button>
  	</div>
</div>
<?php 
			$nomparking = $_POST['parking'];
?>

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
			<table class="table table-bordered table-striped">
  				<caption>
  					<h4 style="text-align: center">Profits du parking <?php echo $nomparking;?></h4>
  				</caption>
  				<thead>
    				<tr>
      					<th style="text-align: center">Mensuels</th>
      					<th style="text-align: center">Annuels</th>
    				</tr>
  				</thead>
				<tbody>
				<?php 
				$nomzone = $bdd->query("SELECT zone_park FROM parking where nom_park='$nom_park'");	
				$reponse3A = $bdd->query("SELECT SUM(prix) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY')||'-01-01', 'YYYY-MM-DD') AND Now() AND nom_park=$nomparking") ;
				$reponse3M = $bdd->query("SELECT SUM(prix) FROM transac WHERE date_achat BETWEEN to_timestamp(to_char(Now()::timestamptz, 'YYYY-MM')||'-01', 'YYYY-MM-DD') AND Now() AND nom_park=$nomparking");
				
				//$donnees3A = $reponse3A->fetch(); 
				//$donnees3M = $reponse3M->fetch();
				
				?>
				
				<tr>
				<td><center><?php echo $donnees3M['sum'] ?></center></td>
				<td><center><?php echo $donnees3A['sum'] ?></center></td>
				
        			</tr>
				</tbody>
    			

			</table>			    
</section>		


<script src="bootstrap/js/jquery.js"></script> 
		<!--SCRIPTS FONCTiONNELS POUR TOUS LES BOUTONS DE LA PAGE-->
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
    			$("#afficherChoixParking").click(function() {
      				$("#afficherChoixParking").hide();
      				$("#alertChoixParking").show("slow");
    			}); 
    			$("#closeChoixParking").click(function() {
      				$("#alertChoixParking").hide("slow");
      				$("#afficherChoixParking").show();
    			}); 
  			}); 
		</script> 
    	

    	<!--INSERTION DU FOOTER-->
		<!--<?php include ('footer.php'); ?>-->
    </body>
</html>
