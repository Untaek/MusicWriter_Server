<?php

	include_once "./dbconn.php";

	$userID = $_POST['id'];
	$sheetID = $_POST['sheetid'];
	
	$result = mysqli_query($conn,
	"SELECT like_music FROM users
	 WHERE userID='$userID'") or die(mysqli_error($conn));

	$user_likes = mysqli_fetch_assoc($result)['like_music'];

    $array = json_decode($user_likes);
	$isIn = in_array($sheetID, $array);
	if(!$isIn){
		array_push($array, $sheetID);
		$json = json_encode($array);
		
		mysqli_query($conn,
		"UPDATE users
		 SET like_music='$json'
		 WHERE userID='$userID'"
		 ) or die(mysqli_error($conn));
		
		mysqli_query($conn,
		"UPDATE music_sheet
		SET likes=likes+1
		WHERE sheetID='$sheetID'"
		) or die(mysqli_error($conn));
			
		 echo 1;
	}else{
		echo "10";
		die;
	}
?>
