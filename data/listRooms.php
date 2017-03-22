<!DOCTYPE html>

<html>
<head>
  <!--might allow for better scaling for mobile.-->
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>GetARoom</title>
  <!-- Custom theme made from ThemeRoller-->
  <link rel="stylesheet" href="themes/FirstTheme.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />

<!-- Install Jqery mobile to site-->
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
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
<li><a href="#info" data-icon="grid">Info</a></li>
</ul>
</div>


</div>

<div data-role="main" class="ui-content">
  <h1>Get A Room: Search Results</h1>
<?php
/*  $sql = "CREATE TABLE ROOMS(
  name VARCHAR(20) PRIMARY KEY,
  capacity INT(3),
  features VARCHAR(100),
  type VARCHAR(15)
  )";
*/
	include 'COSC310.php';
	include 'ClassInfo_Functions.php';
	/*select * from bookings where date = $_GET["date"] and location
	//IS LIKE "$_GET["building"]%" and $_GET["start"] < startTime
	or $_GET["end"] > endTime
	date is in 2017-03-21 format
	*/
	/*
	website stack help

Here's how to do it for the current time:

$day=strftime("%A",time());

Or for a specific date:

$day=strftime("%A",strtotime("2011-05-19"));

*/
	function returnList_start( $start, $date, $building, $type, $connection){
		$stamp = new DateTime($date);
		$strstamp = explode("-",$str,4);
		if($strstamp[1] <= 8 or ( $strstamp[1] == 8  and $strstamp[2] < 22)){$initdate = $strstamp[0]-1;}else{$initdate = $strstamp[0];}
		$initdate = "$initdate-08-022";
		$NUMBER_OF_DAYS = dateDifference($initdate, $stamp, '%a');
		$NUMBER_OF_WEEKS =1 + ($NUMBER_OF_DAYS - $NUMBER_OF_DAYS%7)/7
		$DAY_NAME=strftime("%A",strtotime($date));
		$DAY_NUM=convertDayToNum($DAY_NAME);
		$VALID_DATE = "$NUMBER_OF_WEEKS.$DAY_NUM";
		$startTIME = "";
		$strSTART = explode(":",$start,2);
		if(strpos($strEND[1] > 30){
				$startTIME = $strEND[0].".5";
			}else{
				$startTIME = $strEND[0];
			}
		if(empty($building) and !empty($type)){
			$bulding = "any"
			$sql = "SELECT DISTINCT location FROM BOOKINGS WHERE dates = ? and  startTime -0.5 > ? or endTime < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddd", $VALID_DATE,$startTIME,$startTIME);
			$ps->execute();
			return $ps;
		}
		elseif(empty($building) and empty($type)){
			$building = "any";
			$type = "any";
			$sql = "SELECT DISTINCT location FROM BOOKINGS WHERE dates = ? and  startTime -0.5 > ? or endTime  < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddd", $VALID_DATE,$startTIME,$startTIME);
			$ps->execute();
			return $ps;
		}
		elseif(!empty($building) and empty($type)){
			$type = "any";
			$sql = "SELECT DISTINCT location FROM BOOKINGS WHERE dates = ? and location IS LIKE '?%' startTime -0.5 > ? or endTime < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("dsdd", $VALID_DATE,$building,$startTIME,$startTIME);
			$ps->execute();
			return $ps;
		}
	}
	function returnList_end($end, $date, $building, $type,$connection){
		$stamp = new DateTime($date);
		$strstamp = explode("-",$str,4);
		if($strstamp[1] <= 8 or ( $strstamp[1] == 8  and $strstamp[2] < 22)){$initdate = $strstamp[0]-1;}else{$initdate = $strstamp[0];}
		$initdate = "$initdate-08-022";
		$NUMBER_OF_DAYS = dateDifference($initdate, $stamp, '%a');
		$NUMBER_OF_WEEKS =1 + ($NUMBER_OF_DAYS - $NUMBER_OF_DAYS%7)/7
		$DAY_NAME=strftime("%A",strtotime($date));
		$DAY_NUM=convertDayToNum($DAY_NAME);
		$VALID_DATE = "$NUMBER_OF_WEEKS.$DAY_NUM";
		$endTIME = "";
		$strEND = explode(":",$end,2);
			if(strpos($strEND[1] > 30){
				$endTIME = $strEND[0].".5";
			}else{
				$endTIME = $strEND[0];
			}
		if(empty($building) and !empty($type)){
			$bulding = "any"
			$sql = "SELECT DISTINCT location FROM BOOKINGS WHERE dates = ? and  startTime -0.5 > ? or endTime < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddd", $VALID_DATE,$endTIME,$endTIME);
			$ps->execute();
			return $ps;
		}
		elseif(empty($building) and empty($type)){
			$building = "any";
			$type = "any";
			$sql = "SELECT DISTINCT location FROM BOOKINGS WHERE dates = ? and  startTime -0.5 > ? or endTime < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddd", $VALID_DATE,$endTIME,$endTIME);
			$ps->execute();
			return $ps;
		}
		elseif(!empty($building) and empty($type)){
			$type = "any";
			$sql = "SELECT DISTINCT location FROM BOOKINGS WHERE dates = ? and location IS LIKE '?%' startTime -0.5 > ? or endTime < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("dsdd", $VALID_DATE,$building,$endTIME,$endTIME);
			$ps->execute();
			return $ps;
		}
	}
	function returnList_both($start, $end, $date, $building, $type,$connection){
		$stamp = new DateTime($date);
		$strstamp = explode("-",$str,4);
		if($strstamp[1] <= 8 or ( $strstamp[1] == 8  and $strstamp[2] < 22)){$initdate = $strstamp[0]-1;}else{$initdate = $strstamp[0];}
		$initdate = "$initdate-08-022";
		$NUMBER_OF_DAYS = dateDifference($initdate, $stamp, '%a');
		$NUMBER_OF_WEEKS =1 + ($NUMBER_OF_DAYS - $NUMBER_OF_DAYS%7)/7
		$DAY_NAME=strftime("%A",strtotime($date));
		$DAY_NUM=convertDayToNum($DAY_NAME);
		$VALID_DATE = "$NUMBER_OF_WEEKS.$DAY_NUM";
		$startTIME = "";
		$endTIME = "";
		$strSTART = explode(":",$start,2);
		if(strpos($strEND[1] > 30){
				$endTIME = $strEND[0].".5";
			}else{
				$endTIME = $strEND[0];
			}
			$strEND = explode(":",$end,2);
			if(strpos($strEND[1] > 30){
				$endTIME = $strEND[0].".5";
			}else{
				$endTIME = $strEND[0];
			}
		if(empty($building) and !empty($type)){
			$bulding = "any"
			$sql = "SELECT DISTINCT location FROM BOOKINGS where dates = ? and  startTime -0.5 > ? or endTime + 0.5 < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddd", $VALID_DATE,$startTIME,$endTIME);
			$ps->execute();
			return $ps;

		}
		elseif(empty($building) and empty($type)){
			$building = "any";
			$type = "any";
			$sql = "SELECT DISTINCT location FROM BOOKINGS where dates = ? and  startTime -0.5 > ? or endTime + 0.5 < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddd", $VALID_DATE,$startTIME,$endTIME);
			$ps->execute();
			return $ps;
		}
		elseif(!empty($building) and empty($type)){
			$type = "any";
			$sql = "SELECT DISTINCT location FROM BOOKINGS where dates = ? and location IS LIKE '?%' and  startTime -0.5 > ? or endTime + 0.5 < ?";
			$ps = $connection->prepare($sql);
			$ps->bind_param("dsdd", $VALID_DATE,$building,$startTIME,$endTIME);
			$ps->execute();
			return $ps;
		}
	}
	//Change username and password as needed.
	//initializing relevant variables below.
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mainDB";
	$start = $_GET["start"]; //start and end are in 10:50 sort of format
	$end = $_GET["end"];
	$date = $_GET["date"]; //date is in 2017-03-21
	$building = $_GET["building"]; //building is just FIPKE EME etc. or all
	$type = $_GET["type"]; //any, Computer labs or Class Rooms
  error_reporting(E_ALL);
  ini_set('display_errors','1');
  include_once('ValidationResult.class.php');
  $startvalid = new ValidationResult("","","",true);
  $endvalid = new ValidationResult("","","",true);
  $datevalid = new ValidationResult("","","",true);
  $startvalid = ValidationResult::checkParameter("start",'^\d{2}[:]\d{2}$','Enter a valid Start Time [PHP]');
  $endvalid = ValidationResult::checkParameter("start",'^\d{2}[:]\d{2}$','Enter a valid Start Time [PHP]');
  $datevalid = ValidationResult::checkParameter("start",'^[2][0]\d{2}-[1-12]-[1-32]$','Enter a valid Start Time [PHP]');
  if($startvalid -> isValid() && $endvalid -> isValid() && $datevalid -> isValid()) {
	//start of real code here.
	$connection = new mysqli($host, $user, $password, $database);
	$error = mysqli_connect_error();
	if((empty($start) and empty($end)) or empty($date)) {
	exit("Incomplete Form. A start time or end time, and date are required.
	<br>
	<br>
	<a href = '../HomePage.php')Return</a>");
	}else{
	if($error != null)
	{
	  $output = "<p>Unable to connect to database!</p>";
	  exit($output);
	}
	else //main getlist function here.
	{
		if(empty($start){
					 $results = returnList_start( $start, $date, $building, $type){
					$results -> bind_result($location);
					while($results -> fetch()){
						  echo "
						<p>Room: ".$location."</p></br></br>";
					}

		}
		}
		elseif(empty($end){
					$results = returnList_end( $end, $date, $building, $type){
					$results -> bind_result($location);
					while($results -> fetch()){
						  echo "
						<p>Room: ".$location."</p></br></br>";
		 }
		}
		}
		else{
					$results = returnList_both( $start, $end, $date, $building, $type){
					$results -> bind_result($location);
					while($results -> fetch()){
						  echo "
						<p>Room: ".$location."</p></br></br>";
					}
		 }
		}
	}
}

?>
</body>
</html>
