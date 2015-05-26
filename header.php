<?php
	session_start();
?>

<?php 
	if($_SESSION['membreid']==NULL){
?>
<!-- Si un utilisateur n'est pas connecté on affiche le formulaire de connexion-->
<div id="header">
    <div class="container">
    	<div class="row">
    		<div  class="col-md-4">
    			<a href="index.php"><h1>UPARK</h1>
    			<p>Les parkings de Lyon</p></a>
    		</div>
    		<div  class="col-md-offset-3 col-md-4">
    			<form  method="post" action="verifconnexion.php">	
    				<input id="pseudo" name="pseudo" type="text" placeholder="pseudo">
    				<input id="password" name="motdepasse" type="password" placeholder="password">    					
    				<button>Connexion</button>
    			</form>	
    		</div>
    	</div>
    </div>
</div>
<?php
	}
	else{
?>
<!-- Si un utilisateur est pas connecté on affiche son compte et la possibilité de se déconnecter-->
<div id="header">
    <div class="container">
    	<div class="row">
    		<div  class="col-md-4">
    			<a href="index.php"><h1>UPARK</h1>
    			<p>Les parkings de Lyon</p></a>
    		</div>
    		<div  class="col-md-offset-3 col-md-4">
    			<h4 class="colorwhite">Connecté avec le compte : <?php echo $_SESSION['membreid'];?></h4>
    			<a href="deconnexion.php">Deconnexion</a>
	   		</div>
    	</div>
    </div>
</div>
<?php
	}
?>


