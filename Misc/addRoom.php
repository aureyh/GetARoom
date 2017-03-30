<?php

  //Change connection information as needed


  function addRoom($name, $capacity, $features, $type,$ignores){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mainDB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "INSERT INTO ROOMS (name, capacity, features, type,ignores)
    VALUES ('$name', $capacity, '$features', '$type','$ignores')";
    if ($conn->query($sql) === TRUE) {
    }else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

 ?>
