<?php
	include 'core/init.php';
	include'includes/overall/header.php';
?>
<style type="text/css">
.protect_link{
}
.protect_link:hover{
	color: rgb(255,100,255);
	text-decoration: underline;
}
</style>
	<h1>Sorry, you need to be logged to do that</h1>
	<p>Please <a href="register.php" class="protect_link" style="color: rgb(0,0,255);">Register</a> or <a href="index.php" class="protect_link" style="color: rgb(0,0,255);">Log In</a></p>
<?php include'includes/overall/footer.php'; ?>

