<?php
@include_once("settings.php");

$username = $_REQUEST['username']; 
$password = $_REQUEST['password']; 
$email = $_REQUEST['email'];


if(preg_match("/^[a-zA-Z0-9\s\.,!?]*$/", $password))
	echo "Password was good.";
else
	die("Password is not valid.");

$password = password_hash($password, PASSWORD_BCRYPT);

if(mysql_query("SELECT `username` FROM `users` where `username`=`" . $username. "`"))
	mysql_query("INSERT INTO `users` VALUES ({$username}', '{$password}', '{$email}', '(10,000)')") or die ('Query failed: ' . mysql_error());

$findid = mysql_query("SELECT `userid` FROM `users` WHERE `username`='" . $username . "'" ) or die (mysql_error());

$numrows = mysql_num_rows($findid);

$message = "";
if ($numrows == 0)
	die(" the new user not found \n");
else {
	while($row = mysql_fetch_assoc($findid))
		$userid = $row['id'] ;  break;
			
echo "done, userid:".$userid."";
}

?>
