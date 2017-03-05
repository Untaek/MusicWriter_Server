<?php

	include_once "./dbconn.php";

	$userID = $_POST['userID'];

	$m = "music_sheet";
	$u = "users";

	$result = mysqli_query($conn,
	"SELECT COUNT(*), SUM(music_sheet.likes), users.push 
	 FROM music_sheet INNER JOIN users 
	 ON music_sheet.uploadUserID=users.userID 
	 WHERE users.userID='$userID'"
	 ) or die(mysqli_error($conn));

	$data = mysqli_fetch_array($result);

		
	$json['sheets'] = $data[0];
	$json['likes'] = $data[1];
	$json['push'] = $data[2];
	if(!$json['likes']) $json['likes'] = 0;
		
	echo json_encode($json, JSON_UNESCAPED_UNICODE);



?>
