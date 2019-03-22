<?php
	include 'core/init.php';
	include'includes/overall/header.php';
	include'search/php_lf.php';
 ?>
	<h1>Search page</h1>
	<!Doctype html>
<html>
<head>
	<style type="text/css">
	.headerCont a{
		color: #000;
		text-decoration: underline;
	}
	</style>
	<title>File Uploader</title>
	<link rel="stylesheet" type="text/css" href="css/datahtml.css">
</head>
<body>
	<div class="wrapper">
		<div class="header">

			<div class="headerCont">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="search" placeholder="Search">
					<input type="submit" name="submit" value="Search">
				</form>
				
			</div>
		</div>

		<div class="container">

			<ul class="contList">
				<?php echo getinfo(); ?>
			</ul>

			
		</div>
	</div>
</body>
</html>
<?php include'includes/overall/footer.php'; ?>
