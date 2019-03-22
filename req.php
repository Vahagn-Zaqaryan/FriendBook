<?php
	include 'core/init.php';
	include'includes/overall/header.php';
	include 'function_friend.php';
?>
			<style type="text/css">
				#req_h4:hover{
					color: #000;
				}
				.reqrow{
					-webkit-transition: all 0.5s;
					width: 600px;
					margin-left: 10px;
					border: 1px solid #aaa;
					border-radius: 3px;
					display: inline-block;
				}
				.reqrow img{
					width: 100px;
				}
				.reqrow h4{
					margin-left: 10px;
					color: #000;
					display: inline-block;
					vertical-align: top;
					text-transform: capitalize;
				} 
				.reqrow:hover{
					background-color: rgba(0,0,0,0.1003551);
				} 
				.reqrow h4:hover{
					color: #000;
				}
				.input{
					margin: -70px 90px;
					-webkit-transition: all 0.5s;
					background: rgb(0, 90, 250);
					color: white;
				    border-radius: 6px;
				    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
				    padding: 8px 16px;
				    border: 1px solid #fff;
				    box-shadow: inset  0 0 3px rgba(255,255,255,0.5)
				}
				.input:hover{
					background: rgb(0, 130, 250);
				}
				.input_white{
					margin: -70px 10px;
					-webkit-transition: all 0.5s;
					background-color: #fff;
					color: white;
				    border-radius: 6px;
				    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
				    padding: 8px 16px;
				    border: 1px solid rgb(0, 90, 250);
				    box-shadow: inset  0 0 3px rgba(0, 90, 250,0.5);
				}
				.input_white:hover{
					background: rgb(230, 230, 230);
				}
			</style>
			<script type="text/javascript">
		function  closebox() {
			var x =document.getElementById('searchbox');
			x.style.display="none";
		}
	</script>
			<h1><img class="title_icons"src="logos/icons/req.png"> Requests</h1>
			<?php 
				$id=$_SESSION['id'];
				$req_query=mysql_query("SELECT `from` FROM friend_req WHERE `to`='$my_id'");
				while ($run_req=mysql_fetch_array($req_query)) {
					$form=$run_req['from'];
					$fname=getuser($form, 'fname');
					$lname=getuser($form, 'lname');
					$img=getuser($form, 'img');
					$user_id=getuser($form, 'id');
					$quary=mysql_query("SELECT * FROM `friends` WHERE `user_one`='$id' OR `user_two`='$id'");
					$num_rows=mysql_num_rows($quary);
					echo "<a href='profile.php?id=$form' style='display: block;'>
					<div class='reqrow'>
					<table>
						<tr>
							<td><div id='req_img' style='background-image: url(".$img.");'></div></td>
							<td><h4 id='req_h4'> $fname $lname</h4></td>
						</tr>
					</table>
					<a href='actions.php?action=ignore&user=$user_id'class='right input_white'>Ignore</a>
					<a href='actions.php?action=accept&user=$user_id'class='right input' style='color: #fff;'><img src='logos/icons/accept_white.png' id='icons'> Add Friend</a>
				</div>
				</a>";
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