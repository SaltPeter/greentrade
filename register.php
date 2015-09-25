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

?>