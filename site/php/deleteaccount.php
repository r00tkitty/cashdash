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