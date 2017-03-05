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

<div id="wrap">
	<div class="row" style="width:1200px; margin:0 auto;">
		<?php include $_SERVER['DOCUMENT_ROOT']. '/member/mypage_nav.php'; ?>
		
		<div id="right-content-wrap" class="col-sm-8">
			<h1>Quit Us</h1>
			<form action="confirm_quit.php" method="post">
				<h4>Password</h4>
				<input class="form-control" type="password" name="pw">
				<h3>Are you Sure?</h3>
				<button type="submit" class="btn btn-warning">YES I WANT TO QUIT</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>