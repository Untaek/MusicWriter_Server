<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style type="text/css">
	#wrap{
		width: 800px;
		margin: 0 auto;
	}

	p{
		margin-bottom: 0;
	}
</style>
<script type="text/javascript">
	
</script>
	<title>upload</title>
</head>
<body>
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/res/topnav.php';
?>
<?php 
	if(isset($_GET['id']) && isset($_SESSION['user_id'])){
		include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';

		$id = $_GET['id'];
		$sql = "SELECT * FROM video_posts WHERE Post_id=$id";

		$query = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($query);
		if($data['User_id'] != $_SESSION['user_id']){
			exit;
		}
	}else{
		exit;
	}
?>
<div id="wrap">
	<div id="videowrap" class="panel panel-default">
		<div id="videoframewrap" class="panel-body">
			<iframe id="videoframe" width="100%" height="400px" src="https://www.youtube.com/embed/<?php echo $data['Video_url'];?>"></iframe>
		</div>
		<div id="videobtngroup" class="panel-footer">
			<input id="videohref" class="form-control" disabled type="text" name="href" size="40" value="https://www.youtu.be/<?php echo $data['Video_url'];?>">
		</div>
	</div>

	<div id='videodetail' class="panel panel-info">
		<div class="panel-heading">Write details</div>
		<div class="panel-body">
		<form method="post" action="confirm_modify.php" id="modform">
			<p>Subject</p>
			<input id="subject" class="form-control" type="text" name="subject" value="<?php echo $data['Subject']; ?>">
			<p>Discription</p>
			<textarea form="modform" name="discription" id="discription" class="form-control"><?php echo $data['Discription']; ?></textarea>
			<p>Category</p>
			<script type="text/javascript">
				console.log($("input:radio[value=prevCate]"));
				$(function(){
					$("input:radio[value='<?php echo $data['Category']; ?>']").prop('checked', true);
				});
			</script>
			<label class="radio-inline"><input type="radio" value="funny" name="category">Funny</label>
			<label class="radio-inline"><input type="radio" value="impressive" name="category">Impressive</label>
			<label class="radio-inline"><input type="radio" value="information" name="category">Information</label>
		</div>
	</div>
	<input type="hidden" name="postid" value="<?= $id ?>">
	<input type="submit" value="done" id="submit" class="btn btn-primary" style="width:100%">
	</form>
	<script type="text/javascript">
		$(function(){
				$('#discription').on('keydown', function(){
				var height = $('#discription').val().match(/\n/g).length +2;
				$('#discription').attr('rows', height);
			});
		});

		/*$(function(){
			var url = null;
			var category = null;
			var day;
			var time;
			var runningtime;

			function encode(url){
				var youtube = 'https://www.youtube.com/embed/'
				return youtube + url.slice(-11);
			}

			$('#upload').on('click', function(){
				url = encode($('#videohref').val());
				$('#videoframe').attr('src', url);
			});

			

			$('#submit').on('click', function(){
				var date = new Date();
				var month = date.getMonth()+1;
				var dayOfMonth = date.getDate();

				if(month<10) month = '0' + month;
				if(dayOfMonth<10) dayOfMonth = '0' + dayOfMonth;

				var hours = date.getHours();
				var minutes = date.getMinutes();
				var seconds = date.getSeconds();

				if(hours<10) hours = '0' + hours;
				if(minutes<10) minutes = '0' + minutes;
				if(seconds<10) seconds = '0' + seconds;

				day = date.getFullYear()+'/'+month+'/'+dayOfMonth;
				time = hours+':'+minutes+':'+seconds;
				
				if(typeof $('input:checked').val() != "undefined")
				category = $('input:checked').val();
				$.ajax({
					url:'confirm_upload.php',
					data:{
						video_url: url.slice(-11),
						subject: $('#subject').val(),
						discription: $('#discription').val(),
						category: category,
						day: day,
						time: time
					},
					success: function(result){
						console.log(result);
						if(result=='true'){
							alert('done!');
							location.replace('/videos/all.php?sort=newest&page=1');
						}
					}
				});
			});
		});*/
	</script>
</div>

<script type="text/javascript">

</script>
</body>
</html>