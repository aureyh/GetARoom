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
</ul>
</div>


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

  <!--script for setting time-->
  <script>
  $(document).ready(function() { //runs a function before site opens
var fullDate = new Date(); //creates a date object
//gets date and time from date object

var h = fullDate.getHours();
var m = fullDate.getMinutes();
var month = fullDate.getMonth()+1;
if(month<10){ //formats month from 0-11 -> 01-12
 month = ""+0+month;}
 if(h<10){ //formats hour from 0-24 -> 01-24    (Clock is 24h on mobile and 12 on desktop reason unknown)
  h = ""+0+h;}
  if(m<10){ //formats minute from 0-59 -> 01-59
   m = ""+0+m;}
var time = h+':'+m;

var date = fullDate.getFullYear()+"-"+month+"-"+fullDate.getDate();

//fill the date and time inputs to the varaibles

$("#start").val(time);
$("#date").val(date);
  });
  </script>



  <!--Building Filter-->

    <fieldset class="ui-field-contain">
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
        <option value="Computer Labs">Computer Lab</option>
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

</div>

<div data-role="main" class="ui-content">
<h1>Get A Room: Results</h1>

<!--Return button to go to homepage-->

<a href="#home" class="ui-btn" name="return" id="return">Return</a>



<!--php test-->
<div>
<?php

//include("data/booking.php");

?>
</div>



</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>
<!--Info page-->
<div data-role="page" id="info"  data-theme="d"> <!--Pages are given an id for linking-->
<div data-role="header">
  <h1>Get A Room</h1>

</div>

<div data-role="main" class="ui-content">
<h1>Get A Room: Info</h1>

<ul>
	<li>
	<h3>Problem Statement</h3>
	<p>At UBCO, there is not enough space on campus in popular areas to study, complete homework or use computers. There is plenty of open classrooms or labs that students could use for studying, and yet the limited study spaces in areas such as the library remain over booked. Our application would alleviate the difficulty and inconvenience of finding empty spaces to work in for periods of time by displaying these rooms through a website. Nothing currently exists that would achieve the same goals as our solution. The closest thing would be a webapp by UBCO that lets you search specific classrooms one at a time to see if they are vacant. However, our software would show all available rooms at the current time and how long they would be available to work in.</p>
	</li>
	<li>
		<h3>Goals</h3>
		<p>We want to create a database of all the available study spaces on campus, including relevant information such as their location and times available. We then want to make this information accessible to users so that they can search for rooms based on desired parameters, such as the previously mentioned time or location. We are planning on implementing an interactive map so that users can see a visual representation of what rooms are open and at what times. If we implement a tracking system, we would also be able to visualize different levels of traffic for different rooms. </p>
	</li>
	<li>
		<h3>User Interaction</h3>
		<p>There is potential for user interaction that can be addressed in multiple ways. A useful addition would be the implementation of a ‘sign in’ feature so that users can show whether they are using a room or not. There are various ways this could be implemented. The first would be user accounts. This would allow us to track user information and patterns, and would open up a host of other features such as tracking where friends are and signing up for rooms. The issue with this feature is that it is dependent on users going through the process of creating an account and signing into a room. What would stop a user from simply seeing that a room is empty, ignoring the signing in process and using the room. We would need a way to work around this, and provide some incentive for users to use the sign in feature. An alternative method would be a gps feature where users allow a gps to track their location, which would in turn display whether they are in a room or not. This would be much more convenient for the user, but would provide less in depth information for us to use in our program. Another option that would avoid the hassle of account creation would be to make the app function with Facebook accounts. This would have some of the same issues as user created accounts, including signing in to rooms, minus the issue of creating an account, plus the added benefit of additional user data mining. </p>
	</li>
	<li>
		<h3>Monetization</h3>
		<p>It is possible that we could market our product to other universities. If this was the case, we could go even further and sell the information that we would track in student patterns. We would need to implement our program in such a way that it would be easy for us to make it applicable to other campuses and so that the databases were self-regulating at least to a certain extent. This would be a stretch goal for us, potentially a summer project or something along those lines, but it’s worth acknowledging.</p>
	</li>
</ul>
<a href="#home" class="ui-btn" name="return" id="return">Return</a>
</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>



</body>
</html>
