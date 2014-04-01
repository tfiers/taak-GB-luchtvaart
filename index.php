<?php
	// Voer de inhoud van "database.inc" uit. Dit is PHP-code
	// die de verbinding met de database aangaat.
	require('database.inc');

	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Luchtvaart database";

	// Voer de inhoud van "top.inc" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("top.inc");
?>

<p>Winnend lot:</p>
<?php print rand(1, 20); ?>
<p>U mag uw prijs komen ophalen in /prijs</p>

<?php
// Voer de inhoud van "bottom.inc" uit. Dit sluit de pagina af
// en verbreekt de verbinding met de database.
require("bottom.inc");
?>