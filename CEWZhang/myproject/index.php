<?php include_once "header.php"; ?>

<html>
<head><title>COP 4710 Database Project</title></head>
<body>
<?php
	if (isset($_SESSION["usersId"]))
		echo "<h2>Welcome, " . $_SESSION['usersName'] . "!</h2>";
?>
<h4> Click The Tabs Above To Manage Your College Events Now! </h4>
<img src="HP.jpg" alt="My Image">
</body>
</html>