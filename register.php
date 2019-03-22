<?php
	include 'core/init.php';
	include'includes/overall/header.php';
	if (empty($_POST) === false) {
		$required_fields = array('firstName', 'lastName', 'userName', 'password', 'password_again');
		foreach ($_POST as $key => $value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[]="Fields marked with an asterisk are required";
				break 1;
			}
		}
		if (empty($errors) === true) {
			if (user_exitsts($_POST['userName']) === true) {
				$errors[]='Sorry, the username \'' .$_POST['userName']. '\' is already taken';
			}
			if (preg_match('/\\s/', $_POST['userName']) == true) {
				$errors[]='Your username must not contain any spaces';
			}
			if (strlen($_POST['password']) < 6) {
				$errors[]='Your password must be at least 6 characters';
			}
			if ($_POST['password'] !== $_POST['password_again']) {
				$errors[]='Your passwords don\'t match';
			}
		}
	}
	function output_errors($errors)
	{
		return '<ul><li style="color:#fff;">'.implode('</li><li>',$errors).'</li><ul>';
	}
?>
	<h1 style="color: #fff;">Register</h1>
	<?php
		if (isset($_GET['success']) && empty($_GET['success'])) {
			echo "You've been registered successfully";
			echo "<br><a href='index.php'>continue-></a>";
		}else{
		if (empty($_POST) === false && empty($errors) === true) {
				$firstName = $_POST['firstName'];
				$lastName = $_POST['lastName'];
				$age = $_POST['age'];
				$userName = $_POST['userName'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				$imgcover="logos/img2.jpg";
				$img="logos/avatar.png";
				$errors = "connection error";
				$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
				mysql_select_db("database",$con);
				echo "hell yeah!";
				$query= mysql_query("INSERT INTO data (fname,lname,uname,age,password,img,imgcover) VALUES ('$firstName', '$lastName','$userName','$age','$password','$img','$imgcover')");
				echo "boom motherfucker";
				// header('Location: index.php');
				// header('Location: index.php?success');
			exit();
		}else {
			echo output_errors($errors);
		}

	?>
<html>
	<head>
		<title></title>
		<style type="text/css">
		</style>
	</head>
	<body>
		<form action="" method="POST" enctype="multipart/form-data">
			<ul id="login">
				<li><input type="text" name="firstName" placeholder="First Name" maxlength="15"></li>
				<li><input type="text" name="lastName" placeholder="Last Name" maxlength="16"></li>
				<li><input type="text" name="userName" placeholder="Username" maxlength="20"></li>
				<li><input type="password" name="password" placeholder="Password" maxlength="20"></li>
				<li><input type="password" name="password_again" placeholder="Re-enter password" maxlength="20"></li>
				<li><input type="submit" name="submit" value="Sign Up" class="login"></li>
			</ul>
	</body>
</html>
<?php
	}
 include'includes/overall/footer.php';
 ?>
