<?php 
	session_start();
	if(!isset($_SESSION['authentification'])){
		header("Location: index.php");	
	}
	else
	{
		if($_SESSION['roleutil']!='client'){
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
        <title>UPARK | Client <?php echo $_SESSION['membreid'];?></title>
    </head>
    <body>
    	<!--INSERTION DU HEADER-->
		<?php include ('header.php'); ?>			
    	
    	<!--BARRE DE NAVIGATION-->
		<?php include ('menuClient.php');?>
			    	
    	<!--CORPS DE LA PAGE D\'INDEX-->
		<!--INFORMATIONS SUR LE CLIENT-->
  		<?php
			try
			{
				$bdd = new PDO('pgsql:host=localhost;dbname=parkingProject', 'admin', 'admin');
			}
			catch (Exception $e)
			{
        		die('Erreur : ' . $e->getMessage());
			}
		?>
		
		<!--ON INSERE les infos personnelles du client-->
		<?php include('infoPersoClient.php'); ?>
						
    	<!--MODIFICATION DES INFOS CLIENTS-->
    	<div class="container">
  			<div id="infoPerso" class="alert btn-warning alert-dismissable col-md-offset-3 col-md-6" style="display: none">
    			<button type="button" class="close" id="closePerso">×</button>
      		<form method="post" action="modifInfosPers.php">
  					<legend>Modifications des informations</legend>
						<div class="form-group">
      				<input id="nom" name="nom" type="text" placeholder="Nom" class="form-control">
    				</div>
            <div class="form-group">
              <select name="identification" class="selectpicker form-control">
                <option>
                  societe  
                </option>
                <option>
                  personne
                </option>    
              </select> 
            </div>
    				<button type="submit" class="btn btn-primary">Modifier</button>
				  </form>
  			</div>


      <!--AJOUTER UN VEHICULE-->  
			  <div id="infoVeh" class="alert btn-success alert-dismissable col-md-offset-3 col-md-6" style="display: none">
    			<button type="button" class="close" id="closeInfoVeh">×</button>
      			<form method="post" action="creationVehicule.php">
  					<legend>Ajouter un véhicule pour <?php echo $_SESSION['membreid'];?></legend>
						    <div class="form-group">
      							<input id="marque" name="marque" type="text" placeholder="Marque" class="form-control">
    						</div>
						    <div class="form-group">
      							<input id="immat"  name="immat" type="text" placeholder="Immatriculation" class="form-control">
    						</div>
    						<div class="form-group">
      							<input id="dateFab" name="dateFab" type="text" placeholder="Date de fabrication" class="form-control">	
      					</div>
                 <div class="form-group">
                  <select name="typeVeh" class="selectpicker form-control">
                    <option>
                      2  
                    </option>
                    <option>
                      4
                    </option>
                    <option>
                      8
                    </option>    
                  </select> 
                </div>
                <div class="form-group">
      						<button type="submit" class="btn btn-primary form-control">Ajouter</button>
                </div>
				    </form>
  			</div>

        <!--MODIFICATION DES INFOS CLIENTS-->
  		 	<div class="col-md-offset-2 col-md-8"> 
       			<div class="btn-group btn-group-justified" role="group"> 
        			<div class="btn-group"  role="group">
		    			<button type="submit" class="btn btn-warning" id="afficherInfoPerso">
    						<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifications des infos personnelles
    					</button>
  					</div>

        <!--AJOUTER UN VEHICULE-->     
  					<div class="btn-group"  role="group">
    					<button type="submit" class="btn btn-success" id="ajoutVehicule">
    						<span class="glyphicon glyphicon-pushpin"></span>&nbsp;Ajouter un véhicule
    					</button>
  					</div>
  				</div>
  			</div>
		</div>

		<!--INFORMATIONS SUR LE VEHICULE ET BOUTON DE MODIFICATION-->
		<?php include('infoVehiculeClient.php'); ?>
    	
    	
    	<!--FORMULAIRE POUR MODIFIER LES VEHICULES DU CLIENT-->
	<div id="infoModifVehicule" class="alert btn-warning alert-dismissable col-md-offset-3 col-md-6" style="display: none">
    	<button type="button" class="close" id="closeModifVehicule">×</button>
      	<form method="post" action="modifInfosVehicule.php">
  			  <legend>Modifier le véhicule</legend>
  			  <?php
  				  $reponse = $bdd->query("SELECT immatriculation FROM vehicule WHERE proprietaire = '$login'");
  			  ?>
          <div class="form-group">
          <select name="immatAncienne"class="selectpicker form-control">
  				<?php
						while ($donnees = $reponse->fetch())
						{
					?>
  						<option><?php echo $donnees['immatriculation'];?></option>
  				<?php
						}
						$reponse->closeCursor();
					?>
  			  </select>
          </div>
			    <div class="form-group">
     			  <input id="marque" name="marque" type="text" placeholder="Marque" class="form-control">
    		  </div>
			    <div class="form-group">
      			<input id="immatriculation"  name="immatriculation" type="text" placeholder="Immatriculation" class="form-control">
    		  </div>
			    <div class="form-group">
    				<input id="dateFabrication" name="dateFabrication" type="text" placeholder="Date de Fabrication" class="form-control">	
          </div>
          <div class="form-group">
            <select name="typeVehicule" class="selectpicker form-control">
              <option>
                2  
              </option>
              <option>
                4
              </option>
              <option>
                8
              </option>    
            </select> 
          </div>
          <div class="form-group">
      	    <button type="submit" class="btn btn-primary form-control">Modifer le véhicule</button>
	        </div>
  	    </form>
  </div>

  <!--FORMULAIRE POUR SUPPRIMER UN VEHICULE DU CLIENT-->
  <div id="infoSupprVehicule" class="alert btn-danger alert-dismissable col-md-offset-3 col-md-6" style="display: none">
      <button type="button" class="close" id="closeSupprVehicule">×</button>
        <form method="post" action="supprVehicule.php">
          
          <legend>Supprimer le véhicule</legend>
          <?php
            $reponse = $bdd->query("SELECT immatriculation FROM vehicule WHERE proprietaire = '$login'");
          ?>
          <div class="form-group"> 
          <select name="immatriculation"class="selectpicker form-control" >
          <?php
            while ($donnees = $reponse->fetch())
            {
          ?>
              <option><?php echo $donnees['immatriculation'];?></option>
          <?php
            }
            $reponse->closeCursor();
          ?>
          </select>
          </div>
          <div class="form-group"> 
            <button type="submit" class="btn btn-primary form-control">Supprimer le véhicule</button>
          </div>
        </form>
  </div>
			
		<!--INSERTION DU FOOTER-->
		<?php include ('footer.php'); ?>

		<!--Pour animer la page (bouton pour update le profil-->
		<script src="bootstrap/js/jquery.js"></script> 
		<script>  
  			$(function (){
    			$("#afficherInfoPerso").click(function() {
      				$("#afficherInfoPerso").hide();
      				$("#ajoutVehicule").hide();
      				$("#infoPerso").show("slow");
    			}); 
    			$("#closePerso").click(function() {
      				$("#infoPerso").hide("slow");
      				$("#afficherInfoPerso").show();
      				$("#ajoutVehicule").show();
    			}); 
  			}); 
 		</script>
 		<script>  
  			$(function (){
    			$("#ajoutVehicule").click(function() {
      				$("#ajoutVehicule").hide();
      				$("#afficherInfoPerso").hide();
      				$("#infoVeh").show("slow");
      				
    			}); 
    			$("#closeInfoVeh").click(function() {
      				$("#infoVeh").hide("slow");
      				$('#afficherInfoPerso').show();
      				$("#ajoutVehicule").show();
    			}); 
  			}); 
 		</script>
 		<script>  
  			$(function (){
    			$("#afficherModifVehicule").click(function() {
      				$("#afficherModifVehicule").hide();
      				$("#afficherSuppressionVehicule").hide();
      				$("#infoModifVehicule").show("slow");
    			}); 
    			$("#closeModifVehicule").click(function() {
      				$("#infoModifVehicule").hide("slow");
      				$("#afficherModifVehicule").show();
      				$("#afficherSuppressionVehicule").show();
    			}); 
  			}); 
 		</script>
    <script>  
        $(function (){
          $("#afficherSuppressionVehicule").click(function() {
              $("#afficherModifVehicule").hide();
              $("#afficherSuppressionVehicule").hide();
              $("#infoSupprVehicule").show("slow");
          }); 
          $("#closeSupprVehicule").click(function() {
              $("#infoSupprVehicule").hide("slow");
              $("#afficherModifVehicule").show();
              $("#afficherSuppressionVehicule").show();
          }); 
        }); 
    </script>	
    </body>
</html>