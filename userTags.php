Processing...
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
  header("REFRESH:0;url=HomePage.php");
} elseif($_SERVER['HTTP_REFERER']) != 'http://localhost/GetARoom/counterButton') {
  header("REFRESH:0;url=HomePage.php");
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
if ($connection->query($sql) === TRUE) {
 echo"<br>Room Booked. Returning to Home.";
 $sql2 = "UPDATE rooms, roomschedule SET rooms.Count =
 (Select Sum(roomschedule.clientcount) From roomschedule where rooms.name = roomschedule.room)";
 if($conn->query($sql2) ===false){
   echo "<br>Error with insert" . $conn->error;
 }
 header("REFRESH:3;url=HomePage");
} else{
  exit("<br>Something is horribly wrong.<br> <a href = 'HomePage'>Please play again</a>")
}
}
catch(Exception $e){
  exit("<br><a href = 'HomePage'>Unknown Error Occured</a>");
} finally{
  $connection -> close();
}
 ?>
