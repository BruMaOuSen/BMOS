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
        <title>UPARK | Admin <?php echo $_SESSION['membreid'];?></title>
    </head>
    <body>
    	<!--INSERTION DU HEADER-->
			<?php include ('header.php'); ?>			
    	
    	<!--CORPS DE LA PAGE D'INDEX-->    	
    	<?php echo "page client papa!"; ?>

    	
    	<!--INSERTION DU FOOTER-->
		<?php include ('footer.php'); ?>
    </body>
</html>