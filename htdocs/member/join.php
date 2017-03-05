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
<?php $php_page = $_SERVER['PHP_SELF']; ?>
<script type="text/javascript">
	$(function(){
	});
</script>
	<title>Member Confirmation</title>
</head>
<body>
<?php
	$dbconn = mysqli_connect('127.0.0.1', 'root', 'a1234567', 'novaplayer');

?>

<?php
	include $_SERVER['DOCUMENT_ROOT'].'/res/topnav.php'
?>
	<div class="container">
		<div class="well" style="background-color:#ffffff;">
			<form id="login_form" style="display:none" method="post" action="confirm_login.php">
				<h2 style="text-align:center">Welcome !</h2>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">E-mail</span><input  id="loginemail" class="col-sm-6" type="text" name="email" required="true">
				</div>
				<div class="row">
					<span class="col-sm-3" style="text-align:right">Password</span><input  id="loginpassword" class="col-sm-6" type="password" name="pw" required="true">
				</div>
				<div class="row">
					<span class="col-sm-3"></span>
					<div class="checkbox col-sm-7">
						<label><input id="autologin" type="checkbox" name="auto">Auto login</label>
					</div>
				</div>
				<div class="row">
					<span class="col-sm-3"></span><input id="loginsubmit" class="btn btn-primary col-sm-6" type="submit" name="gologin" value="Log in">
				</div>
			</form>
			<script type="text/javascript">
				$("#loginsubmit").on('click', function(event) {
					event.preventDefault();
					/* Act on the event */
					$.ajax({
						url: '/member/confirm_login.php',
						type: 'POST',
						data: {email: $('#loginemail').val(), 
								pw: $('#loginpassword').val(),
								auto: $('#autologin').is(":checked")}
					})
					.done(function(data) {
						console.log(data);
						if(data==0){
							alert('Check your Email & Password');
						}
						else if(data==1){
							location.replace('/index.php');
						}else{
							console.log(data);
						}
					})
					.fail(function() {
						console.log("error");
					})
					
				});
			</script>
			<form id=signup_form style="display:none" method="post" action="confirm_signup.php">
				<h2 style="text-align:center">Join Us~!</h2>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">E-Mail</span><input id="email_sign" class="col-sm-6" type="email" name="email" required="true"><span style="margin-left:10px" id="hasemail"></span>
				</div>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">Nickname</span><input id="nick_sign" class="col-sm-6" type="text" name="nick" required="true"><span style="margin-left:10px" id="hasnick"></span>
				</div>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">Password</span><input id="pw_sign" class="col-sm-6" type="password" name="pw" required="true"><span style="margin-left:10px" id="checkpw"></span>
				</div>
				<div class="row">
				<span class="col-sm-3" style="text-align:right">Confirm Password</span><input id="pw_sign2" class="col-sm-6" type="password" name="pw2" required="true"><span style="margin-left:10px" id="checkpw2"></span>
				</div>
				<div class="row">
				<span class="col-sm-3"></span><input id="signupsubmit" class="btn btn-success col-sm-6" type="submit" name="gosignup" value="Sign Up" >
				</div>

				<script type="text/javascript">

				var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/; 

				var emailflag = false;
				var nickflag = false;
					$('#signupsubmit').on('click', function(){
						if($('#pw_sign').val() != $('#pw_sign2').val() || $('#pw_sign').val().length <8 || $('#pw_sign2').val().length <8 || !emailflag || !nickflag){
							alert("check your input")
							return false;
						}
					});

					$('#email_sign').change(function(){
						if($("#email_sign").val() != "")
						$.ajax({
							url:'check_email.php',
							data:({
								hasemail: $('#email_sign').val()
							}),
							success: function(data){
								if(data == 'no' && $("#email_sign").val() != ""){
									if($("#email_sign").val().match(regex)){
										$("#hasemail").addClass("glyphicon glyphicon-ok");
										$("#hasemail").removeClass("glyphicon-remove");
										$("#hasemail").html("");
										emailflag = true;
									}else{
										$("#hasemail").addClass("glyphicon glyphicon-remove");
										$("#hasemail").removeClass("glyphicon-ok");
										$("#hasemail").html("not email");
										emailflag = false;
									}
								}else{
									$("#hasemail").addClass("glyphicon glyphicon-remove");
									$("#hasemail").removeClass("glyphicon-ok");
									$("#hasemail").html("already exist");
									emailflag = false;
								}
							}
						});
						else{
							$("#hasemail").removeClass("glyphicon glyphicon-remove glyphicon-ok");
							$("#hasemail").html("");
							emailflag = false;
						}
						
					});

					$('#nick_sign').change(function(){
						if($("#nick_sign").val() != "")
						$.ajax({
							url:'check_nick.php',
							data:({
								hasnick: $('#nick_sign').val()
							}),
							success: function(data){
								if(data == 'no' && $("#nick_sign").val() != ""){
									$("#hasnick").addClass("glyphicon glyphicon-ok");
									$("#hasnick").removeClass("glyphicon-remove");
									$("#hasnick").html("");
									nickflag = true;
								}else{
									$("#hasnick").addClass("glyphicon glyphicon-remove");
									$("#hasnick").removeClass("glyphicon-ok");
									$("#hasnick").html("already exist");
									nickflag = false;
								}
							}
						});
						else{
							$("#hasnick").removeClass("glyphicon glyphicon-warning-sign glyphicon-ok");
							nickflag = false;
						}
					});

					$("#pw_sign").on('keyup', function(){
						if($("#pw_sign").val() != ""){
							if($("#pw_sign").val().length<8){
							$("#checkpw").addClass("glyphicon glyphicon-remove");
							$("#checkpw").removeClass("glyphicon-ok");
							$('#checkpw').html('At least 8 char');
							}
							else{
								$("#checkpw").addClass("glyphicon glyphicon-ok");
								$("#checkpw").removeClass("glyphicon-remove");
								$('#checkpw').html('');
							}
						}else{
							$("#checkpw").removeClass("glyphicon glyphicon-ok glyphicon-remove");
							$('#checkpw').html('');
						}

						if($("#pw_sign").val() != $("#pw_sign2").val() && $("#pw_sign").val() != "" && $("#pw_sign2").val() != "" && $("#pw_sign").val().length>=8){
							$("#checkpw2").addClass("glyphicon glyphicon-remove");
							$("#checkpw2").removeClass("glyphicon-ok");
							$("#checkpw2").html("Not correct password");
							
						}
						else if($("#pw_sign").val() == $("#pw_sign2").val() && $("#pw_sign").val() != "" && $("#pw_sign").val().length>=8){
							$("#checkpw2").addClass("glyphicon glyphicon-ok");
							$("#checkpw2").removeClass("glyphicon-remove");
							$("#checkpw2").html(" ");
						}


					});

					$("#pw_sign2").on('keyup', function(){
						console.log($("#pw_sign2").val());
						if($("#pw_sign2").val() != ""){
							if($("#pw_sign").val() != $("#pw_sign2").val() && $("#pw_sign").val() != "" && $("#pw_sign").val().length>=8){
							$("#checkpw2").addClass("glyphicon glyphicon-remove");
							$("#checkpw2").removeClass("glyphicon-ok");
							$("#checkpw2").html("Not correct password");
							
							}
							else if($("#pw_sign").val() == $("#pw_sign2").val() && $("#pw_sign").val() != "" && $("#pw_sign").val().length>=8){
								$("#checkpw2").addClass("glyphicon glyphicon-ok");
								$("#checkpw2").removeClass("glyphicon-remove");
								$("#checkpw2").html(" ");
							}
						}else{
							$("#checkpw2").html(" ");
							$("#checkpw2").removeClass("glyphicon glyphicon-ok glyphicon-remove");
						}
					});
				</script>
			</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	var id_nav = "<?php echo $status ?>_nav";
	var id_form = "<?php echo $status ?>_form"
	if(id_nav != null){
		document.getElementById(id_nav).className = "active";
		document.getElementById(id_form).style.display = "block";
	}
</script>
</body>
</html>