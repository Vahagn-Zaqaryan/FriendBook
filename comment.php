<?php 
	include 'core/init.php';
	protect_page();
	date_default_timezone_set('UTC');
	$my_id=$_SESSION['id'];
	$post_id = $_POST['post_id'];
	$comment = $_POST['comment'];
	$friend_id = $_POST['friend_id'];
	$date=date("d.m.Y");
    $time=date("H:i:s");
	mysql_query("INSERT INTO comment VALUES ('', '$my_id', '$post_id', '$comment')");
	mysql_query("INSERT INTO `notifications_inbox` VALUES ('', '$my_id', '$friend_id')");
	mysql_query("INSERT INTO `notifications` VALUES ('', '$my_id', '$friend_id', '$comment', 'comment your post', '$date', '$time')");
 ?>