<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style type="text/css">
	.row{
		margin: 10px;
	}
</style>
<?php $status = $_GET['page']; ?>

	<title>Member Confirmation</title>
</head>
<body>


<nav class="navbar navbar-inverse" style="border-radius:0;">
  <div class="container-fluid">
    <div class="navbar-header" style="width:100%;">
      <a class="navbar-brand"  style="width: 100%; padding: 40px; margin:0; text-align:center; font-size:30px;" href="index.php">TEAMNOVA</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li> 
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li id=signup_nav><a href="member.php?page=signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li id=login_nav><a href="member.php?page=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
	<div class="container">
		<div class="well" style="background-color:#ffffff;">
			<form id="login_form" style="display:none" method="post">
				<h2 style="text-align:center">welcome to TEAMNOVA!!!!!!!!!</h2>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">ID</span><input class="col-sm-6" type="text" name="">
				</div>
				<div class="row">
					<span class="col-sm-3" style="text-align:right">Password</span><input class="col-sm-6" type="text" name="">
				</div>
				<div class="row">
					<span class="col-sm-3"></span><input class="btn btn-primary col-sm-6" type="submit" name="gologin" value="Log in">
				</div>
			</form>
			<form id=signup_form style="display:none" method="post" action="confirm_signup.php">
				<h2 style="text-align:center">Join Us~!~!!</h2>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">ID</span><input class="col-sm-6" type="text" name="id">
				</div>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">Password</span><input class="col-sm-6" type="password" name="pw">
				</div>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">Confirm Password</span><input class="col-sm-6" type="password" name="">
				</div>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">E-Mail</span><input class="col-sm-6" type="email" name="email">
				</div>
				<div class="row">
				<span class="col-sm-3"></span><input class="btn btn-success col-sm-6" type="submit" value="Sign Up">
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	var id_nav = "<?php echo $status ?>_nav";
	var id_form = "<?php echo $status ?>_form"
	console.log(id_nav);
	if(id_nav != null){
		document.getElementById(id_nav).className = "active";
		document.getElementById(id_form).style.display = "block";
	}
</script>
</body>
</html>