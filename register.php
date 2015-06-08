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
$invalid=false;
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
    <script src='test.js'></script>
</head>
<body>";
if (isset($_GET['action'])) {
  if ($_GET['action'] === 'invalidname') {
    $invalid = true;
  }
  if ($_GET['action'] === 'logout') {
    $_SESSION = array();
    session_destroy();
  }
}
if (!isset($_SESSION['username'])) {
  echo "
    <div data-role='page' id='pageone'>
      <div data-role='header'>
        <h2>Volunteer Registration Page</h2>
      </div>
      <br>";
    if ($invalid == true) {
      echo "
        <div id = 'error'>
          Username already exists. Please try again.
        </div>";
    }
    echo "
    <form data-ajax='false'>
    Enter your first name:
    <input type='text' name='fname' id='fname' required>
    Enter your last name:
    <input type='text' name='lname' id='lname' required>
    Enter the grade of your youngest child who attends Forest View (0-5, enter 0 for Kindergarten):
    <input type='number' min='0' max='5' name='grade' id='grade' required>
    Enter your email:
    <input type='email' name='email' id='email' required>
    Enter your username:
    <div id='username_availability_result'></div>
    <input type='text' name='username' id='username' required>
    Enter your password:
    <div id='pw_result'></div>
    <input type='password' name='password' id='password' required>
    <input type='submit' id='submitform' value='Register'>
    </form>
    Already registered? Log in <a href='login.php' data-ajax='false'>here</a>
    </div>";
}
else {
	echo "<p>If you would like to register a different user, ";
	echo "please <a href='register.php?action=logout' data-ajax='false'>log out</a> first.</p>";
	echo "Return to <a href='volunteer.php'>volunteer form</a>";
	}
echo "
  </body>
</html>";
?>
