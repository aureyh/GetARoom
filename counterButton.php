<!DOCTYPE html>
<html>
<head>

  <!-- Install Jqery mobile to site-->
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<!-- Css install -->
<link href="buttonStyle.css" type="text/css" rel="stylesheet" />


</head>

<body id ="jordansbody">

<?php
session_start();
if(!isset($_GET["room"])){header("Refresh:0; url=HomePage.php");}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maindb";

$conn = new mysqli($servername, $username, $password, $dbname);
//check connection
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION["user"])){
  $user = $_SESSION["user"];
}
else {
  $user = null;
}

$room = $_GET["room"];

$sql = "INSERT INTO roomschedule (starttime, endtime, user, clientcount, room)
        VALUES (NOW(), timestampadd(HOUR, 1, NOW(), '$user', 1, '$room')";

if($conn->query($sql)===false){
  echo "Error with insert" . $conn->error;
}
       ?>




<!--Outer popup box -->
<div id="popup-Box1-Position">
  <div class="popup-Wrapper">
    <!-- Contained in popup box -->
      <div class="popup-Container">

        <div id="popup1-Contents">
        <h4>Thank you for using our counter!</h4>
        <p>Would you like to tag this room?<p>
        <button class="yesBtn">Yes</button>
        <input type="button" onclick="location.href='homePage.php';" value="No" />
        </div><!-- end of popup1-Contents -->
        <!-- contents to display upon clicking yes -->
        <div id="popup1-Yes-Contents">
          <h4>Please read the descriptions for the available room stickies. Please note stickies will disappear after 1 hour.</h4>
          <h4>Your participation will help us allocate space better.</h4>
          <div id="groupTag">
            <?php echo  "<form action ='/userTags.php?room=$room' method = 'POST'>"?>
            <form action ="/userTags.php?room=$room" method = "POST">
            <p>The group tag represents the size of the group registering a room for use.</p>
            <p>By registering we will be able to show other users how full a room is</p>
            <p></p>
            <h3>Group</h3>
            <fieldset class="ui-field-contain">
              <select name="groupCheck" id="Group">
                <option value="1">Group Size</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5+</option>
              </select>
            </fieldset>
          </div>

          <div id="quietTag">
            <p>The quiet sticky indicates this room can be used by anyone, but please do not disturb other people.</p>

            <h3>Quiet</h3>
            <input type="checkbox" name="quietCheck" value="quiet">Quiet Room<br>
          </div>

          <div id="privateTag">
            <p>The private sticky indicates a group needs the room for a meeting, presentation etc.</p>
            <h3>Private</h3>
            <input type="checkbox" name="privateCheck" value="private">Private Room<br>
          </div>
          <p>When you have selected your preffered stickies, please press apply. </p>
          <input type="submit" value="Apply">
        </form> <!-- End of form tag to apply check box info to php file -->
          <input type="button" onclick="location.href='homePage.php';" value="Cancel" />
        </div><!-- End of popup1-Yes-Contents -->

      </div><!-- popup-Container end-->
      </div><!-- popoup-wrapper end -->
    </div><!-- popup-Box1-Position end -->
<!--
<div id="wrapper">
  <button id= "+1" onclick="toggle_visibility('popup-Box1-Position');" data-inline="true">+1</button>
<<<<<<< HEAD
</div>
-->

<script>
// Visibility toggle function for pop-up window
      function toggle_visibility(id) {
         var e = document.getElementById(id);
         if(e.style.display == 'block')
            e.style.display = 'none';
         else
            e.style.display = 'block';
      }
//script to fade out popup1-Contents and fade in popup1-Yes-Contents when pushing yes button
      $(document).ready(function(){
        $(".yesBtn").click(function(){
          $("#popup1-Yes-Contents").fadeIn();
          $("#popup1-Contents").fadeOut();
          $('input[type=checkbox]').removeAttr('checked');
        });
      });

//script that fades in popup1-Yes-Contents and fades out popup1-Contents when pushing cancel button
      $(document).ready(function(){
        $(".cancelBtn").click(function(){
          $("#popup1-Yes-Contents").fadeOut();
          $("#popup1-Contents").fadeIn();
          $('input[type=checkbox]').removeAttr('checked');
        });
      });
// scrip that faces in popup1-Yes-Contents and faces out popup1-Contents when pushing apply button
      $(document).ready(function(){
        $(".applyBtn").click(function(){
          $("#popup1-Yes-Contents").fadeOut();
          $("#popup1-Contents").fadeIn();
        });
      });
</script>
</body>
</html>
