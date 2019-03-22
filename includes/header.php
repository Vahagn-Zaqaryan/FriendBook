<header>
	<?php
	if (logged_in() === true) {
		include'includes/login/header.php';	
	}
	else{
		include'includes/manu.php';	
	}
	  ?>
	<div class="clear"></div>
</header>