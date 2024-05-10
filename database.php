 <?php
	// kobler opp mot databasen med tjener, brukernavn, passord og database
	// Disse kan evt. definerast som variable.
	// Returnerer linken $kobling som skal brukast i spørringer.
	$kobling = mysqli_connect("localhost","root","","mydb");

	// Testar om oppkoblingen gjekk greit. Hvis ikkje stoppar vi. (die!)
	if (!$kobling) {
    die("Tilkobling mislukkast: " . mysqli_connect_error());
}
 ?>
