<?php
  session_start();
  if(isset($_SESSION["username"])){


    $_SESSION["username"] = null;
    header("Refresh:0; url=home.php");
  //  header("location:javascript://history.go(-1)");
  }else{
    header("Refresh:0; url=login.php");
  }

 ?>
