<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Zoeken op aantal stops';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

	// Voer deze query uit en sla het result op in $result.
	$query = "SELECT Vlucht_Nr, LuchthavenVanHerkomst, LuchthavenVanBestemming FROM Vlucht WHERE AantalStops = " . gebruikersInvoer('aantalstops') . ";";
	$result = mysql_query($query) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vluchtnummer</td><td>Herkomst</td><td>Bestemming</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) { ?>
	<tr>
		<td><?php echo $entry['Vlucht_Nr']; ?></td>
		<td><?php echo $entry['LuchthavenVanHerkomst']; ?></td>
		<td><?php echo $entry['LuchthavenVanBestemming']; ?></td>
	</tr>
	<?php } ?>
</table>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>