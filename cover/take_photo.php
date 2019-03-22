<?php
	include '../core/init.php';
	protect_page();
	$my_id = $_SESSION['id']; 
	$photo_query = mysql_query("SELECT * FROM `database`.`photo` WHERE `user_id`='$my_id' ORDER BY `id` DESC");
	while ($run_query=mysql_fetch_array($photo_query)) {
		echo '<a href="photo_put.php?img='.$run_query['img'].'&category=cover&option=take"><div class="photo_pc" style="background-image: url('.$run_query['img'].');"></div>';
	}
?>
