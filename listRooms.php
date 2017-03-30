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

	//include 'COSC310.php';
	//include 'ClassInfo_Functions.php';

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

function dateDifference($datetime1 , $datetime2 , $differenceFormat)
{
  $interval = date_diff($datetime1, $datetime2);

  return $interval->format($differenceFormat);

} #credit goes to http://php.net/manual/en/function.date-diff.php. i am familiar with the code, but this will make it easier.
function convertDayToNum($str){
  switch($str){
    case "Mon":
    return 1;
    case "Tue":
    return 2;
    case "Wed":
    return 3;
    case "Thu":
    return 4;
    case "Fri":
    return 5;
    case "Sat":
    return 6;
    case "Sun":
    return 7;
    default:
    return FALSE;

  }
}
	function returnList_start( $start, $date, $building, $type, $connection){
    //echo $date;
		$stamp = new DateTime($date);
		$strstamp = explode("-",$date,4);
		if($strstamp[1] <= 8 xor ( $strstamp[1] == 8  and $strstamp[2] < 22)){$initdate = $strstamp[0]-1;}else{$initdate = $strstamp[0];}
    //echo "<br> $initdate";
		$initdate = new DateTime("$initdate-08-22");
		$NUMBER_OF_DAYS = dateDifference($initdate, $stamp, '%a');
		$NUMBER_OF_WEEKS =1 + ($NUMBER_OF_DAYS - $NUMBER_OF_DAYS%7)/7;
		$DAY_NAME=strftime("%A",strtotime($date));
		$DAY_NUM=convertDayToNum(substr($DAY_NAME,0,3));
		$VALID_DATE = "$NUMBER_OF_WEEKS.$DAY_NUM";
    //echo $VALID_DATE;
		$startTIME = "";
		$strSTART = explode(":",$start,3);
		if($strSTART[1] > 30){
				$startTIME = $strSTART[0].".5";
			}else{
				$startTIME = $strSTART[0];
			}
      //var_dump($startTIME);
		if($building === "all"){


			$sql = "SELECT DISTINCT name FROM rooms WHERE name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  (startTime <= ? and endTime >= ?)) and ignores is FALSE ";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddd", $VALID_DATE,$startTIME,$startTIME);
			$ps->execute();
      //echo "$startTIME";
      //          echo "$VALID_DATE";
			return $ps;

		} elseif ($building !== "all"){
      $building = "$building%";
			$sql = "SELECT DISTINCT name FROM rooms WHERE name LIKE ?  and ignores is FALSE and name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  (startTime - 0.5 < ? and endTime > ?))";
			$ps = $connection->prepare($sql);
			$ps->bind_param("sddd",$building,$VALID_DATE,$startTIME,$startTIME);
			$ps->execute();
			return $ps;
    }
	}
	function returnList_end($end, $date, $building, $type,$connection){
    //echo $date;
    $stamp = new DateTime($date);
    $strstamp = explode("-",$date,4);
    if($strstamp[1] <= 8 xor ( $strstamp[1] == 8  and $strstamp[2] < 22)){$initdate = $strstamp[0]-1;}else{$initdate = $strstamp[0];}
    //echo "<br> $initdate";
    $initdate = new DateTime("$initdate-08-22");
    $NUMBER_OF_DAYS = dateDifference($initdate, $stamp, '%a');
    $NUMBER_OF_WEEKS =1 + ($NUMBER_OF_DAYS - $NUMBER_OF_DAYS%7)/7;
    $DAY_NAME=strftime("%A",strtotime($date));
    $DAY_NUM=convertDayToNum(substr($DAY_NAME,0,3));
    $VALID_DATE = "$NUMBER_OF_WEEKS.$DAY_NUM";
    //echo $VALID_DATE;
		$endTIME = "";

    //echo "end";
		$strEND = explode(":",$end,3);
			if($strEND[1] > 30){

				$endTIME = $strEND[0].".5";
			}else{
				$endTIME = $strEND[0];
			}

      if($building === "all"){
			$sql = "SELECT DISTINCT name FROM rooms WHERE name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  (startTime <= ? and endTime >= ?)) and ignores is FALSE";
  			$ps = $connection->prepare($sql);
  			$ps->bind_param("ddd", $VALID_DATE,$endTIME,$endTIME);
  			$ps->execute();
          //    echo "$endTIME";
          //          echo "$VALID_DATE";
  			return $ps;
  		} elseif ($building !== "all"){
        $building = "$building%";
        $sql = "SELECT DISTINCT name FROM rooms WHERE name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  (startTime - 0.5 < ? and endTime > ?)) and name LIKE ? and ignores is FALSE";
  			$ps = $connection->prepare($sql);
  			$ps->bind_param("sddd",$building, $VALID_DATE,$endTIME,$endTIME);
  			$ps->execute();
  			return $ps;
      }
	}
	function returnList_both($start, $end, $date, $building, $type,$connection){
    //echo $date;
    $stamp = new DateTime($date);
    $strstamp = explode("-",$date,4);
    if($strstamp[1] <= 8 xor ( $strstamp[1] == 8  and $strstamp[2] < 22)){$initdate = $strstamp[0]-1;}else{$initdate = $strstamp[0];}
    //echo "<br> $initdate";
    $initdate = new DateTime("$initdate-08-22");
    $NUMBER_OF_DAYS = dateDifference($initdate, $stamp, '%a');
    $NUMBER_OF_WEEKS =1 + ($NUMBER_OF_DAYS - $NUMBER_OF_DAYS%7)/7;
    $DAY_NAME=strftime("%A",strtotime($date));
    $DAY_NUM=convertDayToNum(substr($DAY_NAME,0,3));
    $VALID_DATE = "$NUMBER_OF_WEEKS.$DAY_NUM";
    //echo $VALID_DATE;
		$startTIME = "";
		$endTIME = "";
		$strSTART = explode(":",$start,2);

    $strEND = explode(":",$end,2);
		if($strEND[1] > 30){

				$endTIME = $strEND[0].".5";
			}else{
				$endTIME = $strEND[0];
			}
			$strEND = explode(":",$end,2);
			if($strEND[1] > 30){
				$endTIME = $strEND[0].".5";
			}else{
				$endTIME = $strEND[0];
			}
      if($building === "all"){
			$sql = "SELECT DISTINCT name FROM rooms WHERE name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  ((startTime <= ? and ? <= endTime) or (startTime <= ? and ? <= endTime) or (? < startTime and ? > startTime))) and ignores is FALSE ";
  			$ps = $connection->prepare($sql);
  			$ps->bind_param("ddddddd", $VALID_DATE,$startTIME,$startTIME,$endTIME,$endTIME,$startTIME,$endTIME);
  			$ps->execute();
  			return $ps;
  		} elseif ($building !== "all"){
        $building = "$building%";
        $sql = "SELECT DISTINCT name FROM rooms WHERE  name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  ((startTime <= ? and ? <= endTime) or (startTime <= ? and ? <= endTime) or (? < startTime and ? > startTime))) and name LIKE ? and ignores is FALSE";
        $ps = $connection->prepare($sql);
        $ps->bind_param("ddddddds",$VALID_DATE,$startTIME,$startTIME,$endTIME,$endTIME,$startTIME,$endTIME,$building);
  			$ps->execute();
  			return $ps;
      }
	}//startTime <= start <=endTime or startTime <= end <= endTime or (start < startTime and end > startTime)
	//Change username and password as needed.
	//initializing relevant variables below.
  //echo "john";
  try{
    var_dump($_SERVER['HTTP_REFERER']);
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mainDB";
	$start = $_GET["start"]; //start and end are in 10:50 sort of format
	$end = $_GET["end"];
	$date = $_GET["date"]; //date is in 2017-03-21
	$building = $_GET["building"]; //building is just FIPKE EME etc. or all
	$type = $_GET["type"]; //any, Computer labs or Class Rooms
//echo "john";
//  error_reporting(E_ALL);
  //ini_set('display_errors','1');
  //include_once('ValidationResult.class.php');
  if((!empty($start) xor !empty($end)) and !empty($date)){
  if(!empty($start)){
    preg_match_all('/^\d{2}[:]\d{2}$/',$start,$startvalid);
    //var_dump($startvalid);
  }
//  $startvalid = new ValidationResult("","","",true);
    if(!empty($end)){
      preg_match_all('/^\d{2}[:]\d{2}$/',$end,$endvalid);
    }
//  $endvalid = new ValidationResult("","","",true);
      preg_match_all('/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/',$date,$datevalid);
    //  var_dump($startvalid);
      //var_dump($endvalid);
    //  var_dump($datevalid);
//  $datevalid = new ValidationResult("","","",true);
  if(empty($datevalid[0])){
    //echo("duh");
    exit("Incomplete Form. Date Format is Invalid.
    <br><br>Acceptable Format: yyyy-mm-dd
    <p><a href = 'HomePage.php'>Return</a></p>");
  }
  if(isset($startvalid)){if(empty($startvalid[0])){
      //  echo("duh");
      exit("Incomplete Form. Time Format is Invalid.
      <br>
      <p><a href = 'HomePage.php'>Return</a></p>");
    }}
    if(isset($endvalid)){if(empty($endtvalid[0])){
        //  echo("duh");
        exit("Incomplete Form. Time Format is Invalid.
        <br>
        <p><a href = 'HomePage.php'>Return</a></p>");
      }}

//  $endvalid = ValidationResult::checkParameter("start",'^\d{2}[:]\d{2}$','Enter a valid Start Time [PHP]');
//  $datevalid = ValidationResult::checkParameter("start",'^[2][0]\d{2}-[1-12]-[1-32]$','Enter a valid Start Time [PHP]');
  //if($startvalid -> isValid() && $endvalid -> isValid() && $datevalid -> isValid()) {
	//start of real code here.
	$connection = new mysqli($servername, $username, $password, $dbname);
	$error = mysqli_connect_error();

	if($error != null)
	{
	  $output = "<p>Unable to connect to database!</p>";
	  exit($output);
	}
	else //main getlist function here.
	{
    //echo "here i am ";
		if(empty($end)){
					 $results = returnList_start( $start, $date, $building, $type,$connection);
		}elseif(empty($start)){
					$results = returnList_end( $end, $date, $building, $type,$connection);
		} else{
					$results = returnList_both( $start, $end, $date, $building, $type,$connection);
        }
		}
    if($results != null){
      //echo "Results:";
    $results -> bind_result($location);
    while($results -> fetch()){
        echo "
      <p>Room: ".$location."</p>";
    }
    $results -> close();


	}else{
    echo "No Rooms Found.";
  }
} else {
  exit("Incomplete Form. A start time or end time, and date are required.
  <br>
  <p><a href = 'HomePage.php'>Return</a></p>");
}
} catch(Exception $e){
echo "Oops something went wrong.
  <br>
  <p><a href = 'HomePage.php'>Try again?</a></p>";

}finally{
      $connection -> close();
}

//}
?>
</body>
</html>
