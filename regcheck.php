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
session_start();
ob_start();
$name = $_POST['username'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$password = md5($password);
$email = $_POST['email'];
$grade = $_POST['grade'];
$checkuser = $db->prepare("SELECT COUNT(`userID`) FROM `users` WHERE `username` = ?");
$checkuser->bind_param('s', $name);
$checkuser->execute();
$checkuser->bind_result($num);
$checkuser->fetch();
$checkuser->close();
if ($num === 1) { /* user name already exists */ 
  echo 0;
} else { /* login correct */
    echo 1;
    $dd = new mysqli('oniddb.cws.oregonstate.edu', $user, $pass, $mydb);
    if ($dd->connect_error) {
      echo "Unable to connect: (" . $dd->connect_errno . ")" . $dd->connect_error;
    }
    $addrow = $dd->prepare("INSERT INTO `users`(`username`, `firstname`, `lastname`, `grade`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?)");
    $addrow->bind_param('sssiss', $name, $fname, $lname, $grade, $email, $password);
    $addrow->execute();
    $addrow->close();
}
?>
