<?php

include("ClassInfo_Functions.php"); #includes all functions used above.
    $csv = fopen("bookingInfo.csv", "r"); //open csv file. csv file changed so that , can be used as delimiter with fget()
    $sqlArr = array(); //initializes output array to db
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
    for($i = 0; $i <= 52; $i++){
      for($j = 0; $j <= 7; $j++){
        $date["$i.$j"] = array(0 => "$i.$j");
        $sqlArr["$i.$j"] = array(); /*will become a 3 dimensional array.
        first by date. second by classroom. third by time.*/
      }
    }
    /*week 1 sarts at august 22*/
    /*
    2 aug 29
    3 sep 5
    */

    foreach($holder as $arr){
      $dt = new DateTime($arr[3]);
      $arr[3] = $dt->format('H:i');
      $dt2 = new DateTime($arr[4]);
      $arr[4] = $dt2->format('H:i');
      $weekarr = array(); #array of weeks for given line.
      $dayarr = array(); #array of days for given line.
      /*checks for existence of keywords in string.*/
      #takes string, and array of weeks to change
      getWeekArr($arr[0],$weekarr);
      getDayArr($arr[2],$dayarr);
      getSQLARR($weekarr,$dayarr,$sqlArr,$arr);

}


?>
