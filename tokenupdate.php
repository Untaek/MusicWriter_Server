<?php
	include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php';
	include_once('./vendor/autoload.php');
	use \Firebase\JWT\JWT;

	$id = $_POST['id'];

	$config = array(
		"digest_alg" => "sha512",
		"private_key_bits" => 1024,
		"private_key_type" => OPENSSL_KEYTYPE_RSA		
	);

	$s = "users_server"
	$check = "select $s.userID, $s.userPW, $s.userStrID, $s.userEmail, users.userPic_url 
	from users_server inner join users
	on users.userID=$s.userID
	where userStrID='$id'";
	
	$query = mysqli_query($conn, $check) or die($conn);
	$userInf = mysqli_fetch_assoc($query);
	$userID = $userInf['userID'];
	$userPW = $userInf['userPW'];
	$userStrID = $userInf['userStrID'];
	$userEmail = $userInf['userEmail'];
	$userPic_url = $userInf['userPic_url'];

		$skey = openssl_pkey_new($config);
		openssl_pkey_export($skey, $priv);

		$token = array(
			"iss" => "http://115.71.236.157",
			"userID" => $userID,
			"userStrID" => $userStrID,
			"userEmail" => $userEmail,
			"userPic_url" => $userPic_url
		);

		$jwt = JWT::encode($token, $priv);
		
		mysqli_query($conn,
		 "insert into user_token (userID, token, s_key) 
		 values ('$userID', '$jwt', '$priv') 
		 on duplicate key update 
		 userID='$userID', token='$jwt', s_key='$priv'")
		or die($conn);
	
		$return = array(
			"result" => 1,
			"jwt" => $jwt
		);

		echo json_encode($return);

	mysqli_close($conn);
?>
