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
        <?php
        function isMobile() {
          return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
      }
      
      if(isMobile()){
          echo  "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/main-css-mobile.css\">";
        
      }
      else {
        echo "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/main-css.css\">";
      }
      ?>
       
        
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';

$conn = new mysqli($dbhost, $dbuser, $dbpass);

if(! $conn ) {
   die('Could not connect: ' . $conn->error);
}

$sql = "SELECT (SELECT MIN(priority)
FROM users, doel
WHERE users.username = '$username' AND users.id = doel.id) AS min_prio";
$conn->select_db('app');
$retval = $conn ->query( $sql);

if(! $retval ) {
 die('<img src="error.png" style="display: block; margin-left: auto; margin-right: auto;"></img> <br><p class="error">We are having issues fetching your data.</p><br><p class="error2">Please try again later.</p>' . $conn->error);
}

while($row = $retval->fetch_array(MYSQLI_ASSOC)) {
  if("{$row['min_prio']}" !== null){
  $minprio = "{$row['min_prio']}";
  echo "$minprio";}
  else
  $minprio = "{$row['min_prio']}";
  echo "$minprio";
}
?>
<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   
   $conn = new mysqli($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) {
      die('Could not connect: ' . $conn->error);
   }
   
   $sql = "SELECT username, (SELECT SUM(recieve.amount)
   FROM users, recieve
   WHERE users.username = '$username' AND users.id = recieve.id) AS recieve,
   (SELECT SUM(spend.amount)
   FROM users, spend
   WHERE users.username = '$username' AND users.id = spend.id) AS SPEND,
   (SELECT cost
   FROM users, doel
   WHERE users.username = '$username' AND users.id = doel.id AND priority = 1) AS goal1cost,
   (SELECT descrip
   FROM users, doel
   WHERE users.username = '$username' AND users.id = doel.id AND priority = 1) AS descript
   
   FROM users
   WHERE users.username = '$username'";
   $conn->select_db('app');
   $retval = $conn ->query( $sql);
   
   if(! $retval ) {
    die('<img src="img/error.png" style="display: block; margin-left: auto; margin-right: auto;"></img> <br><p class="error">We are having issues fetching your data.</p><br><p class="error2">Please try again later.</p>' . $conn->error);
   }
   
   while($row = $retval->fetch_array(MYSQLI_ASSOC)) {
      echo "<p class='deftext' id='main'>Hello, $username. <br>You currently have</p>";
   $spend = "{$row['SPEND']}";
   $recieve = "{$row['recieve']}";
   $total = $spend + $recieve;
   $cost = "{$row['goal1cost']}";
   $descript = "{$row['descript']}";
   $left = $cost - $total;
   echo  "<div class=\"main\">€$total</div>";
      if( (empty($cost) && empty($descript))){ 
     echo <<<EOD
    <p class="youare">You don't have any goals.<br><a href="goals.php">Make some!</a></p>
    EOD;
  }
  else{
    if ($left > 0){
      echo "<p class='youare'>You are €$left away from reaching your goal:<br><bi>$descript</i></p>";
    }
    elseif ($left < 0){
      echo <<<EOD
      <p class="youare">You have more than €$cost.<br>You can buy $descript!</p>
      EOD;
    }
    else{
      echo <<<EOD
      <p class="youare">Something went wrong<br><a href="goals.php">Make some!</a></p>
      EOD;
    }
    
   $conn->close();
    }
}

?>
    </body>
</html>