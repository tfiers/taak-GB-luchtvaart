<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Vluchtinformatie opzoeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");
?>

<form action="zoekopaantalstops.php">
<em>Aantal stops:</em><br />
<input type="text" name="aantalstops" length="2"/><br />
<input type="submit"/>
</form>
<br />
<form action="zoekopvertrektijd.php">
<em>Vertrekdatum (vb: "2009-11-23"):</em><br />
<input type="text" name="datum"/><br />
<input type="submit" label="Zoek"/>
</form>
<br />
<form action="zoekopoorsprong.php">
<em>Naam luchthaven van vertrek:</em><br />
<input type="text" name="oorsprong"/><br />
<input type="submit"/>
</form>
<br />

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>