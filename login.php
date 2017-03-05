<?php
	include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php';
	include_once('./vendor/autoload.php');
	use \Firebase\JWT\JWT;

	$id = $_POST['id'];
	$pw = $_POST['pw'];
	$fcm = $_POST['fcm'];

	$config = array(
		"digest_alg" => "sha512",
		"private_key_bits" => 1024,
		"private_key_type" => OPENSSL_KEYTYPE_RSA		
	);

	$s= "users_server";

	$check = "select $s.userID, $s.userPW, users.userStrID, $s.userEmail, users.userPic_url, users.push 
	from users_server inner join users
	on users.userID=$s.userID
	where users.userStrID='$id'";
	
	$query = mysqli_query($conn, $check) or die($conn);	
	
	$query_fcm = mysqli_query($conn,
	"SELECT * from token_fcm where token='$fcm'"
	) or die(mysqli_error($conn));
	$arr_fcm = mysqli_fetch_assoc($query_fcm);
	$id_fcm = $arr_fcm['id'];
	$to_fcm = $arr_fcm['token'];
/*
	mysqli_query($conn,
	"UPDATE users SET token_fcm='NULL'
	 WHERE token_fcm='$fcm'"
	) or die(mysqli_error($conn)); 
 */
	mysqli_query($conn,
	"UPDATE users SET token_fcm='$fcm'
	 WHERE userStrID='$id'"
     ) or die(mysqli_error($conn));
	
	$userInf = mysqli_fetch_assoc($query);
	$userID = $userInf['userID'];
	$userPW = $userInf['userPW'];
	$userStrID = $userInf['userStrID'];
	$userEmail = $userInf['userEmail'];
	$userPic_url = $userInf['userPic_url'];
	$push = $userInf['push'];

	if($userPW == $pw){
		$skey = openssl_pkey_new($config);
		openssl_pkey_export($skey, $priv);

		$token = array(
			"iss" => "http://115.71.236.157",
			"userID" => $userID,
			"userStrID" => $userStrID,
			"userEmail" => $userEmail,
			"userPic_url" => $userPic_url,
			"push" => $push
		);

		$jwt = JWT::encode($token, $priv);
		
		mysqli_query($conn,
		 "update users_server 
		 set token='$jwt', s_key='$priv'
		 where userId='$userID'"
		 ) or die($conn);
		
		$return = array(
			"result" => 1,
			"jwt" => $jwt
		);

		echo json_encode($return);
	}
	else{
		echo 10;
	}

	

	mysqli_close($conn);
?>
