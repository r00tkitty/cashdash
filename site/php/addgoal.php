
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
  

}
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$descrip = $cost = "";
$descrip_err = $cost_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username;
    if(empty($_POST["descrip"])){
      $descrip_err = "Please enter a description.";
    } elseif(!preg_match('/^[a-zA-Z0-9_ ]/', ($_POST["descrip"]))){
      $descrip_err = "Description can only contain letters, numbers, spaces and underscores .";
    } else{
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
                    $descrip_err = "You have reached the maximum amount of saving goals.";
                } else{
                    $descrip = ($_POST["descrip"]);
                    header("location: goals.php");
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
    } elseif ($_POST["cost"] <= 0){
        $cost_err = "Your goal cost must be greater than 0.";
    } else{
        $cost = ($_POST["cost"]);
    }
    
    // Check input errors before inserting in database
    if(empty($descrip_err) && empty($cost_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO doel (id, descrip, cost) VALUES (?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $id, $param_descrip, $param_cost);
            
            // Set parameters
            $id = $_SESSION["id"];
            $param_descrip = $descrip;
            $param_cost = $cost;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                echo "Success!";
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

$username = $_SESSION["username"]
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>CashDash</title>
        <link rel="icon" href="favicon.png">
<script>
  var validate = function(e) {
  var t = e.value;
  e.value = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)) : t;
}
</script>
	  	  <style type="text/css">
        /* The sidebar menu */
    .sidebar {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 1; /* Stay on top */
    top: 0;
    left: 0;
    background-color: #111; /* Black*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 60px; /* Place content 60px from the top */
    transition: 0.3s; /* 0.5 second transition effect to slide in the sidebar */
    background: rgb(26,0,89);
    background: linear-gradient(135deg, rgba(26,0,89,1) 0%, rgba(128,0,35,1) 70%);
  }
  
  /* The sidebar links */
  .sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }
  
  /* When you mouse over the navigation links, change their color */
  .sidebar a:hover {
    color: #4A00FF;
    transition: 0.4s;

  }
  
  /* Position and style the close button (top right corner) */
  .sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }
  
  /* The button used to open the sidebar */
  .openbtn {
    font-size: 20px;
    cursor: pointer;
    background-color: rgba(128,0,35,0);
    color: white;
    padding: 0px 0px;
    border: none;
    border-radius: 10px;
  }
  
  .openbtn:hover {
    background-color: #444;
  }
  
  /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
  #main {
    transition: margin-left .5s; /* If you want a transition effect */
    padding: 20x;
  }
  
  /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
  @media screen and (max-height: 450px) {
    .sidebar {padding-top: 15px;}
    .sidebar a {font-size: 18px;}
  }
  /*this is the text i'm gonna use*/
    .deftext {
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      font-size: medium;
      color: black;
      text-align: center;
      font-size: 80px;
      
    }
    .text {
     font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
     font-size: large;
     text-align: center;
     font-size: 150px;
     color: linear-gradient(0deg, rgba(255,214,0,1) 0%, rgba(255,89,89,1) 100%);
    }
    body {
      font: 14px sans-serif; text-align: left;
      background: rgb(245,0,219);
      background: linear-gradient(0deg, rgba(245,0,219,1) 0%, rgba(74,0,201,1) 100%);
    
    }
    .construcc {
      display: block;
      margin-left:auto;
      margin-right:auto;
      width: 40%;
      text-align: center;
    }
    .form-group {
      display:flex;
      justify-content:center;
      align-items:center;
    }
    .label {
      display:flex;
      justify-content:center;
      align-items:center;
    }
    .container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  width: 25%;
  display: block;
  margin-left:auto;
  margin-right:auto;
} 
input[type=submit] {
  background-color: #04AA6D;
  color: black;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=reset] {
  background-color: #04AA6D;
  color: black;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=text] {
  background-color: #000000;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=number] {
  background-color: #000000;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

  </style>
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
  <button class="openbtn" onclick="openNav()"><img src="favicon.png" style="height: 40px; position:fixed;"></button>
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
<p style="text-align: center;">Insert your new goal here!</p></br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group">
                <input type="text" name="descrip" class="form-control" value="" placeholder="Description">
                
            </div>    
            <div class="form-group">
                <input type="number" name="cost" min="0" value="0.00" step="0.01" id="resultText" oninput="validate(this)" class="form-control <?php echo (!empty($cost_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cost; ?>">
            </div>
            <span class="invalid-feedback"><?php echo "<p style='text-align: center; color: red;'>$descrip_err</p>"; ?></span>
            <span class="invalid-feedback"><?php echo "<p style='text-align: center; color: red;'>$cost_err</p>"; ?></span>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
</div>
</body>
</html>