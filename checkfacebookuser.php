<?php

	include "./dbconn.php";

	$id = $_POST['id'];
	$strID = $_POST['strid'];

	$result = mysqli_query($conn,
	"select * from users_facebook
	where userID='$id'") or die($conn);
	
	if($data = mysqli_fetch_assoc($result)['userID'] != $id){
		mysqli_query($conn,
		"insert into users
		(userID, userStrID) values ('$id', '$strID')"
		) or die(mysqli_error($conn));

		mysqli_query($conn,
		"insert into users_facebook
		(userID) values ('$id')") or die(mysqli_error($conn));
		echo 1;	
	}else{
		echo $data['userPic_url'];
	}
?>
