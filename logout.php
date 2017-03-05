<?php

	require_once "./dbconn.php";

	$userID = $_POST['userid'];

	mysqli_query($conn,
		"UPDATE users SET token_fcm=' '
		 WHERE userID='$userID'"
	 ) or die(mysqli_error($conn));

?>
