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

<script type="text/javascript">
	$(function(){
		$('#submit').on('click',  function(event) {
			event.preventDefault();
			/* Act on the event */
			var currentPw = $('#currentpw').val();
			$.ajax({
				url: 'check_pw.php',
				type: 'POST',
				data: {pw: currentPw},
			})
			.done(function(data) {
				if(data == 1){
					$('#currentpw').prop('disabled', true);
					$('#submit').html('Confirmed!');
					$('#submit').removeClass('btn-default');
					$('#submit').addClass('btn-success');
					$('#submit').prop('disabled', true);
					$('#changepwwrap').fadeIn(400);
					$('#incorrect').html('');
				}else{
					$('#incorrect').html('Incorrect Password!');
				}
			})
		});
	});

</script>

<div id="wrap">
	<div class="row" style="width:1200px; margin:0 auto;">
		<?php include $_SERVER['DOCUMENT_ROOT']. '/member/mypage_nav.php'; ?>
		
		<div id="right-content-wrap" class="col-sm-8">
			<h1>Change your Password</h1>

			<h3>Current Password</h3>
			<p><input id="currentpw" class="form-control" type="password" name="currentpw"></p>
			<button id="submit" class="btn btn-default">Submit</button><span id="incorrect"></span>

			<div id="changepwwrap" style="display:none;">
				<h3>Change Password</h3>
				<form id="changepwform" action="confirm_change_pw.php" method="post">
					<h5>Password</h5>
					<p><input class="form-control" type="password" name="pw1"></p>
					<h5>Confirm Password</h5>
					<p><input class="form-control" type="password" name="pw2"></p>
					<input id="changesubmit" type="submit" value="Confirm" class="btn btn-default">
				</form>
			</div>
			<script type="text/javascript">
				$(function(){
					$('#changesubmit').on('click', function(event) {
						event.preventDefault();
						/* Act on the event */
						if($('input[name="pw1"]').val() != $('input[name="pw2"]').val()){
							alert("match password!");
						}else {
							alert("Successfully Change Password");
							$('#changepwform').submit();
						}
					});
				})
			</script>
		</div>
	</div>
</div>
</body>
</html>