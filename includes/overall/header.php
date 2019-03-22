<html>
	<?php include'includes/head.php'; ?>
	<body>
		<?php include'includes/header.php'; 
		if (logged_in() === true) {
			include'conteiner.php';	
		}
		else{
			include'containar_login.php';	
		}
		?>
			<?php include'includes/aside.php'; ?>