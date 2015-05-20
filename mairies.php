<?php 
	session_start();
	if(!isset($_SESSION['authentification'])){
		header("Location: index.php");	
	}
	else
	{
		if($_SESSION['roleutil']!='mairie' && $_SESSION['roleutil']!='administrateur'){
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
        <title>UPARK | Mairie <?php echo $_SESSION['membreid'];?></title>
    </head>
    <body>
    	<!--INSERTION DU HEADER-->
    	<?php include('header.php'); ?>   

		<!--CORPS DE LA PAGE MAIRIE-->
		<?php
			try
			{
				$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
			}
			catch (Exception $e)
			{
        		die('Erreur : ' . $e->getMessage());
			}
			$reponse = $bdd->query('SELECT * FROM zone ORDER BY nom_zone');
			
		?>
		<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
			<form method="post" action="mairiesmodif.php">
			<div class="panel panel-primary">
  				<div class="panel-heading">
    				<h3 class="panel-title">Modifier le prix d'une zone</h3>
  				</div>
  				<div class="panel-body form control">
  					<select name="zone"class="selectpicker">
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
  					<select name="typeTarif">
  							<option value="prix à l'heure">prix à l'heure</option>
  							<option value="prix au mois">prix au mois </option>
  			  		</select>
  			  		<input name="prix" type="text" placeholder="nouveau prix">
  			  		<button type="submit">Changer le prix</button>
  				</div>
			</div>
			</form>
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
						$reponse = $bdd->query('SELECT * FROM zone ORDER BY nom_zone');
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
		
		<!--INSERTION DU FOOTER-->
    	<?php include('footer.php'); ?>   		
	</body>
</html>