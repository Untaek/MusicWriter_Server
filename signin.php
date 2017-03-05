<?php	

	include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php';

	$strid = $_POST["id"];
	$pw = $_POST["pw"];
	$email = $_POST["email"];
	
	$checkid = "select userID from users_server where userStrID='$strid'";
	$checkemail = "select userID from users_server where userEmail='$email'";
	$insert = "insert into users (userStrID) values ('$strid')";
	$insert_sdb = "insert into users_server (userID, userStrID, userPW, userEmail) 
				   values ('$id', '$strid', '$pw', '$email')";

	$query = mysqli_query($conn, $checkid) or die(mysqli_error($conn));
	if(mysqli_num_rows($query)>0){
	echo 10;
	die();
	}
	$query = mysqli_query($conn, $checkemail) or die(mysqli_error($conn));
	if(mysqli_num_rows($query)>0){
	echo 11;
	die();
	}

	mysqli_query($conn, $insert) or die(mysqli_error($conn));
	$query = mysqli_query($conn, "select last_insert_id()");
	$id = mysqli_fetch_assoc($query)['last_insert_id()'];
	$insert_sdb = "insert into users_server (userID, userStrID, userPW, userEmail) 
				   values ('$id', '$strid', '$pw', '$email')";

	mysqli_query($conn, $insert_sdb) or die ($conn);
	echo 1;

	mysqli_close($conn);
?>
