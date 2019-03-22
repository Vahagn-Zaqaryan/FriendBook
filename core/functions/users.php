<?php
	function user_count()
	{
		return mysql_result(mysql_query("SELECT COUNT(id) FROM data WHERE active=1"), 0);
	}

	function user_data($user_id)
	{
		$data = array();
		$user_id = (int)$user_id;
		$func_num_args=func_num_args();
		$func_get_args=func_get_args();
		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields='`'.implode('`,`', $func_get_args).'`';
			$data=mysql_fetch_array( mysql_query("SELECT $fields FROM data WHERE id= $user_id"));
			return $data;
		}
	}
	function logged_in()
	 {
	 	return (isset($_SESSION['id'])) ? true : false;
	 } 
	function user_exitsts($username) {
		$username = sanitize($username);
		return (mysql_result(mysql_query("SELECT COUNT(id) FROM data WHERE uname='$username'"), 0) == 1) ? true :false;
	}
	function user_active($username) {
		$username= sanitize($username);
		return (mysql_result(mysql_query("SELECT COUNT(id) FROM data WHERE uname='$username' AND active = '1'"), 0) == 1) ? true :false;
	}

	function user_id_form_username($username)
	{
		$username = sanitize($username);
		return mysql_result(mysql_query("SELECT id FROM data WHERE uname='$username'"), 0, `id`);
	}
	function login($username, $password)
	{
		$user_id=user_id_form_username($username);
		$username=sanitize($username);
		$password=$password;
		return (mysql_result(mysql_query("SELECT COUNT(id) FROM data WHERE password='$password' AND uname='$username'"), 0)==1) ? $user_id :false; 
	}
	
?>