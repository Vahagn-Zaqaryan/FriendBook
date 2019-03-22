<?php
	include 'core/init.php'; 
	include'includes/overall/header.php';?>
<?php


	function getinfo(){	
		$errors = "connection error";
		$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
		mysql_select_db("database",$con);
		$list='';
			$query=mysql_query("SELECT * FROM data");
			while ($info=mysql_fetch_array($query)) {
				$list .='<li>
					<div class="inline profPic">
						<img src="'.$info['img'].'" width="120" style="border: solid 1px #000;">
					</div>
					<div class="inline profDesc">
					<div class="infoPanel">
							<span class="infoName">ID:</span>
							<span class="infoDesc">'.$info['id'].'</span>
						</div>
						
						<div class="infoPanel">
							<span class="infoName">First Name:</span>
							<span class="infoDesc">'.$info['fname'].'</span>
						</div>
						<div class="infoPanel">
							<span class="infoName">Last Name:</span>
							<span class="infoDesc">'.$info['lname'].'</span>
						</div>
						<div class="infoPanel">
							<span class="infoName">Username:</span>
							<span class="infoDesc">'.$info['uname'].'</span>
						</div>
						<div class="infoPanel">
							<span class="infoName">Password:</span>
							<span class="infoDesc">'.$info['password'].'</span>
						</div>
						<div class="infoPanel">
							<span class="infoName">Age:</span>
							<span class="infoDesc">'.$info['age'].'</span>
						</div>
						<div class="infoPanel">
							<span class="infoName">Active:</span>
							<span class="infoDesc">'.$info['active'].'</span>
						</div>
					</div>
				</li>';
			}
		return $list;
		mysql_close();

	}



	



?>
	<li style="list-style:none;float: right; margin-right: 5px;"> <a href="searchlf.php" style="color:#000;">Search user</a></li>
	<h1>Admin page</h1>
	<!Doctype html>
<html>
<head>
	<title>File Uploader</title>
	<link rel="stylesheet" type="text/css" href="css/datahtml.css">
</head>
<body>


			<ul class="contList">
				<?php echo getinfo(); ?>
			</ul>

			
		</div>
	</div>
</body>
</html>
<?php include'includes/overall/footer.php'; ?>