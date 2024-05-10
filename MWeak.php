<html>
	<head>
		<title>Monster Hunter Source</title>
		<meta charset="UTF-8">
		<link rel="Stylesheet" href="CSS/MHW.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
		<body>
		<div class="topnav" align="right">
			<a class="active" href="Login.php">Login</a>
		</div>
		<div class="topnav">
		<a class="active" href="MHWM.php">Home</a>
		</div>
			<h1>Monster Weaknesses</h1>
			<h3>Elements</h3>
			<?php
			include 'database.php';

			$resultat = mysqli_query($kobling,"SELECT * from Elements Order by idElements");
			if (!$resultat) echo "<b>FEIL: ikke i stand til å sende.</b>";
			$element = array();
			$element = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
			?>

			<?php
			//TABLE-STYLE
			echo '<style>
				table, th, td {
    		border: 1px solid black;
				}
				</style>';
			//TABLE-STYLE-END
		echo '<table> <tr>
		<th>ID</th>
		<th>Element</th>
		</tr>';
	foreach ($element as $rad) {
		echo '<tr>'.
		'<td>'.$rad['idElements'].'</td>'.
		'<td>'.$rad['Weakness'].'</td>'.
		'</tr>';
	}
	echo '</table>';
	?>
<br/>
<h2>Search for a monster</h2>

	<?php
	   $con=mysqli_connect("localhost", "root", "","mydb") or die("Error connecting to database: ".mysql_error());
	   /*
	       localhost - it's location of the mysql server, usually localhost
	       root - your username
	       third is your password

	       if connection fails it will stop loading the page and display an error
	   */

	   mysqli_select_db($con,"mydb") or die(mysql_error());
	   /* tutorial_search is the name of database we've created */

	?>


	<form action="MWeak.php" method="GET">
	<input type="text" name="query" />
	<input type="submit" value="Search" />
</form>


<?php
if (isset($_GET['query'])) {
$query = $_GET['query'];


$min_length = 3;
// you can set minimum length of the query if you want

if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

		$query = htmlspecialchars($query);
		// changes characters used in html to their equivalents, for example: < to &gt;

		$query = mysqli_real_escape_string($con,$query);
		// makes sure nobody uses SQL injection

		$raw_results = mysqli_query($con,"SELECT Monster.Navn, Elements.Weakness, DamageChart.idDamageChart, DamageChart.One_Star,
		DamageChart.Two_Stars, DamageChart.Three_Stars
		FROM DamageChart
		Join Monster On idMonster = Monster_idMonster
		Join Elements On Elements_idElements = idElements
		WHERE (`navn` LIKE '%".$query."%')") or die(mysql_error());

		// Her skriver jeg scripten som velger ut den informasjonen jeg vil ha fra databasen
		// articles is the name of our table

		// '%$query%' is what we're looking for, % means anything, for example if $query is Hello
		// it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
		// or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'

		if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
			echo '<table> <tr>
			<th>Name</th>
			<th>Weakness</th>
			<th>1 Star</th>
			<th>2 Stars</th>
			<th>3 Stars</th>
			</tr>';
				while($results = mysqli_fetch_array($raw_results)){
				// $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop

						echo '<tr><td>'.$results['Navn'].'</td>'.
						'<td>'.$results['Weakness'].'</td>'.
						'<td>'.$results['One_Star'].'</td>'.
						'<td>'.$results['Two_Stars'].'</td>'.
						'<td>'.$results['Three_Stars'].'</td>'.
						'</tr>';
						// Her kommer informasjonen som er hentet ut over i en tabell. Først står overskriften på alle kolonnene, så kommer informasjonen.
				}
				echo "</table>";
}
		else { // if there is no matching rows do following
				echo "No results";
		}

}
else { // if query length is less than minimum
		echo "Minimum length is ".$min_length;
}
}
?>
<?php
include 'database.php';
$resultat = mysqli_query($kobling,"SELECT Monster.Navn, Elements.Weakness, DamageChart.idDamageChart, DamageChart.One_Star, DamageChart.Two_Stars, DamageChart.Three_Stars
From DamageChart
Join Monster On idMonster = Monster_idMonster
Join Elements On idElements = Elements_idElements");


$Monsters = array();
$Monsters = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
?>



<h2>Insert a new monster to the database</h2>

<?php
if(isset($_GET["Insert"])){
	$statusMessage = $_GET["Insert"];
	if($statusMessage == "success"){
		echo "<p>Success!
		<br/>
		The new monster is added to the database.
		</p>";
	}
	elseif ($statusMessage == "failure"){
			echo "<p>Insert failed</p>";
		}
}
?>

<form action="Insert.php" method="POST">
	The name of the new monster: <input type="text" name="Navn">
	<br>
	<h4>Weakness:</h4>
	Fire:
	<select name="3" >
    <option value="0">No weakness</option>
    <option value="1">1-star</option>
    <option value="2">2-star</option>
    <option value="3">3-star</option>
  </select>
	<br>
	Thunder:
	<select name="1" >
    <option value="0">No weakness</option>
    <option value="1">1-star</option>
    <option value="2">2-star</option>
    <option value="3">3-star</option>
  </select>
	<br>
	Ice:
	<select name="5" >
    <option value="0">No weakness</option>
    <option value="1">1-star</option>
    <option value="2">2-star</option>
    <option value="3">3-star</option>
  </select>
	<br>
	Water:
	<select name="2" >
    <option value="0">No weakness</option>
    <option value="1">1-star</option>
    <option value="2">2-star</option>
    <option value="3">3-star</option>
  </select>
	<br>
	Dragon:
	<select name="4" >
    <option value="0">No weakness</option>
    <option value="1">1-star</option>
    <option value="2">2-star</option>
    <option value="3">3-star</option>
  </select>
	<br>

	<input type="submit" value="Send in">
</form>



		</body>
</html>
