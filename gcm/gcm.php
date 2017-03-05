<?php	

	function send_noti($token, $title, $content, $url, $imageUrl)
	{
		$gcmUrl = "https://gcm-http.googleapis.com/gcm/send";
		$serverKey = "AIzaSyCeI-nAyeLPfd9SWeJAZxgsLNV3kZL3FGs";
		
		$fields = array(
				"to" => $token,
				"data" => array(
							"title" => $title,
							"content" => $content,
							"url" => $url,
							"imageUrl" => $imageUrl,
						  )	
				);

		$headers = array(
				'Authorization:key ='.$serverKey,
				'Content-Type:application/json'
				);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $gcmUrl);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
		$result = curl_exec($ch);           
		if ($result === FALSE) {
		   die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}
	
	$token = $_POST['token'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$url = $_POST['url'];
	$imageUrl = $_POST['image'];
	if($imageUrl == "")
		unset($imageUrl);

	echo send_noti($token, $title, $content, $url, $imageUrl);
?>
