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
    	
    	<!--CORPS DE LA PAGE D'INDEX-->
		
		<!--INFORMATIONS SUR LE CLIENT-->
		<div class="container">
    		<div class="row">
    			<div class="col-md-offset-2 col-md-8">
  					<table class="table table-bordered table-striped">
  						<caption>
  							<h4 style="text-align: center">Informations personnelles</h4>
  						</caption>
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
  						<?php
  							$id = $_SESSION['membreid'];
							$reponse = $bdd->query('SELECT * FROM client WHERE login =\''.$id.'\'');
							$donnees = $reponse->fetch();
						?>
    					<tbody>
    						<tr>
    							<td class="col-md-6">Pseudo</td>
    							<td>
    								<?php 
    									if($donnees){
	    									echo $donnees['login'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}
    								?>
    							</td>
    						</tr>
    						<tr>
    							<td>Nom</td>
    							<td><?php 
    									if($donnees){
	    									echo $donnees['nom'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}
    								?>
    							</td>
    						</tr>			    
    						<tr>
    							<td>Identification</td>
    							<td><?php 
    									if($donnees){
	    									echo $donnees['typep'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}
    								?>
    							</td>
    						</tr>
    						<tr>
    							<td>Numéro de compte</td>
    							<td><?php 
    									if($donnees){
	    									echo $donnees['numero_compte'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}	
    								?>
    							</td>
    						</tr>
    						<tr>
    							<td>Taux de réduction</td>
    							<td><?php 
    									if($donnees){
	    									echo $donnees['taux_de_reduction'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}	
    								?>
    							</td>
    						</tr>    				    					
						</tbody>
						<?php
							$reponse->closeCursor(); // Termine le traitement de la requête
						?>
					</table>
  				</div>
			</div>
  		</div>			
    	<div class="container">
  			<div id="infoPerso" class="alert alert-info alert-dismissable col-md-offset-3 col-md-6" style="display: none">
    			<button type="button" class="close" id="closePerso">×</button>
      			<form method="post" action="modifInfosPers.php">
  					<legend>Modifications des informations</legend>
						    <div class="form-group">
      							<input id="nom" name="nom" type="text" placeholder="Nom" class="form-control">
    						</div>
						    <div class="form-group">
      							<input id="identification"  name="identification" type="text" placeholder="Identification" class="form-control">
    						</div>
    						<div class="form-group">
      							<input id="numCompte" name="numCompte" type="text" placeholder="Numéro de compte" class="form-control">	
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

		<!--INFORMATIONS SUR LE VEHICULE-->
		<div class="container">
    		<div class="row">
    			<div class="col-md-offset-2 col-md-8">
  					<table class="table table-bordered table-striped">
  						<caption>
  							<h4 style="text-align: center">Informations sur le Véhicule</h4>
  						</caption>
  						<?php
							$reponse = $bdd->query("SELECT * FROM vehicule WHERE proprietaire = '$id'");
							$donnees = $reponse->fetch();
						?>
    					<tbody>
    						<tr>
    							<td class="col-md-6">Marque</td>
    							<td>
    								<?php 
    									if($donnees){
	    									echo $donnees['marque'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}
    								?>
    							</td>
    						</tr>
    						<tr>
    							<td>Immatriculation</td>
    							<td><?php 
    									if($donnees){
	    									echo $donnees['immatriculation'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}
    								?>
    							</td>
    						</tr>			    
    						<tr>
    							<td>Date de fabrication</td>
    							<td><?php 
    									if($donnees){
	    									echo $donnees['date_fabrication'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}
    								?>
    							</td>
    						</tr>
    						<tr>
    							<td>Type de véhicule</td>
    							<td><?php 
    									if($donnees){
	    									echo $donnees['type_veh'];
    									}
    									else
    									{
    										echo "Non renseigné";
    									}	
    								?>
    							</td>
    						</tr>
    					</tbody>
						<?php
							$reponse->closeCursor(); // Termine le traitement de la requête
						?>
					</table>
  				</div>
			</div>
  		</div>			
    	<div class="container">
  			<div id="infoVoit" class="alert alert-info alert-dismissable col-md-offset-3 col-md-6" style="display: none">
    			<button type="button" class="close" id="closeVoit">×</button>
      			<form method="post" action="modifInfosVehicule.php">
  					<legend>Modifications des informations</legend>
						    <div class="form-group">
      							<input id="marque" name="marque" type="text" placeholder="Marque" class="form-control">
    						</div>
						    <div class="form-group">
      							<input id="immatriculation"  name="immatriculation" type="text" placeholder="Immatriculation" class="form-control">
    						</div>
    						<div class="form-group">
      							<input id="datefabrication" name="dateFabrication" type="text" placeholder="Date de fabrication" class="form-control">	
      						</div>
      						<div class="form-group">
      							<input id="typeVehicule" name="typeVehicule" type="text" placeholder="Type de véhicule" class="form-control">	
      						</div>
    						<button type="submit">Valider</button>
				</form>
  			</div>
  			<div class="col-md-offset-3 col-md-6">
    			<button type="submit" class="btn btn-info" id="afficherInfoVoit">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier les informations du véhicule
    			</button>
  			</div>
		</div>

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
		<script>  
  			$(function (){
    			$("#afficherInfoVoit").click(function() {
      				$("#afficherInfoVoit").hide();
      				$("#infoVoit").show("slow");
    			}); 
    			$("#closeVoit").click(function() {
      				$("#infoVoit").hide("slow");
      				$("#afficherInfoVoit").show();
    			}); 
  			}); 
 		</script> 		
		

    </body>
</html>