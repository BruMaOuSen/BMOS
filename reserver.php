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
		
    </head>
<body>
	<?php 
		include ('header.php');
		include('menuClient.php'); 
	?>	
<div class="container">
    <div class="row">
    	<div class="col-md-offset-2 col-md-8">
		<form method="post" action= "zone.php">
			<h3 style="panel-title">Faut choisir un parking selon la zone choisie nonnn??? (ici ou dans zone.php) (c'est Oumaima), j'ai fait quelques modifs de mise en page et 
				corrigé les warnings des deux premieres pages<br> 
				la page choisir_place à revoir, elle n'a pas fonctionné pour moi dans le cas de la reservation par heure(bcp d'erreurs)</h3>
		

</br></br></br></br></br>
<h3 style="panel-title">Choisir une zone:</h3>

		<div class="form-group">
			<select class="selectpicker  form-control" name='zone'>
			<?php
				include ('connect.php');
		
				$conn=Connect();
				if(is_null($conn))
				echo "connect error";
		
		
				$request = pg_query($conn, "SELECT nom_zone FROM zone ORDER BY nom_zone");
				if(is_null($request))
				echo "query error";
		
				while ($row = pg_fetch_row($request)) {
					echo "<option  value='$row[0]'>$row[0]</option>";
				}
			 	echo "</select>";
			 	echo "</div>";
				$sql="select date_fin from occupe";
				$request_place = pg_query($conn, $sql);
				while ($row = pg_fetch_row($request_place)) {
					if(strtotime($row[0])<(time()+9*3600))
					{
						$sqll="delete from occupe where date_fin='$row[0]'";
						$request_delete = pg_query($conn, $sqll);
					}
				}

		$login =$_SESSION['membreid'];
		$request = pg_query($conn, "SELECT * FROM Vehicule where proprietaire = '$login' ");
		echo "<div class='form-group'>";
		echo "<h3 style='panel-title'>Choisissez votre Véhicule</h3>";
		echo "<select name='vehicule' class='selectpicker form-control'>";
		
	
		while ($row = pg_fetch_row($request)) {
				
				echo "<option value='$row[0]'>immatriculation:$row[0] marque:$row[2] type_veh:$row[4]</option>";
			}
			
		?>
		</select>
		</div>
	<div class="form-group">
	 <input type="submit" name ="submitted" value ="Valider" class="btn btn-primary form-control">
	</div>
	</form>
  	</div>
	</div>
</div>

	
	
</body>
</html>
