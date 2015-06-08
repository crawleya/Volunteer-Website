<?php
/* Alisha Crawley-Davis
 * CS 290
 * 6/7/2015
 * Final Project
 * Code modified from class materials, tutoring sessions, w3 schools, and this tutorial: http://web.enavu.com/tutorials/checking-username-availability-with-ajax-using-jquery/
 * */
/* Get form variables */
include "stored.php";
include "dbconnect.php";
ob_start();
session_start();
$name = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);
$checkuser = $db->prepare("SELECT COUNT(`userID`), `userID`, `firstname` FROM `users` WHERE `username` = ? AND `password` = ?");
$checkuser->bind_param('ss', $name, $password);
$checkuser->execute();
$checkuser->bind_result($num, $id, $fname);
$checkuser->fetch();
$checkuser->close();
if ($num == 1) { /* login correct */ 
  $_SESSION['userID'] = $id;
  $_SESSION['username'] = $name;
  $_SESSION['fname'] = $fname;
  echo 1;
} else { /* login incorrect */
  echo 0;
}
?>
