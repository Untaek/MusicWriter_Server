<?php 

$conn = mysqli_connect('127.0.0.1', 'root', 'a1234567', 'novaplayer');

$sort = $_GET['sort'];
$cate = substr(basename($_SERVER['PHP_SELF']), 0, -4);
$page = $_GET['page'] -1;

$PAGENUM=10;
$pagepos = $page*$PAGENUM;

$condition = "WHERE Category='$cate'";
if($cate == "all"){
	$condition = "";
} 
switch ($sort) {
	case 'newest':
		$getdata = "SELECT * FROM video_posts $condition ORDER BY Day DESC, Time DESC LIMIT $pagepos, $PAGENUM";
		break;
	case 'likes':
		$getdata = "SELECT * FROM video_posts $condition ORDER BY Likes DESC LIMIT $pagepos, $PAGENUM";
		break;
	case 'popular':
		$getdata = "SELECT * FROM video_posts $condition ORDER BY Views DESC LIMIT $pagepos, $PAGENUM";
		break;
	default:
		$getdata = "SELECT * FROM video_posts $condition ORDER BY Day DESC, Time DESC LIMIT $pagepos, $PAGENUM";
		break;
}

$getpage = "SELECT Post_id FROM video_posts $condition ORDER BY Day DESC, Time DESC";
echo '<div class="prev_next" style="margin:0 auto;">';
echo '<div style="float:left">';
echo	'<a style="" class="prevbtn btn btn-primary" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page=1">FIRST</a>';
echo	'<a style="" class="prevbtn btn btn-primary" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page='.($page).'">PREV</a>';
echo   '</div>';
echo	'<div style="float:left; text-align:center; width:75%">';
	$row = mysqli_num_rows(mysqli_query($conn, $getpage));
	$max=$row;
	$i=0;
	if($page+1>9) {
		$i = $page-9;
			$row = 189 + $i * 10;
			if($row>$max)
			$row = $max;
	}else{
		if($row >180){
			$row = 189;
		}
	}
	$currentpage = 'text-decoration:underline;
				font-weight:bold;';

	for(; $i<=$row/10; $i++){
		echo '<a style="font-size:20px; margin-right:20px;" class="pagenum" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page='.($i+1).'">'.($i+1).'</a>';
	}
echo	'</div>';
echo '<div style="float:right">';
echo '<a style="" class="nextbtn btn btn-primary" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page='.($page+2).'">NEXT</a>';
echo '<a style="" class="nextbtn btn btn-primary" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page='.ceil($max/10).'">LAST</a>';
echo   '</div>';
echo '</div>';

echo '<div style="clear:both;margin-bottom:10px;"></div>';

$data_sql = mysqli_query($conn, $getdata);

	while($data = mysqli_fetch_assoc($data_sql)){
	$subject = $data['Subject'];
	$id = $data['Post_id'];
	$day = $data['Day'];
	$time = $data['Time'];
	$video_url = $data['Video_url'];
	$category = $data['Category'];
	$nick = $data['Nickname'];
	$likes = $data['Likes'];
	$views = $data['Views'];
	$comments = $data['Comments'];

echo '<div class="post well" style="height:110px;">';
echo		'<a href="/videos/post/view.php?id='.$id.'"><img style="width:110px; height:100%; background-color:#aaaaaa; display:block; float:left; position:relative; margin-right:15px" src="https://i.ytimg.com/vi/'.$video_url.'/default.jpg"/></a>';
echo		'<div>';
echo			'<div style="float:left">';
echo				'<h2 style="margin:0; text-overflow:ellipsis;"><a class="subject" href="/videos/post/view.php?id='.$id.'" style="margin:0">'.$subject.'</a></h2>';
echo				'<p style="margin:0"><a class="videourl" href="https://www.youtu.be/'.$video_url.'">https://www.youtu.be/'.$video_url.'</a> - youtube</p>';
echo				'<p style="margin:0"> <span class="nick">'.$nick.'</span><span class="views" style="margin-left:10px">views : '.$views.'</span><span class="likes" style="margin-left:10px">likes : '.$likes.'</span><span class="comment" style="margin-left:10px">comments : '.$comments.'</span></p>';
echo			'</div>';
echo			'<div style="float:right">';
echo				'<label style="float:right;" class="category label label-primary">'.$category.'</label>';
				
echo				'<p class="day" style="text-align:right">'.$day.'</p>';
echo				'<p class="time" style="text-align:right">'.$time.'</p>';
echo			'</div>';
echo			'<div style="clear:both;"></div>';
echo		'</div>';
echo	'</div>';

}

echo '<div class="prev_next" style="">';
echo '<div style="float:left">';
echo	'<a style="" class="prevbtn btn btn-primary" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page=1">FIRST</a>';
echo	'<a style="" class="prevbtn btn btn-primary" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page='.($page).'">PREV</a>';
echo   '</div>';
echo	'<div style="float:left; text-align:center; width:75%">';
	$row = mysqli_num_rows(mysqli_query($conn, $getpage));
	$max=$row;
	$i=0;
	if($page+1>9) {
		$i = $page-9;
			$row = 189 + $i * 10;
			if($row>$max)
			$row = $max;
	}else{
		if($row >180){
			$row = 189;
		}
	}
	$currentpage = 'text-decoration:underline;
				font-weight:bold;';

	for(; $i<=$row/10; $i++){
		echo '<a style="font-size:20px; margin-right:20px;" class="pagenum2" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page='.($i+1).'">'.($i+1).'</a>';
	}
echo	'</div>';
echo '<div style="float:right">';
echo '<a style="" class="nextbtn btn btn-primary" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page='.($page+2).'">NEXT</a>';
echo '<a style="" class="nextbtn btn btn-primary" href="http://127.0.0.1/videos/'.$cate.'.php?sort='.$sort.'&page='.ceil($max/10).'">LAST</a>';
echo   '</div>';
echo '</div>';

echo '<div style="clear:both;margin-bottom:10px;"></div>';

 mysqli_close($conn);
?>

<script type="text/javascript">
	$(function(){
		var page = <?=($page+1)?>;
		var index = page-1;

		if(page>10){
			index = 9;
		}

		if($('.pagenum').eq(index).html() == page){
			$('.pagenum').eq(index).css({
				'text-decoration': 'underline',
				'font-weight': 'bold'
			});
			$('.pagenum2').eq(index).css({
				'text-decoration': 'underline',
				'font-weight': 'bold'
			});
		}

		if(page==1){
			$('.prevbtn').css('visibility', 'hidden');
		}
		if(<?= $max/10 ?> < page){
			$('.nextbtn').css('visibility', 'hidden');
		}
	})
</script>