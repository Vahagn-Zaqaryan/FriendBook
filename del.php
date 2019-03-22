<?php 
	include 'core/init.php';
	protect_page();
	session_destroy();
	$id=$user_data['id'];
	$query=mysql_query("DELETE FROM `database`.`data` WHERE `data`.`id` = $id");
	$query_del_post=mysql_query("DELETE FROM `database`.`post` WHERE `post`.`post_id` = $id");
	$query_del_status=mysql_query("DELETE FROM `database`.`status` WHERE `status`.`user_id` = $id");
 	$query_del_friend=mysql_query("DELETE FROM `database`.`friends` WHERE `friends`.`user_one` = $id OR user_two=$id");
 	$query_del_message_group=mysql_query("DELETE FROM `database`.`message_group` WHERE `message_group`.`user_one` = $id OR user_two=$id");
 	$query_del_message_group=mysql_query("DELETE FROM `database`.`message` WHERE `message`.`from_id` = $id");
 	header('Location: index.php');
 ?>