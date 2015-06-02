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
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    	<link href="style.css" rel="stylesheet">
    	<meta charset="utf-8">
        <title>UPARK | Client <?php echo $_SESSION['membreid'];?></title>
    </head>
    <body>
    	<!--INSERTION DU HEADER-->
		<?php include ('header.php'); ?>			
    	
    	<!--BARRE DE NAVIGATION-->
		<?php include ('menuClient.php')?>
			    	
    	<!--CORPS DE LA PAGE D'INDEX-->
		<!--INFORMATIONS SUR LE CLIENT-->
  		<?php
			try
			{
				$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
			}
			catch (Exception $e)
			{
        		die('Erreur : ' . $e->getMessage());
			}
		?>
		
		<!--ON INSERE les infos personnelles du client-->
		<?php include('infoPersoClient.php'); ?>
						
    	<!--MODIFICATION DES INFOS CLIENTS-->
    	<div class="container">
  			<div id="infoPerso" class="alert btn-warning alert-dismissable col-md-offset-3 col-md-6" style="display: none">
    			<button type="button" class="close" id="closePerso">×</button>
      			<form method="post" action="modifInfosPers.php">
  					<legend>Modifications des informations</legend>
						    <div class="form-group">
      							<input id="nom" name="nom" type="text" placeholder="Nom" class="form-control">
    						</div>
						    <div class="form-group">
      							<input id="identification"  name="identification" type="text" placeholder="Société ou personne?" class="form-control">
    						</div>
    						<div class="form-group">
      							<input id="nbVoit" name="nbVoit" type="text" placeholder="Nombre de voiture(s)" class="form-control">	
      						</div>
    						<button type="submit" class="btn btn-info">Valider</button>
				</form>
  			</div>

			<div id="infoVeh" class="alert btn-success alert-dismissable col-md-offset-3 col-md-6" style="display: none">
    			<button type="button" class="close" id="closeInfoVeh">×</button>
      			<form method="post" action="test.php">
  					<legend>Ajouter un véhicule pour <?php echo $_SESSION['membreid'];?></legend>
						    <div class="form-group">
      							<input id="marque" name="marque" type="text" placeholder="Marque" class="form-control">
    						</div>
						    <div class="form-group">
      							<input id="immat"  name="immat" type="text" placeholder="Immatriculation" class="form-control">
    						</div>
    						<div class="form-group">
      							<input id="dateFab" name="dateFab" type="text" placeholder="Date de fabrication" class="form-control">	
      						</div>
    						<div class="form-group">
      							<input id="typeVeh" name="typeVeh" type="text" placeholder="Type de véhicule" class="form-control">	
      						</div>

    						<button type="submit" class="btn btn-succes">Valider</button>
				</form>
  			</div>

  		 	<div class="col-md-offset-2 col-md-8"> 
       			<div class="btn-group btn-group-justified" role="group"> 
        			<div class="btn-group"  role="group">
		    			<button type="submit" class="btn btn-warning" id="afficherInfoPerso">
    						<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifications des infos personnelles
    					</button>
  					</div>
  					<div class="btn-group"  role="group">
    					<button type="submit" class="btn btn-success" id="ajoutVehicule">
    						<span class="glyphicon glyphicon-pushpin"></span>&nbsp;Ajouter un véhicule
    					</button>
  					</div>
  				</div>
  			</div>
		</div>

		<!--INFORMATIONS SUR LE VEHICULE ET BOUTON DE MODIFICATION-->
		<?php include('infoVehiculeClient.php'); ?>
    	

		<!--INSERTION DU FOOTER-->
		<?php include ('footer.php'); ?>

		<!--Pour animer la page (bouton pour update le profil-->
		<script src="bootstrap/js/jquery.js"></script> 
		<script>  
  			$(function (){
    			$("#afficherInfoPerso").click(function() {
      				$("#afficherInfoPerso").hide();
      				$("#ajoutVehicule").hide();
      				$("#infoPerso").show("slow");
    			}); 
    			$("#closePerso").click(function() {
      				$("#infoPerso").hide("slow");
      				$("#afficherInfoPerso").show();
      				$("#ajoutVehicule").show();
    			}); 
  			}); 
 		</script>
 		<script>  
  			$(function (){
    			$("#ajoutVehicule").click(function() {
      				$("#ajoutVehicule").hide();
      				$("#afficherInfoPerso").hide();
      				$("#infoVeh").show("slow");
      				
    			}); 
    			$("#closeInfoVeh").click(function() {
      				$("#infoVeh").hide("slow");
      				$('#afficherInfoPerso').show();
      				$("#ajoutVehicule").show();
    			}); 
  			}); 
 		</script>	
    </body>
</html>