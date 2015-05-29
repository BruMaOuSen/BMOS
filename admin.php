<?php 
	session_start();
	if(!isset($_SESSION['authentification'])){
		header("Location: index.php");	
	}
	else
	{
		if($_SESSION['roleutil']!='administrateur'){
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
        <title>UPARK | Admin <?php echo $_SESSION['membreid'];?></title>
    </head>
    <body>
    	<!--INSERTION DU HEADER-->
		<?php include ('header.php'); ?>	
			
		<nav class="navbar navbar-default navbarColor">
		  	<div class="container-fluid col-md-offset-2 col-md-8">
    			<ul>
    		 		<li> <a href="adminStats.php">Statistiques</a> </li>
      				<li> <a href="#">Gestion Abonnement</a> </li>
      				<li> <a href="#">Reserver une place</a> </li>
      				<!--<li> <a href="#">Références</a> </li>-->
    			</ul>
			</div>
		</nav>
			
    	
    	<!--CORPS DE LA PAGE D'INDEX-->    	
    	<?php echo "page client papa!"; ?>

    	
    	<!--INSERTION DU FOOTER-->
		<?php include ('footer.php'); ?>
    </body>
</html>