<?PHP 
session_start();
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
<?php include ('header.php'); ?>	
<div class="container">
    <div class="row">
    	<div class="col-md-offset-2 col-md-8">
  			<table class="table table-bordered table-striped">
<tr><th>nom_park</th><th>hfree_places</th><th>nbplaces_park</th><tr>
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
		echo "<h1>VOUS AVEZ CHOISI LA ZONE : $zone<h1>"; 
		$conn=Connect();
		
		if(is_null($conn))
			echo "connect error";
		
		/*afficher table parking*/
		$request = pg_query($conn, "SELECT nom_park,free_places,nbplaces_park FROM parking where zone_park='$zone' and free_places > 0 ");
		if(is_null($request))
			echo "query error";
		
		while ($row = pg_fetch_row($request)) {
    		echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><tr>";
			$parking =$row[0];
    	}
		if(is_null($parking))
		{
			$message = "Il n'y a pas parking dans cette zone!";
			echo "<script type='text/javascript'>lert('$message');</script>";
			header("location:reserver.php");
		}
		$_SESSION['parking']=$parking;
		pg_close($request);
		/*afficher table place*/
		echo "</table><h1>DANS $parking LES PLACES LIBRE CI-DESOUS</h1>";
		$request_place = pg_query($conn, "SELECT p.num_place,p.type_place,p.type_veh FROM place p where p.park_place = '$parking' 
				
					and p.type_veh in (select type_veh from Vehicule where immatriculation='$vehicule')");
		if(is_null($request_place))
			echo "query error";
		echo "<table class='table table-bordered table-striped'><tr><th>num_place</th><th>type_veh</th><th>type_place</th></tr>";
		while ($row = pg_fetch_row($request_place)) {
			echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
		}
		echo "</table>";
		pg_close(request_place);
		/*affichier les temps occupe*/
		echo "</table>";
		echo "<h1>DANS $parking LES TEMPS OCCUPE CI-DESOUS</h1>";
		$request_place = pg_query($conn, "SELECT o.numero,o.date_debut,o.date_fin FROM occupe o where o.nom_park = '$parking'   ");
		if(!$request_place)
			echo "TOUTES PLACE SONT LIBRE!";
		else{
		echo "<table class='table table-bordered table-striped'><tr><th>num_place</th><th>date_debut</th><th>date_fin</th></tr>";
		while ($row = pg_fetch_row($request_place)) {
			echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
			if(!$row)
			{
				echo "TOUTES PLACE SONT LIBRE!";
			}
		}
		echo "</table>";
		}
		
			
	?>	
</div></div></div>
	<h1 style="text-align : center">CHOISIR VOTRE NUMERO DE PLACE RT LE TEMP:</h1>
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
		echo "<label><h3>reservation par heure sont :'$prixheure' €</h3></label>";
		echo "<label><h3>reservation par mois sont :'$prixmois' €</h3></label>";
	?>
	
	
	<label id="mois"><input type="radio" name="temp" value ="heure" onclick='unvalide()'>reservation par heure<br/>
	datedebut<input type="text" name="datedebut" id ="datedebut" disabled="true" > datefin<input type="text" name="datefin" id ="datefin" disabled="true"></label>
	
	<label id="heure"><input type="radio" name="temp" value ="mois" onclick='valide()' >reservation 1 mois <br/> 
	datedebut<input type="text" name="datedebut_m" id ="datedebut1" disabled="true"></label><br/>

	
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

