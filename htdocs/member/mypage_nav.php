<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
	$(function(){
		var nowpage = "<?php echo $_SERVER['PHP_SELF'] ?>";

		switch(nowpage){
		  case '/member/user_info.php' : $('#user-info-nav').addClass('active');
		  break;
		  case '/member/change_pw.php' : $('#change-pw-nav').addClass('active');
		  break;
		  case '/member/quit_us.php' : $('#quit-us-nav').addClass('active');
		  break;
		}
	});
</script>
</head>
<body>
<div id="left-menu-wrap" class="col-sm-4">
	<ul class="nav nav-pills nav-stacked">
		<li id="user-info-nav"><a href="user_info.php">user-info</a></li>
		<li id="change-pw-nav"><a href="change_pw.php">change-pw</a></li>
		<li id="quit-us-nav"><a href="quit_us.php">quit us</a></li>
	</ul>
</div>
</body>
</html>