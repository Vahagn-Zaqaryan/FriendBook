<?php 
	function getuser($id, $field){
		$query_get=mysql_query("SELECT $field FROM data WHERE `id`='$id'");
		$run=mysql_fetch_array($query_get);
		return $run[$field];
	}
 ?>