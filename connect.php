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
if (isset($_SESSION['username']) && ($_SESSION['username'])) {
/*connect to database - code is modified from tutoring session and lecture*/
echo "
<!doctype html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>cs 290:final project</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css'>
<script src='http://code.jquery.com/jquery-1.11.2.min.js'></script>
<script src='http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js'></script>
</head>
<body>";
$uid = 'userid';
$tid = 'teamid';
$usid = $_SESSION['userID'];
/*get information from post form to add to join table in database */
if (isset($_POST['submitform'])) {
  $teamnames = $db->prepare("SELECT teamID, name from $teamtable");
  $teamnames->execute();
  $teamnames->bind_result($theid, $thename);

  while ($teamnames->fetch()) {
    if (isset($_POST[$thename])) {
      $dd = new mysqli('oniddb.cws.oregonstate.edu', $user, $pass, $mydb);
      if ($dd->connect_error) {
        echo "unable to connect: (" . $dd->connect_errno . ")" . $dd->connect_error;
      }
      $newrow = $dd->prepare("INSERT INTO $jointable($uid,$tid) VALUES ($usid,$theid)");
      $newrow->execute();
      $newrow->close();
    } /* end if */
  } /* end while */
  $teamnames->close();
  /* redirect back to volunteer page*/
  header("Location:volunteer.php");
} /* end if */

/*delete row */
if (isset($_POST['delete'])) {
  $delrow = $db->prepare("DELETE FROM `user_team` WHERE `userID` = ? AND `teamID` = ?");
  $delrow->bind_param('ii', $_POST['uname'], $_POST['tname']);
  $delrow->execute();
  $delrow->close();
  header("Location:volunteer.php");
}
} else {
  echo "Please <a href='login.php' data-ajax='false'>log in</a>";
}
?>
