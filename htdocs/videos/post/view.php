
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
		width:1200px; 
		margin:0 auto;
	}

	#videobtnwrap{
		margin-top: 20px;
		margin-left: 10px;
	}

	#videodetailswrap{
		padding: 20px;
	}

	#videodetailswrap>blockquote>p{
		word-wrap: break-word;
	}

	#videocommentwrap{
	}

	.mynicktd{
		width: 15%;
		text-align: center;
	}

	.textareatd{
		width: 70%;
	}

	.btntd{
		width:15%;
	}

	.nicktd{
		text-align: center;
		border-right: 1px solid #dddddd;
	}

	.texttd{
		border-right: 1px solid #dddddd; 
	}
</style>


	<title>view</title>


</head>
<body>
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/res/topnav.php'
?>

<?php
	$id = $_GET['id'];

	$conn = mysqli_connect('127.0.0.1', 'root', 'a1234567', 'novaplayer');

	$sql = "SELECT * FROM video_posts WHERE Post_id=$id";
	$query = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($query);

	$comSql = "SELECT * FROM comments WHERE Post_id=$id ORDER BY Day DESC, Time DESC";
	$comQuery = mysqli_query($conn, $comSql);
	$comrow = mysqli_num_rows($comQuery);
	
	$likeupdatesql = "UPDATE video_posts SET Likes=Likes+1 WHERE Post_id=$id";
	$likeselectsql = "SELECT Likes FROM video_posts WHERE Post_id=$id";

	$viewupdatesql = "UPDATE video_posts SET Views=Views+1 WHERE Post_id=$id";
	$viewQuery = mysqli_query($conn, $viewupdatesql);

	$deletesql = "DELETE FROM video_posts WHERE Post_id=$id";
?>
<script type="text/javascript">
	$(function(){
		$.ajax({
			url: '/videos/comment.php',
			data: {id: <?= $id ?>,
					page: 1},
		})
		.done(function(data) {
			$("tbody").append(data);
		})
	});
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/videos/post/check_like.php'; ?>

<div id="wrap">
	<div id="videowrap" class="embed-responsive embed-responsive-16by9">
		<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $data['Video_url']; ?>" frameborder="0" allowfullscreen></iframe>
	</div>
	<div id="videobtnwrap">
		<button id="likebtn" class="btn btn-info">
			<span class='glyphicon glyphicon-thumbs-up'></span>Like this video
		</button>
		<script type="text/javascript">
			$(function(){
				$("#likebtn").on('click', function(event) {
					event.preventDefault();
					/* Act on the event */
					$.ajax({
						url: 'like.php',
						data: { id : <?php echo $data['Post_id']; ?>},
					})
					.done(function(data) {
						if(data ==0){
							alert('You aleady click like');
						}
						else if(data==-1){
							alert('Please login');
						}else{
							$("#likescore").html(data);
							$("#likebtn").removeClass('btn-info');
							$("#likebtn").addClass('btn-success');
							$("#likebtn").html("<span class='glyphicon glyphicon-thumbs-up'></span>You like this video!");
						}
					})
				});
			});
		</script>
		<?php
		if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $data['User_id']){
			echo '<a id="updatebtn" class="btn btn-success" href="/videos/modify.php?id='.$id.'">
			Update
			</a>';
			echo '<button style="margin-left:3px;" id="deletebtn" class="btn btn-warning">
				Delete
			</button>';
		}
		?>
		<script type="text/javascript">
				$("#deletebtn").on('click', function(event) {
					event.preventDefault();
					/* Act on the event */
					$(function(){
						$.ajax({
							url: 'delete_post.php',
							data: {id: <?php echo $id ?>},
						})
						.done(function(status) {
							console.log(status);
							if(status==1){
								location.href = '/videos/all.php?sort=newest&page=1';
							}
						})
						.fail(function() {
							console.log("error");
						})
					});
				});
			</script>
	</div>

	<div id="videodetailswrap">
		<h2><?php echo $data['Subject']; ?></h2>
		<p><a href="https://youtu.be/<?php echo $data['Video_url']; ?>">https://youtu.be/<?php echo $data['Video_url']; ?></a></p>
		<h5>Uploader : <?= $data['Nickname']; ?></h5>
		<p><span id="viewscore"><?php echo $data['Views']; ?></span> <span>Views</span></p> 
		<p><span id="likescore"><?php echo $data['Likes']; ?></span> <span>Likes</span></p>
		<blockquote>
			<p>
				<?php echo $data['Discription']; ?>
			</p>
		</blockquote>
	</div>

	<div id="videocommentwrap" >
		<table class="table table-striped">
			<thead>
				<tr>
					<td style="font-size:16px;" class="mynicktd">
						<?php if(isset($_SESSION['nickname'])) echo '<span style="margin-right:4px;"  class="glyphicon glyphicon-user"></span>'. $_SESSION['nickname'];
							  else echo '<p>anonymous</p><input id="pwinput" placeholder="password" type="password">';?>
					</td>
					<td class="textareatd">
						<textarea id="commenttext" style="width:100%"></textarea>
					</td>
					<td class="btntd" colspan="2">
						<button id="commentbtn" class="btn btn-success" style="width:100%; ">comment</button>
						<script type="text/javascript">
							$(function(){
								var date = new Date;
								var page = 1;

								$("#commentbtn").on('click', function(event) {
									event.preventDefault();
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
										if($('#pwinput').val() == ""){
											alert("need password");
											return;
										}
									}



									$.ajax({
										url: 'write_comment.php',
										data: {
											text: $('#commenttext').val(),
											day: day,
											time: time,
											user_id: user_id,
											post_id: <?php echo $data['Post_id']; ?>,
											pw : $('#pwinput').val(),
											page : page
										},
									})
									.done(function(result) {
										$('#commenttext').val("");
										$("tbody").html("");
										$("tbody").html(result);
									})
									
								});



								
								$('.morecmt').on('click', function(event) {
									event.preventDefault();
									/* Act on the event */
									page=page+1;
									$.ajax({
										url: '/videos/comment.php',
										data: {id: <?= $id ?>,
												page: page},
									})
									.done(function(data) {
										$("tbody").append(data);
									})
								});
							});

						</script>
					</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
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
			</tfoot>
		</table>
		<div>
		<?php if($comrow>15) echo
			'<button class="morecmt btn btn-primary" style="width:100%">Show more comments</button>';
		?>
		</div>
	</div>

</div>
</body>
</html>