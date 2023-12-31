<?php

if (isset($_POST["submitrequestevent"])) 
{
	
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
	
	if (isEmptyRequestEvent($eventname, $eventdesc, $eventphone, $eventdate, $eventtime, $eventtime2, $eventlat, $eventlong, $eventtype) !== false) 
	{
		header("location: ../requestevent.php?error=empty_input");
		exit();
	}
	
	$eventtime3 = (int) $eventtime + ($eventtime2 === "pm" ? 12 : 0);

	if ((int)$eventtime === 12)
		$eventtime3 = $eventtime3 - 12;
	
	$eventdatetime = $eventdate . " " . $eventtime3 . ":00:00";
	
	if (eventExists($conn, $eventdatetime, $eventlat, $eventlong) !== FALSE) 
	{
		header("location: ../requestevent.php?error=time_place_conflict&datetime=".$eventdatetime. "&lat=".$eventlat."&long=".$eventlong);
		exit();
	}
	
	session_start();
	
	$usersid = $_SESSION["usersId"];
	
	requestEvent($conn, $eventname, $eventdesc, $eventphone, $eventdatetime, $eventlat, $eventlong, $eventtype, $usersid);
	
	header("location: ../requestevent.php?error=none");
}
else 
{
	header("location: ../requestevent.php");
	exit();
}