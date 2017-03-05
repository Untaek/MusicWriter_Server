<?php

	require "./dbconn.php";

	$cpw = $_POST['cpw'];
	$pw = $_POST['pw'];
	$id = $_POST['id'];

	$result = mysqli_query($conn,
	"select userStrID, userPW 
	from users_server 
	where userStrID='$id'") or die($conn);

	if($set = mysqli_fetch_assoc($result)){
		if(!strcmp($set['userPW'], $cpw)){
			mysqli_query($conn,
			"update users_server 
			set userPW='$pw'
			where userStrID='$id'") or die($conn);
		}
		else{
			echo 10;
			exit;
		}
	}
	else{
		echo 11;
		exit;
	}

	echo 1;





?>
