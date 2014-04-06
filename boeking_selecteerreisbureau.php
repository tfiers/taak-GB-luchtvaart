<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Een vlucht boeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
?>

<!-- Dit is het formulier om de klant in te geven: -->
<form action="boeking_selecteerklant.php">
<!-- Voeg hier je code toe -->
<em>Reisbureau:</em>
<select name="reisbureau">
<?php
	$query = "SELECT * FROM Reisbureau";
	$resultaat = mysql_query($query) or die("Kan de lijst van klanten niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_assoc($resultaat)) {
		$adres = implode(" ", array_values($rij));
		echo "<option value=\"".$rij['Reisbureau_ID']."\">".$adres."</option>";
	}
?>
</select>
<input type="submit" value="Selecteer" />
</form>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>