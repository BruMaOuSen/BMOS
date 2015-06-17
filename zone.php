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
<html>
    <head>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    	<link href="style.css" rel="stylesheet">
    	<meta charset="utf-8">
        <title>UPARK | Home <?php echo $_SESSION['membreid'];?></title>
		<style type="text/css">
			label {
			display: inline-block;
			cursor: pointer;
			position: relative;
			padding-left: 280px;
			margin-right: 15px;
			font-size: 13px;
			}
			input[type=radio]:checked + label:before {
    content: "\2022";
    color: #f3f3f3;
    font-size: 30px;
    text-align: center;
    line-height: 18px;
}
		</style>
		<script type="text/javascript">
		function valide(){
			document.getElementById("datedebut1").disabled=false;
			document.getElementById("datedebut").disabled=true;
			document.getElementById("datefin").disabled=true;
		}
		function unvalide(){
			document.getElementById("datedebut1").disabled=true;
			document.getElementById("datedebut").disabled=false;
			document.getElementById("datefin").disabled=false;
		}
		function pay()
		{
			document.getElementById("ad1").disabled=true
		}
		</script>
    </head>
<body style="background-color:#eeeeee">
<?php 
	include ('header.php');
	include('menuClient.php');
 ?>	
<div class="container">
    <div class="row">
    	<div class="col-md-offset-2 col-md-8">
  			<table class="table table-bordered table-striped">
<tr>
	<th style="text-align: center">Nom du parking</th>
	<th style="text-align: center">Places disponibles</th>
	<th style="text-align: center">Total des places</th>
