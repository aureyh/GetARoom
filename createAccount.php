<?php
  session_start();
  $method = $_SERVER["REQUEST_METHOD"];
  if(!isset($_SESSION["user"]) && $method == "POST" && isset($_POST["userName"]) && isset($_POST["password"]) && isset($_POST["email"])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mainDB";

    $user = $_POST["userName"];
    $pass = md5($_POST["password"]);
    $email = $_POST["email"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM USER WHERE username='$user' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "User already exists with that username or password";
      header("Refresh:1; url=HomePage.php");
    }else{
      $sql = "INSERT INTO user (username, password, email)
      VALUES ('$user', '$pass', '$email')";
      if ($conn->query($sql) === TRUE) {
        echo "An account for user $user has been created.";
      }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $_SESSION["user"] = $user;
      header("Refresh:0; url=HomePage.php");
    }
  }else{
    echo "Sign up failed";
    header("Refresh:1; url=HomePage.php");
  }
 ?>
