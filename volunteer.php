<?php
/* Alisha Crawley-Davis
 * CS 290
 * 6/7/2015
 * Final Project
 * Code modified from class materials, tutoring sessions, w3 schools, and this tutorial: http://web.enavu.com/tutorials/checking-username-availability-with-ajax-using-jquery/
 * */
include "stored.php";
include "dbconnect.php";
ob_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();
echo "
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
  </head>";
/* log out */
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  $_SESSION = array();
  session_destroy();
  header('Location: login.php');
}
/* Make sure user is logged in */
if (session_status() == PHP_SESSION_ACTIVE) {
  if (isset($_POST['username']) && $_POST['username'] != "") {
    $_SESSION['username'] = $_POST['username'];
  }
}
if (isset($_SESSION['username']) && $_SESSION['username']) {
  $name = $_SESSION['username'];
  $userID = $_SESSION['userID'];
  $fname = $_SESSION['fname'];
echo "
  <body>
    <div data-role='page' id='pageone'>
    <div data-role='header'>
      <h2>Forest View Elementary Volunteer Form</h2>
    </div>
    <div data-role='main' class='ui-content'>
      <div id='logout'>
        <a href='volunteer.php?action=logout' data-ajax=false>Log out</a>
      </div>
      <p>Hello $fname! Thank you for your interest in volunteering! If you would like to learn more about a team and/or join it, simply click on the + next to the team you are interested in. After clicking on the +, be sure to click on 'Join Team' and then submit the form (at the bottom) to join! You will find a list of your current teams next to the form.</p>
    </div>
    <div class='ui-grid-a'>
      <div class='ui-block-a'>
        <div>
          <form action='connect.php' method='POST' data-ajax='false'>";
          /* Get team information from teams database */
          for ($i = 1; $i <= 4; $i++) {
            $teams = $db->prepare("SELECT displayname, name, dates, description FROM $teamtable WHERE season=$i");
            $teams->execute();
            $teams->bind_result($displayname, $teamname, $dates, $description);
            /* Display form section headings */
            switch ($i) {
              case 1:
	        echo "<h3>Fall Opportunities</h3>";
	        break;
	      case 2:
	        echo "<h3>Winter Opportunities</h3>";
	        break;
              case 3:
	        echo "<h3>Spring Opportunities</h3>";
                break;
	      case 4:
	        echo "<h3>Year-long Opportunities</h3>";
	        break;
	    }
            /* Display teams information */
            while ($teams->fetch()) {
              echo"
              <div data-role='collapsible'>
                <h3>$displayname ($dates)</h3>
	        <p>$description</p>
	        <div>
	          <label><input type='checkbox' id='$teamname' name='$teamname'>Join Team</label>
                </div>
	      </div>";
            } /*end while loop */
          } /*end for loop */
          $teams->close();
          echo"
            <input type='submit' name='submitform' value='Submit Form'>
          </form><br>
	</div>
      </div>";
    /*Make Table - code modified from tutoring session */
    echo "    
      <div class='ui-block-b'>
        <div id='teamheader'>
          <h3>$fname's Current Teams</h3>
          <table>
          <tr>
            <td>Team Name</td>
	    <td>Season</td>
	    <td>Dates</td>
	    <td>Remove Team</td>
	    </tr>";
          $maketable = $db->prepare("SELECT teams.teamID, teams.displayname, teams.season, teams.dates
	                             FROM user_team INNER JOIN teams
	                             ON user_team.teamID=teams.teamID 
	                             WHERE user_team.userID = $userID");
          $maketable->execute();
          $maketable->bind_result($theid, $displayname, $season, $date);
          while ($maketable->fetch()) {
            echo "
            <tr>
	      <td>$displayname</td>";
		switch($season) {
		case 1:
		  echo"<td>FALL</td>";
		  break;
		case 2:
		  echo"<td>WINTER</td>";
                  break;
		case 3:
		  echo"<td>SPRING</td>";
		  break;
		case 4:
		  echo"<td>YEAR LONG</td>";
		  break;
	        }
              echo"
	        <td>$date</td>
		<td><form action='connect.php' method='POST' data-ajax='false'>
	        <input type='hidden' name='tname' value='$theid'>
	        <input type='hidden' name='uname' value='$userID'>
	        <input type='submit' name='delete' value='Remove'></form></td>	
              </tr>";
          }
	  echo "
          </table>
	</div>
      </div>
    </div>
  </div>
</body>
</html>";
/*If user is not logged in */
} else {
  echo "
  <body>
    <div data-role='page' id='pageone'>
      <div data-role='header'>
        <h2>Forest View Elementary Volunteer Form</h2>
      </div>
    <div data-role='main' class='ui-content'>
      <p>Hello! Thank you for your interest in volunteering! You must be logged in to fill out our volunteer form.</p>
    Click <a href='login.php' data-ajax='false'>here</a> to log in.<br>
    Click <a href='register.php' data-ajax='false'>here</a> to register.
    </div>
    </div>
  </body>
</html>";
}
?>
