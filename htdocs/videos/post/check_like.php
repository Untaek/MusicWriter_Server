<?php
	if(isset($_SESSION['user_id'])){
		$id=$_GET['id'];
		$user_id = $_SESSION['user_id'];
		$conn = mysqli_connect('127.0.0.1', 'root', 'a1234567', 'novaplayer');

		$likeselectsql = "SELECT Likes, Likes_user_id FROM video_posts WHERE Post_id=$id";
		$checkusersql = "select json_search(Likes_user_id, 'one' ,'$user_id') from video_posts where Post_id=$id";

		$likesquery = mysqli_query($conn, $likeselectsql);
		$likesdata = mysqli_fetch_assoc($likesquery);

		if(json_encode(mysqli_fetch_assoc(mysqli_query($conn, $checkusersql))["json_search(Likes_user_id, 'one' ,'$user_id')"])!='null'){
			$isLiked = "<span class='glyphicon glyphicon-thumbs-up'></span>";
			echo '<script type="text/javascript">
				$(function(){
					$("#likebtn").removeClass("btn-info");
					$("#likebtn").addClass("btn-success");
					$("#likebtn").html("'.$isLiked.'You like this video!");
				})
				</script>';
		}
	}
?>

