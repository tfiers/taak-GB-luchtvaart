<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Stel een nieuw adres in';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

// Implementeer je code hier.
$naam = explode(",", gebruikersInvoer('naam'));
mysql_query("UPDATE klant SET Straat='".gebruikersInvoer('straat')."', Nummer=".gebruikersInvoer('nummer')." ".
			"WHERE Voornaam='".$naam[0]."' and Familienaam='".$naam[1]."';")
	or die("Database fout: ".mysql_error());
?>

owkidowki

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>
