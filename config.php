<html>
<head>
  <meta charset="utf-8">
  <title>MHS Login</title>
</head>
  <body>
    <?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mydb');

$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
/* Attempt to connect to MySQL database */

// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
    ?>
</body>
</html>
