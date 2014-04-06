<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Zoeken op oorsprong';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

	$query = "SELECT Vlucht_Nr, LBestemming.Naam AS Bestemming, Vertrektijd, Aankomsttijd
				FROM Vlucht, Luchthaven AS LHerkomst, Luchthaven AS LBestemming 
				WHERE LHerkomst.Naam LIKE '%".gebruikersInvoer('oorsprong')."%'
						AND Vlucht.LuchthavenVanHerkomst = LHerkomst.Luchthaven_ID
						AND Vlucht.LuchthavenVanBestemming = LBestemming.Luchthaven_ID;";
	// Merk op dat de gebruiker slechts een deel van de naam van de luchtvaartmaatschappij 
	// hoeft in te typen. Zo moet je bij het ontwikkelen/debuggen niet steeds in de 'luchtvaart' tabel
	// naar een correcte naam te zoeken.
	$result = mysql_query($query) or die("Database fout: " . mysql_error());
?>
<table>
	<tr><td>Vluchtnummer</td><td>Bestemming</td><td>Aantal dagen vliegen</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($result, MYSQL_ASSOC) ) { ?>
	<tr>
		<td><?php echo $entry['Vlucht_Nr']; ?></td>
		<td><?php echo $entry['Bestemming']; ?></td>
		<td><?php 
			$diff = (new DateTime($entry['Aankomsttijd']))->diff(new DateTime($entry['Vertrektijd']));
			echo $diff->days
		?></td>
	</tr>
	<?php } ?>
</table>
<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>