<?php
	$servernameAsterisk = "localhost";
	$usernameAsterisk = "intrade_apu";
	//$usernameAsterisk = "root";
	$passwordAsterisk = "Q04+o%?(!!f^";
	//$passwordAsterisk = "m";
	$dbnameAsterisk = "asterisk";

	// Create connection
	$connAsterisk = mysqli_connect($servernameAsterisk, $usernameAsterisk, $passwordAsterisk, $dbnameAsterisk);
	// Check connection
	if (!$connAsterisk) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>