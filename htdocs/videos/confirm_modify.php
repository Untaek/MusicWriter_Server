<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';

	$postid = $_POST['postid'];
	$subject = $_POST['subject'];
	$category = $_POST['category'];
	$discription = $_POST['discription'];

	$sql = "UPDATE video_posts SET Subject='$subject', Category='$category', Discription='$discription' WHERE Post_id=$postid";

	

	if($query = mysqli_query($conn, $sql)){
		echo 1;
		echo '<meta http-equiv="refresh"; content="0; url=/videos/post/view.php?id=' .$postid. '">';
	}else{
		echo 0;
	}
?>