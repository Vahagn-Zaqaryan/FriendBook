<?php
	include 'core/init.php';
	protect_page();
	include'includes/overall/header.php';
	if (empty($_POST) === false) {
		$required_fields = array('current_username', 'username', 'username_again');
		foreach ($_POST as $key => $value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[]="Fields marked with an asterisk are required";
				break 1;
			}
		}
		if ($_POST['current_username'] === $user_data['uname']) {
			if (trim($_POST['username']) !== trim($_POST['username_again'])) {
				$errors[]="Your new usernames don't match";
			}elseif (strlen($_POST['username']) < 6) {
				$errors[]='Your username must be at least 6 characters';
			}elseif (user_exitsts($_POST['username']) === true) {
				$errors[]='Sorry, the naw username \'' .$_POST['username']. '\' is already taken';
			}elseif (preg_match('/\\s/', $_POST['username']) == true) {
				$errors[]='Your new username must not contain any spaces';
			}
		}else{
			$errors[]='Your current username is incorrect';
		}
	}	
	function output_errors($errors)
	{
		return '<ul><li>'.implode('</li><li>',$errors).'</li><ul>';
	}
?>
	<style type="text/css">
	form li{
		list-style: none;
	}
	input[type="text"]{
		width: 255px;
		height: 45px;
		border-radius: 10px;
		border: solid 1px #ccc;
		font-size: 18px;
		padding-left: 10px; 
	}
	.styled-button-10 {
		background:#5CCD00;
		background:-moz-linear-gradient(top,#bcadad 0%,#bc198f 100%);
		background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#5CCD00),color-stop(100%,#bc198f));
		background:-webkit-linear-gradient(top,#bcadad 0%,#bc198f 100%);
		background:-o-linear-gradient(top,#bcadad 0%,#bc198f 100%);
		background:-ms-linear-gradient(top,#bcadad 0%,#bc198f 100%);
		background:linear-gradient(top,#bcadad 0%,#bc198f 100%);
		filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#5CCD00', endColorstr='#4AA400',GradientType=0);
		padding:10px 15px;
		color:#fff;
		font-family:'Helvetica Neue',sans-serif;
		font-size:16px;
		border-radius:5px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border:1px solid #459A00
	}
	.styled-button-10:hover {
		background:#5CCD00;
		background:-moz-linear-gradient(top,#aa2345 0%,#bc198f 100%);
		background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#5CCD00),color-stop(100%,#bc198f));
		background:-webkit-linear-gradient(top,#aa2345 0%,#bc198f 100%);
		background:-o-linear-gradient(top,#aa2345 0%,#bc198f 100%);
		background:-ms-linear-gradient(top,#aa2345 0%,#bc198f 100%);
		background:linear-gradient(top,#aa2345 0%,#bc198f 100%);
		filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#5CCD00', endColorstr='#4AA400',GradientType=0);
		padding:10px 15px;
		color:#fff;
		font-family:'Helvetica Neue',sans-serif;
		font-size:16px;
		border-radius:5px;
		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border:1px solid #459A00;
	}
	</style>
	<script type="text/javascript">
		function  closebox() {
			var x =document.getElementById('searchbox');
			x.style.display="none";
		}
	</script>
	<h1><img class="title_icons"src="logos/icons/edit_settings.png"> Update Username</h1>
	<?php 
		if (empty($_POST) === false && empty($errors) === true) {
			$username = $_POST['username'];
			$errors = "connection error";
			$id= $user_data['id'];
			$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
			mysql_select_db("database",$con);
			$query= mysql_query("UPDATE  `database`.`data` SET  `uname` =  '$username' WHERE  `data`.`id` = \"$id\" ");
			header('Location: index.php?success');
		}else {
			echo output_errors($errors);
		}	
	 ?>
	<form action="" method="POST">
		<li>
			<input type="text" name="current_username" placeholder="Current username">
		</li>
		<li>
			<br>
			<input type="text" name="username" placeholder="New username">
		</li>
		<li>
			<br>
			<input type="text" name="username_again" placeholder="New username again">
		</li><br>
		<li>
			<input type="submit" value="Update" class="styled-button-10">
		</li>
	</form>
	<div id="searchbox">
		<button onclick="closebox()"></button>
		<div class="container">
			<ul class="contList">
				<?php echo getinfo(); ?>
			</ul>			
		</div>
	</div>
<?php include'includes/overall/footer.php'; ?>

