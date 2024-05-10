<?php
session_start();

$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "Users"; // the name of the database that you are going to use for this project
$dbuser = "root"; // the username that you created, or were given, to access your database
$dbpass = ""; // the password that you created, or were given, to access your database

    // kobler opp mot databasen med server, brukernavn, passord og databasenavn
	$db = mysqli_connect($dbhost,$dbname,$dbuser,$dbpass);

	if (mysqli_connect_errno()) {
      die(mysqli_connect_error());
	}

//mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
//mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
?>
