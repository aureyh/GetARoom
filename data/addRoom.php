<?php

  //Change connection information as needed


<<<<<<< HEAD
  function addRoom($name, $capacity, $features, $type,$ignores){
=======
  function addRoom($name, $capacity, $features, $type){
>>>>>>> cff2bda9238e7277ea08d21408af216b0a95070c

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mainDB";

    $conn = new mysqli($servername, $username, $password, $dbname);

<<<<<<< HEAD
    $sql = "INSERT INTO ROOMS (name, capacity, features, type,ignores)
    VALUES ('$name', $capacity, '$features', '$type','$ignores')";
=======
    $sql = "INSERT INTO ROOMS (name, capacity, features, type)
    VALUES ('$name', $capacity, '$features', '$type')";
>>>>>>> cff2bda9238e7277ea08d21408af216b0a95070c
    if ($conn->query($sql) === TRUE) {
    }else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

 ?>
