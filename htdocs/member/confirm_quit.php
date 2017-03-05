<?php
session_start();
$id = $_SESSION['user_id'];
$pw = $_POST['pw'];

if(isset($id) && isset($pw)){
	include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php';

	$pwsql = "SELECT Password FROM users WHERE User_id=$id";
	$pwquery = mysqli_query($conn, $pwsql);
	$pwdata = mysqli_fetch_assoc($pwquery);
	if($pwdata['Password'] != $pw){
		exit();
	}else{
		$delsql = "DELETE FROM users WHERE User_id=$id";
		$delquery = mysqli_query($conn, $delsql);
		session_destroy();
		echo '<meta http-equiv="refresh"; content="0; url=/index.php">';
	}
}

?>