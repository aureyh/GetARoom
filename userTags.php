<?php

try{
  session_start();
  $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mainDB";
  $connection = new mysqli($servername, $username, $password, $dbname); #makes connection
  $error = mysqli_connect_error();
	if($error != null)
	{
	  $output = "<p>Unable to connect to database!</p>";
	  exit();
	}

if(!isset($_SERVER['HTTP_REFERER'])){
  header("REFRESH:0;url=HomePage");
} elseif($_SERVER['HTTP_REFERER']) != 'http://localhost/GetARoom/counterButton') {
  header("REFRESH:0;url=HomePage");
}

if(!isset($_POST['groupCheck']) && !isset($_POST['quietCheck'] && !isset($_POST['privateCheck'])){
  $url = $_SERVER['HTTP_REFERER'];
  echo "Incomplete form.";
  header("REFRESH:3;url=$url");
}
if(isset($_POST['groupCheck']){$groupCheck = $_POST['groupCheck'] -1;} else {$groupCheck = 0; }
if(isset($_POST['quietCheck']){$quietCheck = $_POST['quietCheck'];} else {$quietCheck = null; }
if(isset($_POST['privateCheck']){$privateCheck = $_POST['privateCheck'];} else {$privateCheck = null; }
if(isset($_SESSION['user'])){$user = $_SESSION['user'];} else {$user = null;}
$sql = "INSERT INTO roomschedule (clientcount,room,user,starttime,endtime)VALUES ($groupCheck, $room,$user,NOW(),TIMESTAMPADD(HOUR,1,NOW()))";
if ($connection2->query($sql2) === TRUE) {
 echo"Room Booked. Returning to Home.";
 header("REFRESH:3;url=HomePage");
} else{
  exit("Something is horribly wrong.<br> <a href = 'HomePage'>Please play again</a>")
}
}
catch(Exception $e){
  exit("<a href = 'HomePage'>Unknown Error</a>");
} finally{
  $connection -> close();
}
 ?>
