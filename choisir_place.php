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
		body {background-color:#eeeeee}

		</style>
    </head>
<body>
<?php 
	include ('header.php');
	include ('menuClient.php');
 ?>	
	<?php
		include "connect.php";
		$conn=Connect();
		if(is_null($conn))
			echo "connect error";
		$parking=$_SESSION['parking'];
		$num_tran=$_SESSION['nun_tran']+1;
		if (isset($_POST["choisir_place"])) 
		{
			
			
			$num=$_POST["num_place"];
			$type_t="ticket";
			$moyen_p=$_POST["modePaiement"];
			$temp=$_POST["temp"];
			//echo $temp;
			if($temp=="heure"){
			$date_debut=$_POST["datedebut"];
			$date_fin=$_POST["datefin"];
			}
			else
			{
				$date_debut=$_POST["datedebut_m"];
				//echo $date_debut;
				$date_fin_date=strtotime($date_debut)+30*24*3600;
				//echo $date_fin_date;
				$date_fin=date("Y-m-d H:i:s",$date_fin_date);
				//echo $date_fin;
			}
			
		}
		$request_da = pg_query($conn, "SELECT date_debut,date_fin FROM occupe where numero='$num' and nom_park='$parking'");
		while ($row = pg_fetch_row($request_da)) {
			//echo $row[0];
			$debut=strtotime($row[0]);
			$fin=strtotime($row[1]);
			$nouv_debut=strtotime($date_debut);
			$nouv_fin=strtotime($date_fin);
			if($nouv_debut>$fin || $nouv_fin<$nouv_debut){}
			else
			{
				echo "<h1 style='color : #ff0000'>réservation echec</h1>";
				echo "<h1 style='color : #ff0000'>place déjà  occupe</h1>";
				$date_debut=0;
				
			}
		}
		
		
		/*if($type_t=="abonnement")
		{
			$moyen_p="carte";
		}*/
		$zone=$_SESSION['zone'];
		$request_login = pg_query($conn, "SELECT prix_h_zone,prix_m_zone FROM zone where nom_zone = '$zone'   ");
		$row = pg_fetch_row($request_login);
		$prixheure=$row[0];
		$prixmois=$row[1];
		/*obtenir immatriculation par login*/
		$login =$_SESSION['membreid'];
		$request_login = pg_query($conn, "SELECT taux_de_reduction FROM compte where loginC = '$login'   ");
		$row = pg_fetch_row($request_login);
		$taux=$row[0];
		
		
		$date_achat=date("Y-m-d H:i:s",(time()+9*3600));
		/*--------------------------------------------*/
		
		
		$duree=(date_default_timezone_set($date_fin)-date_default_timezone_set($date_debut))/3600;
		if($temp=="mois")
		{
			$prix=$prixmois*(1-$taux/100);
		}
		else
		{
			$prix=$duree*$prixheure*(1-$taux/100);
		}
		/*if($type_t=="abonnement"){
			$prix=0;
		}else{
		$prix=$duree*2;
		}*/
		/*$request_login = pg_query($conn, "SELECT immatriculation FROM Vehicule where proprietaire = '$login'   ");
		$row = pg_fetch_row($request_login);*/
		$immatriculation=$_SESSION['vehicule'];
		
		/*insert  le reservation*/
		$sql="insert into occupe(immatriculation,nom_park,numero,date_debut,date_fin) values ('$immatriculation','$parking','$num','$date_debut','$date_fin')";
		//echo $sql;
		$query1 = pg_query($conn,$sql);
		if(!$query1)
		{
			echo "<h1 style='color : #ff0000'>réservation echec</h1>";
			echo "<h1 style='color : #ff0000'>place occupe</h1>";
			
		}
		/*insert  le transaction*/
		$sql="insert into Transac(numero_transac,date_achat,date_debut,date_fin,prix,type_t,numero_paiement,moyen_p,client,nom_park,numero_place) 
					values ('$num_tran','$date_achat','$date_debut','$date_fin','$prix','$type_t','$num_tran','$moyen_p','$login','$parking','$num')";
					//echo $sql;
		$query2 = pg_query($conn,$sql);
		if(!$query2)
		{
			echo "<h1 style='color : #ff0000'>réservation echec</h1>";
			echo "<h1 style='color : #ff0000'>paiement a échoué</h1>";
			
			
		}
		/*update free_place*/
		if($query1&&$query2)
		{
			echo "<h1 style='color : #ff0000'>réservation succès</h1>";
			$query = pg_query($conn, "UPDATE parking set free_places=free_places-1 where nom_park='$parking'");
		
		
		
		echo "</table><h1>DANS '$parking' LES TEMPS OCCUPE CI-DESOUS</h1>";
		$request_place = pg_query($conn, "SELECT o.numero,o.date_debut,o.date_fin FROM occupe o where o.nom_park = '$parking'   ");
		if(!$request_place)
			echo "query error";
		echo "<table class='table table-bordered table-striped'><tr><th>num_place</th><th>date_debut</th><th>date_fin</th></tr>";
		while ($row = pg_fetch_row($request_place)) {
			echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
			if(is_null($row))
			{
				echo "TOUTES PLACE SONT LIBRE!";
			}
		}
		echo "</table>";
		echo "<h1>Votre transaction</h1>";
		$request_transac = pg_query($conn, "SELECT * FROM transac where numero_transac = '$num_tran' ");
		
		echo "<table class='table table-bordered table-striped'><tr>
				<th>numero_transac</th><th>date_achat</th><th>date_debut</th><th>date_fin</th><th>prix</th>
					<th>type_t</th><th>numero_paiement</th><th>moyen_p</th><th>client</th><th>nom_park</th><th>numero_place</th></tr>";
		$row = pg_fetch_row($request_transac);
		echo "<tr>
		<th>$row[0]</th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th><th>$row[4]</th><th>$row[5]</th>
					<th>$row[6]</th><th>$row[7]</th><th>$row[8]</th><th>$row[9]</th><th>$row[10]</th></tr>";
		
		echo "</table>";
		}else{
			$sql="delete from Transac where numero_transac='$num_tran'";
			$query1 = pg_query($conn,$sql);
			$sql="delete from occupe where immatriculation='$immatriculation' AND date_debut=$date_debut and date_fin=$date_fin";
			$query1 = pg_query($conn,$sql);
		}
		$_SESSION['nun_tran']=$num_tran;
	?>
	
	<label><a href="reserver.php" style='color=#9933ff'><h1>RETOUNER A PAGE RESEVER</h1></a></label>
</body>
</html>
