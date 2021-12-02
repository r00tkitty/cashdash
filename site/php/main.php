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
        <link rel="icon" href="favicon.png">

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
      font-size: 300%;
      -webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 2s; /* Firefox < 16 */
        -ms-animation: fadein 2s; /* Internet Explorer */
         -o-animation: fadein 2s; /* Opera < 12.1 */
            animation: fadein 2s;
}

@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Opera < 12.1 */
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
.error {
     font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
     text-align: center;
     font-size: 200%;
     margin-top: -20px;
     color: linear-gradient(0deg, rgba(255,214,0,1) 0%, rgba(255,89,89,1) 100%);
    }
    .error2 {
     font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
     text-align: center;
     font-size: 150%;
     margin-top: -20px;
     color: linear-gradient(0deg, rgba(255,214,0,1) 0%, rgba(255,89,89,1) 100%);
    }
    .text {
     font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
     font-size: large;
     text-align: center;
     font-size: 800%;
     margin-top: -20px;
     color: linear-gradient(0deg, rgba(255,214,0,1) 0%, rgba(255,89,89,1) 100%);
     -webkit-animation: fadein 4s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 4s; /* Firefox < 16 */
        -ms-animation: fadein 4s; /* Internet Explorer */
         -o-animation: fadein 4s; /* Opera < 12.1 */
            animation: fadein 4s;
}

@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Opera < 12.1 */
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
    
    .youare {
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      font-size: medium;
      color: black;
      text-align: center;
      font-size: 300%;
      margin-top: -90px;
    text-align: center;
    -webkit-animation: fadein 6s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 6s; /* Firefox < 16 */
        -ms-animation: fadein 6s; /* Internet Explorer */
         -o-animation: fadein 6s; /* Opera < 12.1 */
            animation: fadein 6s;
}

@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Opera < 12.1 */
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
    body {
      font: 14px sans-serif; text-align: center;
      background: rgb(245,0,219);
      background: linear-gradient(0deg, rgba(245,0,219,1) 0%, rgba(74,0,201,1) 100%);
    }
  </style>
    </head>
    <body>
    <div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="goals.php">Goals</a>
  <a href="main.php">Main</a>
  <a href="spendings.php">Spend/Get</a>
  <a href="Login.php">Profile</a>
  </div>

  <div id="main">
  <button class="openbtn" onclick="openNav()"><img src="favicon.png" style="height: 40px;"></button>
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
    die('<img src="error.png"></img> <br><p class="error">We are having issues fetching your data.</p><br><p class="error2">Please try again later.</p>' . $conn->error);
   }
   
   while($row = $retval->fetch_array(MYSQLI_ASSOC)) {
      echo "<p class='deftext'>Hello, $username. <br>You currently have</p>";
   $spend = "{$row['SPEND']}";
   $recieve = "{$row['recieve']}";
   $total = $spend + $recieve;
   $cost = "{$row['goal1cost']}";
   $descript = "{$row['descript']}";
   $left = $cost - $total;
   echo <<<EOD
      <p class="text">€$total</p>
      EOD;
      if ($left > 0){
      echo <<<EOD
      <p class="youare">You are €$left away from reaching your goal:<br><bi>$descript</i></p>
      EOD;
    }
    else {
      echo <<<EOD
      <p class="youare">You have more than €$cost.<br>You can buy $descript!</p>
      EOD;
    }
   $conn->close();
  }
?>
    </body>
</html>