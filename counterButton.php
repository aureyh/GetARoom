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

<body>


<!--Outer popup box -->
<div id="popup-Box1-Position">
  <div class="popup-Wrapper">
    <!-- Contained in popup box -->
      <div class="popup-Container">

        <div id="popup1-Contents">
        <h4>Thank you for using our counter!</h4>
        <p>Would you like to add tags to this room?<p>
          <button class="yesBtn">Yes</button>
          <button class="noBtn" onclick="toggle_visibility('popup-Box1-Position');">No</button>
        </div><!-- end of popup1-Contents -->

        <!-- contents to display upon clicking yes -->
        <div id="popup1-Yes-Contents">
          <h4>Please read the descriptions for the available room tags. Please note tags will disappear after 1 hour.</h4>
          <div id="groupTag">
            <form action ="/userTags.php" method = "POST">
            <p>The group tag indicates a group of the amount of people that are working in the room.</p>
            <h3>Group</h3>
            <span>
            <input type="checkbox" name="check2People" value="2">2<br>
            <input type="checkbox" name="check3People" value="3">3<br>
            <input type="checkbox" name="check4People" value="4">4<br>
            <input type="checkbox" name="check5People" value="5">5+<br>
          </span>
          </div>

          <div id="quietTag">
            <p>The quiet tag indicates this room can be used by anyone, but please do not disturb other people.</p>
            <h3>Quiet</h3>
            <input type="checkbox" name="quietCheck" value="quiet">Quiet Room<br>
          </div>

          <div id="privateTag">
            <p>The private tag indicates a group needs the room for a meeting, presentation etc.</p>
            <h3>Private</h3>
            <input type="checkbox" name="privateCheck" value="private">Private Room<br>
          </div>
          <p>When you have selected your preffered tags, please hit apply. </p>
          <input type="submit" value="Apply">
        </form> <!-- End of form tag to apply check box info to php file -->
          <button class="cancelBtn" onclick="toggle_visibility('popup-Box1-Position');">Cancel</button>
        </div><!-- End of popup1-Yes-Contents -->

      </div><!-- popup-Container end-->
      </div><!-- popoup-wrapper end -->
    </div><!-- popup-Box1-Position end -->

<div id="wrapper">
  <button id= "+1" onclick="toggle_visibility('popup-Box1-Position');" data-inline="true">+1</button>
</div><!-- wrapper end-->




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
        });
      });
// scrip that faces in popup1-Yes-Contents and faces out popup1-Contents when pushing apply button
      $(document).ready(function(){
        $(".applyBtn").click(function(){
          $("#popup1-Yes-Contents").fadeOut();f
          $("#popup1-Contents").fadeIn();
        });
      });
</script>
</body>
</html>
