
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

<body>

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
<!---->

<div data-role="main" class="ui-content">

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
          <div id="groupTag"></div>

          <div id="quietTag"></div>

          <div id="privateTag"></div>

          <button class="applyBtn" onclick=javascriptvoid(0);>Apply</button>

          <button class="cancelBtn" onclick=javascriptvoid(0);>Cancel</button>
        </div><!-- End of popup1-Yes-Contents -->

      </div><!-- popup-Container end-->
      </div><!-- popoup-wrapper end -->
    </div><!-- popup-Box1-Position end -->

<div id="wrapper">
  <button class= "+1" onclick="toggle_visibility('popup-Box1-Position');" data-inline="true">+1</button>
</div><!-- wrapper end-->



<!--Visibility toggle function for pop-up window-->
<script>
      function toggle_visibility(id) {
         var e = document.getElementById(id);
         if(e.style.display == 'block')
            e.style.display = 'none';
         else
            e.style.display = 'block';
      }
//******CODE BELOW IS NOT WORKING******
//script to fade out popup1-Contents and fade in popup1-Yes-Contents
      $(document).ready(function(){
        $("#popup-1-Yes-Contents").hide() //can't fadeIn() unless hidden, display: none set in css
        $("yesBtn").click(function(){
          ("#popup-1-Yes-Contents").show();
      });
        $("yesBtn").click(function(){
          ("#popup1-Contents").hide();
        });
      });

</script>
</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>


</body>
</html>
