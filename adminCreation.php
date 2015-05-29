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
			$reponse1 = $bdd->query('SELECT * FROM zone ORDER BY nom_zone');
		?>

		<div class="container">

  			<div class="alert alert-info alert-dismissable col-md-offset-2 col-md-8" style="display: none">
    			<button type="button" class="close">×</button>
				<form method="post" action="adminPark.php">
					<h3 class="panel-title">Choisir une zone</h3>
  					<select name="zone"class="selectpicker">
  					<?php
						while ($donnees1 = $reponse1->fetch())
						{
					?>
  							<option ><?php echo $donnees1['nom_zone'];?></option>
  					<?php
						}
						
						$reponse1->closeCursor();
					?>
  					</select>
  					
 
  			  		<button type="submit">Ajouter la zone</button>
				</form>	
  			</div>
  		<div class="col-md-offset-3 col-md-6">
    			<button type="submit" class="btn btn-info" id="afficher">
    				<span class="glyphicon glyphicon-pencil"></span>&nbsp;choisir une zone
    			</button>
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