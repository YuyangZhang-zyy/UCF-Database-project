<?php
	session_start();
	include_once "includes/database-includes.php";
	include_once "includes/functions-includes.php";
?>
<link rel="stylesheet" href="css/headerstyle.css">

<head>
	<h1> College Event Website </h1>

	<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
	<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
	<!-- Font special for pages-->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<!-- Vendor CSS-->
	<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
	<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
	<!-- Main CSS-->
	<link href="css/main.css" rel="stylesheet" media="all">
</head>

<div class="topnav">
	<ul>
		<a class = "active" href = "index.php">Home</a>
		<?php
			// Header for logged in person
			if (isset($_SESSION["usersId"])) 
			{
				$usersId = $_SESSION["usersId"];
				echo "<a href = 'my_events.php'>My Events</a>";
				echo "<a href = 'my_rsos.php'>My RSOs</a>";
				echo "<a href = 'events.php'>Existing Events</a>";
				echo "<a href = 'rsos.php'>Existing RSOs</a>";
				if (isAdmin($conn, $usersId) !== FALSE)// Admin
					echo "<a href = 'createevent.php'>Create</a>";
				echo "<a href = 'requestevent.php'>Request</a>";
				if (isSuperAdmin($conn, $usersId) !== FALSE)// SuperAdmin
					echo "<a href = 'pendingevents.php'>Pending Events</a>";
				//if (isAdmin($conn, $usersId) === FALSE && isSuperAdmin($conn, $usersId) === FALSE)// Normal User
					//;
				echo "<a href = 'makerso.php'>Make An RSO</a>";
				echo "<a href = 'includes/logout-includes.php'>Log Out</a>";
			}
			else 
			{
				echo "<a href = 'signup.php'>Sign Up</a>";
				echo "<a href = 'login.php'>Log In</a>";
			}
		?>
	</ul>
</div>