
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
<?php //starting session for user verification
session_start();
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

<div data-role="main" class="ui-content">
  <h1>Get A Room: Search Results</h1>

 <table data-role="table" data-mode="columntoggle" class="ui-responsive ui-shadow" id="myTable">
  <thead>
    <tr>

    <th>Room</th>
    <th data-priority="1">Occupancy</th>
    <th data-priority="2">Request Room</th>
    <th data-priority="3">Ratings</th>
  </tr>
</thread>
<tbody>

<?php
#################################### BELOW COMMENT BLOCKS WITH CODE ARE DEPRICATED ##########################################
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
function dateDifference($datetime1 , $datetime2 , $differenceFormat)  #credit goes to http://php.net/manual/en/function.date-diff.php. i am familiar with the code, but this will make it easier.
{
  $interval = date_diff($datetime1, $datetime2);
  return $interval->format($differenceFormat);
}
function convertDayToNum($str){ #used to convert string day to number
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
	function returnList_one_Time( $input_time, $date, $building, $type, $connection){ #When user inputs one time, this code will query database
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
		$input_time_decimal = "";
		$strSTART = explode(":",$input_time,3);
		if($strSTART[1] > 30){
				$input_time_decimal = $strSTART[0].".5";
			}else{
				$input_time_decimal = $strSTART[0];
			}
      //var_dump($startTIME);
    echo "START TIME: $input_time<br>";
		//returns all buildings of all types
		if($building === "all" && $type === "any"){
		  $sql = "SELECT DISTINCT name,Count FROM rooms WHERE name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  (startTime <= ? and endTime >= ?)) and ignores is FALSE ";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddd", $VALID_DATE,$input_time_decimal,$input_time_decimal);
			$ps->execute();
			//echo "$startTIME";
			//echo "$VALID_DATE";
			return $ps;
		//returns specific building of all types
		} elseif ($building !== "all" && $type === "any"){
			$building = "$building%";
			$sql = "SELECT DISTINCT name,Count FROM rooms WHERE name LIKE ?  and ignores is FALSE and name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  (startTime - 0.5 < ? and endTime > ?))";
			$ps = $connection->prepare($sql);
			$ps->bind_param("sddd",$building,$VALID_DATE,$startTIME,$startTIME);
			$ps->execute();
			return $ps;
		//returns all buildings of specific type
		} elseif ($building === "all" && $type !== "any"){
			$type = "$type%";
			$sql = "SELECT DISTINCT name,Count FROM rooms WHERE type LIKE ?  and ignores is FALSE and name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  (startTime - 0.5 < ? and endTime > ?))";
			$ps = $connection->prepare($sql);
			$ps->bind_param("sddd",$type,$VALID_DATE,$startTIME,$startTIME);
			$ps->execute();
			return $ps;
		//returns specific building of specific type
		}elseif ($building !== "all" && $type !== "any"){
			$building = "$building%";
			$type = "$type%";
			$sql = "SELECT DISTINCT name,Count FROM rooms WHERE name LIKE ? and type LIKE ? and ignores is FALSE and name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  (startTime - 0.5 < ? and endTime > ?))";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ssddd",$building,$type,$VALID_DATE,$startTIME,$startTIME);
			$ps->execute();
			return $ps;
		}
	}
	function returnList_both($start, $end, $date, $building, $type,$connection){ #queries database for all rooms not active in this time frame
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
    if($strSTART[1] > 30){
        $startTIME = $strSTART[0].".5";
      }else{
        $startTIME = $strSTART[0];
      }
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
      echo "START TIME: $start<br>END TIME: $end<br>";
      //echo "$endTIME    $startTIME";
      if($endTIME < $startTIME){
        exit("<p>Invalid User Input. Starting time must be before the end of a given time frame.<p><br><p><a href = 'HomePage.php'>Return</a></p>");
      }
	  //returns all buildings and all typs
      if($building === "all" && $type === "any"){
			$sql = "SELECT DISTINCT name, Count FROM rooms WHERE name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  ((startTime <= ? and ? <= endTime) or (startTime <= ? and ? <= endTime) or (? < startTime and ? > startTime))) and ignores is FALSE ";
  			$ps = $connection->prepare($sql);
  			$ps->bind_param("ddddddd", $VALID_DATE,$startTIME,$startTIME,$endTIME,$endTIME,$startTIME,$endTIME);
  			$ps->execute();
  			return $ps;
		//returns specific building of all types
  		} elseif ($building !== "all" && $type === "any"){
			$building = "$building%";
			$sql = "SELECT DISTINCT name, Count FROM rooms WHERE  name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  ((startTime <= ? and ? <= endTime) or (startTime <= ? and ? <= endTime) or (? < startTime and ? > startTime))) and name LIKE ? and ignores is FALSE";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddddddds",$VALID_DATE,$startTIME,$startTIME,$endTIME,$endTIME,$startTIME,$endTIME,$building);
  			$ps->execute();
  			return $ps;
		//returns all buildings of specific type
		} elseif ($building === "all" && $type !== "any"){
			$type = "$type%";
			$sql = "SELECT DISTINCT name, Count FROM rooms WHERE  name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  ((startTime <= ? and ? <= endTime) or (startTime <= ? and ? <= endTime) or (? < startTime and ? > startTime))) and type LIKE ? and ignores is FALSE";
			$ps = $connection->prepare($sql);
			$ps->bind_param("ddddddds",$VALID_DATE,$startTIME,$startTIME,$endTIME,$endTIME,$startTIME,$endTIME,$type);
  			$ps->execute();
  			return $ps;
		//returns specific building of specific type
		} elseif ($building !== "all" && $type !== "any"){
			$building = "$building%";
			$type = "$type%";
			$sql = "SELECT DISTINCT name, Count FROM rooms WHERE  name NOT IN (Select location FROM BOOKINGS WHERE dates = ? and  ((startTime <= ? and ? <= endTime) or (startTime <= ? and ? <= endTime) or (? < startTime and ? > startTime))) and name LIKE ? and type LIKE ? and ignores is FALSE";
			$ps = $connection->prepare($sql);
			$ps->bind_param("dddddddss",$VALID_DATE,$startTIME,$startTIME,$endTIME,$endTIME,$startTIME,$endTIME,$building,$type);
  			$ps->execute();
  			return $ps;
		}
	}//startTime <= start <=endTime or startTime <= end <= endTime or (start < startTime and end > startTime)
	//Change username and password as needed.
	//initializing relevant variables below.
  //echo "john";
// I try below to add security that is excessive.
  try{
    /*session_unset();if ( !isset( $_SESSION["origURL"] ) )
      $_SESSION["origURL"] = $_SERVER["HTTP_REFERER"];
 var_dump($_SESSION["origURL"]);
  if (strpos($_SESSION["origURL"], '/GetARoom/HomePage.php') === false) {
      exit("Try to access site");
  }*/

  if(!isset($_SERVER['HTTP_REFERER'])){
    header("REFRESH:0;url=HomePage.php");
    exit();
  } /*elseif($_SERVER['HTTP_REFERER'] !== 'http://localhost/GetARoom/HomePage') {
  echo "something";
    header("REFRESH:0;url=HomePage.php");

  }*/
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
  if((!empty($start) or !empty($end)) and !empty($date)){ #below checks if all user input information is kocher
  if(!empty($start)){
    preg_match_all('/^\d{2}[:]\d{2}$/',$start,$startvalid);
    //var_dump($startvalid);
  }
//  $startvalid = new ValidationResult("","","",true);
    if(!empty($end)){
      preg_match_all('/^\d{2}[:]\d{2}$/',$end,$endvalid);
    }
//  $endvalid = new ValidationResult("","","",true);
preg_match_all('/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[1-9]|[12][0-9]|3[01])$/',$date,$datevalid);
    //  var_dump($startvalid);
      //var_dump($endvalid);
    //  var_dump($datevalid);
//  $datevalid = new ValidationResult("","","",true);
  if(empty($datevalid[0])){
    //echo("duh");
    exit("Date Format is Invalid.
    <br><br>Acceptable Format: yyyy-mm-dd
    <p><a href = 'HomePage.php'>Return</a></p>");
  }
  if(isset($startvalid)){if(empty($startvalid[0])){
      //  echo("duh");
      exit("Time Format is Invalid.
      <br>
      <p><a href = 'HomePage.php'>Return</a></p>");
    }}
    if(isset($endvalid)){if(empty($endvalid[0])){
        //  echo("duh");
        exit("Time Format is Invalid.
        <br>
        <p><a href = 'HomePage.php'>Return</a></p>");
      }}
	$connection = new mysqli($servername, $username, $password, $dbname); #makes connection
	$error = mysqli_connect_error();
	if($error != null)
	{
	  $output = "<p>Unable to connect to database!</p>";
	  exit();
	}
	else { //Query database
		if(empty($end)){
					 $results = returnList_one_Time( $start, $date, $building, $type,$connection);
		}elseif(empty($start)){
					$results = returnList_one_Time( $end, $date, $building, $type,$connection);
		} else{
					$results = returnList_both( $start, $end, $date, $building, $type,$connection);
        }
		}
    $results -> bind_result($location, $count);
    #if results exist, print results.
    $connection2 = new mysqli($servername, $username, $password, $dbname);
    $sql2 = "Delete From roomschedule WHERE endtime <= Now()";
    if ($connection2->query($sql2) === TRUE) {
      echo "<p>Click on a room for more information</p>";
    } else {
    exit("Something went horribly wrong.
    <p><a href = 'HomePage.php'>Return</a></p>");
    }
    if($results -> fetch()){
    do{
      echo "<td class = 'RoomName'><a href = 'roomCalendar.php'>Room: ".$location."</a></td>
      <td class = 'OccCount'> $count </td>
      <td><a href = 'counterButton.php?room=$location'>Request</a></td>
      <td><a href = 'counterButton.php'>Rate</a></td></tr>";
      //Request will show the current user Request
      //Rating will show the top 3 user ratings
    }while($results -> fetch());
	}else{
    echo "<a href = 'HomePage.php'>No Rooms Found</a>";
  }
} else {
  exit("Incomplete Form. A start time or end time, and date are required.
  <br>
  <p><a href = 'HomePage.php'>Return</a></p>");
}
} catch(Exception $e){
echo "Oops something went wrong!
  <br>
  <p><a href = 'HomePage.php'>But try again?</a></p>";
}finally{ #always close.
      $connection -> close();
      $results -> close();
}
//}
?>

</tbody>
</table>


</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>

</div>



</body>
</html>
