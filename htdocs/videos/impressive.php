<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
	<?php 
	$sort = $_GET['sort'];
	$category = substr(basename($_SERVER['PHP_SELF']), 0, -4);
	?>
	$(function(){
		$('#sort_btn a').on('click', function(){
			$('#sort_btn a').removeClass('active');
			$(this).addClass("active");
		});
		var category = "#<?php echo basename($_SERVER['PHP_SELF']) ?>";
		category = category.substring(0, category.length-4);
		console.log(category);
		$(category).addClass("active");
		$(category).addClass("btn-primary");
		$("#<?php echo $sort ?>").addClass("active");
	});
</script>
	<title>Videos</title>
</head>
<body>
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/res/topnav.php'
?>

<div class="container">
	<div class="btn-group btn-group-justified">
		<a id="all" href="all.php?sort=newest&page=1" class="btn btn-default">All</a>
		<a id="funny" href="funny.php?sort=newest&page=1" class="btn btn-default">Funny</a>
		<a id="impressive" href="impressive.php?sort=newest&page=1" class="btn btn-default">Impressive</a>
		<a id="information" href="information.php?sort=newest&page=1" class="btn btn-default">Information</a>
	</div>
	<div class="row">
		<div class="col-sm-7" style="">
			<div id="sort_btn" class="btn-group btn-group-justified" style="background-color:#eeeeee;">
				<a id="newest" href="<?php $_SERVER['PHP_SELF']; ?>?sort=newest&page=1" class="btn btn-default">Newest</a>
				<a id="likes" href="<?php $_SERVER['PHP_SELF']; ?>?sort=likes&page=1" class="btn btn-default">Likes</a>
				<a id="popular" href="<?php $_SERVER['PHP_SELF']; ?>?sort=popular&page=1" class="btn btn-default">Popular</a>
			</div>
			
		</div>
		<div class="col-sm-5">
			<div class="form-inline" style="float:right;">
				<input id="search" type="search" class="form-control" name="search" placeholder="Search">
				<button id="searchbutton" type="button" class="btn btn-info" name=""><span class="glyphicon glyphicon-search"></span></button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
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
	<a id="upload" href="#" class="btn btn-success">upload</a>
</div>
<script type="text/javascript">
	$(function(){
		$('#upload').on('click',  function(event) {
			event.preventDefault();
			/* Act on the event */
			if('<?= isset($_SESSION['user_id']); ?>'){
				location.href = 'upload.php';
			}else{
				alert('Please login');
			}
		});
	})
</script>
<div id="postwrap" class="container" style="margin-top:20px">
<?php include $_SERVER['DOCUMENT_ROOT'].'/videos/recent_search.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/videos/query_posts.php' ?>

</div>

</body>
</html>