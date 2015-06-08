<?php
/* Alisha Crawley-Davis
 * CS 290
 * 6/7/2015
 * Final Project
 * Code modified from class materials, tutoring sessions, w3 schools, and this tutorial: http://web.enavu.com/tutorials/checking-username-availability-with-ajax-using-jquery/
 * */
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();
$invalid = false;
$register = false;
echo"
<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <title>CS 290:Final Project</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='style.css'>
    <link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css'>
    <script src='http://code.jquery.com/jquery-1.11.2.min.js'></script>
    <script src='http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js'></script>
    <script src='login.js'></script>
</head>
<body>";
if (isset($_GET['action'])) {
  if ($_GET['action'] === 'invalidform') {
    $invalid = true;
  }
  if ($_GET['action'] === 'logout') {
    $_SESSION = array();
    session_destroy();
  }
  if ($_GET['action'] === 'registrationsuccess') {
    $register = true;
  }
}
if (!isset($_SESSION['username'])) {
  echo "
    <div data-role='page' id='pageone'>
      <div data-role='header'>
        <h2>Volunteer Log in Page</h2>
      </div>
      <br>";
    if ($invalid == true) {
      echo "
        <div id = 'error'>
          Invalid username or password. Please try again.
        </div>";
    }
    if ($register == true) {
      echo "
        <h2>Registration successful! Please log in below.</h2>";
    }
    echo "
    <form>
    <div id='username_availability_result'></div>
    Enter your username:
    <input type='text' name='username' id='username' required> 
    Enter your password:
    <input type='password' name='password' id='password' required>
    <input type='submit' id='submitbutton' value='Log in'>
    </form>
    <a href='register.php' data-ajax='false'>Register</a>
    </div>";
}
else {
	echo "<p>If you would like to log in with a different user name, ";
	echo "please <a href='login.php?action=logout' data-ajax='false'>log out</a> first.</p>";
	echo "Return to <a href='volunteer.php'>volunteer form</a>";
	}
echo "
  </body>
</html>";
?>
