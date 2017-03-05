<?php

	include_once "./dbconn.php";

	$userID = $_POST['userid'];

	mysqli_query($conn,
	"UPDATE users
	SET userPic_url='0'
	WHERE userID='$userID'"
	) or die(mysqli_error($conn));

	echo 1;
?>
