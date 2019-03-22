<?php
	include 'core/init.php';
	protect_page();
	include'includes/overall/header.php';
	include 'function_friend.php';
	$id = $_GET['id'];
	$my_id = $_SESSION['id'];
	function friend_rows(){
		$id = $_GET['id'];
		$quary=mysql_query("SELECT * FROM `friends` WHERE `user_one`='$id' OR `user_two`='$id'");
		$num_rows=mysql_num_rows($quary);
		if ($num_rows == 0) {
			echo "";
		}else{
			echo $num_rows;
		}
	}
	function info($id, $field){
		$query_get=mysql_query("SELECT $field FROM data WHERE `id`='$id'");
		$run=mysql_fetch_array($query_get);
		return $run[$field];
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/user_profile.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript">
		function  closebox() {
			var x =document.getElementById('searchbox');
			x.style.display="none";
		}
		$(document).ready(function () {
			$( "#find_friend" ).click(function() {
			  $( "#searchinput" ).focus();
			});
		});	
	</script>
	<style type="text/css">
		.right{
			margin-top: 15px;
		}
		.right a{
			background-color: #fff;
			padding: 5px 10px; 
			border: 1px solid #aaa;
			border-radius: 3px;

		}
		.big_text{
			margin: 70px 300px;
		}
		#content_parag{
			font-size: 12px;
			line-height: 16px;
			color: #777;
		}
	</style>	
	</head>
	<body>
		<div>
			<?php 
					if ($id == $my_id) {
				?>
				<div id="imgcoverboxforfile">
					<a href="#" id="photobutton"><img src="logos/icons/camera3.png"></a>
				</div>
				<?php 
					}else {
				?>
						<div class="coverbox">
						<?php
							$chack_frnds_query=mysql_query("SELECT id FROM friends WHERE (user_one='$my_id' AND user_two='$id') OR (user_one='$id' AND user_two='$my_id')");
							if (mysql_num_rows($chack_frnds_query) == 1) {
								echo "<a href='' class='friend_req_box'>Already, friands</a> | <a href='actions.php?action=unfriend&user=$id' class='friend_req_box'>Unfriend ".info($id,'fname')."</a>";
							}else{
								$form_query=mysql_query("SELECT `id` FROM `friend_req` WHERE `from`='$id' AND `to`='$my_id'");
								$to_query=mysql_query("SELECT `id` FROM `friend_req` WHERE `from`='$my_id' AND `to`='$id'");
								if (mysql_num_rows($form_query)) {
								 echo "<a href='' class='friend_req_box'>Ignore</a> | <a href='actions.php?action=accept&user=$id' class='friend_req_box' style='color:#000;'>Accept</a>";
								}elseif (mysql_num_rows($to_query)) {
								 echo "<a href='actions.php?action=cancel&user=$id' class='friend_req_box' style='color:#000;'>Cancel Request</a>";
								}else{
								 echo "<a href='actions.php?action=send&user=$id' class='friend_req_box' style='color:#000;'>Send Friend Request</a>";
								}
							}
						?>
						</div>
				<?php
					}		
				?>

			<div id='imgcover' style='background-image: url(<?php echo info($id,'imgcover');?>);'></div>
		</div>
		<?php 
		if ($id == $my_id) {
		?>
			<div id="imgcoverboxforfile" style="margin-top: -15px;margin-left: 20px;;">
				<a href="#" id="photobuttonp"><img src="logos/icons/camera3.png"></a>
			</div>
		<?php 
			}
		?>
		<div id='img' style='background-image: url(<?php echo info($id,'img');?>);'></div>
		<div class="fl"><h2 id="fl"><?php echo info($id,'fname') ." ". info($id,'lname'); ?></h2></div>
		<div id="navcontent">
			<ul>
				<a id="nav_a" href="profile.php?id=<?php echo $id; ?>"><li id="TB">Timeline</li></a>
				<a id="nav_a" href="friend_show.php?id=<?php echo $id; ?>"><li class="active">Friands <?php friend_rows(); ?></li></a>
				<a id="nav_a" href="photo_show.php?id=<?php echo $id; ?>"><li>Photos</li></a>
			</ul>
		</div><br>
		<div id="box">
			<div id="title_bar">
				<h1><img src="logos/icons/group67.png"> Friends</h1>
				<?php 
					if ($id == $my_id) {
				?>
				<div class="right">
					<a href="#" id="find_friend"><img id="icons"src="logos/icons/plus.png"> Find Friends</a>
					<a href="req.php"><img id="icons"src="logos/icons/req.png"> Requests <?php number_rows() ?></a>
				</div>
				<?php
					}
				?>
			</div>
			<div id="content_show">
				<?php
				$my_id=$_GET['id'];
				$frnd_query=mysql_query("SELECT user_one, user_two FROM friends WHERE (user_one='$my_id' OR user_two='$my_id')");
				$frnd_rows=mysql_num_rows($frnd_query);
				if ($frnd_rows == 0) {
					echo "<div class='big_text'>No activity to show</div>";
				}
				
				while ($run_frnd=mysql_fetch_array($frnd_query)) {
					$user_one=$run_frnd['user_one'];
					$user_two=$run_frnd['user_two'];
					if ($user_one == $my_id) {
						$user=$user_two;
					}else{
						$user=$user_one;
					}
					$fname=getuser($user, 'fname');
					$lname=getuser($user, 'lname');
					$img=getuser($user, 'img');
					$id=getuser($user, 'id');
					$quary_user=mysql_query("SELECT * FROM `friends` WHERE `user_one`='$id' OR `user_two`='$id'");
					while ($user_result=mysql_fetch_array($quary_user)) {
						$user_one=$user_result['user_one'];
						$user_two=$user_result['user_two'];
						if ($user_one == $id) {
							$user_frnd=$user_two;
						}else{
							$user_frnd=$user_one;
						}
						$quary=mysql_query("SELECT * FROM `friends` WHERE `user_one`='$id' OR `user_two`='$id'");
						$num_rows=mysql_num_rows($quary);
						$quary_my=mysql_query("SELECT * FROM `friends` WHERE (`user_one`='$my_id' AND `user_two`='$user_frnd') OR (`user_one`='$user_frnd' AND `user_two`='$my_id')");
						$num_mutual=mysql_num_rows($quary_my);
						if ($num_rows == 1) {
							echo "<a href='profile.php?id=$user' style='display: inline-block;text-decoration: none;'>
							<div class='friendrow'>
							<table>
								<tr>
									<td><div id='req_img' style='background-image: url(".$img.");' style='display: inline-block;'></div></td>
									<td><h4  id='req_h4'> $fname $lname</h4><p id='content_parag'>Friends $num_rows</p></td>
								</tr>
							</table>
						</div>
						</a>";
						}
						if ($num_mutual == 0) {

						}else{
							echo "<a href='profile.php?id=$user' style='display: inline-block;text-decoration: none;'>
							<div class='friendrow'>
							<table>
								<tr>
									<td><div id='req_img' style='background-image: url(".$img.");' style='display: inline-block;'></div></td>
									<td><h4  id='req_h4'> $fname $lname</h4><p id='content_parag'>Friends $num_rows(Mutual: $num_mutual)</p></td>
								</tr>
							</table>
						</div>
						</a>";
						}
						
						// while ($my_result=mysql_fetch_array($quary_user)) {
						// 	$user_one=$my_result['user_one'];
						// 	$user_two=$my_result['user_two'];
						// 	if ($user_one == $my_id) {
						// 		$my_frnd=$user_two;
						// 	}else{
						// 		$my_frnd=$user_one;
						// 	}
						// }	
					}
				}
		 ?>
			</div>
		</div>
	</div>
	</div>
	<div id="searchbox">
		<button onclick="closebox()"></button>
		<div class="container">
			<ul class="contList">
				<?php echo getinfo(); ?>
			</ul>			
		</div>
	</div>
	</body>
</html> 
<?php include'includes/overall/footer.php'; ?>