<?php
/* Connect to database */
$user = 'crawleya-db';
$mydb = 'crawleya-db';
$teamtable = 'teams';
$usertable = 'users';
$jointable = 'user_team';
$db = new mysqli('oniddb.cws.oregonstate.edu', $user, $pass, $mydb);
if ($db->connect_error) {
  echo "Unable to connect: (" . $db->connect_errno . ")" . $db->connect_error;
}
?>
