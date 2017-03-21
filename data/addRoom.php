<?php

  //Change connection information as needed


  function addRoom($name, $capacity, $features, $type){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mainDB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "INSERT INTO ROOMS (name, capacity, features, type)
    VALUES ('$name', $capacity, '$features', '$type')";
    if ($conn->query($sql) === TRUE) {
    }else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

 ?>
