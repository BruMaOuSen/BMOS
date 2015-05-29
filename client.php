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
  			<div id="infoPerso" class="alert alert-info alert-dismissable col-md-offset-3 col-md-6" style="display: none">
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
    						<button type="submit">Valider</button>
				</form>
  			</div>
  			<div class="col-md-offset-3 col-md-6">
    			<button type="submit" class="btn btn-info" id="afficherInfoPerso">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier les informations personnelles
    			</button>
  			</div>
		</div>

		<!--INFORMATIONS SUR LE VEHICULE ET BOUTON DE MODIFICATION-->
		<?php 
			
		?>
		<?php include('infoVehiculeClient.php'); ?>
    	
    	
    	<!--INSERTION DU FOOTER-->
		<?php include ('footer.php'); ?>
		  
    	<!--Pour animer la page (bouton pour update le profil-->
		<script src="bootstrap/js/jquery.js"></script> 
		<script>  
  			$(function (){
    			$("#afficherInfoPerso").click(function() {
      				$("#afficherInfoPerso").hide();
      				$("#infoPerso").show("slow");
    			}); 
    			$("#closePerso").click(function() {
      				$("#infoPerso").hide("slow");
      				$("#afficherInfoPerso").show();
    			}); 
  			}); 
 		</script>
 		
 		
 		<?php
			$login = $_SESSION['membreid'];
			$reponse = $bdd->query("SELECT nb_voitures FROM client WHERE login = '$login'");
			$donnees = $reponse->fetch();
			$nbVoit = $donnees['nb_voitures'];
			$reponse->closeCursor();
		?>

		<?php
			$compteur = 0;
			while($compteur<$nbVoit)
			{
			$numeroVoiture = $compteur + 1;
		?>
		<script>  
  			$(function (){
    			$("#afficherInfoVoit<?php echo $numeroVoiture;?>").click(function() {
      				$("#afficherInfoVoit<?php echo $numeroVoiture;?>").hide();
      				$("#infoVoit<?php echo $numeroVoiture;?>").show("slow");
    			}); 
    			$("#closeVoit<?php echo $numeroVoiture;?>").click(function() {
      				$("#infoVoit<?php echo $numeroVoiture;?>").hide("slow");
      				$("#afficherInfoVoit<?php echo $numeroVoiture;?>").show();
    			}); 
  			});
        	var machin; 
        function clic("afficherInfoVoit<?php echo $numeroVoiture;?>"){
                alert("afficherInfoVoit<?php echo $numeroVoiture;?>");
                machin = outgoingLink;
        } 
 		</script> 
 		<?php
			$compteur = $compteur + 1;
		}
		?>		
    </body>
</html>