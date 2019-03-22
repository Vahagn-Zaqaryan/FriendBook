<?php
	$error="connection error";
	$error="connection error w/ database";
	mysql_connect("localhost", "root", "usbw") or die($error);
	mysql_select_db("database") or die ($error);
?>
