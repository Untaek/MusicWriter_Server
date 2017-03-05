<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';

$commentid = $_POST['cmtid'];

if(isset($_SESSION['user_id'])){
	$password = '-1';
}else{
	$password = $_POST['cmtpw'];
}

$sql1 = "SELECT Password FROM comments WHERE Comment_id=$commentid";

$sql2 = "DELETE FROM comments WHERE Comment_id=$commentid";

$query = mysqli_query($conn, $sql1);
$pwdata = mysqli_fetch_assoc($query);

if($password == $pwdata['Password']){
	if($query = mysqli_query($conn, $sql2)){
		echo 1;
	}else{
		echo 0;
	}

}else{
	echo 0;
}


?>