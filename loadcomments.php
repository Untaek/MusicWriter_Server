<?php
	include_once "./dbconn.php";

	$sheetID = $_POST['sheetID'];
	$page = $_POST['page'];
	$n = $page*7;

	$result = mysqli_query($conn,
	"SELECT * FROM comment
	 INNER JOIN users ON users.userID=comment.userID
	 WHERE sheetID='$sheetID' 
	 ORDER BY uploadTime DESC
	 LIMIT $n, 7" 
	) or die(mysqli_error($conn));

	$array = array();

	while($data = mysqli_fetch_assoc($result)){
		array_push($array, $data);
	}

	$result = mysqli_query($conn,
	"SELECT comments FROM music_sheet
	 WHERE sheetID='$sheetID'"
	) or die(mysqli_error($conn));

	$count = mysqli_fetch_array($result)[0];
	date_default_timezone_set('Asia/Seoul');
	$today = date('Y-m-d H:i:s');
	$json = array(
				"count" => $count,
				"comments" => $array,
				"today" => $today
			);

	echo json_encode($json);
?>
