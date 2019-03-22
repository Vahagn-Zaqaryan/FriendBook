<?php 

function getinfo(){	

		error_reporting(0);
		$errors = "connection error";
		$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
		mysql_select_db("database",$con);
		if (isset($_POST['search'])) {
			$searchp=$_POST['search'];
			$query=mysql_query("SELECT * FROM data WHERE fname ='$searchp' OR lname= '$searchp'");
			$count=mysql_num_rows($query);
			if ($count == 0) { 
				echo "<h3 style='color:red;''>"."No results"."</h3>";
			}
		}
		$list='';
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