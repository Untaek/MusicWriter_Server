<?php
	session_start();
	$conn = mysqli_connect('127.0.0.1', 'root', 'a1234567', 'novaplayer');

	$user= $_GET['user_id'];
	$post= $_GET['post_id'];
	$text= $_GET['text'];
	$day= $_GET['day'];
	$time= $_GET['time'];
	if(isset($_GET['pw'])){
		$pw= $_GET['pw'];
	}
	

	$nick = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Nickname FROM users WHERE User_id=$user"))['Nickname'];

	if(isset($pw)){
		$sql = "INSERT INTO comments (User_id, Post_id, Nickname, Text, Day, Time, Password) VALUES ('$user', '$post', '$nick', '$text', '$day', '$time', '$pw')";
	}else{
		$sql = "INSERT INTO comments (User_id, Post_id, Nickname, Text, Day, Time) VALUES ('$user', '$post', '$nick', '$text', '$day', '$time')";
	}

	$sql2 = "SELECT * FROM comments WHERE Post_id=$post ORDER BY Day DESC, Time DESC LIMIT 0, 15";

	$sql3 = "UPDATE video_posts SET Comments = Comments+1 WHERE Post_id='$post'";

	$sql4 = "UPDATE users SET Comments=Comments+1 WHERE User_id=$user";

	$save = mysqli_query($conn, $sql);

	$load = mysqli_query($conn, $sql2);

	$update = mysqli_query($conn, $sql3);

	$update_user = mysqli_query($conn, $sql4);

	while ($comData = mysqli_fetch_assoc($load)) {
		echo "<tr style='height:60px;'>";
		echo 	"<td class='nicktd'>";
		if($comData['User_id']!=-1){
			echo "<span style='margin-right:4px;' class='glyphicon glyphicon-user'></span>";
		}
		echo		$comData['Nickname'];
		echo	"</td>";
		echo	"<td class='texttd'>";
		echo		$comData['Text'];
		echo	"</td>";
		echo	"<td class='timetd'>";
		echo		$comData['Day'] . "  " . $comData['Time'];
		echo	"</td>";
		echo    "<td>";
		if($comData['User_id']==-1 || (isset($_SESSION['user_id']) && $comData['User_id']==$_SESSION['user_id'])){
		echo		"<span style='cursor:pointer;' class='cmtremove glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal'></span>";
		echo		"<span style='cursor:pointer;' class='cmtmodify glyphicon glyphicon-pencil' data-toggle='modal' data-target='#modModal'></span>";
	}
		echo '<input id="cmtid" type="hidden" name="cmt_id" value="'.$comData["Comment_id"].'">';
		echo	"</td>";
		echo "</tr>";
	} 

	
	
	$maxsql = "SELECT Post_id FROM comments WHERE Post_id=$post ORDER BY Day DESC, Time DESC";
	$maxquery = mysqli_query($conn, $maxsql);
	$maxrow = mysqli_num_rows($maxquery);
	echo '<script type="text/javascript">
	$(function(){
		$("#currentcomment").html("'.$maxrow.'");
	})	
		</script>';
?>

<script type="text/javascript">
	$(function(){
		var cmtid;
		var cmtpw;
		var commentwrap;

		$('.cmtremove').on('click', function(event) {
			cmtid = $(this).parent().find('#cmtid').val();
			commentwrap = $(this);
			$(":input[name='cmtpwdel']").val("");
		});


		$('#cmtdelbtn').on('click', function(event) {
			cmtpw = $(":input[name='cmtpw']").val();

			$.ajax({
				url: '/videos/comment_delete.php',
				type: 'POST',
				data: 
				{
					cmtid: cmtid,
					cmtpw: cmtpw
				}
			})
			.done(function(data) {
				if(data==1){
					commentwrap.parent().parent().remove();
				}
			});
		});

		$('.cmtmodify').on('click', function(event) {
			cmtid = $(this).parent().find('#cmtid').val();
			commentwrap = $(this);
			$(":input[name='cmtpwmod']").val("");
			$("#cmtmodtext").val("");
		});

		$('#cmtmodbtn').on('click', function(event) {
			cmtpw = $(":input[name='cmtpwmod']").val();
			text = $("#cmtmodtext").val();
			$.ajax({
				url: '/videos/comment_modify.php',
				type: 'POST',
				data: 
				{
					cmtid: cmtid,
					cmtpw: cmtpw,
					text: text
				}
			})
			.done(function(data) {
				if(data!=0){
					commentwrap.parent().parent().find('.texttd').html(data);
				}
			});
		});
	})
</script>

