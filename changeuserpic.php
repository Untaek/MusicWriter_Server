<?php
	$base = "user_pic/";
	$path = $base. basename($_FILES['file']['name']);	
	$fileurl = "http://115.71.236.157/".$path;

	if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){
		include "./dbconn.php";

		$id = explode("_", $_FILES['file']['name'])[1];

		$result = mysqli_query($conn,
		"update users 
		set userPic_url='$fileurl'
		where userID='$id'") or die($conn);
		
		$val = array("result" => 1, "url" => $fileurl);

		echo json_encode($val);
	}
	else{
		echo 10;
	}

?>
