<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';

$index = $_GET['index'];

$commentsql = "SELECT Post_id FROM comments WHERE Post_id=$index";
$likesql = "SELECT Likes FROM video_posts WHERE Post_id=$index";

$commentquery = mysqli_query($conn, $commentsql);
$likequery = mysqli_query($conn, $likesql);

$commentrow = mysqli_num_rows($commentquery);
$likedata = mysqli_fetch_assoc($likequery);

$likes = $likedata['Likes'];
$comments = $commentrow;
$isLiked = "";

if(isset($_SESSION['user_id'])){
	$id=$index;
	$user_id = $_SESSION['user_id'];
	$conn = mysqli_connect('127.0.0.1', 'root', 'a1234567', 'novaplayer');

	$likeselectsql = "SELECT Likes, Likes_user_id FROM video_posts WHERE Post_id=$id";
	$checkusersql = "select json_search(Likes_user_id, 'one' ,'$user_id') from video_posts where Post_id=$id";

	$likesquery = mysqli_query($conn, $likeselectsql);
	$likesdata = mysqli_fetch_assoc($likesquery);

	
	$thumb = "<span class='glyphicon glyphicon-thumbs-up'></span>";
	if(json_encode(mysqli_fetch_assoc(mysqli_query($conn, $checkusersql))["json_search(Likes_user_id, 'one' ,'$user_id')"])!='null'){
		$isLiked = '<script type="text/javascript">
			$(function(){
				$("#likebtn").removeClass("btn-primary");
				$("#likebtn").addClass("btn-success");
				$("#likebtn").html("'.$thumb.'Like!");
			})
			</script>';
	}else{
		
		$isLiked = '<script type="text/javascript">
			$(function(){
				$("#likebtn").removeClass("btn-success");
				$("#likebtn").addClass("btn-primary");
				$("#likebtn").html("'.$thumb.'");
			})
			</script>';
	}
}



$output = [$likes, $comments, $isLiked];

echo json_encode($output);

?>