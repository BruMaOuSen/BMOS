<?php
function Connect()
{
	$host="localhost";
	$port=5432;
	$dbname="parkingProject";
	$user="admin";
	$password="admin";
	$list = "host=$host port=5432 dbname=$dbname user=$user password=$password";
	$conn= pg_connect($list);

	return $conn;
}
?>
