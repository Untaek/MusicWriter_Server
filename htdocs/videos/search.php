<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<title>Search</title>
	<style type="text/css">
	</style>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/res/topnav.php'; ?>

<?php include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php'; ?>
<?php 
$keyword = $_GET['keyword'];
if(isset($_SESSION['user_id'])) $userid = $_SESSION['user_id'];
if(!isset($userid) && !empty($keyword)){
	$i = 0;
	if(!isset($_COOKIE['anonykeyword'])){
		$keywords = array();
	}else{
		$keywords = json_decode($_COOKIE['anonykeyword']);
	}

	while (1){
		if(!empty($keywords[$i])){
			$i++;
		}else{
			if($keywords[$i-1] != $keyword){
				$keywords[$i] = $keyword;
			}
			break;
		}
	}
	if(count($keywords)>6){
		$keywords = array_slice($keywords, count($keywords)-6);
	}

	setcookie('anonykeyword', json_encode($keywords), time()+60*60*24*365);
}else if(isset($userid) && !empty($keyword)){
	$i = 0;
	$getsearchsql = "SELECT Search FROM users WHERE User_id=$userid";

	$searchquery = mysqli_query($conn, $getsearchsql);
	$searchdata = mysqli_fetch_assoc($searchquery);

	$keywords = json_decode($searchdata['Search']);

	while (1) {
		if(!empty($keywords[$i])){
			$i++;
		}else{
			if($keywords[$i-1] != $keyword){
				$keywords[$i] = $keyword;
			}
			break;
		}
	}
	$keywords[$i] = $keyword;

	if(count($keywords)>6){
		$keywords = array_slice($keywords, count($keywords)-6);
	}
	$keywords = json_encode($keywords, JSON_UNESCAPED_UNICODE);
	$searchsql = "UPDATE users SET Search='$keywords' WHERE User_id=$userid";

	$savequery = mysqli_query($conn, $searchsql);
}

$sql = "SELECT * FROM video_posts WHERE Subject LIKE '%$keyword%' ORDER BY Day DESC, Time DESC";
?>
<script type="text/javascript">
	$(function(){
		$('#search').val('<?= $keyword; ?>');


		$('#searchbutton').on('click', function(event) {
			event.preventDefault();
			/* Act on the event */
			var keyword = $('#search').val();
			location.href = "/videos/search.php?keyword="+keyword;
		});
		$('#search').on('keyup', function(event) {
			event.preventDefault();
			/* Act on the event */
			if(event.which == 13){
				var keyword = $('#search').val();
				location.href = "/videos/search.php?keyword="+keyword;
			}
		});
	});
</script>

<div class="container">
	<div class="row">
		<div class="col-sm-7 form-inline">
			<input style="width:80%" id="search" type="search" class="form-control" name="search" placeholder="Search">
			<button id="searchbutton" type="button" class="btn btn-info" name=""><span class="glyphicon glyphicon-search"></span></button>
		</div>
	</div>
	<!--
	<div class="row">
		<div id="conditionwrap">
			<p>
			<label class="radio-inline"><input type="radio" name="category" value="all">All</label>
			<label class="radio-inline"><input type="radio" name="category" value="funny">Funny</label>
			<label class="radio-inline"><input type="radio" name="category" value="impressive">Impressive</label>
			<label class="radio-inline"><input type="radio" name="category" value="information">Information</label>
			</p>
			<p>
			<label class="radio-inline"><input type="radio" name="sort" value="newest">Newest</label>
			<label class="radio-inline"><input type="radio" name="sort" value="likes">Likes</label>
			<label class="radio-inline"><input type="radio" name="sort" value="popular">Popular</label>
			</p>
		</div>
	</div>
	-->
</div>

<div id="postwrap" class="container" style="margin-top:20px"> <!-- start  -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/videos/recent_search.php' ?>

<?php

if($query = mysqli_query($conn, $sql)){

	if(mysqli_num_rows(mysqli_query($conn, $sql))==0){
		echo "<h1 style='text-align:center;'>Can not found anything</h1>";
	}

	while ($data = mysqli_fetch_assoc($query)) {
		$subject = $data['Subject'];
		$id = $data['Post_id'];
		$day = $data['Day'];
		$time = $data['Time'];
		$video_url = $data['Video_url'];
		$category = $data['Category'];
		$nick = $data['Nickname'];
		$likes = $data['Likes'];
		$views = $data['Views'];
		$comments = $data['Comments'];

echo '<div class="post well" style="height:110px;">';
echo		'<a href="/videos/post/view.php?id='.$id.'"><img style="width:110px; height:100%; background-color:#aaaaaa; display:block; float:left; position:relative; margin-right:15px" src="https://i.ytimg.com/vi/'.$video_url.'/default.jpg"/></a>';
echo		'<div>';
echo			'<div style="float:left">';
echo				'<h2 style="margin:0; text-overflow:ellipsis;"><a class="subject" href="/videos/post/view.php?id='.$id.'" style="margin:0">'.$subject.'</a></h2>';
echo				'<p style="margin:0"><a class="videourl" href="https://www.youtu.be/'.$video_url.'">https://www.youtu.be/'.$video_url.'</a> - youtube</p>';
echo				'<p style="margin:0"><span class="duration">06:25</span> - <span class="nick">'.$nick.'</span><span class="views" style="margin-left:10px">views : '.$views.'</span><span class="likes" style="margin-left:10px">likes : '.$likes.'</span><span class="comment" style="margin-left:10px">comments : '.$comments.'</span></p>';
echo			'</div>';
echo			'<div style="float:right">';
echo				'<label style="float:right;" class="category label label-primary">'.$category.'</label>';
				
echo				'<p class="day" style="text-align:right">'.$day.'</p>';
echo				'<p class="time" style="text-align:right">'.$time.'</p>';
echo			'</div>';
echo			'<div style="clear:both;"></div>';
echo		'</div>';
echo	'</div>';
	}

	
	mysqli_close($conn);
?>

</div> <!-- end -->

<?php
}else{
	die("query error");
}

?>
</body>
</html>