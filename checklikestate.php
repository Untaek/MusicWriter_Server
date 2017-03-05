<?php
	include_once "./dbconn.php";
	
	$userID = $_POST['userID'];
	$sheetID = $_POST['sheetID'];

	$result = mysqli_query($conn,
	"SELECT like_music FROM users 
	 WHERE userID='$userID'"
	 ) or die(mysqli_error($conn));

	$data = mysqli_fetch_array($result)[0];

	$array = json_decode($data);

	$isIn = in_array($sheetID, $array);

	if(!$isIn){
		echo 1;
	}
	else{
		echo 2;
	}






?>
