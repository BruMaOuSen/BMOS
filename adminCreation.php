




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
			$reponse2 = $bdd->query('SELECT * FROM parking, zone where zone.nom_zone=parking.zone_park ORDER BY nom_park');     // requete a finir 
		?>
		<div class="container">
  			<div class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
    			<button type="button" class="close">×</button>
				<form method="post" action="mairiesmodif.php">
					<h3 class="panel-title">Choisir une zone</h3>
  					<select name="zone"class="selectpicker">
  					<?php
						while ($donnees1 = $reponse1->fetch())
						{
					?>
  							<option><?php echo $donnees1['nom_zone'];?></option>
  					<?php
						}
						$reponse1->closeCursor();
					?>
  					</select>
  					<select name="parking" class="selectpicker">
  						<?php
						while ($donnees2 = $reponse2->fetch())
						{
					?>
  							<option><?php echo $donnees2['nom_park'];?></option>
  					<?php
						}
						$reponse2->closeCursor();
					?>
  			  		</select>
  			  		<input name="prix" type="text" placeholder="nom du parking">
  			  		<button type="submit">Ajouter le parking</button>
				</form>
  			</div>
  			<div class="col-md-offset-3 col-md-6">
    			<button type="submit" class="btn btn-info" id="afficher">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;choisir une zone
    			</button>
  			</div>
		</div>
