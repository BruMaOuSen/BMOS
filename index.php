<?php
    // Script faisant appel aux sessions
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    	<link href="style.css" rel="stylesheet">
    	<meta charset="utf-8">
        <title>UPARK | Home</title>
    </head>
    <body>
    	<!--INSERTION DU HEADER-->
			<?php include ('header.php'); ?>			
		<!--CORPS DE LA PAGE D'INDEX-->
    	<div id="inscription">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-offset-1 col-md-4 presIndex">
  						<legend>Bienvenue chez UPARK</legend>
					    <div class="alignjustify">	
					    	Ce site g&egrave;re l'ensemble des parkings UPARK de Lyon.
							Une fois inscrit, vous pourrez alors g&eacute;rer vos diff&eacute;rents abonnements, r&eacute;server une place libre 
							occasionnellement, r&eacute;server une place pour une p&eacute;riode donn&eacute;e.<br/><br/>
	
							Si vous n'&ecirc;tes pas encore inscrit, remplissez le formulaire d'inscription sur votre droite avant
					    	de profiter de tous nos services.<br/><br/>	
						</div>
						<div class="size10">
	    					UPARK vous remercie de la confiance que vous lui accordez.
						</div>
					</div>
					<div class="col-md-offset-2 col-md-4 presIndex"> 
    					<form method="POST" action="creationutilisateur.php">
  							<legend>Inscrivez-vous!</legend>
						    <div class="form-group">
      							<input id="login" name="login" type="text" placeholder="pseudo" class="form-control">
    						</div>
						    <div class="form-group">
      							<input id="motdepasse"  name="motdepasse" type="password" placeholder="Choississez un mot de passe" class="form-control">
    						</div>
    						<div class="form-group">
      							<input id="motdepasseverif" type="password" placeholder="Vérifier votre mot de passe" class="form-control">	
      						</div>
    						<button type="submit">Inscription</button>
						</form>
					</div>    				
				</div>
    		</div>
    	</div>
    	
    	<!--INSERTION DU FOOTER-->
		<?php include ('footer.php'); ?>
    </body>
</html>