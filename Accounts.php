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

<!--Sign in page-->
<div data-role="page" id="signIn"  data-theme="d"> <!--Pages are given an id for linking-->
<div data-role="header">
  <h1>Get A Room</h1>

  <!--Adds nav bar-->
<div data-role="navbar">
<ul>     <!--Nav bar that links to the home page-->
<li><a href="HomePage.php" data-icon="home">Home</a></li>

</ul>
</div>


</div>

<div data-role="main" class="ui-content">
<h1>Get A Room: Sign In</h1>
<!--Form for the user sign in. It's currently set to use HomePage since it should end at the homepage after the data is stored in the database-->
<form method="POST"action="HomePage.php" id="formid">
<!--Labels and text fiels for username and password-->
<label for="userName">User Name:</label>
<input type="text" name="userName" id="userName">
<label for="password">Password: </label>
<input type="password" name="password" id="password">

<!--Submit button and create account button that links to the create account page-->
 <input type="submit" data-inline="true" value="Sign in">
<a href="#createAccount" class="ui-btn">Create Account</a>

</form>

</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>


<!--Create account page-->
<div data-role="page" id="createAccount"  data-theme="d"> <!--Pages are given an id for linking-->
<div data-role="header">
  <h1>Get A Room</h1>

  <!--Adds nav bar-->
<div data-role="navbar">
<ul>
<li><a href="HomePage.php" data-icon="home">Home</a></li>

</ul>
</div>


</div>

<div data-role="main" class="ui-content">
<h1>Get A Room: Create Account</h1>
<!--form which is tempararily set to go to the sign in page since that's where it should be after the form data is submitted to the database-->
<form method="GET"action="Accounts.php" id="formid">
  <!--labels and text inputs for email, username and password-->
<label for="email">E-Mail:</label>
<input type="text" name="email" id="email">
<label for="userName">Desired User Name:</label>
<input type="text" name="userName" id="userName">
<label for="password">Desired Password:</label>
<input type="text" name="password" id="password">

<!--submit button for create account form. Cancel button which returns to sign in page.-->
 <input type="submit"data-inline="true" value="Create Account">
<a href="#signIn" class="ui-btn">Cancel</a>

</form>

</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>
</div>






</body>
</html>
