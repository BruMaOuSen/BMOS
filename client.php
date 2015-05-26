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
		<div class="container">
    		<div class="row">
    			<div class="col-md-offset-2 col-md-8">
  					<table class="table table-bordered table-striped">
  						<caption>
  							<h4 style="text-align: center">Informations personnelles</h4>
  						</caption>
  						<!--<thead>
    						<tr>
      							<th style="text-align: center">Quartiers</th>
      							<th style="text-align: center">Prix à l'heure</th>
      							<th style="text-align: center">Prix au mois</th>
    						</tr>
  						</thead>-->
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
							$donnees = $reponse->fetch()
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
  			<div class="alert alert-warning alert-dismissable col-md-offset-3 col-md-6" style="display: none">
    			<button type="button" class="close">×</button>
      				<h4>Mettre ici le formulaire de modification</h4> 
      				Du style du formulaire de modif pour le prix des zones (fichier mairie.php).
  			</div>
  			<div class="col-md-offset-3 col-md-6">
    			<input type="button" class="btn btn-primary" id="afficher" value="Modifier les paramètres du profil">
  			</div>
		</div>

    	<!--INSERTION DU FOOTER-->
		<?php include ('footer.php'); ?>
		
		
		<!--Pour animer la page (bouton pour update le profil-->
		<script src="bootstrap/js/jquery.js"></script> 
		<script>  
  			$(function (){
    			$("#afficher").click(function() {
      				$("#afficher").hide();
      				$(".alert").show("slow");
    			}); 
    			$(".close").click(function() {
      				$(".alert").hide("slow");
      				$("#afficher").show();
    			}); 
  			}); 
		</script>
    </body>
</html>