<?php 
	include'core/init.php';
	
	if (empty($_POST) === false) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		if (empty($username) === true || empty($password) === true) {
			$errors[] =  "You need to enter a username and password";
		}else if (user_exitsts($username) === false) {
			$errors[] = "We can't find that username.Have you registered.";
		}else if (user_active($username) === false) {
			 $errors[] = "You haven't activated your account";
		}else{
			if (strlen($password) > 32) {
				$errors[] = "Password too long"."<br>";
			}
		$login = login($username, $password);
		if ($login === false) {
				$errors[] =  "This username/password is incorrect.";
			}else{
				$_SESSION['id'] = $login;
				header ('Location: profile.php?id='.$_SESSION['id']);
				exit();
			}
	}
		
}else{
	$errors[] = "No data reseived";
}
include'includes/overall/header.php';
	function output_errors($errors)
	{
		return '<ul><li style="color:#fff;">'.implode('</li><li>',$errors).'</li><ul>';
	}
	if (empty($errors) === false) {
		?>
			<h2 style="color:#fff;">We tride to log you in, but...</h2>
		<?php
		echo output_errors($errors);;
	} ?>
	<div class="widget">
		<form action="login.php" method="post">
			<ul id="login">
				<li><br><input type="text" name="username" placeholder="Username"></li>
				<li><br><input type="password" name="password" placeholder="Password"></li>
				<li> <input type="submit" value="Log In" class="login" /></li>
				<a href="register.php" id="cna" style="color: #fff;"><li><img id="icons"src="logos/icons/plus32.png"> Create new account</li></a>
			</ul>
		</form>
	</div>
</div>
	<?php  
include'includes/overall/footer.php'; 
 
 ?>