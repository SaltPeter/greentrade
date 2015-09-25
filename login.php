<?php
@include_once("settings.php");

$username = $_REQUEST['username']; 
$password = $_REQUEST['password']; 

$check = mysql_query("SELECT * FROM `users` WHERE `username`='" . $username . "'" ) or die (mysql_error());
$numrows = mysql_num_rows($check);
if ($numrows == 0)
	die("Username doesn't exist \n");
else {
	$password = password_hash($password, PASSWORD_BCRYPT);
	while ($row = mysql_fetch_assoc($check)) {
		if($password == $row['password'])
			die("userid=".$row['userid']);
		else
			die("Incorrect login");
	}
}

?>
