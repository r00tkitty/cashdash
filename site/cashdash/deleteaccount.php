<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$id = $_SESSION["id"];
$username = $_SESSION["username"];
error_reporting(E_ERROR | E_PARSE);
?>
<?php
require_once "config.php";
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = "app";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if(! $conn ) {
   die('Could not connect: ' . $conn->error);
}

// sql to delete a record
$con = "DELETE FROM doel where id = '$id' AND EXISTS(SELECT * FROM doel WHERE id = $id)";
if ($conn->query($con) === TRUE) {
  echo "Goals deleted<br>";

} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>  
<?php
require_once "config.php";
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = "app";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if(! $conn ) {
   die('Could not connect: ' . $conn->error);
}

// sql to delete a record
$con = "DELETE FROM spend where id = '$id' AND EXISTS(SELECT * FROM spend WHERE id = $id)";
if ($conn->query($con) === TRUE) {
  echo "Spend log deleted<br>";

} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
<?php
require_once "config.php";
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = "app";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if(! $conn ) {
   die('Could not connect: ' . $conn->error);
}

// sql to delete a record
$con = "DELETE FROM recieve where id = '$id' AND EXISTS(SELECT * FROM recieve WHERE id = $id)";
if ($conn->query($con) === TRUE) {
  echo "Recieved logs deleted<br>";

} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
<?php
require_once "config.php";
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = "app";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if(! $conn ) {
   die('Could not connect: ' . $conn->error);
}

// sql to delete a record
$con = "DELETE FROM users where id = '$id'";
if ($conn->query($con) === TRUE) {
  echo "Your account has been deleted. You will be redirected to the login page.";
  session_destroy();
  header('Refresh: 3; URL=login.php');

} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>We're sad to see you go!</title>
        <link rel="icon" href="img/favicon.png">
        <link rel="stylesheet" href="css/deleteaccount-css.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            <?php
        function isMobile() {
          return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
      }
      
      if(isMobile()){
          echo  "background: url(img/goaway-mobile.png);
        background-repeat: no-repeat;
        background-size: 100% 100%;";
        
      }
      else {
        echo "background: url(img/goaway.png);
        background-repeat: no-repeat;
        background-size: 100% 100%;";
      }
      ?>
        }
    </style>
    </head>
    <body>
    </body>
</html>