<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<title> main page </title>
	<style type="text/css">
		a:hover{
			text-decoration: none;
			color: #000000;
		}
		a{
			color: #000000;
		}
	#videocommentwrap{
	}

	.mynicktd{
		width: 10%;
		text-align: center;
		font-size: 16px;
	}

	.textareatd{
		width: 80%;
	}

	.btntd{
		width:10%;
	}

	.nicktd{
		text-align: center;
		border-right: 1px solid #dddddd;
	}

	.texttd{
		border-right: 1px solid #dddddd; 
	}

	.trow{
	}

	.subjecttd{
		vertical-align: middle;
		width:90%;
		font-size: 18px;
	}

	.liketd{
		vertical-align: middle;
	}

	.tablerow:hover{
		cursor: pointer;
	}

	</style>
</head>
<body>
<div class="container-fluid" style="text-align:center;"><a href="/index.php" style="width:100%;"><span style="display:block; padding:10px; font-size:40px">Nova Player</span></a> </div>
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/res/topnav.php';
?>
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/dbconn.php';
?>
<?php
	$sql_table = "SELECT * FROM video_posts ORDER BY Likes DESC LIMIT 5";
	$query_table = mysqli_query($conn, $sql_table);
	$query_table2 = mysqli_query($conn, $sql_table);
