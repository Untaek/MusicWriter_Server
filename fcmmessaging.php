<?php

	include_once"./dbconn.php";
	
	$userID = $_POST['userID'];
	$sheetID = $_POST['sheetID'];

	function send_noti($token, $sheet, $title, $content)
	{
		$url = "https://fcm.googleapis.com/fcm/send";
		$serverKey = "AIzaSyBYNiZKos0MRRsu7x9DZTyJbrS_DyXTaaM";	
		
		$fields = array(
				"to" => $token,
				"data" => array(
									"title" => $title,
									"text" => $content,
									"sheetID" => $sheet
									)	
				);

		$headers = array(
				'Authorization:key ='.$serverKey,
				'Content-Type: application/json'
				);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);           
		if ($result === FALSE) {
		   die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}
	
	$result = mysqli_query($conn,
	"SELECT token_fcm from users
	 WHERE userID='$userID'"
	 ) or die(mysqli_error($conn));
		
	$token = mysqli_fetch_array($result)[0];

	$title = "게시한 악보에 댓글이 달렸습니다";
	$content = "확인하려면 터치하세요";

	echo send_noti($token, $sheetID, $title, $content);

?>
