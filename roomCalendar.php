<!DOCTYPE html>

<html><!---->
<head>
  <!--might allow for better scaling for mobile.-->
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>GetARoom</title>
  <!-- Custom theme made from ThemeRoller-->
  <link rel="stylesheet" href="themes/FirstTheme.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />

<!-- Install Jqery mobile to site-->
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<?php session_start();
//below is a part of extra security that is optional.
//if ( !isset( $_SESSION["origURL"] ) )
//    $_SESSION["origURL"] = $_SERVER["HTTP_REFERER"]; ?>

<style>
th {
    border-bottom: 1px solid #d6d6d6;
}

tr:nth-child(even) {
    background: #262980;
}
</style>


</head>

<body> <!---->

<div data-role="page" id="map"  data-theme="d"> <!--Pages are given an id for linking-->
<div data-role="header">
  <h1>Get A Room</h1>

  <!--Adds nav bar-->
<div data-role="navbar">
<ul>      <!--nav bar links to the info page,uses a grid icon and is called Info-->
<li><a href="HomePage.php" data-icon="home">Home</a></li>

<!--Link to the accounts page from the nav bar-->
<li><a href="Accounts.php" data-icon="user">Sign In</a></li>
</div>

</div>


<div data-role="main" class="ui-content">
  <<?php if(isset($_GET['room'])){$room = $_GET['room']; echo "<h1>Room $room</h1>";} else{echo "<h1>Room X</h1>";}?>
   <table data-role="table" data-mode="columntoggle" class="ui-responsive ui-shadow" id="myTable">
     <thead>
       <tr>
          <th data-priority="1">Time</th>
          <th>Booking Duration</th>
         <th>Stuck With</th>
         <th>Booked By</th>
       </tr>
       <!--List of bookings for given room-->
     </thead>
     <tbody>
       <?php
       try {
         $servername = "localhost";
         $username = "root";
         $password = "";
         $dbname = "mainDB";
         if(!isset($_GET['room'])){
         exit("No room selected. Please return home.");
       } else {
           $room = $_GET['room'];
         }
         $connection = new mysqli($servername, $username, $password, $dbname); #makes connection
         $error = mysqli_connect_error();
         if($error != null)
         {
           $output = "<p>Unable to connect to database!</p>";
           exit();
         }
         $sql = "SELECT starttime,endtime,stickies,user FROM roomschedule WHERE room = ?";
           $ps = $connection->prepare($sql);
           $ps->bind_param("s",$room);
           $ps->execute();
          $ps -> bind_result($starttime,$endtime,$stickies,$user);
          if($ps -> fetch()){
          do{
            $sticky = explode("^",$stickies,10);
            $tags = "";
            if(empty($sticky[0]) and empty($sticky[1])){ $tags = "NA";} else {foreach($sticky as $tag){$tags = $tags.', '.$tag;}}
            if(empty($user) or $user = null){
              $user = "NA";
            }
            echo "<tr>
            <td>$starttime</td>
            <td>1 Hour</td>
            <td>$tags</td>
            <td>$user</td>
            </tr>";
            //Request will show the current user Request
            //Rating will show the top 3 user ratings
          }while($ps -> fetch());
        }else{
          echo "<tr><td>NA</td>
            <td>No Booking</td><td>NA</td><td>NA</td></tr>";
        }
       } catch(Exception $e){
         exit("<br><a href = 'HomePage.php'>Unknown Error Occured</a>");
       } finally{
         $connection -> close();
       }


        ?>
     </tbody>
   </table>
   <!--Returns to Search results-->
   <a data-rel="back" data-role="button">Search Results</a>
 </div>




<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>





</body>
</html>
