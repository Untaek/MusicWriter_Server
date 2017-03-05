<?php
	include_once "./dbconn.php";

	$userID = $_POST['id'];

	$result = mysqli_query($conn,
	"SELECT favorite_music FROM users
	 WHERE userID='$userID'"
	) or die(mysqli_error($conn));

	$data = mysqli_fetch_array($result)[0];
	$array = json_decode($data);

	$result = mysqli_query($conn,
	"SELECT * FROM music_sheet
	 WHERE sheetID IN (". implode(',', $array) .")"
	 ) or die(mysqli_error($conn));

	date_default_timezone_set('Asia/Seoul');
	$today = date('Y-m-d H:i:s');
	
	$final = array();
	$list = array();
	
	while($data = mysqli_fetch_assoc($result)){
		array_push($list, $data);
	}

	$final['today'] = $today;
	$final['list'] = $list;
	
	echo json_encode($final, JSON_UNESCAPED_UNICODE);
?>
