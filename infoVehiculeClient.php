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
    									echo " 2 roues";
    								}
    								else if($donnees['type_veh']=='4'){
    									echo " 4 roues";
    								}
    								else if($donnees['type_veh']=='8'){
    									echo " 8 roues";
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
