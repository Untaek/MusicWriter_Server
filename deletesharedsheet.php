<?php

	include_once "./dbconn.php";

	$userID = $_POST['userid'];
	$sheetID = $_POST['sheetid'];

	mysqli_query($conn,
	"DELETE FROM music_sheet
	 WHERE sheetID='$sheetID'"
	 ) or die(mysqli_error($conn));

	//mysqli_query($conn,
	//"DELETE FROM comment
	//WHERE sheetID='$sheetID'"
	//) or die(mysqli_error($conn));


	echo 1;
	








?>
