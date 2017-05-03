

<!DOCTYPE html>

<html>
<head><!---->
  <!--might allow for better scaling for mobile.-->
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>GetARoom</title>
  <!-- Custom theme made from ThemeRoller-->
  <link rel="stylesheet" href="themes/FirstTheme.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link href="buttonStyle.css" type="text/css" rel="stylesheet" />
<!-- Install Jqery mobile to site-->
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="jquery-3.2.0.min.js"></script>
<?php //starting session for user verification
if (session_status() == 'PHP_SESSION_NONE') {
    session_start();
}
 ?>

 <style>
 th {
     border-bottom: 1px solid #d6d6d6;
 }
 tr:nth-child(even) {
     background: #262980;
 }
 </style>


</head>
<body>
<!---->
<!-- All pages are within Div tags-->
<div data-role="page" id="home" data-theme="d">
  <div data-role="header">
    <h1>Get A Room</h1>

	<!--Adds nav bar-->
<div data-role="navbar">
<ul>      <!--nav bar links to the info page,uses a grid icon and is called Info-->

<li><a href="HomePage.php" data-icon="home">Home</a></li>

<!--Link to the accounts page from the nav bar-->
<li><a href="Accounts.php" data-icon="user">Sign In</a></li>
</ul>
</div>


</div>

<div data-role="main" class="ui-content" id = "processing">
Processing Request...
</div>
<?php

try{
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

  exit("<script>$('#processing').html('Something is horribly wrong. You tried to submit a duplicate form. <br><br> <a href = HomePage.php>Head home and play again?</a>');</script>");
} else{
  $url = explode("=",$_SERVER['HTTP_REFERER'],10);
  if($url[0] !== 'http://localhost/GetARoom/counterButton.php?room'){
  header("REFRESH:3;url=HomePage.php");
  exit("<script>$('#processing').text('Redirecting. Page not available from wherever you're from.');</script>");
} else {
  $room = $_GET['room'];
}
}
if(!isset($_POST['groupCheck']) && !isset($_POST['quietCheck']) && !isset($_POST['privateCheck'])){
  $url = $_SERVER['HTTP_REFERER'];
  header("REFRESH:3;url=$url=$room");
  exit("<script>$('#processing').text('Incomplete Form. Hold on as we redirect you to the form page.');</script>");
}
if(isset($_POST['groupCheck'])){$groupCheck = $_POST['groupCheck'] -1;} else {$groupCheck = 0; }

if(isset($_POST['quietCheck'])){$quietCheck = $_POST['quietCheck'];} else {$quietCheck = ""; }
if(isset($_POST['privateCheck'])){$privateCheck = $_POST['privateCheck'];} else {$privateCheck = ""; }
if(isset($_SESSION['user'])){$user = $_SESSION['user'];} else {$user = null;}

# -----------EXAMPLE SQL STRING--------------------
# $sql = "INSERT INTO roomschedule (starttime, endtime, user, clientcount, room)
#        VALUES (NOW(), timestampadd(HOUR, 1, NOW()), '$user', 1, '$room')";
#concatenate sticky string ---------------------------

$sticky = $quietCheck.'^'.$privateCheck;

$sql = "INSERT INTO roomschedule (starttime, endtime, user, clientcount, room,stickies) VALUES (NOW(), timestampadd(HOUR, 1, NOW()),'$user',$groupCheck, '$room','$sticky')";
if ($connection->query($sql) === TRUE) {
 /*$sql2 = "UPDATE rooms, roomschedule SET rooms.Count =
 (Select Sum(roomschedule.clientcount) From roomschedule where rooms.name = roomschedule.room)";
 if($conn->query($sql2) ===false){
   echo "<br>Error with insert" . $conn->error;
 }*/
 header("refresh:3;url=HomePage.php");
 exit("<script>$('#processing').text('Room Booked. Returning to Account Page if Registered. Otherwise returning Home. Please wait a moment.');</script>");
} else{
  exit("<script>$('#processing').text('Something is horribly wrong.<br><br> <a href = 'HomePage.php'>Please play again?</a>');</script>");
}
}
catch(Exception $e){
  exit("<br><a href = 'HomePage.php'>Unknown Error Occured</a>");
} finally{
  $connection -> close();
}
 ?>
