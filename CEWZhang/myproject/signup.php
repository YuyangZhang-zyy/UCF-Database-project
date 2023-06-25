<?php include_once "header.php" ?>

<h2> Sign Up </h2>
<div class="card card-1">
	<div class="card-body">
		<?php
			// Error handling
			if(isset($_GET["error"])) 
			{
				if ($_GET["error"] == "empty_input")
					echo "<p style='color:#500'>All fields are required to fill!<br><br></p>";
				if ($_GET["error"] == "invalid_username")
					echo "<p style='color:#500'>Username can only be composed of NUMBERS or ALPHABETS!<br><br></p>";
				if ($_GET["error"] == "pwd_mismatch")
					echo "<p style='color:#500'>Your passwords do not match!<br><br></p>";
				if ($_GET["error"] == "nonunique_username")
					echo "<p style='color:#500'>Username already exists!<br><br></p>";
				if ($_GET["error"] == "bad_stmt")
					echo "<p style='color:#500'>Database error!<br><br></p>";
				if ($_GET["error"] == "none") 
					echo "<p style='color:#500'>Sign up successfully!<br><br></p>";
			}
		?>
		<form action="signup-superadmin.php" method="post">
			<div class="input-group">
				<input class="input--style-1" type="text" name="uname" placeholder="Username">
			</div>
			<div class="input-group">
				<input class="input--style-1" type="password" name="pwd" placeholder="Password">
			</div>
			<div class="input-group">
				<input class="input--style-1" type="password" name="pwdrepeat" placeholder="Repeat Your Password">
			</div>
			<div class="input-group">
				<input class="input--style-1" type="text" name="uniname" placeholder="University Name...">
			</div>
			<div class="p-t-20">
				<button class="btn btn--radius btn--green" type="submit" name="submit">Sign Up</button>
			</div>
		</form>
	</div>
</div>