<?php
	include 'core/init.php';
	protect_page();
	include'includes/overall/header.php';
	include 'function_friend.php';
?>
<?php $my_id=$_SESSION['id']; ?>
<style type="text/css">
.message_row{
	padding: 10px;
	width: 800px;
	margin-left: 10px;
	border-bottom: solid 1px #aaa; 
	-webkit-transition:all 0.1s;
}
.message_row:first-child{
	border-top: solid 1px #aaa;
}
.message_row:hover{
	background-color: rgba(0,0,0,0.23);
	color: #000;
}
#message_img{
    width: 70px;
    height: 70px;
    background-position: 50% 25%;
    background-size: cover;
    -webkit-transition-duration: 500ms;
    -webkit-transition-property: width, height;
    border: 1px solid #aaa;
    display: inline-block;
}
</style>
<script type="text/javascript">
		function  closebox() {
			var x =document.getElementById('searchbox');
			x.style.display="none";
		}
	</script>
<?php
		if(!isset($_GET['hash']) && empty($_GET['hash'])){
				echo "<h1><img class='title_icons' src='logos/icons/messanger.png'> Messanger</h1>";
				$my_id=$_SESSION['id'];
				$con_query=mysql_query("SELECT `hash`, `user_one`,`user_two` FROM `message_group` WHERE (`user_one`='$my_id' OR `user_two`='$my_id')");
				while ($run_con=mysql_fetch_array($con_query)) {
					$hash=$run_con['hash'];
					$user_one=$run_con['user_one'];
					$user_two=$run_con['user_two'];
					if ($user_one == $my_id) {
						$user=$user_two;
					}else{
						$user=$user_one;
					}
					$fname=getuser($user, 'fname');
					$lname=getuser($user, 'lname');
					$img=getuser($user, 'img');
					echo "<a href='conversations.php?hash=$hash' style='display: block;text-decoration: none;'>
					<div class='message_row'>
					<table>
						<tr>
							<td><div id='message_img' style='background-image: url(".$img.");'> </div></td>
							<td><h4 id='req_h4'>$fname $lname<div class='clear'></div></h4></td>
						</tr>
					</table>
				</div>
				</a>";
				}
			}
	?>
	<div id="searchbox">
		<button onclick="closebox()"></button>
		<div class="container">
			<ul class="contList">
				<?php echo getinfo(); ?>
			</ul>			
		</div>
	</div>				
<?php include'includes/overall/footer.php'; ?>