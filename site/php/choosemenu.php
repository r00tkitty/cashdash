<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$username = $_SESSION["username"];
error_reporting(E_ERROR | E_PARSE);
?>
<html>
   <head>
        <meta charset="utf-8">
        <title>CashDash</title>
        <link rel="icon" href="img/favicon.png">
        <link rel="stylesheet" type="text/css" href="addtohomescreen.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        function isMobile() {
          return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
      }
      
      if(isMobile()){
          echo  "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/choosemenu-css-mobile.css\">";
        
      }
      else {
        echo "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/choosemenu-css.css\">";
      }
      ?>
<script src="addtohomescreen.js"></script>
<script>
addToHomescreen();
</script>

    </head>
    <body>
    <div id="mySidebar" class="sidebar">
  <a style="text-align:center;" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a style="text-align:center;" href="main.php">Main</a>
  <a style="text-align:center;" href="goals.php">Goals</a>
  <a style="text-align:center;" href="spendings.php">Spend/Get</a>
  <a style="text-align:center;" href="Login.php">Profile</a>
  </div>

  <div id="main">
  <button class="openbtn" onclick="openNav()"><img src="img/favicon.png" style="height: 5%; position:fixed; "></button>
</div>
  <script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}

</script>

<p class="youare">Are you going to spend or get money?</p>
<div style="display:flex;justify-content:center;align-items:center;">
  <div><a href="removemoney.php"><button class="spendbutton">Spend</button></a></div></div>
  <br>
  <div style="display:flex;justify-content:center;align-items:center;">
  <div><a href="addmoney.php"><button class="getbutton">Recieve</button></a></div></div>

    </body>
</html>