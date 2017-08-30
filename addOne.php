<?php

//initialize
if (session_status() == 'PHP_SESSION_NONE') { session_start();}
require("Connection.php");
error_reporting(0);
if(isset($_GET['name']) && isset($_GET['sticky'])){$room = $_GET['name']; $sticky = $_GET['sticky'];} // REQUIRED
else { //echo "fatal error";
     echo json_encode(array("user"=>$user,"room"=>$room,"sticky"=>$sticky,"count"=>"error","newsticky"=>"0"));
     die(); }

//Find VALUES
//if(isset($_POST['quietCheck'])){$quietCheck = $_POST['quietCheck'];} else {$quietCheck = ""; }
//if(isset($_POST['privateCheck'])){$privateCheck = $_POST['privateCheck'];} else {$privateCheck = ""; }
if(isset($_SESSION['user'])){$user = $_SESSION['user'];} else {$user = 'anonymous';}
//$sticky = $quietCheck.'^'.$privateCheck; //can later explode database element with ^
//if(isset($_GET['count'])){$newcount = $_GET['count'] + 1;}else{$newcount = 1;}
//Register to Room

$register = "INSERT INTO roomschedule (starttime, endtime, user, clientcount, room,stickies) VALUES (NOW(), timestampadd(HOUR, 1, NOW()), ?, 1, ?, ?)";
try{
$ps = $connection->prepare($register);
$ps->bind_param("ssd",$user,$room,$sticky);
$ps->execute();
} catch(Exception $e) {
  echo json_encode(array("user"=>$user,"room"=>$room,"sticky"=>$sticky,"count"=>"error","newsticky"=>"0"));
  $ps->close();
  $connection->close();
  die();
} finally{
  $ps->close();
  $connection->close();
}

$connection2 = new mysqli($servername, $username, $password, $dbname);
$newcount;
$newsticky;
try{$update_client = "SELECT DISTINCT stickies,Count FROM rooms WHERE name LIKE ?";
$ps2 = $connection2 -> prepare($update_client);
$ps2->bind_param("s",$room);
$ps2->execute();
$ps2->bind_result($newsticky,$newcount);
if($ps2-> fetch()){echo json_encode(array("user"=>$user,"room"=>$room,"sticky"=>$sticky,"count"=>$newcount,"newsticky"=>$newsticky));}
else{echo json_encode(array("error"=>"Couldn't retrieve from database","user"=>$user,"room"=>$room,"sticky"=>$sticky,"count"=>0,"newsticky"=>0));}

}
catch(Exception $e) {
  echo json_encode(array("user"=>$user,"room"=>$room,"sticky"=>$sticky,"count"=>"error","newsticky"=>"0"));
}finally {
  $ps2->close();
  $connection2->close();
}
?>
