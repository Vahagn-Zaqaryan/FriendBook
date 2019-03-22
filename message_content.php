<?php 
	include 'core/init.php';
	$my_id = $_SESSION['id'];
	$hash = $_GET['hash'];
	$message_quary=mysql_query("SELECT `from_id`, `message`, `id` FROM `message` WHERE `group_hash`='$hash'");
	while($run_message = mysql_fetch_array($message_quary)){
			$from_id = $run_message['from_id'];
			$id = $run_message['id'];
			$message = $run_message['message'];
			$user_query = mysql_query("SELECT `img`,`id`,`fname` FROM `data` WHERE id='$from_id'");
			$run_user = mysql_fetch_array($user_query);
			$img = $run_user['img'];
			if ($from_id == $my_id) {
				
				echo "
				<a href='actions.php?action=delmess&user=$id&hash=$hash'>
					<div class='message_box'>
                    	<div id='mess_box_con'>$message</div>
					  </div></a>
					  <br><br>";
			}else{
				echo "<div class='message_box_user'>
                    	<div id='mess_img' style='background-image: url(".$img.");'></div>
                    	<div id='mess_box_con'>$message</div>
					  </div><br>";
					  $user_id=$id;
			}	
	}
	$num_rows=mysql_num_rows($message_quary);
		if ($num_rows == 0) {
		echo "<div class='middle_text'>No messages</div>";
	}
?>