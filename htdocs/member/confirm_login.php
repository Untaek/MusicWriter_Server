
<?php 

$pw = $_POST['pw'];
$email = $_POST['email'];
$autologin = $_POST['auto'];



include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';

$sql = "SELECT Email, Password, Nickname, User_id, User_id_crypt FROM users WHERE Email='$email'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);

$nickname = $data['Nickname'];
$id = $data['User_id'];
$idcrypt = $data['User_id_crypt'];
if($email != $data['Email'] || !password_verify($pw, $data['Password'])){
	echo 0;
}else{
	if($autologin){
		setcookie('autologin', $idcrypt, time()+60*60*24*7, '/', '127.0.0.1', false, true);
	}
	echo 1;
	session_start();
	$_SESSION['user_id'] = $id;
	$_SESSION['email'] = $email;
	$_SESSION['nickname'] = $nickname;
	$_SESSION['logined'] = true;
}
?>