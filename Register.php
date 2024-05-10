<html>
<?php
if(!empty($_POST['brukarnavn']) && !empty($_POST['Password']))
{
    $username = mysqli_real_escape_string($db, $_POST['Username']);
    $password = md5(mysqli_real_escape_string($db,$_POST['Password']));

     $checkusername = mysqli_query($db, "SELECT * FROM Users WHERE username = '".$username."'");

     if(mysqli_num_rows($checkusername) == 1)
     {
        echo "<h1>Error</h1>";
        echo "<p>Username busy, try a new one.</p>";
     }
     else
     {
        $registrering = mysqli_query($db, "INSERT INTO Users (username, password) VALUES('".$brukarnavn."', '".$passord."')");
        if($registrering)
        {
            echo "<h1>Suksess</h1>";
            echo "<p>Din bruker er laga. Vennligst <a href=\"index.php\">login</a>.</p>";
        }
        else
        {
            echo "<h1>Error</h1>";
            echo "<p>Register failed. Try again.</p>";
        }
     }
}
else
{
    ?>

   <h1>Registrering av ny brukar</h1>

   <p>Vennligst fyll ut skjemaet.</p>

    <form method="post" action="register.php" name="registerform" id="registerform">
    <fieldset>
        <label for="brukarnavn">Brukarnavn:</label><input type="text" name="brukarnavn" id="brukarnavn" /><br />
        <label for="passord">Passord:</label><input type="password" name="passord" id="passord" /><br />
        <input type="submit" name="register" id="register" value="Registrer" />
    </fieldset>
    </form>

    <?php
}
?>
</html>