<tr>
<?php
		
		include "connect.php";
		if (isset($_POST["submitted"])) 
		{
			$zone=$_POST["zone"];
			$vehicule=$_POST["vehicule"];
			$_SESSION['zone']=$zone;
			$_SESSION['vehicule']=$vehicule;
		}
		else
		echo "choisir zone error";
		echo "<h3>Vous avez choisi la zone $zone<h3>"; 
		$conn=Connect();
		
		if(is_null($conn))
			echo "connect error";
		
		/*afficher table parking*/
		$request = pg_query($conn, "SELECT nom_park,free_places,nbplaces_park FROM parking where zone_park='$zone' and free_places > 0 ");
		if(is_null($request))
			echo "query error";
		
		while ($row = pg_fetch_row($request)) {
    		echo "<tr><td><center>$row[0]</center></td><td><center>$row[1]</center></td><td><center>$row[2]</center></td><tr>";
			$parking =$row[0];
    	}
		if(is_null($parking))
		{
			$message = "Il n'y a pas de parking dans cette zone!";
			echo "<script type='text/javascript'>lert('$message');</script>";
			header("location:reserver.php");
		}
		$_SESSION['parking']=$parking;
		/*afficher table place*/
		echo "</table><h3>Les places libres dans le parking $parking</h3>";
		$request_place = pg_query($conn, "SELECT p.num_place,p.type_place,p.type_veh FROM place p where p.park_place = '$parking' 
				
					and p.type_veh in (select type_veh from Vehicule where immatriculation='$vehicule')");
		if(is_null($request_place))
			echo "query error";
		echo "<table class='table table-bordered table-striped'><tr><th style='text-align: center'>Numéro de la place</th><th style='text-align: center'>Type de la place</th><th style='text-align: center'>Type du véhicule</th></tr>";
		while ($row = pg_fetch_row($request_place)) {
			echo "<tr><td><center>$row[0]</center></td><td><center>$row[1]</center></td><td><center>$row[2]</center></td></tr>";
		}
		echo "</table>";
		/*affichier les temps occupe*/
		echo "</table>";
		echo "<h3>Les périodes de réservation des places occupées dans le parking $parking </h3>";
		$request_place = pg_query($conn, "SELECT o.numero,o.date_debut,o.date_fin FROM occupe o where o.nom_park = '$parking'   ");
		if(!$request_place)
			echo "Toutes les places sont libres!";
		else{
		echo "<table class='table table-bordered table-striped'><tr><th style='text-align: center'>Numéro de la place</th><th style='text-align: center'>Date de début</th><th style='text-align: center'>Date de fin</th></tr>";
		while ($row = pg_fetch_row($request_place)) {
			echo "<tr><td><center>$row[0]</center></td><td><center>$row[1]</center></td><td><center>$row[2]</center></td></tr>";
			if(!$row)
			{
				echo "Toutes les places sont libres!";
			}
		}
		echo "</table>";
		}
		
			
	?>	
</div></div></div>
	<h2 style="text-align : center">Choisissez votre place et la période de votre réservation</h2>
	<form method="post" action = "choisir_place.php">
	
	<?php
		$conn=Connect();
		$request = pg_query($conn, "SELECT p.num_place,p.type_place,p.type_veh FROM place p where p.park_place = '$parking' 
			
				and p.type_veh in (select type_veh from Vehicule where immatriculation='$vehicule')");
		//echo "<label><select name='num_place' class='form-control'>";
		echo "<label>num  type </label><br/>";
		while ($row = pg_fetch_row($request)) {
				//echo "<option  value='$row[0]'>$row[0] $row[1]  </option>";
				echo "<label><input type='radio' name='num_place' value='$row[0]'>$row[0] $row[1] $row[2] </label><br/>";
			}
		//echo "</select></label><br/>"
		
		$request_login = pg_query($conn, "SELECT prix_h_zone,prix_m_zone FROM zone where nom_zone = '$zone'   ");
		$row = pg_fetch_row($request_login);
		$prixheure=$row[0];
		$prixmois=$row[1];
		echo "<label><h4>Prix de la réservation par heure: $prixheure €</h4></label>";
		echo "<label><h4>Prix de la réservation par mois: $prixmois €</h4></label>";
	?>
	
	
	<label id="mois">
		<input type="radio" name="temp" value ="heure" onclick='unvalide()'>Réservation par heure<br/>
		date de début <input type="text" name="datedebut" id ="datedebut" disabled="true"><i>(AAAA-MM-JJ)</i> <br/>
		date de fin<input type="text" name="datefin" id ="datefin" disabled="true"><i>(AAAA-MM-JJ)</i>
	</label>
	
	<label id="heure">
		<input type="radio" name="temp" value ="mois" onclick='valide()' >Réservation d'un mois <br/> 
		date de début<input type="text" name="datedebut_m" id ="datedebut1" disabled="true"><i>(AAAA-MM-JJ)</i>
	</label><br/>

	
	<?php
	/*$meb=$_SESSION['membreid'];
		$sql="select abonne from client where login='$meb'";
		
		$request_abo = pg_query($conn, $sql);
			$row = pg_fetch_row($request_abo);
		if($row[0]=="t")
		{
			echo "<label>Vous avez un abonnement!</label><br/>";
			echo "<label><input type='radio'  name='typeTransac' value='abonnement' onclick='unvalide()' >abonnement</label><br/>";
			echo "<label><input type='radio' name=.'typeTransac'. value='ticket' onclick='valide()' disabled='true'>ticket   ";
		}
		else
		{
			echo "<label>Vous n'avez pas un abonnement!</label><br/>";
			echo "<label><input type='radio' name='typeTransac' value='abonnement' onclick='unvalide()'  disabled='true'>abonnement</label><br/>";
			echo "<label><input type='radio' name='typeTransac' value='ticket' onclick='valide()' >ticket   ";
		}*/
	?>
	
	
        <label><select name="modePaiement" id="pay_method" >
            <option value="carte">
             carte 
            </option>
            <option value="monnaie">
             monnaie
             </option>
        </select> 
     </label><br/>
			<input type="submit" value="Valider" name="choisir_place" class="btn btn-info col-md-offset-5 ">
	</form>
	
</body>
</html>

