<?php //starting session for user verification
session_start();
error_reporting(0);
 ?>
<?php
require("roomsfunctions.php");
  try{
require('Connection.php');
	if(array_key_exists('start', $_GET) and array_key_exists('end',$_GET) and array_key_exists('date',$_GET) and array_key_exists('building',$_GET) and array_key_exists('type',$_GET)){
	$start = $_GET["start"]; //start and end are in 10:50 sort of format
	$end = $_GET["end"];
	$date = $_GET["date"]; //date is in 2017-03-21
	$building = $_GET["building"]; //building is just FIPKE EME etc. or all
	$type = $_GET["type"]; //any, Computer labs or Class Rooms
}
else {echo "invalid access attempt<br>";
exit();}
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
 //Query database
		if(empty($end)){
					 $results = returnList_one_Time( $start, $date, $building, $type,$connection);
		}elseif(empty($start)){
					$results = returnList_one_Time( $end, $date, $building, $type,$connection);
		} else{
					$results = returnList_both( $start, $end, $date, $building, $type,$connection);
        }
    $results -> bind_result($location, $count);
    #if results exist, print results.
    $connection2 = new mysqli($servername, $username, $password, $dbname);
    $sql2 = "Delete From roomschedule WHERE endtime <= Now()";
    if ($connection2->query($sql2) === TRUE) {
      echo "<p>Click on a room for more information</p>";
    } else {
    exit("Fatal Error.
    <p><a href = 'HomePage.php'>Return</a></p>");
    }

    if($results -> fetch()){
    do{ //will display each room that matches criteria
			//and a occupancy button, request button and comment button.
      echo "<td class = 'RoomName'><a href = 'roomCalendar.php?room=$location'>Room: ".$location."</a></td>
      <td class = 'OccCount'> <span>$count</span>  <button id = '$location' value = $count class='ui-btn ui-btn-inline'>+1</button> </td>
      <td>

      <label for='select-native-4' class='ui-hidden-accessible' data-inline='true'>Native select:</label>
<select name='select-native-4' id='select-native-4'>
    <option value='small'>Indifferent</option>
    <option value='small'>Quiet</option>
    <option value='medium'>Social</option>
    <option value='large'>Presentation</option>
</select>
      </td>
      <td><a href = 'comments.php' class='ui-btn ui-btn-inline'>Comment</a></td></tr>";
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
