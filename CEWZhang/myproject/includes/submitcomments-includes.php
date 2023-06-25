<?php

include_once "database-includes.php";
include_once "functions-includes.php";

echo submitCommentHelper($conn);

function submitCommentHelper($conn) 
{
	if (isset($_POST["eventid"]))
		$eventid = $_POST["eventid"];
	if (isset($_POST["comment_field"]))
		$desc = $_POST["comment_field"];
	
	session_start();
	
	$userid = $_SESSION["usersId"];

	$data = '';

	if (makeComment($conn, $eventid, $userid, $desc) !== FALSE)
		$data = "Comment added";
	else
		$data = "Unable to add comment.";
	
	echo json_encode($data);
}

function submitdCommentHelper($conn) 
{
	echo json_encode("Tddest");
}