<?php
	$login = $_SESSION['membreid'];
	$reponse = $bdd->query("SELECT * FROM vehicule WHERE proprietaire = '$login'");
	
	while($donnees = $reponse->fetch()){
?>
<div class="container">
    <div class="row">
    	<div class="col-md-offset-2 col-md-8">
  			<table class="table table-bordered table-striped">
  				<caption>
  					<h4 style="text-align: center">Informations sur le véhicule <?php echo $donnees['immatriculation']; ?></h4>
  				</caption>
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
			</table>
  		</div>
	</div>
	<?php
	}
	$reponse->closeCursor();

	$reponse = $bdd->query("SELECT * FROM vehicule WHERE proprietaire = '$login'");
	if($reponse->fetch() == NULL){
	?>
	<div class="container">
  		<div class="alert btn-primary alert-dismissable col-md-offset-3 col-md-6" style="margin-bottom: 10px;">
			Aucun véhicule encore renseigné pour : <?php echo $login;?>
  		</div>
    </div>
	
	<?php
	}
    else
    {    
	?>
	<div class="col-md-offset-2 col-md-8"> 
	    <div class="btn-group btn-group-justified" role="group"> 
    		<div class="btn-group"  role="group">
			    <button type="submit" class="btn btn-warning" id="afficherModifVehicule">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier un véhicule
    			</button>
	  		</div>
  			<div class="btn-group"  role="group">
    			<button type="submit" class="btn btn-danger" id="afficherSuppressionVehicule">
    				<span class="glyphicon glyphicon-remove"></span>&nbsp;Supprimer un véhicule
    			</button>
  			</div>
  		</div>
	</div>
    <?php
    $reponse->closeCursor();
    }
    ?>
</div>

