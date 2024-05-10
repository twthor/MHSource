<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MHS Sign up</title>
<link rel="stylesheet" href="CSS/MHW.css">
</head>
<body>
  <?php include "config.php" ?>
  <?php
  if(!empty($_POST['username']) && !empty($_POST['password']))
  {
      $username = mysqli_real_escape_string($db, $_POST['username']);
      $password = md5(mysqli_real_escape_string($db, $_POST['password']));

      $checkusername = mysqli_query($db, "SELECT * FROM Users WHERE username = '".$username."'");

     if(mysqli_num_rows($checkusername) == 1)
       {
          echo "<h1>Error</h1>";
          echo "<p>Username busy, try a new one.</p>";
       }
       else
       {
         $idquery = mysqli_query($db, "SELECT MAX(id) FROM Users");
         $idpluss = mysqli_fetch_array($idquery);
         $newid = $idpluss[0] +1;
          $signup = mysqli_query($db, "INSERT INTO Users (id, username, password) VALUES('".$newid."', '".$username."', '".$password."')");
          if($signup)
          {
              echo "<h1>Sucsess!</h1>";
              echo "<p>Your account was sucsessfully made. Please <a href=\"Login.php\">login</a>.</p>";
          }
          else
          {
              echo "<h1>Error</h1>";
              echo "<p>Register failed. Try again.</p>";
          }
       }
  }
?>

   <h1>Sign up</h1>

   <p>Fill in the following:</p>

    <form method="post" action="Registrering.php" name="signup" id="signup">
    <fieldset>
        <label for="username">Username:</label><input type="text" name="username" id="usename" /><br />
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br />
        <input type="submit" name="registrering" id="registrering" value="Submit" />
    </fieldset>
    </form>
</body>

</html>
