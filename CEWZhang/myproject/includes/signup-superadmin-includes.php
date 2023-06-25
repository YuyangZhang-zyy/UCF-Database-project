<?php

if (isset($_POST["submitsa"])) 
{
	session_start();
	extract($_SESSION['post'], EXTR_PREFIX_ALL, "cred");
	
	$lat = $_POST["lat"];
	$long = $_POST["long"];
	$desc = $_POST["desc"];
	
	require_once "database-includes.php";
	require_once "functions-includes.php";
	
	if (isEmptySignupSA($lat, $long, $desc) !== false) 
	{
		header("location: ../signup.php?error=empty_input");
		exit();
	}
	
	createSuperAdmin($conn, $cred_uname, $cred_pwd, $cred_uniname, $lat, $long, $desc);
}
else 
{
	header("location: ../signup.php");
	exit();
}