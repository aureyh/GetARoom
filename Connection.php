
<?php  error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mainDB";
$connection = new mysqli($servername, $username, $password, $dbname); #makes connection
$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p> Fatal Error. Unable to connect to database!</p>";
  exit();
}
 ?>
