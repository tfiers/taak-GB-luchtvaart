<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Een vlucht boeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

	$beschikbare_plaatsen = mysql_query("SELECT zitplaats.Zitplaats_Nr, vlucht.Vlucht_Nr, 
											  LHerkomst.Naam AS luchthaven_herkomst, LBestemming.Naam AS luchthaven_bestemming, 
											  Luchtvaartmaatschappij_ID, Klasse, COUNT(*) AS aantal_vrije_zitplaatsen
										 FROM vlucht, zitplaats, luchthaven AS LHerkomst, luchthaven AS LBestemming
										 WHERE vlucht.LuchthavenVanHerkomst = LHerkomst.Luchthaven_ID
												 AND vlucht.LuchthavenVanBestemming = LBestemming.Luchthaven_ID
												 AND zitplaats.Vlucht_Nr = vlucht.Vlucht_Nr
												 AND (vlucht.Vlucht_Nr, zitplaats.Zitplaats_Nr) NOT IN
														(SELECT boeking.Vlucht_Nr, boeking.Zitplaats_Nr
														 FROM wordtgeboektdoor AS boeking)
										 GROUP BY Vlucht_Nr, Luchtvaartmaatschappij_ID, Klasse
										;") 
	or die("Kan de lijst van beschikbare plaatsen niet opvragen: ".mysql_error()); 

	// Opmerking 1:
	// We limiteren het aantal resultaten om lange wachttijden te vermijden.
	// Om alle data te zien zou paging geïmplementeerd moeten worden.
	// (Of nog veel beter: zoeken, met autocomplete, op velden)
	
	// Opmerking 2:
	// deze query, met: 
	// 
	// 		AND (vlucht.Vlucht_Nr, zitplaats.Zitplaats_Nr) NOT IN
	//		 		(SELECT boeking.Vlucht_Nr, boeking.Zitplaats_Nr
	//		  		 FROM wordtgeboektdoor AS boeking)
	// 
	// is 19x sneller dan de semantisch equivalente query:
	// 
	//		AND NOT EXISTS 
	//		(SELECT * 
	//		 FROM wordtgeboektdoor
	//		 WHERE vlucht.Vlucht_Nr = wordtgeboektdoor.Vlucht_Nr
	//		        AND zitplaats.Zitplaats_Nr = wordtgeboektdoor.Zitplaats_Nr)
	// 
	// ("Query took 0.2563 sec" tov. "Query took 4.9187 sec")

	// Opmerking 3
	// We laten de gebruiker zelf geen zitplaats nummer kiezen,
	 // maar nemen gewoon degene die door 'GROUP BY' wordt gegeven
	// (voor een bepaalde vlucht, klasse en luchtvaartmaatschappij).
?>



<!-- Voeg hier je code toe -->
<table>
	<tr><td>Vluchtnummer</td><td>Herkomst</td><td>Bestemming</td><td>ID Luchtvaartmaatschappij</td><td>Klasse</td><td>Aantal nog beschikbare plaatsen</td></tr>
	<!-- Begin van een while()-lus over de resultaten. -->
	<?php while( $entry = mysql_fetch_array($beschikbare_plaatsen, MYSQL_ASSOC) ) { ?>
	<tr>
 		<td><?php echo $entry['Vlucht_Nr']; ?></td>
		<td><?php echo $entry['luchthaven_herkomst']; ?></td>
		<td><?php echo $entry['luchthaven_bestemming']; ?></td>
		<td><?php echo $entry['Luchtvaartmaatschappij_ID']; ?></td>
		<td><?php echo $entry['Klasse']; ?></td>
		<td><?php echo $entry['aantal_vrije_zitplaatsen']; ?></td>
		<td>
			<form action="boeking_uitvoer.php">
				<input type="hidden" name="Klant_ID" value="<?php echo gebruikersInvoer('Klant_ID'); ?>">
				<input type="hidden" name="Reisbureau_ID" value="<?php echo $_SESSION['Reisbureau_ID']; ?>">
				<input type="hidden" name="Zitplaats_Nr" value="<?php echo $entry['Zitplaats_Nr']; ?>">
				<input type="hidden" name="Luchtvaartmaatschappij_ID" value="<?php echo $entry['Luchtvaartmaatschappij_ID']; ?>">
				<input type="hidden" name="Vlucht_Nr" value="<?php echo $entry['Vlucht_Nr']; ?>">
				<input type="submit" value="Selecteer">
			</form>
		</td>
	</tr>
	<?php } ?>
</table>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>