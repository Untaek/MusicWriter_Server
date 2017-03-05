<?php 
	$nick = $_REQUEST['hasnick'];

	$server = "127.0.0.1";
	$dbuser = "root";
	$dbpw = "a1234567";
	$dbname = "novaplayer";

	$connect = mysqli_connect($server, $dbuser, $dbpw, $dbname);

	if(!$connect){
		die(mysqli_connect_error());
	} 

	$que = "SELECT Nickname FROM users WHERE Nickname='$nick'";
	$result = mysqli_num_rows(mysqli_query($connect, $que));

	if(empty($result)){
		echo 'no';
	}
	else{
		echo 'yes';
	}
?>