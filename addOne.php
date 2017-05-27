<?php

//initialize
if (session_status() == 'PHP_SESSION_NONE') { session_start();}
require("Connection.php");
error_reporting(0);
if(isset($_GET['name'])){$room = $_GET['name'];} // REQUIRED
else { echo "fatal error"; $room = 'notaname'; die(); }

//Find VALUES
$groupCheck = 1;
if(isset($_POST['quietCheck'])){$quietCheck = $_POST['quietCheck'];} else {$quietCheck = ""; }
if(isset($_POST['privateCheck'])){$privateCheck = $_POST['privateCheck'];} else {$privateCheck = ""; }
if(isset($_SESSION['user'])){$user = $_SESSION['user'];} else {$user = null;}
$sticky = $quietCheck.'^'.$privateCheck; //can later explode database element with ^
if(isset($_GET['count'])){$newcount = $_GET['count'] + 1;}else{$newcount = 1;}
//Register to Room
$register = "INSERT INTO roomschedule (starttime, endtime, user, clientcount, room,stickies) VALUES (NOW(), timestampadd(HOUR, 1, NOW()),'$user',$newcount, '$room','$sticky')";
if ($connection->query($register) === TRUE) { echo "true"; echo "$newcount <button id = $room value = $newcount class='ui-btn ui-btn-inline'>+1</button>";} else {echo "false";$newcount = $newcount -1; echo "$newcount  <button class='ui-btn ui-btn-inline'>+1</button>";}

?>
