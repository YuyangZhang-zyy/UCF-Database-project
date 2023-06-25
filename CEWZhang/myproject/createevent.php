<?php include_once "header.php" ?>

<h2> Create An Event For Your RSO </h2>

<?php
	if (!isset($_SESSION["usersId"]) OR isAdmin($conn, $usersId) === FALSE)
		header("location: index.php");
?>

<div class="card card-1">
	<div class="card-body">
		<?php
			if(isset($_GET["error"])) 
			{
				if ($_GET["error"] == "empty_input")
					echo "<p style='color:#500'>All fields are required to fill!<br><br></p>";
				if ($_GET["error"] == "bad_stmt") 
					echo "<p style='color:#500'>Database error!<br><br></p>";
				if ($_GET["error"] == "time_place_conflict") 
				{
					if(isset($_GET["datetime"]) AND isset($_GET["lat"]) AND isset($_GET["long"]))
						echo "<p style='color:#500'>Event already exists on ".$_GET["datetime"]."<br>at LATITUDE= " .$_GET["lat"]. ", LONGITUDE= ".$_GET["long"].".<br><br></p>";
					else 
						echo "<p style='color:#500'>Event already exists!<br><br></p>";
				}
				if ($_GET["error"] == "invalid_access") 
					echo "<p style='color:#500'>Unauthorized to create an event for this RSO.<br><br></p>";
				if ($_GET["error"] == "none") 
					echo "<p style='color:#500'>Event submitted.<br><br></p>";
			}
		?>
		<form action="includes/createevent-includes.php" method="post">
			<h4><b>EVENT INFOMATION</b></h4>
			<div class="input-group">
				<div class="rs-select2 js-select-simple select--no-search">
					<select name="rsoid" required>
						<?php
							$userid = $_SESSION["usersId"];
							$activersodata = getActiveRSOs($conn, $userid);
							$x = 0;
							while ($row = mysqli_fetch_assoc($activersodata)) 
							{
								$x = $x + 1;
								$rsoid = $row["rsosId"];
								$rsoname = $row["rsosName"];
								echo "<option value=$rsoid>$rsoname</option>";
							}
							if ($x === 0)
								echo "<option disabled='disabled' selected='selected'>NO ACTIVE RSOs</option>";
							else
								echo "<option disabled='disabled' selected='selected'>SELECT RSO</option>";
						?>
					</select>
					<div class="select-dropdown"></div>
				</div>
			</div>
			<div class="input-group">
				<input class="input--style-1" type="text" name="eventname" placeholder="Your Event Name..." required>
			</div>
			<div class="input-group">
				<input class="input--style-1" type="text" name="eventdesc" placeholder="Your Event Description..." required>
			</div>
			<div class="input-group">
				<input class="input--style-1" type="tel" id="eventphone" name="eventphone" placeholder="Contact Number: 123-456-7890"
					pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
			</div>
			<h4><b>EVENT DATE AND TIME</b></h4>
			<div class="input-group">
				<input class="input--style-1" type="date" name="eventdate" placeholder="Your Event Date..." required>
				<i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
			</div>
			<div class="row row-space">
				<div class="col-2">
					<div class="input-group">
						<div class="rs-select2 js-select-simple select--no-search">
							<select name="eventtime" required>
								<?php
									$select = 0;
									for ($i = 0; $i < 12; $i++) 
									{
										$select = (($i + 11) % 12) + 1;
										echo "<option value=$select>$select</option>";
									}
								?>
							</select>
							<div class="select-dropdown"></div>
						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="input-group">
						<div class="rs-select2 js-select-simple select--no-search">
							<select name="eventtime2" required>
								<option value="am">AM</option>
								<option value="pm">PM</option>
							</select>
							<div class="select-dropdown"></div>
						</div>
					</div>
				</div>
			</div>
			<h4><b>EVENT LOCATION</b></h4>
			<div class="row row-space">
				<div class="col-2">
					<div class="input-group">
						<input class="input--style-1" type="text" name="eventlat" placeholder="Your Event Location Latitude..." required>
					</div>
				</div>
				<div class="col-2">
					<div class="input-group">
						<input class="input--style-1" type="text" name="eventlong" placeholder="Your Event Location Longitude..." required>
					</div>
				</div>
			</div>
			<h4><b>EVENT TYPE</b></h4>
			<div class="input-group">
				<div class="rs-select2 js-select-simple select--no-search">
					<select name="eventtype" required>
						<option disabled="disabled" selected="selected">Select Your Event Type...</option>
						<option value="public">Public</option>
						<option value="private">Private</option>
						<option value="rso">RSO</option>
					</select>
					<div class="select-dropdown"></div>
				</div>
			</div>
			<div class="p-t-20">
				<button class="btn btn--radius btn--green" type="submit" name="submitrequestevent">Submit</button>
			</div>
		</form>
	</div>
</div>

<?php include_once "footer.php"; ?>