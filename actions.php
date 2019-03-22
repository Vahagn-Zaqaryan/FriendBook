<?php 
include 'core/init.php';
	protect_page();
	$action = $_GET['action'];
	$user = $_GET['user'];
	$random_number = rand();
	$my_id=$_SESSION['id'];
	if ($action == 'send') {
		mysql_query("INSERT INTO friend_req VALUES ('','$my_id','$user')");
		header("Location: profile.php?id=".$user);
	}
	if ($action == 'cancel') {
		mysql_query("DELETE FROM `friend_req` WHERE `from`='$my_id' AND `to`='$user'");
		header("Location: profile.php?id=".$user);
	}
	if ($action == 'accept') {
		mysql_query("DELETE FROM `friend_req` WHERE `from`='$user' AND `to`='$my_id'");
		mysql_query("INSERT INTO friends VALUES ('','$user','$my_id')");
		mysql_query("INSERT INTO message_group VALUES ('','$my_id','$user','$random_number')");
		header("Location: profile.php?id=".$user);}
	if ($action == 'unfriend') {
		mysql_query("DELETE FROM `friends` WHERE (user_one='$my_id' AND user_two='$user') OR (user_one='$user' AND user_two='$my_id')");
		mysql_query("DELETE FROM `message_group` WHERE (user_one='$my_id' AND user_two='$user') OR (user_one='$user' AND user_two='$my_id')");
		header("Location: profile.php?id=".$user);
	}
	if ($action == 'delcomment') {
		mysql_query("DELETE FROM `comment` WHERE `id`='$user'");
		header("Location: index.php");
	}
	if ($action == 'delpost') {
		mysql_query("DELETE FROM `post` WHERE `id`='$user'");
		header("Location: index.php");
	}
	if ($action == 'hidepost') {
		mysql_query("INSERT INTO hide_post VALUES ('','$my_id','$user')");
		header("Location: profile.php?id=".$user);
	}	
	if ($action == 'delphoto') {
		mysql_query("DELETE FROM `photo` WHERE `id`='$user'");
		header("Location: photo_show.php?id=".$my_id);
	}
	if ($action == 'delmess') {
		$hash = $_GET['hash'];
		mysql_query("DELETE FROM `message` WHERE `id`='$user'");
		header("Location: conversations.php?hash=".$hash);
	}
	if ($action == 'delnotification') {
		mysql_query("DELETE FROM `notifications` WHERE `id`='$user'");
		header("Location: notifications.php");
	}
	if ($action == 'ignore') {
		mysql_query("DELETE FROM `friend_req` WHERE `from`='$user' AND `to`='$my_id'");
		header("Location: req.php");
	}
 ?>