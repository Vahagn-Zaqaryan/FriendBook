<?php
	include 'core/init.php';
	include'includes/overall/header.php';
	if (logged_in() === true) {
		include'includes/widgets/propage.php';
	}
	else{
		include'includes/widgets/home.php';	
	}
?>
<!-- <div id="loading"><img src="http://jxnblk.com/loading/loading-bubbles.svg" width="100px;"></div> -->
<?php include'includes/overall/footer.php'; ?>
<!-- UPDATE  `database`.`data` SET  `img` =  'images/nnnnnnnn.jpeg ' WHERE  `data`.`id` =16;-->
