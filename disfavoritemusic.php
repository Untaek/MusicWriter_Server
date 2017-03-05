<?php

	include_once "./dbconn.php";

	$userID = $_POST['id'];
	$sheetID = $_POST['sheetid'];
	
	$result = mysqli_query($conn,
	"SELECT favorite_music FROM users
	 WHERE userID='$userID'") or die(mysqli_error($conn));

	$user_likes = mysqli_fetch_assoc($result)['favorite_music'];

    $array = json_decode($user_likes);
	$isIn = in_array($sheetID, $array);
	if($isIn){
		$index = array_search($sheetID, $array);
		array_splice($array, $index, 1);
		$json = json_encode($array);
		
		mysqli_query($conn,
		"UPDATE users
		 SET favorite_music='$json'
		 WHERE userID='$userID'"
		 ) or die(mysqli_error($conn));
	
		 echo 1;
	}else{
		echo "10";
		die;
	}
?>
