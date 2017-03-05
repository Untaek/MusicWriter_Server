<?php

	include_once "./dbconn.php";
	
	$amount = 7;
	$page = $_POST['page'] * $amount;
	$sort = $_POST['sort'];
	$userID = $_POST['userID'];
	$queryString = $_POST['query'];
	$me = $_POST['me'];

	if($sort==0){
		$order = "sheetID DESC";
	}
	else{
		$order = "likes DESC";
	}
	if($userID>0){
		$where = "WHERE uploadUserID=$userID";
	}
	if($queryString != '\''){
		$where = "WHERE title LIKE '%$queryString%'";
	}
	$result = mysqli_query($conn,
		"SELECT * FROM music_sheet
		".$where." 
		ORDER BY ". $order ." limit $page, $amount")
		or die(mysqli_error($conn));

	date_default_timezone_set('Asia/Seoul');
	$today = date('Y-m-d H:i:s');

	$array = array();
	$list = array();
	while($data = mysqli_fetch_assoc($result)){
		array_push($list, $data);
	}

	$result = mysqli_query($conn,
		"SELECT * from users
		WHERE userID='$me'"
	) or die (mysqli_error($conn));

	$mydata = mysqli_fetch_assoc($result);

	$array['today'] = $today;
	$array['mydata'] = $mydata;
	$array['list'] = $list;

	echo json_encode($array);

?>
