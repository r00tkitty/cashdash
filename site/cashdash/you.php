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
?>
 <?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   
   $conn = new mysqli($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) {
      die('Could not connect: ' . $conn->error);
   }
   $sql = "SELECT created_at
   FROM users
   WHERE users.username = '$username'";
   $conn->select_db('app');
   $retval = $conn ->query($sql);
   
   if(! $retval ) {
    die('<img src="img/error.png" style="display: block; margin-left: auto; margin-right: auto;"></img> <br><p class="error">We are having issues fetching your data.</p><br><p class="error2">Please try again later.</p>' . $conn->error);
   }
   $date = $retval->fetch_array()[0] ?? '';
   $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        function isMobile() {
          return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
      }
      
      if(isMobile()){
          echo  "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/you-css-mobile.css\">";
        
      }
      else {
        echo "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/you-css.css\">";
      }
      ?>
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
<h1 class="deftext"><b>Your profile</b></h1>
<div class="container"> 
<p class="name"><?php echo $username;?></p>
<p class="date"><?php echo "Account created at: <b> $date</b>";?></p>
<button class="center"><a href="reset-password.php" class="textdeco">Reset Your Password</a></button>
<button class="center"><a href="logout.php" class="textdeco">Log out of your account</a></button>
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<input type='submit'  name='hehe' value="Delete your account">
</form>

<?php
if(isset($_POST['hehe'])){
 echo '<button><a onclick="return confirm(\'Are you sure you want to delete your Sangros ID? \nALL your data will be deleted!\')" href="deleteaccount.php">Are you sure?</a></button>';


{}
}?>

</div>

</body>
</html>