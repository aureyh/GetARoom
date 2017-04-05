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
  <h1>Room X</h1>
   <table data-role="table" data-mode="columntoggle" class="ui-responsive ui-shadow" id="myTable">
     <thead>
       <tr>
          <th data-priority="1">Time</th>
         <th>Bookings</th>

       </tr>
       <!--List of bookings for given room-->
     </thead>
     <tbody>
       <tr><td>Place Holder Time</td>
         <td>Place Holder Booking</td></tr>
         <tr><td>Place Holder Time</td>
           <td>Place Holder Booking</td></tr>
           <tr><td>Place Holder Time</td>
             <td>Place Holder Booking</td></tr>
             <tr><td>Place Holder Time</td>
               <td>Place Holder Booking</td></tr>
               <tr><td>Place Holder Time</td>
                 <td>Place Holder Booking</td></tr>
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
