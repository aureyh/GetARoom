<!DOCTYPE html>

<html>
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
</head>

<body> <!---->
<!-- All pages are within Div tags-->
<div data-role="page" id="home" data-theme="d">
  <div data-role="header">
    <h1>Get A Room</h1>

	<!--Adds nav bar-->
<div data-role="navbar">
<ul>      <!--nav bar links to the info page,uses a grid icon and is called Info-->
<li><a href="#info" data-icon="grid">Info</a></li>
<li><a href="#map" data-icon="navigation">Campus Map</a></li>
<!--Link to the accounts page from the nav bar-->
<li><a href="Accounts.php" data-icon="user">Sign In</a></li>
</ul>
</div>

<!---->
</div>

<div data-role="main" class="ui-content">
  <h1>Get A Room: Search</h1>

  <!--Start of form using test.php temporarity to test submit-->
    <form method="GET"action="listRooms.php" id="formid">

      <!--Time Select-->
      <fieldset class="ui-field-contain">
    <label for="start">Start Time</label>
    <input type="time" name="start" id="start" >
    <label for="end">End Time</label>
    <input type="time" name="end" id="end">
  </fieldset>

      <!--Date select-->
      <fieldset class="ui-field-contain">
    <label for="date">Desired Date</label>
    <input type="date" name="date" id="date">
  </fieldset>

  <!--script for setting default time-->
  <script>
  $(document).ready(function() { //runs a function before site opens
var fullDate = new Date(); //creates a date object
//gets date and time from date object

var h = fullDate.getHours();
var m = fullDate.getMinutes();
var month = fullDate.getMonth()+1;
var day = fullDate.getDate();
if(day<10){
  day = ""+0+day;  //formats the day to include 0 if under 10(eg. 1 = 01)
}
if(month<10){ //formats month from 0-11 -> 01-12
 month = ""+0+month;}
 if(h<10){ //formats hour from 0-24 -> 01-24    (Clock is 24h on mobile and 12 on desktop reason unknown)
  h = ""+0+h;}
  if(m<10){ //formats minute from 0-59 -> 01-59
   m = ""+0+m;}

var time = h+':'+m;

var date = fullDate.getFullYear()+"-"+month+"-"+day;

//fill the date and time inputs to the varaibles

$("#start").val(time);
$("#date").val(date);
  });
  </script>



  <!--Building Filter-->

    <fieldset  class="ui-field-contain">
      <label for="room">Filter Building</label>
      <select name="building" id="building">
        <option value="all">all</option>
        <option value="UNC">UNC</option>
        <option value="FIP">FIPKE</option>
        <option value="SCI">SCI</option>
        <option value="LIB">LIB</option>
        <option value="ART">ART</option>
        <option value="EME">EME</option>
      </select>
    </fieldset>

    <!--Room Type-->
    <fieldset class="ui-field-contain">
      <label for="room">Filter Room Type</label>
      <select name="type" id="type">
        <option value="any">any</option>
        <option value="Computer Lab">Computer Lab</option>
        <option value="Classroom">Classroom</option>

      </select>
    </fieldset>


  <!--Search Button-->
<input type="submit" value="Search">
<!--  <a href="#results" class="ui-btn" name="search" id="search">Search</a>  -->

</form>



</div>

<div data-role="footer"> <!--Adds trademark-->
  <h2>&copy; GetARoom2017 </h2>
</div>



</div>


<!--results page-->
<div data-role="page" id="results"  data-theme="d"> <!--Pages are given an id for linking-->
<div data-role="header">
  <h1>Get A Room</h1>

  <!--Adds nav bar-->
<div data-role="navbar">
<ul>      <!--nav bar links to the info page,uses a grid icon and is called Info-->
<li><a href="#home" data-icon="home">Home</a></li>

<!--Link to the accounts page from the nav bar-->
<li><a href="Accounts.php" data-icon="user">Sign In</a></li>
</ul>
</div>



</div>

<div data-role="main" class="ui-content">
<h1>Get A Room: Results</h1>


</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>



<!--Info page-->
<div data-role="page" id="info"  data-theme="d"> <!--Pages are given an id for linking-->
<div data-role="header">
  <h1>Get A Room</h1>

  <!--Adds nav bar-->
<div data-role="navbar">
<ul>      <!--nav bar links to the info page,uses a grid icon and is called Info-->
<li><a href="#home" data-icon="home">Home</a></li>

</ul>
</div>


</div>

<div data-role="main" class="ui-content">
<h1>Get A Room: Info</h1>

<ul>
	<li>
	<h3>Problem Statement</h3>
	At UBCO, Students are frequently unable to find spaces to study and work. Although the library and study room are frequently at capacity there are plenty of spaces available, on campus such as; open classrooms and labs for students to use. Information on the availability of these rooms is difficult and inconvenient for students to find due to the limited functionality of UBCO’s online timetable webapp which only allows for finding the schedule for rooms one room at a time. With our program a student who is looking for a room can open our website, via computer or mobile, enter in the time they are available and our program will return all the spaces on campus currently open for them to use.
	</li>

	<li>
		<h3>User Accounts</h3>
    Users can sign in or create an account from the sign in icon on the top right. Users with an account can "Rate" a room by applying a tag out of a set list to describe a visited room (eg.  Quiet). Repeated ratings of rooms over a short time may result in loss of the rating privilege. Users can also apply "Request" tags to a room which are displayed when a room is searched and request a behavior of the rooms occupants (eg. Groupwork, Quiet). GetARoom does not take responsibility for whether users honor Request tags applied to rooms.
	</li>

	<li>
		<h3>Monetization</h3>
	   No moetization is currently in place. Possible future means of monetizing include: marketing to the university, hosting advertisments and selling statistical information based on room use.
	</li>
</ul>

</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>


<!--Map page-->
<div data-role="page" id="map"  data-theme="d"> <!--Pages are given an id for linking-->
<div data-role="header">
  <h1>Get A Room</h1>

  <!--Adds nav bar-->
<div data-role="navbar">
<ul>      <!--nav bar links to the info page,uses a grid icon and is called Info-->
<li><a href="#home" data-icon="home">Home</a></li>
<li><a href="#info" data-icon="grid">Info</a></li>
<!--Link to the accounts page from the nav bar-->
<li><a href="Accounts.php" data-icon="user">Sign In</a></li>
</div>

</div>

<div data-role="main" class="ui-content">
<h1>Get A Room: Map</h1>
<img src="map.png">

<strong>FIPKE</strong>: FipKe Center <br>
<strong>SCI</strong>: Science Building <br>
<strong>EME</strong>: Engineering, Managment and Education <br>
<strong>ART</strong>: Arts Building <br>
<strong>LIB</strong>: Library Building

</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>





</body>
</html>
