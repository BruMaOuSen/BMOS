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
<div class="container">
    <div class="row">
    	<div class="col-md-offset-2 col-md-8">
  			<table class="table table-bordered table-striped">
  				<caption>
  					<h4 style="text-align: center">Informations sur le Véhicule <?php echo $numeroVoiture; ?></h4>
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
    					<td>
    						<?php 
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
    					<td>
    						<?php 
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
    					<td>
    						<?php 
    							if($donnees){
    								if($donnees['type_veh']=='2'){
    									echo "2 roues";
    								}
    								else if($donnees['type_veh']=='4'){
    									echo "4 roues";
    								}
    								else if($donnees['type_veh']=='8'){
    									echo "8 roues";
    								}
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
    		<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier les informations du véhicule <?php echo $numeroVoiture; ?>
    	</button>
  	</div>
</div>
		
<?php
	$compteur = $compteur + 1;
	}
?>