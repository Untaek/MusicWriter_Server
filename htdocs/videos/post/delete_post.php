<?php

include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';

$id = $_GET['id'];
$sql = "DELETE FROM video_posts WHERE Post_id=$id";
$sql2 = "DELETE FROM comments WHERE Post_id=$id";

if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql)){
	echo 1;
}else{
	echo 0;
	echo mysqli_error($conn);
}

?>