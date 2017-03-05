<?php

	include_once "./dbconn.php";

	$comment = $_POST['comment'];
	$userID = $_POST['userID'];
	$sheetID = $_POST['sheetID'];
	$userStrID = $_POST['userStrID'];

	mysqli_query($conn,
	"INSERT INTO comment
	(sheetID, userID, commentText) VALUES
	('$sheetID', '$userID', '$comment')")
	 or die(mysqli_error($conn)); 

	mysqli_Query($conn,
	"UPDATE music_sheet
	 SET comments = comments + 1
	 WHERE sheetID='$sheetID'"
	 ) or die(mysqli_error($conn));
	
	 echo 1;






?>
