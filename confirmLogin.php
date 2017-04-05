<?php
  session_start();
  $method = $_SERVER["REQUEST_METHOD"];
  if(!isset($_SESSION["userID"]) && $method == "POST" && isset($_POST["userName"]) && isset($_POST["password"]){
    $host = "localhost";
    $database = "mainDB";
    $username = "root";
    $password = "";

    $user = $_POST["userName"];
    $pass = md5($_POST["password"]);

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT username FROM user WHERE username = '$user' AND password='$pass'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $_SESSION["userID"] = $row["username"];
        echo "Login Succesful";
        header("Refresh:1; url=HomePage.php");
      }
    }else{
      header("Refresh:0; url=HomePage.php");
    }
  }else{
    header("Refresh:0; url=HomePage.php");
  }
 ?>