?>
	<div id="wrap" style="width:1200px; margin:0 auto;">
		<div class="row">
			<div class="col-sm-7" style="height:400px;">
				
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false" style="height:100%">
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox" style="height:100%">
				    <?php
						while($data_table2 = mysqli_fetch_assoc($query_table2)){
				    ?>
				    <div class="item" style="height:100%">
				      <iframe id="currentvideo" class="" width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $data_table2['Video_url'] ?>" frameborder="0" allowfullscreen></iframe>
				    </div>
				    <?php } ?>
				  </div>
				</div>
				
			</div>
			<div class="col-sm-5" style="height:400px;">
			<table class="table table-hover" style="height:100%">
				<tbody>
					<?php
						$i=0;
						$subjectArr = array();
						while($data_table = mysqli_fetch_assoc($query_table)){
							$subjectArr[$i] = $data_table['Subject'];
							$postIdArr[$i] = $data_table['Post_id'];
							$i = $i+1;
					?>
					<tr class="tablerow">
						<td style="vertical-align:middle"><span id="" class="isshowicon"></span></td>
						<td class="subjecttd" style="vertical-align:middle"><span class="subject"><?php echo $data_table['Subject']; ?></span></td>
						<td class="liketd" style="vertical-align:middle"><p class="like">Likes</p><p class="likescore"><?php echo $data_table['Likes']; ?></p></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<script type="text/javascript">
				$(function(){
					var pos = Math.floor(Math.random()*5);
					var subjectArr = <?php echo json_encode($subjectArr); ?>;
					var postIdArr = <?php echo json_encode($postIdArr); ?>;

					var cmtpage=1;

					$('.isshowicon').eq(pos).addClass('glyphicon glyphicon-ok');
					$('#carousel-example-generic').carousel('pause');
					$('#carousel-example-generic').carousel(pos);
					$('.item').eq(pos).addClass('active');
					$('#currentsubject').html(subjectArr[pos]);
					$('.subject').eq(pos).css('font-weight', 'bold');
					$("#currentlike").html($(".likescore").eq(pos).html());
					$.ajax({
							url: 'get_like.php',
							data: {index: postIdArr[pos]}
						})
						.done(function(result) {
							var data =$.parseJSON(result);
							$("#currentlike").html(data[0]);
							$("#currentcomment").html(data[1]);
							$("#scriptcontainer").html(data[2]);

						})
						.fail(function() {
							console.log("error");
						})

					$('.tablerow').on('click', function(event) {
						event.preventDefault();
						pos = $(this).index();
						$('#carousel-example-generic').carousel(pos);
						$('.isshowicon').removeClass('glyphicon glyphicon-ok');
						$('.isshowicon').eq(pos).addClass('glyphicon glyphicon-ok');
						$('.subject').css('font-weight', 'normal');
						$('.subject').eq(pos).css('font-weight', 'bold');
						$('#currentsubject').html(subjectArr[pos]);
						$('#commenttable tbody').html("");
						$('#videocommentwrap').css('display', 'none');
						$.ajax({
							url: 'get_like.php',
							data: {index: postIdArr[pos]}
						})
						.done(function(result) {
							var data =$.parseJSON(result);
							$("#currentlike").html(data[0]);
							$("#currentcomment").html(data[1]);
							$("#scriptcontainer").html(data[2]);

						})
						.fail(function() {
							console.log("error");
						})
						
					});

					$("#showcmtbtn").on('click', function(){
						cmtpage=1;
						$("#videocommentwrap").fadeIn(400);
						console.log(pos);
						$.ajax({
							url: '/videos/comment.php',
							data: {id: postIdArr[pos],
									page: cmtpage}
						})
						.done(function(data) {
							$('#commenttable tbody').html(data);
						})
					});



					$("#commentbtn").on('click', function() {
					/* Act on the event */
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
						var user_id = <?php if(isset($_SESSION['user_id'])) echo  $_SESSION['user_id']; else echo 0;?>;
						if(!user_id){
							user_id=-1;
						}
						$.ajax({
							url: '/videos/post/write_comment.php',
							data: {
								text: $('#commenttext').val(),
								day: day,
								time: time,
								user_id: user_id,
								post_id: postIdArr[pos],
								pw: $('#pwinput').val()
							},
						})
						.done(function(result) {
							$('#commenttext').val("");
							$("#commenttable tbody").html("");
							$("#commenttable tbody").html(result);
						})
					});

					$('.morecmt').on('click', function(event) {
						cmtpage=(cmtpage+1);
						$.ajax({
							url: '/videos/comment.php',
							data: 
								{
									id: postIdArr[pos],
									page: cmtpage
								},
						})
						.done(function(data) {
							$("#commenttable tbody").append(data);
						})
					});


				$('#likebtn').on('click', function(event) {
					event.preventDefault();
					/* Act on the event */
					$.ajax({
						url: '/videos/post/like.php',
						data: {id: postIdArr[pos]}
					})
					.done(function(data) {
						if(data ==0){
							alert('You aleady click like');
						}
						else if(data==-1){
							alert('Please login');
						}else{
							$('#currentlike').html(data);
							$('.likescore').eq(pos).html(data);
							$("#likebtn").removeClass('btn-info');
							$("#likebtn").addClass('btn-success');
							$("#likebtn").append("Like!");
						}
					})

				});
			});

			</script>
<div id="scriptcontainer">
	
</div>
<div id="delModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Comment</h4>
      </div>
      <div class="modal-body">
        <h3>Are you sure?</h3> 
       <?php if(!isset($_SESSION['user_id'])){
        echo '<p>Password</p>
        <input class="form-control" type="password" name="cmtpwdel">';
       }?>
        <input id="cmtidinput" type="hidden" name="cmtid">
      </div>
      <div class="modal-footer">
     	<button id="cmtdelbtn" type="button" class="btn btn-warning" data-dismiss="modal">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Comment</h4>
      </div>
      <div class="modal-body">
      <?php if(!isset($_SESSION['user_id'])){
        echo '<p>Password</p>
        <input class="form-control" type="password" name="cmtpwmod">';
        }?>
        <input id="cmtidinputmod" type="hidden" name="cmtid">
        <p>Comment</p>
        <input id="cmtmodtext" class="form-control" type="text" name="cmt">
      </div>
      <div class="modal-footer">
     	<button id="cmtmodbtn" type="button" class="btn btn-info" data-dismiss="modal">Done</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



			</div>
		</div>
		<div class="row">
			<div style="padding:15px; border-bottom:1px solid #aaaaaa;">
				<h4 id="currentsubject">
					
				SUBJECT</h4>
				<p>Like : <span id="currentlike">7</span></p>
				<button id="likebtn" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></button>
				<button id="showcmtbtn" class="btn btn-primary">Show comment(<span id="currentcomment"></span>)</button>
			</div>
		</div>

		<div id="videocommentwrap" style="display:none">
		<table id="commenttable" class="table table-striped">
			<thead>
				<tr>
					<td class="mynicktd">
					
						<?php if(isset($_SESSION['nickname'])) echo '<span style="margin-right:4px;"  class="glyphicon glyphicon-user"></span>'. $_SESSION['nickname'];
							  else echo '<p>anonymous</p><input id="pwinput" placeholder="password" type="password">';?>
					</td>
					<td class="textareatd">
						<textarea id="commenttext" style="width:100%"></textarea>
					</td>
					<td class="btntd" colspan="2">
						<button id="commentbtn" class="btn btn-success" style="width:100%; ">comment</button>
					</td>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
			<tfoot>
				
			</tfoot>
			
		</table>
		<button class="morecmt btn btn-primary" style="width:100%">Show more comments</button>
	</div>
	</div>
</body>
</html>