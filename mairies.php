<?php
	// Connexion, sélection de la base de données
	$dbconn = pg_connect("host=localhost dbname=parkingProject user=admin1 password=admin")
    	or die('Connexion impossible : ' . pg_last_error());

	// Exécution de la requête SQL
	$query = 'SELECT nom_zone, prix_h_zone, prix_m_zone FROM zone';
	$result = pg_query($query) or die('Echec de la requête : ' . pg_last_error());

	// Affichage des résultats en HTML
	echo "<table>\n";
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    	echo "\t<tr>\n";
    	foreach ($line as $col_value) {
    	    echo "\t\t<td>$col_value</td>\n";
    	}
    	echo "\t</tr>\n";
	}
	echo "</table>\n";

	// LibÃ¨re le résultat		
	pg_free_result($result);

	// Ferme la connexion
	pg_close($dbconn);
?>