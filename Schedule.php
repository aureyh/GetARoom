
<!DOCTYPE html>

<html>
<head><!---->
  <meta charset="utf-8">
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


</head>

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      print();
    setInterval(print,3600000);
    function print(){
     var url = $(location).attr('href');
     var urlarray = url.split('?');
     var getrequest = urlarray[1];
     var results = $.get("listRooms.php?".concat(getrequest));
     results.done(function(data) {
      console.log(data);
      $("tbody").html(data);
      $("select.sticky").change(function(){
        var sticky = this;
        var row = $(sticky.parentNode.parentNode);
        var button = row.find('button.count');
        button.click();
        //BELOW IS CODE THAT IS FASTEr. ABOVE IS EASIER TO MAINTAIN.
        /*console.log('button add to count',button);
        console.log('select sticky',sticky);
        var sticky_val = sticky.value;
        console.log('current count',currcount);
        console.log('sticky value', sticky_val);
        //.concat("&count=").concat(currcount)
        var newcount = $.get("addOne.php?name=".concat(room).concat("&sticky=").concat(sticky_val));
        newcount.done(function(newdata){console.log(newdata);button.parent().find('span').html(newdata.count);sticky.children[newdata.sticky].selected = true;}, "json");
        var currcolorofbutton = button.style.backgroundColor;
        button.style.backgroundColor = "white";
        setTimeout(function(){button.style.backgroundColor = currcolorofbutton;},400);*/
      });
      $("button.count").click(function(){
        var button = $(this);
        var row = $(this.parentNode.parentNode);
        var sticky = row.find('select.sticky');
        console.log('button add to count',button);
        console.log('select sticky',sticky);
        var sticky_val = sticky[0].value;
        var room = row.attr("id");
        console.log('sticky value', sticky_val);
        //.concat("&count=").concat(currcount)
        var newcount = $.getJSON("addOne.php?name=".concat(room).concat("&sticky=").concat(sticky_val));
        newcount.done(function(newdata){console.log(newdata);button.parent().find('span').html(newdata.count);sticky[0].children[newdata.newsticky].selected = true;});
        //var plusonetocount = Number(currcount) + 1;
        //console.log("this is the new count: ".concat(plusonetocount) );
        //button.attr('value', plusonetocount);
       });
     });
     results.fail(function(jqXHR) {console.log("Error: " + jqXHR.status);});
     results.always(function() {console.log("done");});
    }
    });
    </script>
  <h1>Get A Room: Search Results</h1>

 <table data-role="table" data-mode="columntoggle" class="ui-responsive ui-shadow" id="myTable">
  <thead>
    <tr>
    <th>Room</th>
    <th data-priority="1">Occupancy</th>
    <th data-priority="2">Request tag</th>
    <th data-priority="3">Add a Comment</th>
  </tr>
</thread>
<!--All print outs are in a table-->

<tbody>
  <!--content goes here-->

</tbody>
</table>


</div>

<div data-role="footer">
<h2>&copy; GetARoom2017 </h2>
</div>

</div>



</body>
</html>
