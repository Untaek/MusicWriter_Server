<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']. '/dbconn.php';

$id = $_GET['id'];
if(isset($_GET['page'])) $page = $_GET['page'];

$VIEW_NUM = 15;
$pageview = ($page-1)*$VIEW_NUM;

$sql = "SELECT * FROM comments WHERE Post_id = $id ORDER BY Day DESC, Time DESC LIMIT $pageview, $VIEW_NUM";
$query = mysqli_query($conn, $sql);

$query2 = mysqli_query($conn, $sql);
$row = mysqli_num_rows($query2);






while($data = mysqli_fetch_assoc($query)){
	
	echo "<tr style='height:60px;'>";
	echo 	"<td class='nicktd'>";
	if($data['User_id']!=-1){
		echo "<span style='margin-right:4px;' class='glyphicon glyphicon-user'></span>";
	}
	echo		$data['Nickname'];
	echo	"</td>";
	echo	"<td class='texttd'>";
	echo		$data['Text'];
	echo	"</td>";
	echo	"<td class='timetd'>";
	echo		$data['Day'] . "  " . $data['Time'];
	echo	"</td>";
	echo    "<td>";
	if($data['User_id']==-1 || (isset($_SESSION['user_id']) && $data['User_id']==$_SESSION['user_id'])){
		echo		"<span style='cursor:pointer;' class='cmtremove glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal'></span>";
		echo		"<span style='cursor:pointer;' class='cmtmodify glyphicon glyphicon-pencil' data-toggle='modal' data-target='#modModal'></span>";
	}
		echo '<input id="cmtid" type="hidden" name="cmt_id" value="'.$data["Comment_id"].'">';
	echo		"</td>";
	echo "</tr>";
}

mysqli_close($conn);
?>

<script type="text/javascript">
	$(function(){
		var cmtid;
		var cmtpw;
		var commentwrap;
		var text;

		if(<?=$row?><15){
			$('.morecmt').css('display', 'none');
		}else{
			$('.morecmt').css('display', 'block');
		}


		$('.cmtremove').on('click', function(event) {
			cmtid = $(this).parent().find('#cmtid').val();
			commentwrap = $(this);
			$(":input[name='cmtpwdel']").val("");
		});

		$('#cmtdelbtn').on('click', function(event) {
			cmtpw = $(":input[name='cmtpwdel']").val();


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