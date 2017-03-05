<!DOCTYPE html>
<html>
<head>
	<title></title>

<style type="text/css">
	.word{
		text-align: center;
		font-size: 18px;
	}
	.wordwrap{
		margin-bottom: 15px;
		border-bottom: 1px solid #aaaaaa;
		width: 100%;
	}
	h3{
		margin-top: 0;
	}
</style>


	<?php

		include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php';
		if(isset($_SESSION['user_id']))
			$user_id = $_SESSION['user_id'];

		if(!isset($user_id)){
			if(isset($_COOKIE['anonykeyword'])){
				$keywords = json_decode($_COOKIE['anonykeyword'], true);
			}
		}else{
			$searchsql = "SELECT Search FROM users WHERE User_id=$user_id";
			$searchquery = mysqli_query($conn, $searchsql);
			$keywords = json_decode(mysqli_fetch_assoc($searchquery)['Search'], true);
		}
	?>	
</head>
<body>
<div class="container">
	<div class="row">
		<h3>Recent search</h3>
	</div>
	<div class="wordwrap row">
	<?php
	if(isset($keywords)){
		for($i=count($keywords)-1; $i>=0; $i--){
			echo '<div class="word col-sm-2">
				<a href="/videos/search.php?keyword='.$keywords[$i].'">'.$keywords[$i].'</a>
				</div>';
		}
	}
		
	?>	
	</div>
</div>
</body>
</html>