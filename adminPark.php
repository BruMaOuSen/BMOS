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


<html>
<head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    	<link href="style.css" rel="stylesheet">
    	<meta charset="utf-8">
        <title>UPARK | Administrateur <?php echo $_SESSION['membreid'];?></title>
    </head>
<body>

        <?php
			try
			{
				$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
			}
			catch (Exception $e)
			{
        		die('Erreur : ' . $e->getMessage());
			}

			$_SESSION['nomzone'] = $_POST['zone'];
			$nomzone = $_POST['zone'];
			$reponse1 = $bdd->query("SELECT * FROM parking WHERE zone_park= '$nomzone'");
		?>
<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
			<table class="table table-bordered table-striped">
  				<caption>
  					<h4 style="text-align: center">Les parkings de cette zone</h4>
  				</caption>
  				<thead>
    				<tr>
      					<th style="text-align: center">Nom du parking</th>
      					<th style="text-align: center">Total des places</th>
      					<th style="text-align: center">Nombre de places libres</th>
    				</tr>
  				</thead>
    			<tbody>	
    			<?php
						while ($donnees1 = $reponse1->fetch())
						{
					?>
    						<tr>
        						<td><center><?php echo $donnees1['nom_park']; ?></center></td>
        						<td><center><?php echo $donnees1['nbplaces_park']; ?> places </center></td>
        						<td><center><?php echo $donnees1['free_places']; ?> places</center></td>
      						</tr>
					<?php
						}
						$reponse1->closeCursor(); // Termine le traitement de la requête
					?>
				</tbody>
			</table>
		</section>			    
		<div class="container">

  			
  		<div class="col-md-offset-3 col-md-6">
    			<button type="submit" class="btn btn-info" id="afficher">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier ce parking
    			</button>
    			<button type="submit" class="btn btn-info" id="afficher">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Supprimer ce parking
    			</button>

    			<!-- <button type="submit" class="btn btn-info" id="afficher">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Ajouter ce parking
    			</button>                                                                          Boutton ajouter un parking --> 
  			</div>

		</div>




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