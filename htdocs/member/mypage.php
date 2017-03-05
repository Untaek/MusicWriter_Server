<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<title>mypage</title>

<style type="text/css">
	#wrap{
		width: 1300px;
		margin: 0 auto;
	}
	#left-menu-wrap{
		background-color: #eeeeee;
	}
	#right-content-wrap{
		background-color: #aaaaaa;
	}
</style>

</head>
<body>
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/res/topnav.php'
?>
<?php ?>
<div id="wrap">
	<div class="row">
		<?php include $_SERVER['DOCUMENT_ROOT']. '/member/mypage_nav.php'; ?>
		
		<div id="right-content-wrap" class="col-sm-8">
		</div>
	</div>
</div>
</body>
</html>