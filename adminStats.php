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
			$reponse1 = $bdd->query('SELECT * FROM zone ORDER BY nom_zone');
		?>

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
  			</div>
  			<div class="col-md-offset-3 col-md-6">
    			<button type="submit" class="btn btn-info" id="afficherChoixZone">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;choisir une zone
    			</button>
  			</div>
		</div>

<?php 
			$nomzone = $_POST['zone'];
//			$reponse2 = $bdd->query("SELECT nom_park FROM parking WHERE zone_park = '$nomzone'");
//			$donnees2 = $reponse2->fetch();
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
		<div class="container">
		
		  	<!--BOUTON MODIFIER NE PAS LE RECUPERER JUSTE LA POUR TESTER LES SCRIPTS-->
		  	<div id="alertModifPark" class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
    			<button type="button" class="close" id="closeModifPark">×</button>
				<form method="post" action="test.php">
					<h3 class="panel-title">Choisir un parking</h3>
  					<select name="supprparking"class="selectpicker" style="width:219px;">
  				
  					</select>
  					<button type="submit">Supprimer</button>
				</form>	
  			</div>
		  	
		  	<!--BOUTON SUPPRIMER PARKING-->
  			<div id="alertSupprPark" class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
    			<button type="button" class="close" id="closeSupprPark">×</button>
				<form method="post" action="test.php">
					<h3 class="panel-title">Choisir un parking</h3>
  					<select name="supprparking"class="selectpicker" style="width:219px;">
  					<?php
  						$reponse2= $bdd->query("SELECT * FROM parking WHERE zone_park = '$nomzone'");
						while ($donnees2 = $reponse2->fetch())
						{
					?>
  							<option ><?php echo $donnees2['nom_park'];?></option>
  					<?php
						}
						
						$reponse2->closeCursor();
					?>
  					</select>
  					<button type="submit">Supprimer</button>
				</form>	
  			</div>
  			
  			<!--BOUTON AJOUTER PARKING-->
  			<?php $_SESSION['nomZone'] = $nomzone;?>
  			<div id="alertAjoutPark" class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
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
  			  		<button type="submit">Ajouter</button>
				</form>	
  			</div>
  			<div class="col-md-offset-3 col-md-2">
    			<button type="submit" class="btn btn-info" id="modifPark">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier un parking
    			</button>
  			</div>
			<div class="col-md-2" style="padding-left: 0px; padding-right: 0px;">
    			<button type="submit" class="btn btn-info" id="supprPark">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Supprimer un parking
    			</button>
    		</div>
    		<div class="col-md-2">
    			<button type="submit" class="btn btn-info" id="ajoutPark">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Ajouter un parking
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