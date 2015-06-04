<div class="container">
    <div class="row">
    	<div class="col-md-offset-2 col-md-8">
  			<table class="table table-bordered table-striped">
  				<caption>
  					<h4 style="text-align: center">Informations personnelles de <?php echo $_SESSION['membreid'];?></h4>
  				</caption>
  				<?php
  					$id = $_SESSION['membreid'];
					$reponse = $bdd->query('SELECT * FROM client WHERE login =\''.$id.'\'');
					$donnees = $reponse->fetch();
					$reponse1 = $bdd->query('SELECT * FROM compte WHERE loginC = \''.$id.'\'');
					$donnees1 = $reponse1->fetch();
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
    					<td>
    						<?php 
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
    					<td>Identification (société ou personne)</td>
    					<td>
    						<?php 
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
                    <?php
                    if ($donnees['abonne']==TRUE) {
                    ?>
    				<tr>
    					<td>Numéro de compte</td>
    					<td>
    						<?php 
    							if($donnees1){
	    							echo $donnees1['numero_de_compte'];
    							}
    							else
    							{
    								echo "Non renseigné";
    							}	
    						?>
    					</td>
    				</tr>
                    <?php
                    }
                    else if ($donnees['abonne']== FALSE) 
                    {
                    }
                    ?>
    				<tr>
    					<td>Taux de réduction (%)</td>
    					<td>
    						<?php 
    							if($donnees1){
	    							echo $donnees1['taux_de_reduction'] . ' %' ;
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
					$reponse1->closeCursor();
				?>
			</table>
  		</div>
	</div>
</div>