<?php

header('Content-Type: application/json');

include_once "database-includes.php";

echo $_POST["method"]($conn);

function acceptEvent($conn) 
{
	if (isset($_POST["eid"]))
		$eventid = json_decode($_POST["eid"]);
	
	session_start();
	
	$userid = $_SESSION["usersId"];

	if (verifySuperAdmin($conn, $eventid, $userid) === FALSE) 
	{
		echo json_encode(array('status' => 'err', 'statusText' => 'You do not have the access to accept this event.'));
		exit();
	}
	
	$sql = "DELETE FROM eventapproval WHERE eventapprovalEid = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) 
	{
		echo json_encode(array('status' => 'err', 'statusText' => 'Database error in verifySuperAdmin.'));
		exit();
	}
	mysqli_stmt_bind_param($stmt, "i", $eventid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	echo json_encode(array('status' => 'ok'));
}

function verifySuperAdmin($conn, $eventid, $userid) 
{
	$sql = "SELECT * FROM eventapproval WHERE eventapprovalEid = ? AND eventapprovalSid = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) 
	{
		echo json_encode(array('status' => 'err', 'statusText' => 'Database error in verifySuperAdmin.'));
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "ii", $eventid, $userid);
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);

	if (mysqli_fetch_assoc($resultData))
		return TRUE;

	return FALSE;
}

function denyEvent($conn) 
{
	if (isset($_POST["eid"]))
		$eventid = json_decode($_POST["eid"]);
	
	session_start();
	
	$userid = $_SESSION["usersId"];
	
	if (verifySuperAdmin($conn, $eventid, $userid) === FALSE) 
	{
		echo json_encode(array('status' => 'err', 'statusText' => 'You do not have the access to deny this event.'));
		exit();
	}
	
	$sql = "DELETE FROM events WHERE eventsId = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) 
	{
		echo json_encode(array('status' => 'err', 'statusText' => 'Database error in denyEvent.'));
		exit();
	}
	mysqli_stmt_bind_param($stmt, "i", $eventid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	echo json_encode(array('status' => 'ok'));
}