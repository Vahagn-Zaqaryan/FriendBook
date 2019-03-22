<?php 
	include 'core/init.php';
	protect_page();
	$my_id=$_SESSION['id'];
	$message = $_POST['message'];
	$hash = $_POST['hash'];
	$user= $_POST['user'];
	if (!empty($message) && is_null($message) === false) {
		mysql_query("INSERT INTO message (`id`,`group_hash`,`from_id`,`message`) VALUES ('','$hash', '$my_id', '$message')");
		mysql_query("INSERT INTO inbox_message (`id`,`from`,`to`) VALUES ('', '$my_id', '$user')");
	}		
 ?>