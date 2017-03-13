<?php
#strcmp() used to compare strings will need later.

#functions go here.


/*UNIT TEST FOR ALL OF PARSER*/

function unit_test($arr1,$arr2){

foreach($arr2 as $key1 => $val1_array){
  foreach($val1_array as $key2 => $val2_array){
    if($val2_array != $arr2[$key1][$key2]){
        echo "there was error in array";
        break;
      }
  }
}
echo "everything works fine so far";
}
/*COMPUTE SQL 3D ARRAY PER LINE OF CSV*/
function getSQLARR($weekarr,$dayarr,&$sql,$arr){
	$strSTART = explode(":",$arr[3],3);
	$strEND = explode(":",$arr[4],3);
  $startTIME = "";
  $endTIME = "";

	#dilineates between 30,15,00

  if(strpos($strSTART[1], "30") !== FALSE){
  	$startTIME = $strSTART[0].".5";
  }
  	elseif(strpos($strSTART[1], "15")){
  $startTIME = $strSTART[0].".25";
  	}
  	else{
  		$startTIME = $strSTART[0];
  	}


  if(strpos($strEND[1], "30") !== FALSE){
  	$endTIME = $strEND[0].".5";
  }
  	elseif(strpos($strEND[1], "15")){
  $endTIME = $strEND[0].".25";
  	}

  	else{
  		$endTIME = $strEND[0];
  	}

	foreach($weekarr as $weekarrnum){
    foreach($dayarr as $daynum){

      if(empty($sql["$weekarrnum.$daynum"][$arr[1]])){
        $sql["$weekarrnum.$daynum"][$arr[1]] = array($startTIME,$endTIME);

    } else{
        $sql["$weekarrnum.$daynum"][$arr[1]][count($sql["$weekarrnum.$daynum"][$arr[1]])] = $startTIME;
	      $sql["$weekarrnum.$daynum"][$arr[1]][count($sql["$weekarrnum.$daynum"][$arr[1]])] = $endTIME;

    }
    }

	}
}

/*GET DAY ARRAY*/

function getDayArr($str, &$dayarr){
  if (strpos($str,';') !== FALSE){
    $stretchsmcol = explode(";", $str, 3);
    foreach($stretchsmcol as $substr){
    $dayarr[count($dayarr)] = convertDayToNum($substr);
  }}else{
    $dayarr[count($dayarr)] = convertDayToNum($str);
  }
}

#converts the day name into a number 1- 7 starting from monday to sunday. returns false if no day is listed for debugging purposes.
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


/*GET WEEK ARRAY*/
#getweekarr (getweeks(getweeknum)) is the nested sequence of functions. returns array of weeks from string that is tokenized sequentially.
#getweekarr tokenizes for ;
function getWeekArr($str, &$weekarr){
  /*str - string strarr - string into array date0 date 1 init date as specificed. weekarr is array of weeks.*/

  $date0 = "2016"; //arbitrary year number. does not impact.
  $date1 = "2017"; //year number + 1 for jan onward.
  $initdate = new DateTime("2016-08-22");
  #strarr = str_split($str, 1); splits  element string into arrayy. might need later.
    if (strpos($str,";") !== FALSE){ #if multiple weeks, or days splits into substrings.
      $stretchsmcol = explode(";", $str, 10);

      foreach($stretchsmcol as $substr){
        getWeeks($substr, $weekarr,$date0,$date1,$initdate);
      }}  else{
        getWeeks($str, $weekarr,$date0,$date1,$initdate);
}
}

#tokenizes for hyphens, and determines the format of the date
    function getWeeks($str, &$weekarr,$date0,$date1,$initdate){ #interprets - range of weeks.
    if (strpos($str,"-") === FALSE){
      $weekarr[count($weekarr)] = $str;
  } else{
    $stretchhyph = explode("-", $str, 3);
    if (!empty($stretchhyph[1]) and !empty($stretchhyph[0])) {
      if(!ctype_digit($stretchhyph[1])){ #converts string to array checks for integers returns true if none found.
        $weekarr[count($weekarr)] = getWeekNum($str,$weekarr,$date0,$date1,$initdate); #count(weekarr) adds one to current max index since indexing starts at 0.
      }  else{
      $weekarr[count($weekarr)] = $stretchhyph[0];
      $i = 1;
      while($i< $stretchhyph[1] - $stretchhyph[0]){
      $weekarr[count($weekarr)] = $stretchhyph[0] + $i;
      $i++;
      }
      $weekarr[count($weekarr)] = $stretchhyph[1];
      }
    }
  }
  }

  #function built to change 25-Aug into Week 1.
      function getWeekNum($str, $weekarr, $date0, $date1, $initdate){ //str - string strarr - string into array date0 date 1 init date as specificed.
        $stamp;
        #2016 sept or 9  -> 2017 aug or 8
        if(strpos(($str),"Sep") !== FALSE){ //30
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date0 = "$date0-09-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        }
         elseif(strpos($str,"Oct") !== FALSE){ //31
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date0 = "$date0-10-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Nov") !== FALSE){ //30
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          $date0 = "$date0-11-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Dec") !== FALSE){ //31
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date0 = "$date0-12-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Jan") !== FALSE){ //31
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date1 = "$date1-01-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Feb") !== FALSE){ //28 + 1 if year = 2016+ 4k
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date1 = "$date1-02-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Mar") !== FALSE){ //31
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date1 = "$date1-03-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Apr") !== FALSE){ //30
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date1 = "$date1-04-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"May") !== FALSE){ //31
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date1 = "$date1-05-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Jun") !== FALSE){ //30
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date1 = "$date1-06-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Jul") !== FALSE){ //31
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date1 = "$date1-07-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
        } elseif(strpos($str,"Aug") !== FALSE){ //31
          $stamp = explode("-",$str,3);
          $day = $stamp[0];
          if(strlen($day) == 1){$day = "0$day";}
          $date1 = "$date1-08-$day";
          $date0 = new DateTime($date0);
          $change = dateDifference($initdate, $date0, '%a');
          } else
          { echo "$str :: this is an error";
        }
        return 1 + ($change - $change%7)/7;
  }
  function dateDifference($datetime1 , $datetime2 , $differenceFormat)
{
    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);

} #credit goes to http://php.net/manual/en/function.date-diff.php. i am familiar with the code, but this will make it easier.
?>
