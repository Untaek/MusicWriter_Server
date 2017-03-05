<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/res/topnav.php'
?>
<?php include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php' ?>
<?php
	$user = $_SESSION['user_id'];
	$sql = "SELECT Email, Nickname, Posts, Comments FROM users WHERE User_id='$user'";
	$cmtsql = "SELECT User_id FROM comments WHERE User_id='$user'";
	$postsql = "SELECT User_id FROM video_posts WHERE User_id='$user'";
	$query1 = mysqli_query($conn, $sql);
	$query2 = mysqli_query($conn, $cmtsql);
	$query3 = mysqli_query($conn, $postsql);
	
	$cmt = mysqli_num_rows($query2);
	$post = mysqli_num_rows($query3);
	$data = mysqli_fetch_assoc($query1);

?>
<div id="wrap">
	<div class="row" style="width:1200px; margin:0 auto;">
		<?php include $_SERVER['DOCUMENT_ROOT']. '/member/mypage_nav.php'; ?>
		<div id="right-content-wrap" class="col-sm-8">
			<h1>E-mail</h1>
			<h4><?= $data['Email']; ?></h4>

			<h1>Nickname</h1>
			<h4><?= $data['Nickname']; ?></h4>

			<h2>Posts</h2>
			<h4><?= $post; ?></h4>

			<h2>Comments</h2>
			<h4><?= $cmt; ?></h4>
		</div>
	</div>
</div>
</body>
</html>