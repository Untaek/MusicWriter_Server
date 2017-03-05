<?php

	include_once "./dbconn.php";

	$userID = $_POST['userID'];
	$state = $_POST['state'];
	$bool;
	if($state){
		$bool = 1;
		echo "t";
	}
	else{
		$bool = 0;
		echo "f";
	}

	mysqli_query($conn,
	"update users set push='$bool' where userID='$userID'"
	) or die(mysqli_error($conn));

?>
