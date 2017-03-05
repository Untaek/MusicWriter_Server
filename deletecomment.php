<?php

	include_once "./dbconn.php";

	$commentID = $_POST['commentid'];
	$sheetID = $_POST['sheetid'];

	mysqli_query($conn,
	"DELETE FROM comment
	 WHERE commentID='$commentID'"
	 ) or die(mysqli_error($conn));

	mysqli_query($conn,
	"UPDATE music_sheet
	SET comments = comments - 1
	WHERE sheetID='$sheetID'"
	) or die(mysqli_error($conn));


	echo 1;
	








?>
