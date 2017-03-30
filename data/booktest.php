<?php
//Change username and password as necessary
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mainDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Query that shows booking table
$sql = "SELECT id, dates, location, startTime, endTime FROM BOOKINGS";
$result = $conn->query($sql);
$row = mysql_fetch_array($retval, MYSQL_ASSOC)
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - date: " . $row["dates"]. "Location: " . $row["location"] . "- Start Time: " . $row["startTime"]. " - End Time: " . $row["endTime"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

 ?>
