<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Een vlucht boeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

	$_SESSION['Reisbureau_ID'] = gebruikersInvoer('reisbureau');
?>

<!-- Dit moet het formulier worden om de vlucht in te geven: -->
<form action="boeking_selecteervlucht.php">

<!-- Voeg hier je code toe. -->
<em>Klant:</em>
<select name="Klant_ID">
<?php
	$query = "SELECT Klant_ID, Voornaam, Familienaam FROM Klant";
	$resultaat = mysql_query($query) or die("Kan de lijst van klanten niet opvragen: " . mysql_error());
	while($rij = mysql_fetch_array($resultaat)) {
		echo "<option value=\"".$rij['Klant_ID']."\">".$rij['Voornaam'].' '.$rij['Familienaam']."</option>";
	}
?>
</select>
<input type="submit" value="Selecteer"/>
</form>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>