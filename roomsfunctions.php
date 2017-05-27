<?php
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
 ?>
