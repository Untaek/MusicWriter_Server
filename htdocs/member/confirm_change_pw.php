<?php
session_start();
$pw1 = $_POST['pw1'];
$pw2 = $_POST['pw2'];
$user = $_SESSION['user_id'];
$pwcrypt = password_hash($pw1, PASSWORD_BCRYPT);

if(isset($pw1) && isset($pw2) && isset($user)){
	include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';

	$sql = "UPDATE users SET Password='$pwcrypt' WHERE User_id=$user";
	$query = mysqli_query($conn, $sql);
	echo '<meta http-equiv="refresh"; content="0; url=/member/change_pw.php">';
}else{

}









?>