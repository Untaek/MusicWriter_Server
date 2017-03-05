<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'] . '/dbconn.php';
	$user = $_SESSION['user_id'];
	$pw = $_POST['pw'];
	

	$sql = "SELECT Password FROM users WHERE User_id=$user";

	$query = mysqli_query($conn, $sql);

	$data = mysqli_fetch_assoc($query);

	$pwcrypt = password_verify($pw, $data['Password']);
	if($pwcrypt){
		echo 1;
	}else{
		echo 0;
	}
?>