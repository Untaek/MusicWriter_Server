<?php
	include_once "./dbconn.php";
	
	$sheetID = $_POST['sheetid'];
	$userID = $_POST['userid'];

	$array = array();

	$result = mysqli_query($conn,
		"SELECT * FROM music_sheet
		where sheetID='$sheetID'"
	) or die(mysqli_error($conn));
	$data = mysqli_fetch_assoc($result);
	$array['list'] = $data;


	$result = mysqli_query($conn,
		"SELECT favorite_music FROM users
		 where userID='$userID'"
	) or die(mysqli_error($conn));
	$data = mysqli_fetch_assoc($result);
	$array['favorite'] = $data;
	

	echo json_encode($array);
?>
