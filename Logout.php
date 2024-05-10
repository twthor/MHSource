<html>
  <head>
    <title>Logout</title>
  </head>
  <?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: Login.php");
exit;
?>
PREVIOUS PAGENEXT PAGE
Free Bootstrap Snippets and templates
</html>
