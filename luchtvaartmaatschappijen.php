<?php
	// Voer de inhoud van "database.inc" uit. Dit is PHP-code
	// die de verbinding met de database aangaat.
	require('database.inc');

	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Lijst van luchtvaartmaatschappijen in de US";

	// Voer de inhoud van "top.inc" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("top.inc");
?>
	<table>
	<tr><td>Naam</td><td>Call Sign</td></tr>
<?php
	$query = "SELECT Naam, CallSign FROM  luchtvaartmaatschappij WHERE  Thuisbasis= 'United States' ORDER BY  Naam, CallSign";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());
	
	while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) {
?>
	<tr>
		<td><?php echo $entry['Naam']; ?></td>
		<td><?php echo $entry['CallSign']; ?></td>
	</tr>
<?php
	}
?>
	</table>
<?php
	require("bottom.inc");
?>