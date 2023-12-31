<?php

if (isset($_POST["submitrequestevent"])) 
{
	$rsoid = $_POST["rsoid"];
	$eventname = $_POST["eventname"];
	$eventdesc = $_POST["eventdesc"];
	$eventphone = $_POST["eventphone"];
	$eventdate = $_POST["eventdate"];
	$eventtime = $_POST["eventtime"];
	$eventtime2 = $_POST["eventtime2"];
	$eventlat = $_POST["eventlat"];
	$eventlong = $_POST["eventlong"];
	$eventtype = $_POST["eventtype"];
	
	require_once "database-includes.php";
	require_once "functions-includes.php";
	
	if (isEmptyCreateEvent($rsoid, $eventname, $eventdesc, $eventphone, $eventdate, $eventtime, $eventtime2, $eventlat, $eventlong, $eventtype) !== false) 
	{
		header("location: ../createevent.php?error=empty_input");
		exit();
	}
	
	$eventtime3 = (int) $eventtime + ($eventtime2 === "pm" ? 12 : 0);
	if ((int)$eventtime === 12)
		$eventtime3 = $eventtime3 - 12;
	
	$eventdatetime = $eventdate . " " . $eventtime3 . ":00:00";
	
	if (eventExists($conn, $eventdatetime, $eventlat, $eventlong) !== FALSE) 
	{
		header("location: ../createevent.php?error=time_place_conflict&datetime=".$eventdatetime. "&lat=".$eventlat."&long=".$eventlong);
		exit();
	}
	
	session_start();
	
	$usersid = $_SESSION["usersId"];
	
	if (validateCreateEvent($conn, $rsoid, $usersid) === FALSE) 
	{
		header("location: ../createevent.php?error=invalid_access");
		exit();
	}
	
	$uniid = getUsersUniversity($conn,$usersid);
	createRSOEvent($conn, $eventname, $eventdesc, $eventphone, $eventdatetime, $eventlat, $eventlong, $eventtype, $usersid, $rsoid, $uniid);
	
	header("location: ../createevent.php?error=none");
}
else 
{
	header("location: ../createevent.php");
	exit();
}