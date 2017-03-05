<?php
	session_start();
	$conn = mysqli_connect('127.0.0.1', 'root', 'a1234567', 'novaplayer');

	$url = $_GET['video_url'];
	$subject = $_GET['subject'];
	$discription = $_GET['discription'];
	$category = $_GET['category'];
	$user= $_SESSION['user_id'];
	$email= $_SESSION['email'];
	
	$day = $_GET['day'];
	$time = $_GET['time'];
	$nick = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Nickname FROM users WHERE User_id=$user"))['Nickname'];

	$save = "INSERT INTO video_posts (User_id, Email, Subject, Video_url, Discription, Day, Time, Runningtime, Category, Nickname, Likes_user_id) VALUES ('$user', '$email', '$subject', '$url', '$discription', '$day', '$time', '00:00', '$category', '$nick', '[]')";

	$addpost = "UPDATE users SET Posts = Posts+1 WHERE User_id=$user";

	if($url != "" && $subject !="" && $category !=""){
		if(mysqli_query($conn, $save)){
			mysqli_query($conn, $addpost);
			echo 'true';
		}else{
			echo 'false';
			echo mysqli_error($conn);
		}
	}else{
		echo "must fill all blank";
	}
	

	mysqli_close($conn);
?>