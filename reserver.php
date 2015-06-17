<?php
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
	<?php include ('header.php'); ?>	
<div class="container">
    <div class="row">
    	<div class="col-md-offset-2 col-md-8">

		<form method="post" action= "zone.php">
		<h1 style="color:#cc99ff">choisir un zone:</h1>
		<select class="select  form-control" name='zone' multiple="multiple">
		<?php
			include ('connect.php');
		
			$conn=Connect();
			if(is_null($conn))
			echo "connect error";
		
		//echo "</select></label><br/>"
			$request = pg_query($conn, "SELECT nom_zone FROM zone ");
			if(is_null($request))
			echo "query error";
		
			while ($row = pg_fetch_row($request)) {
				echo "<option  value='$row[0]'>$row[0]</option>";
			}
			pg_close($request);
			$sql="select date_fin from occupe";
			$request_place = pg_query($conn, $sql);
			while ($row = pg_fetch_row($request_place)) {
			if(strtotime($row[0])<(time()+9*3600))
			{
				$sqll="delete from occupe where date_fin='$row[0]'";
				$request_delete = pg_query($conn, $sqll);
			}
			
			echo "</select>";
		}
		$login =$_SESSION['membreid'];
		$request = pg_query($conn, "SELECT * FROM Vehicule where proprietaire = '$login' ");
		echo "<h2 style='color:#cc99ff'>Choisez votre Vehicule</h2>";
		echo "<label><select name='vehicule' class='form-control'>";
		while ($row = pg_fetch_row($request)) {
				
				echo "<option value='$row[0]'>immatriculation:$row[0] marque:$row[2] type_veh:$row[4]</option>";
			}
			
		?>
		</select>
	<input type="submit" name ="submitted" value ="submit" class="btn btn-info">
	</select>
	</form>
  	</div>
	</div>
</div>

	
	
</body>
</html>
