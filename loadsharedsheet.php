<?php
	include_once "./dbconn.php";
	$sheetID = $_POST['sheetID'];

	$result = mysqli_query($conn,	
		"SELECT * FROM music_sheet
		 INNER JOIN users ON music_sheet.uploadUserID=users.userID  
		 WHERE music_sheet.sheetID='$sheetID'" 
	)or die(mysqli_error($conn));
	
	$data = mysqli_fetch_assoc($result);
	echo json_encode($data);

	
?>
