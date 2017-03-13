<?php
include ("ClassInfo_Functions.php");
$csv = fopen("unit_test_for_parser.csv", "r"); //open csv file. csv file changed so that , can be used as delimiter with fget()
$sql = array(); //initializes output array to db
$date = array(); //might be erroneous still useful to have a spare array.
$holder = array(); //used to oganize csv content
if($csv !== FALSE){
  $row = 2; //rows start at second row
  if (($temp = fgetcsv($csv,1000,",")) !== FALSE) {
    /*calling holder early to move pointer to second line, but note:
    0 weeks 1 location 2 day 3 starttime 4 endtime*/
  while( ($temp = fgetcsv($csv,1000,",")) !== FALSE){
    $holder[$row] = $temp; //sets array at row number to hold an array of string elements gathered from csv; index at 0
    $row++; //rows start at second row. index starts at 2
  }
}
   //should parse line at pionter into an array of strings. moves pointer when called.
fclose($csv); //shouldn't need file at this point
}
/*every table's title is week+day concatenation*/

/*week 1 sarts at august 22*/
/*
2 aug 29
3 sep 5
*/

foreach($holder as $arr){
  $weekarr = array(); #array of weeks for given line.
  $dayarr = array(); #array of days for given line.
  /*checks for existence of keywords in string.*/
  #takes string, and array of weeks to change
  getWeekArr($arr[0],$weekarr);
  getDayArr($arr[2],$dayarr);
  getSQLARR($weekarr,$dayarr,$sql,$arr);
}

#unit test 1
$arr2 = array(5.1 => array("LIB L306" => array(14,16)), 7.1 =>  array("LIB L306" => array(14,16)), 9.1 => array("LIB L306" => array(14,16)), 10.1 =>  array("LIB L306" => array(14,16)), 11.1 =>  array("LIB L306" => array(14,16)), 12.1 =>  array("LIB L306" => array(14,16)), 13.1 =>  array("LIB L306" => array(14,16)), 15.1 => array("LIB L306" => array(14,16)),
27.4 =>  array("ART 206" => array(17,20)), 30.3 =>  array("ART 218" => array(12.5,14)), 30.5 =>  array("ART 218" => array(12.5,14)), 5.7 => array("ART 203" => array(8,19)));

print_r($sql);
unit_test($arr2,$sql);

?>
