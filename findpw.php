<?php
	include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php';
	require $_SERVER['DOCUMENT_ROOT']. '/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
	require $_SERVER['DOCUMENT_ROOT']. '/vendor/phpmailer/phpmailer/class.smtp.php';	
	$id = $_POST['id'];
	$email = $_POST['email'];

	$query = mysqli_query($conn,
		"select userEmail from users_server 
		where userStrID='$id' and userEmail='$email'")
		or die($conn);

	if(mysqli_num_rows($query)==0){
		echo 10;
		exit;
	}
	
	if($data = mysqli_fetch_assoc($query)){
	
		$tempPW = chr(rand(95,122)) . chr(rand(95,122)) . chr(rand(95,122))
			. chr(rand(95,122)) . chr(rand(95,122)) . chr(rand(95,122))
			. chr(rand(95,122)) . chr(rand(95,122)) . chr(rand(95,122))
			. chr(rand(95,122)) . chr(rand(95,122)) . chr(rand(95,122));
		$email = $data['userEmail'];
		
		$mail = new PHPMailer;
		
		$mail->IsSMTP();
		$mail->SMTPAuth = true;	
		$mail->SMTPSecure = 'tls';

		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;

		$mail->CharSet = 'utf-8';
		$mail->IsHTML(true);
		$mail->Username = "wkblack11@gmail.com";
		$mail->Password = "oxrepxwsrgwrlyxf";

		$mail->SetFrom('wkblack11@gmail.com', 'MusicWriter');
		$mail->AddAddress($email, $id);
		$mail->Subject = '임시 비밀번호가 생성 되었습니다';
		$mail->Body = 
		"임시 비밀번호는 ". $tempPW ." 입니다.".
		"<br>앱에서 로그인 후 비밀번호를 변경해주세요";

		if(!$mail->Send()){
			echo 20;
		}
		else{
			mysqli_query($conn,
				"update users_server set userPW='$tempPW' 
				where userStrID='$id'"
			) or die($conn);
			
			echo 1;
		}
	}
	else{
		echo 30;
	}
?>
