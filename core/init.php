<?php 
	session_start();
	error_reporting();
	require "database/connect.php";
	require "functions/general.php";
	require "functions/users.php";
	if (logged_in()=== true) {
		$user_data= user_data($_SESSION['id'],'id','uname', 'fname', 'lname', 'email','img','age','password','imgcover');
		if (user_active($user_data['uname']) === false) {
			session_destroy();
			header('Location: index.php');
			exit();
		}
	}
	$errors = array();
 ?>
 