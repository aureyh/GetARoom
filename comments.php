
<!DOCTYPE html>

<html>
<head><!---->
  <!--might allow for better scaling for mobile.-->
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>GetARoom</title>
  <!-- Custom theme made from ThemeRoller-->
  <link rel="stylesheet" href="themes/FirstTheme.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link href="buttonStyle.css" type="text/css" rel="stylesheet" />
<!-- Install Jqery mobile to site-->
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<?php //starting session for user verification
session_start();
 ?>

 <style>
 th {
     border-bottom: 1px solid #d6d6d6;
 }
 tr:nth-child(even) {
     background: #262980;
 }
 </style>


</head>
<body>
<!---->
<!-- All pages are within Div tags-->
<div data-role="page" id="home" data-theme="d">
  <div data-role="header">
    <h1>Get A Room</h1>

	<!--Adds nav bar-->
<div data-role="navbar">
<ul>      <!--nav bar links to the info page,uses a grid icon and is called Info-->

<li><a href="HomePage.php" data-icon="home">Home</a></li>

<!--Link to the accounts page from the nav bar-->
<li><a href="Accounts.php" data-icon="user">Sign In</a></li>
</ul>
</div>


</div>

<div data-role="main" class="ui-content">
  <h1>Get A Room: Comments for room XXX</h1>



<!--Previous comments will probably pull from a seperate php later-->

<table data-role="table" id="my-table" data-mode="reflow">
  <thead>
    <tr>
      <th>UserName</th>


    </tr>
  </thead>
  <tbody>
    <tr>
      <th>Date</th>
    <td>Test comment about things and stuff to basically display how it is printing. There is no value to reading this comment it is just rambling. If you've made it this far you probably have wasted your time time.</td>
    </tr>
    </tbody>
</table>



<!--Create a new comment drop down-->
 <form method="GET"action="**" id="formid">
   <div  data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
     <h1>Write Comment</h1>
     <textarea name="text" id="text" placeholder="Type comment here."></textarea>
<input type="submit" value="Post">

   </div>







 </form>


</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>

</div>



</body>
</html>
