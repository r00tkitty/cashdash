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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        function isMobile() {
          return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
      }
      
      if(isMobile()){
          echo  "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/goals-css-mobile.css\">";
        
      }
      else {
        echo "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/goals-css.css\">";
      }
      ?>
    </head>
    <body>
    <div id="mySidebar" class="sidebar">
  <a style="text-align:center" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a style="text-align:center" href="main.php">Main</a>
  <a style="text-align:center" href="goals.php">Goals</a>
  <a style="text-align:center" href="spendings.php">Spend/Get</a>
  <a style="text-align:center" href="you.php">Profile</a>
  </div>

  <div id="main">
  <button class="openbtn" onclick="openNav()"><img src="img/favicon.png" style="height: 5%; position:fixed;"></button>
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
<div id="header">
<p class="deftext">Your goals</p>
</div>
<div id="container">
<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   
   $conn = new mysqli($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) {
      die('Could not connect: ' . $conn->error);
   }
   
   $sql = "SELECT
   doel.id, username, priority, descrip, cost
 FROM
   users
 JOIN
   doel ON doel.id = users.id
 WHERE
   users.username = '$username'";
    $conn->select_db('app');
    $retval = $conn ->query($sql);

   $sql = "SELECT
   COUNT(goal_id) as a
 FROM
   users
 JOIN
   doel ON doel.id = users.id
 WHERE
   users.username = '$username'";

   $conn->select_db('app');
   $retval2 = $conn ->query($sql);
   
   if($retval2->fetch_array(MYSQLI_ASSOC)["a"] == 0) {
echo "<p class='nothing'>You don't have any goals.<br>Make some below!</p>";
    }
   if(! $retval ) {
      die('<img src="img/error.png" style="display: block; margin-left: auto; margin-right: auto;"></img> <br><p class="error">We are having issues fetching your data.</p><br><p class="error2">Please try again later.</p>' . $conn->error);
    
   }
   while($row = $retval->fetch_array(MYSQLI_ASSOC)) {
    echo "<hr class='solid' style='margin-top: 0px'></hr>
    <a href='' style='text-decoration:none;'>
      <p style=' display:inline; font-size: 200%; margin-top: 6  0px;'>???</p>
    </a>
  
      <p class=goalname style='margin-top: -10px;'>{$row['descrip']}</p>
      <p class=cost style='margin-top: -30px;'>???{$row['cost']}</p>
    ";
   }
  
?>
</div>
<div class="button-container">
  <div class="butt-vertical-center">
    <a href="addgoal.php">
      <button class="thebutton"><p class="textinside">Add</p></button></a>
  </div>
</div>
</body>
</html>
