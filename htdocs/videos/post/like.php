<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		echo -1;
		exit;
	}

	$id=$_GET['id'];
	$user_id = $_SESSION['user_id'];
	$conn = mysqli_connect('127.0.0.1', 'root', 'a1234567', 'novaplayer');

	$likeupdatesql = "UPDATE video_posts SET Likes=Likes+1 WHERE Post_id=$id";
	$likeselectsql = "SELECT Likes, Likes_user_id FROM video_posts WHERE Post_id=$id";
	$likeuserupdatesql = "UPDATE video_posts SET Likes_user_id=json_array_append(Likes_user_id, '$', '$user_id') WHERE Post_id=$id";
	$checkusersql = "select json_search(Likes_user_id, 'one' ,'$user_id') from video_posts where Post_id=$id";

	$likesquery = mysqli_query($conn, $likeselectsql);
	$likesdata = mysqli_fetch_assoc($likesquery);

	if(json_encode(mysqli_fetch_assoc(mysqli_query($conn, $checkusersql))["json_search(Likes_user_id, 'one' ,'$user_id')"])=='null'){
		mysqli_query($conn, $likeuserupdatesql);
		mysqli_query($conn, $likeupdatesql);
	}else{
		echo 0;
		exit;
	}

	echo mysqli_fetch_assoc(mysqli_query($conn, $likeselectsql))['Likes'];
?>