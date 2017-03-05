<?php
    include_once "./dbconn.php";

    $id = $_POST['id'];

    $result = mysqli_query($conn,
    "select * from users_facebook
	inner join users
	on users.userID=users_facebook.userID
    where userID='$id'") or die($conn);

    if($data = mysqli_fetch_assoc($result)){
        $json = array(
			"result" => 1,
            "userID" => $data['userID'],
            "userToken" => $data['userToken'],
            "userPic_url" => $data['userPic_url'],
            "favorite_music" => $data['favorite_music'],
            "like_music" => $data['like_music'],
			"push" => $data['push']
        );

        echo json_encode($json);
    }
    else{
        echo 10;
    }
?>
