<?php
	include 'core/init.php';
	protect_page();
	include'includes/overall/header.php';
	include 'function_friend.php';
	$my_id=$_SESSION['id'];
	mysql_query("DELETE FROM `notifications_inbox` WHERE `user_two`='$my_id'")
?>
<h1 style="color:#fff;"><img class="title_icons"src="logos/icons/world91.png"> Notifications</h1>
<style type="text/css">
	.notification_row{
		padding: 10px;
		width: 800px;
		margin-left: 10px;
		border-top: solid 1px #fff; 
		-webkit-transition:all 0.3s;
	}
	.notification_row:first-child{
		border-bottom: solid 1px #fff;
	} 
	.notification_row:hover{
		background-color: rgba(0,0,0,0.23);
		color: #000;
	}  
	#notification_img{
	    width: 70px;
	    height: 70px;
	    background-position: 50% 25%;
	    background-size: cover;
	    -webkit-transition-duration: 500ms;
	    -webkit-transition-property: width, height;
	    border: 1px solid #fff;
	    display: inline-block;
	}
	#content_notificaton{
		vertical-align: top;
		display: inline-block;
	}
	#content_notificaton b{
		font-size: 15px;
		line-height: 12px;
	}
	#notification_comment{
		display: inline-block;
	}
	.notification_row #del img{
		width: 15px;
		height: 15px;
		border: none;
		opacity: 0.6;
		float: right;
		cursor: pointer;
		outline: 0;
		margin-top: -80px;
    }
    .notification_row #del img:hover{
    	opacity: 1;
    }
</style>
<?php
				$my_id=$_SESSION['id'];
				$con_query=mysql_query("SELECT * FROM `notifications` WHERE (`from`='$my_id' OR `to`='$my_id')");
				while ($run_con=mysql_fetch_array($con_query)) {
					$user_one=$run_con['from'];
					$user_two=$run_con['to'];
					$category=$run_con['category'];
					$comment=$run_con['content'];
					$id=$run_con['id'];
					$time=$run_con['time'];
					$date=$run_con['date'];
					if ($user_one == $my_id) {
						$user=$user_two;
					}else{
						$user=$user_one;
					}
					if ($user == $my_id) {
						$fname="You";
						$lname="";
					}else{
						$fname=getuser($user, 'fname');
						$lname=getuser($user, 'lname');
					}
					
					$img=getuser($user, 'img');
					echo "<a href='' style='display: block;'>
					<div class='notification_row'>
						<div id='notification_img' style='background-image: url(".$img.");'> </div>
						<div id='content_notificaton'><b>$fname $lname </b><span>$category</span><p>Comment: $comment</p><p>Date: $time $date</p></div>
						<a href='actions.php?action=delnotification&user=$id' title='Delete notification' id='del'><img src='logos/icons/cross97.png'></a>
					</div>
					</a>";
				}
	?>
	<script type="text/javascript">
		function  closebox() {
			var x =document.getElementById('searchbox');
			x.style.display="none";
		}
	</script>
	<div id="searchbox">
		<button onclick="closebox()"></button>
		<div class="container">
			<ul class="contList">
				<?php echo getinfo(); ?>
			</ul>			
		</div>
	</div>
<?php include'includes/overall/footer.php'; ?>
