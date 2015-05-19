<!DOCTYPE html>
<html>
    <head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    	<link href="style.css" rel="stylesheet">
    	<meta charset="utf-8">
        <title>UPARK | Mairie</title>
    </head>
    <body>
		<?php
			// Connexion, sélection de la base de données
			//$dbconn = pg_connect("host=localhost dbname=parkingProject user=admin password=admin")
    		//			or die('Connexion impossible : ' . pg_last_error());

			try
			{
				$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
			}
			catch (Exception $e)
			{
        		die('Erreur : ' . $e->getMessage());
			}



			// Exécution de la requête SQL
			//$query = 'SELECT nom_zone, prix_h_zone, prix_m_zone FROM zone';
			$reponse = $bdd->query('SELECT * FROM zone');
			
		?>
		<section class="col-md-offset-2 col-md-8 table-responsive">
			<div class="panel panel-primary">
  				<div class="panel-heading">
    				<h3 class="panel-title">Modifier le prix d'une zone</h3>
  				</div>
  				<div class="panel-body form control">
  					<select>
  						<?php
							while ($donnees = $reponse->fetch())
							{
						?>
  								<option><?php echo $donnees['nom_zone'];?></option>
  						<?php
							}
							$reponse->closeCursor();
						?>
  					</select>
  					<select>
  							<option>prix à l'heure</option>
  							<option>prix au mois </option>
  			  		</select>
  			  		<input type="text" placeholder="nouveau prix">
  			  		<button>Changer le prix</button>
  				</div>
			</div>
			<table class="table table-bordered table-striped table-condensed">
  				<caption>
  					<h4 style="text-align: center">Les zones de Lyon où nous sommes implantés.</h4>
  				</caption>
  				<thead>
    				<tr>
      					<th style="text-align: center">Quartiers</th>
      					<th style="text-align: center">Prix à l'heure</th>
      					<th style="text-align: center">Prix au mois</th>
    				</tr>
  				</thead>
    			<tbody>			    
					<?php
						$reponse = $bdd->query('SELECT * FROM zone');
						while ($donnees = $reponse->fetch())
						{
					?>
    						<tr class="active">
        						<td><?php echo $donnees['nom_zone']; ?></td>
        						<td><?php echo $donnees['prix_h_zone']; ?>€</td>
        						<td><?php echo $donnees['prix_m_zone']; ?>€</td>
      						</tr>
					<?php
						}
						$reponse->closeCursor(); // Termine le traitement de la requête
					?>
				</tbody>
			</table>
		</section>			
	</body>
</html>