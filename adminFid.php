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
      
      <!--CORPS DE LA PAGE D'INDEX-->     
        <?php
      try
      {
        $bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
      }
      catch (Exception $e)
      {
            die('Erreur : ' . $e->getMessage());
      }

///////////////////// Affiche le nombre abonnés/non abonnés

    ?>
	<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
 			<table class="table table-bordered table-striped">
   				<caption>
   					<h4 style="text-align: center">Clients</h4>
   				</caption>
   				<thead>
     				<tr>
       					<th style="text-align: center">Nombre d'abonnés</th>
					<th style="text-align: center">Nombre de non abonnés</th>
     				</tr>
   				</thead>
				<tbody>
				<?php $reponse1 = $bdd->query("SELECT COUNT(*) FROM client WHERE abonne='true'");
				$donnees1 = $reponse1->fetch();?>
				<?php $reponse2 = $bdd->query("SELECT COUNT(*) FROM client WHERE abonne='false'");
				$donnees2 = $reponse2->fetch();?>
				<tr>
				<td><center><?php echo $donnees1['count'] ;?></center></td>
				<td><center><?php echo $donnees2['count'] ;?></center></td>
				<?php $reponse1->closeCursor();?>
        			<?php $reponse2->closeCursor();?>
				</tr>
				</tbody>
 			
 			</table>			    
 </section>


<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
        <tbody> 
	<div class="container"> 
    		<form method="POST" action="adminFid.php">
  			<h4>Modifier un taux de réduction</h4>
			<div class="form-group">
      				<input id="login" name="login" type="text" placeholder="Login" class="form-control">
    			</div>
			<div class="form-group">
                  <select name="tauxReduction" class="selectpicker form-control">
			<option>5</option>
                    	<option>10</option>
                    	<option>20</option>
			<option>30</option>    
                  </select> 
    		</div>
    	<button type="submit">Modifier</button>
		</form>
	</div> 
	<?php $login = $_POST['login'];
	$tdr = $_POST['tauxReduction'];	
	$reponse3 = $bdd->query("UPDATE client SET taux_de_reduction='$tdr' WHERE login='$login'");	
	$reponse3->closeCursor();?>
        </tbody>
      	       
</section>

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
      <table class="table table-bordered table-striped">
        <caption>
        	<h4 style="text-align: center">Liste des abonnés</h4>
        </caption>
        <thead>
        <tr>
                <th style="text-align: center">Login</th>
        	<th style="text-align: center">Nom</th>
		<th style="text-align: center">Taux de reduction</th>
        </tr>
        </thead>
        <tbody> 
	<?php
		$reponse = $bdd->query("SELECT * FROM client WHERE abonne = 'true'");
		while ($donnees = $reponse->fetch())
		{ 
	?>
    		<tr>
        	<td><?php echo $donnees['login']; ?></td>
		<td><?php echo $donnees['nom']; ?></td>
		<td><?php echo $donnees['taux_de_reduction']; ?></td>
		</tr>
	<?php
	}
		$reponse->closeCursor(); 
	?>
        </tbody>
      	</table>          
</section>

<section style="margin-top: 15px;" class="col-md-offset-2 col-md-8 table-responsive">
      <table class="table table-bordered table-striped">
        <caption>
        	<h4 style="text-align: center">Liste des non abonnés</h4>
        </caption>
        <thead>
        <tr>
                <th style="text-align: center">Login</th>
        	<th style="text-align: center">Nom</th>
        </tr>
        </thead>
        <tbody> 
	<?php
		$reponse = $bdd->query("SELECT * FROM client WHERE abonne = 'false'");
		while ($donnees = $reponse->fetch())
		{ 
	?>
		
    		<tr>
        	<td><?php echo $donnees['login']; ?></td>
		<td><?php echo $donnees['nom']; ?></td>
		</tr>
	<?php
	}
		$reponse->closeCursor(); 
	?>
        </tbody>
      	</table>          
</section>



<script src="bootstrap/js/jquery.js"></script> 
    <!--SCRIPTS FONCTiONNELS POUR TOUS LES BOUTONS DE LA PAGE-->
    <script>  
        $(function (){
          $("#afficherChoixZone").click(function() {
              $("#afficherChoixZone").hide();
              $("#supprPark").hide();
              $("#ajoutPark").hide();
              $("#modifPark").hide();
              $("#alertChoixZone").show("slow");
          }); 
          $("#closeChoixZone").click(function() {
              $("#alertChoixZone").hide("slow");
              $("#afficherChoixZone").show();
              $("#supprPark").show();
              $("#ajoutPark").show();
              $("#modifPark").show();
          }); 
        }); 
    </script>   
    <script>  
        $(function (){
          $("#supprPark").click(function() {
              $("#supprPark").hide();
              $("#ajoutPark").hide();
              $("#afficherChoixZone").hide();
              $("#modifPark").hide();
              $("#alertSupprPark").show("slow");
          }); 
          $("#closeSupprPark").click(function() {
              $("#alertSupprPark").hide("slow");
              $("#supprPark").show();
              $("#ajoutPark").show();
              $("#afficherChoixZone").show();
          $("#modifPark").show();
          }); 
        }); 
    </script> 
    <script>  
        $(function (){
          $("#ajoutPark").click(function() {
              $("#ajoutPark").hide();
              $("#supprPark").hide();
              $("#afficherChoixZone").hide();
              $("#modifPark").hide();
              $("#alertAjoutPark").show("slow");
          }); 
          $("#closeAjoutPark").click(function() {
              $("#alertAjoutPark").hide("slow");
              $("#ajoutPark").show();
              $("#supprPark").show();
              $("#afficherChoixZone").show();
              $("#modifPark").show();
          }); 
        }); 
    </script>
    <script>  
        $(function (){
          $("#modifPark").click(function() {
              $("#ajoutPark").hide();
              $("#supprPark").hide();
              $("#afficherChoixZone").hide();
              $("#modifPark").hide();
              $("#alertModifPark").show("slow");
          }); 
          $("#closeModifPark").click(function() {
              $("#alertModifPark").hide("slow");
              $("#ajoutPark").show();
              $("#supprPark").show();
              $("#afficherChoixZone").show();
              $("#modifPark").show();
          }); 
        }); 
    </script>
      
      <!--INSERTION DU FOOTER-->
    <!--<?php include ('footer.php'); ?>-->
    </body>
</html>
