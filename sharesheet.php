<?php
	include_once "./dbconn.php";

	$data = json_decode($_POST['data']);

	$id = $data->id;
	$title = $data->title;
	$author = $data->author;
	$note = json_encode($data->note);
	$tempo = $data->tempo;

	mysqli_query($conn,
	"insert into music_sheet
	(title, author, note, uploadUserID, tempo)
	values ('$title', '$author', '$note', '$id', '$tempo')")
	or die($conn);
	
	echo 1; 



?>
