<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<title>Videos</title>
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius:0;">
  <div class="container-fluid">
    <div class="navbar-header" style="width:100%;">
      <a class="navbar-brand"  style="width: 100%; padding: 40px; margin:0; text-align:center; font-size:30px;" href="/index.php">TEAMNOVA</a>
    </div>
    <ul class="nav navbar-nav" style="margin:0 auto">
      <li><a href="/index.php">Home</a></li>
      <li class="active"><a href="/videos/all.php">Videos</a></li>
      <li><a href="#">Page 2</a></li> 
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li id=signup_nav><a href="/member/join.php?page=signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li id=login_nav><a href="/member/join.php?page=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

<div class="container">
	<div class="btn-group btn-group-justified">
		<a href="#" class="btn btn-default active">All</a>
		<a href="#" class="btn btn-default">Funny</a>
		<a href="#" class="btn btn-default">Impressive</a>
		<a href="#" class="btn btn-default">Information</a>
	</div>
	<div class="row"">
		<div class="col-sm-7">
		<div class="btn-group btn-group-justified">
			<div class="btn-group">
			<button type="button" class="btn btn-default">Newest</button></div>
			<div class="btn-group">
			<button type="button" class="btn btn-default">Likes</button></div>
			<div class="btn-group">
			<button type="button" class="btn btn-default">Popular</button></div>
		</div>
		</div>
		<div class="col-sm-3">
			<input type="search" name="">
		</div>
	</div>
</div>

<div class="container" style="margin-top:20px">
	<div class="well">
		<div style="width:110px; height:70px; background-color:#aaaaaa; display:inline-block;">
			thumbnail
		</div>
		<div class="row"></div>
			<div class="col-sm-10">aaaaaaaaaaaaaaaaaaaaaaaaaaaaa</div>
			<div class="col-sm-2">bbbbbbbbbbb</div>
		</div>
	</div>
</div>

</body>
</html>