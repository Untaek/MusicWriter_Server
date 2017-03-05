<!DOCTYPE html>
<html>
<head>
	<title>confirm_signup</title>
</head>
<body>
	<?php 
	$nick = $_POST["nick"]; 
	$pw = $_POST['pw'];
	$email = $_POST['email'];

	$pwcrypt = password_hash($pw, PASSWORD_BCRYPT);

	$server = "127.0.0.1";
	$dbuser = "root";
	$dbpw = "a1234567";
	$dbname = "novaplayer";

	$connect = mysqli_connect($server, $dbuser, $dbpw, $dbname);

	if(!$connect){
		die(mysqli_connect_error());
	}

	$getid = 'asdass:sd'.time().'1w?DXCef';
	$id = password_hash($getid, PASSWORD_BCRYPT);

	$db = "INSERT INTO users (User_id_crypt, Email, Password, Nickname)
			VALUES ('$id', '$email', '$pwcrypt', '$nick')";

	if($nick != "" && $pw != "" && $email !=""){
		if (mysqli_query($connect, $db)){
		
		}else{
			echo mysqli_error($connect);
		}
	}
	

	?>

	<script type="text/javascript">
		location.replace("/index.php");
	</script>
</body>
</html>