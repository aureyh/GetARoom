//This file is for initializing a database and creating the booking table

<?php
include 'data/COSC310.php';

//Change username and password as needed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mainDB";

// Create database
/*
$sql = "CREATE DATABASE mainDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
*/

//Creating the table takes around 15 mins
set_time_limit(6000);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//Delete Table (Required for table reset)
$sql = "DROP TABLE BOOKINGS";
if ($conn->query($sql) === TRUE) {
    echo "Dank Drop";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create Table
$sql = "CREATE TABLE BOOKINGS(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  dates DECIMAL(3,1) NOT NULL,
  location VARCHAR(30),
  startTime DECIMAL(4, 2) NOT NULL,
  endTime DECIMAL(4, 2) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table BOOKINGS created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//Adds all entries to database. Note that in this version, location is not added
foreach ($sqlArr as $date=>$date_array) {
  foreach ($date_array as $location=>$location_array){
    $size = sizeof($location_array);
    for($i = 0; $i < ($size/2); $i++){
      $start = $location_array[$i*2];
      $end = $location_array[($i*2) + 1];
      $sql = "INSERT INTO BOOKINGS (dates, location, startTime, endTime)
      VALUES ($date, '$location',$start, $end)";
      if ($conn->query($sql) === TRUE) {
      }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
}

?>
