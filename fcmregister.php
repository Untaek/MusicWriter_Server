<?php

	include_once "./dbconn.php";

	$token = $_POST['userToken'];

	mysqli_query($conn,
	"DELETE FROM token_fcm 
	 WHERE token='$token'"
	 ) or die($mysqli_error($conn);

	mysqli_query($conn,
	"INSERT INTO token_fcm (token)
	 VALUES ('$token')"
	 ) or die(mysqli_error($conn));


?>
