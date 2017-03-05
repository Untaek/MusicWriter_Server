<?php

	include_once "./dbconn.php";

	$id = $_POST['id'];
	$url = base64_decode($_POST['imageurl']);
	
	$result = mysqli_query($conn,
	"update users set userPic_url='$url'
	where userID='$id'") or die($conn);

	echo 1;


?>
