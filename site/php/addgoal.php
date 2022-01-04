<?php error_reporting(0); ?>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";?>
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';

$conn = new mysqli($dbhost, $dbuser, $dbpass);

if(! $conn ) {
   die('Could not connect: ' . $conn->error);
}
$username = $_SESSION["username"];  
$query = $mysqli->prepare("SELECT
doel.id, username, priority, descrip, cost
FROM
users
JOIN
doel ON doel.id = users.id
WHERE
users.username = '$username'");
$query->execute();
$query->store_result();

if(! $query ) {
 die('<img src="img/error.png" style="display: block; margin-left: auto; margin-right: auto;"></img> <br><p class="error">We are having issues fetching your data.</p><br><p class="error2">Please try again later.</p>' . $conn->error);
}
$number_of_rows = $query->num_rows;

?>
<?php
// Define variables and initialize with empty values
$descrip = $cost = "";
$descrip_err = $cost_err = "";
$easteregg= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username;
    if(empty($_POST["descrip"])){
      $descrip_err = "Please enter a description for your goal.";
    } elseif(!preg_match('/^[a-zA-Z0-9_ ]/', ($_POST["descrip"]))){
      $descrip_err = "Description can only contain letters, numbers, spaces and underscores .";
    }
      elseif(($_POST["descrip"]) == "rickroll"){
        header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ"); /* Redirect browser */
  exit();
    }
    
      elseif(($_POST["descrip"]) == "46 12 25"){
        header("Location: eggs/infinitefun/fun is infinite.html"); /* Redirect browser */
  exit();
    } 
    elseif(($_POST["descrip"]) == "allyourbasearebelongtous"){
      header("Location: eggs/allyourbase/allyourbase.html"); /* Redirect browser */
exit();
  } 
    else{
        // Prepare a select statement
        $sql = "SELECT
        doel.id, username, priority, descrip, cost
      FROM
        users
      JOIN
        doel ON doel.id = users.id
      WHERE
        users.username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_descrip);
            
            // Set parameters
            $param_descrip = $_SESSION["username"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                if($stmt->num_rows == 5){
                    $descrip_err = "You have reached the maximum amount of saving goals (5). Please delete a goal first!";
                } else{
                    $descrip = ($_POST["descrip"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty($_POST["cost"])){
        $cost_err = "Please enter the amount!";     
    } elseif ($_POST["cost"] == 0){
        $cost_err = "Your goal cost must be greater than 0.";
    }elseif ($_POST["cost"] < 0){
      $cost_err = "You can't have a negative saving goal, silly!";
    } 
    elseif ($_POST["cost"] == 6969.00 || $_POST["cost"] == 6969.69 || $_POST["cost"] == 9696.96| $_POST["cost"] == 696.96|| $_POST["cost"] == 969.69){
      $cost_err = "Nice, but I doubt that's something you're saving up for.";
    }
    elseif ($_POST["cost"] > 100000.00){
      $cost_err = "The maximum cost of your goal can be €100000.<br>(Let's keep it realistic: you're not that rich.)";
    }
    else{
      $cost = ($_POST["cost"]);
  }
    // Check input errors before inserting in database
    if(empty($descrip_err) && empty($cost_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO doel (id, descrip, cost, priority) VALUES (?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $id, $param_descrip, $param_cost, $param_priority);
            
            // Set parameters
            $id = $_SESSION["id"];
            $param_descrip = $descrip;
            $param_cost = $cost;
            $param_priority = $number_of_rows + 1;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                echo "Success!";
                header("location: goals.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}


?>
<html>
    <head>
        <meta charset="utf-8">
        <title>CashDash</title>
        <link rel="icon" href="img/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
  var validate = function(e) {
  var t = e.value;
  e.value = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)) : t;
}
</script>
<?php
        function isMobile() {
          return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
      }
      
      if(isMobile()){
          echo  "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/addgoal-css-mobile.css\">";
        
      }
      else {
        echo "<link rel=\"stylesheet\" type=\"text/css\"  href=\"css/addgoal-css.css\">";
      }
      ?>
    </head>
    <body>
    <div id="mySidebar" class="sidebar">
    <a style="text-align:center" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a style="text-align:center" href="main.php">Main</a>
  <a style="text-align:center" href="goals.php">Goals</a>
  <a style="text-align:center" href="spendings.php">Spend/Get</a>
  <a style="text-align:center" href="Login.php">Profile</a>
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
<div class="container">   
<p class="here">Insert your new goal here!</p></br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group">
                <input type="text" name="descrip" class="form-control" value="<?php echo $descrip; ?>" placeholder="Description" maxlength="26" >
                
            </div>    
            <div class="form-group">
                <input type="number" name="cost" min="0" value="0.00" step="0.01" max="100000" id="resultText" size="26" oninput="validate(this)" class="form-control <?php echo (!empty($cost_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cost; ?>">
            </div>
            <span class="invalid-feedback"><?php echo "<p style='text-align: center; color: red; font-size:150%;'>$descrip_err</p>"; ?></span>
            <span class="invalid-feedback"><?php echo "<p style='text-align: center; color: red; font-size:150%;'>$cost_err</p>"; ?></span>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
            <br>
            <a href="goals.php"><p style="text-align: center;">Click here to go back to your goals.</p></a>
        </form>
</div>
</body>
</html>
