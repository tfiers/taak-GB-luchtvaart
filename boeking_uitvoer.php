<?php
	// Dit commando zorgt voor de verbinding met de database.
	require('database.inc');
	
	// De titel van de pagina, die bovenaan en in de menu-balk verschijnt.
	$title = 'Een vlucht boeken';
	
	// Dit commando zorgt voor de initialisatie van de pagina en
	// het weergeven van het menu.
	require("top.inc");

	$fields = ["Klant_ID",
		   	   "Reisbureau_ID",
		   	   "Zitplaats_Nr",
		   	   "Luchtvaartmaatschappij_ID",
		   	   "Vlucht_Nr"];
	$data = array_map("gebruikersInvoer", $fields);
	$dict = array_combine($fields, $data);

	mysql_query("INSERT INTO wordtgeboektdoor
				 VALUES (".implode(", ", $data).");")
	or die("Kan niet boeken: ".mysql_error());
?>

<p>Vlucht geboekt!</p>
<p>
Prijs van deze vlucht: 
<strong>€
<?php
echo array_sum(
		array_map("intval",
			mysql_fetch_row(
				mysql_query(
					 "SELECT klasse.Prijs, LHerkomst.Tax, LBestemming.Tax
					  FROM luchthaven AS LHerkomst, luchthaven AS LBestemming, klasse, zitplaats, vlucht
					  WHERE Zitplaats_Nr = '".$dict["Zitplaats_Nr"]."'
					  		AND klasse.Type = zitplaats.Klasse
					  		AND vlucht.Vlucht_Nr = '".$dict["Vlucht_Nr"]."'
					  		AND vlucht.LuchthavenVanHerkomst = LHerkomst.Luchthaven_ID
					  		AND vlucht.LuchthavenVanBestemming = LBestemming.Luchthaven_ID
					 "))));
?>
</strong>
</p>

<?php
// Dit sluit de verbinding met de gegevensbank en de pagina af.
require("bottom.inc");
?>