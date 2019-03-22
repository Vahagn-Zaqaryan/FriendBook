<?php 
$my_id = $_SESSION['id'];
function getinfo(){	

		error_reporting(0);
		$errors = "connection error";
		$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
		mysql_select_db("database",$con);
		if (isset($_POST['search'])) {
			$searchp = $_POST['search'];
			$searchp = preg_replace ("#[^0-9a-z]#i","",$searchp);
			$query=mysql_query("SELECT * FROM data WHERE fname LIKE '%$searchp%' OR lname LIKE '%$searchp%'");
			$count=mysql_num_rows($query);
			if ($count == 0) { 
				echo "<h3 style='color:red;''>"."No results"."</h3>";
			}
		}
		$list='';
			while ($info=mysql_fetch_array($query)) {
				$list .='<a href="./profile.php?id='.$info['id'].'">
							<div class="searchrow">
								<table>
									<tr>
										<td><div id="search_img" style="background-image: url('.$info['img'].');"></div></td>
										<td><h4>'.$info['fname']." ".$info['lname'].'</h4></td>
									</tr>
								</table>
							</div>
						</a>';
			}
		return $list;
		mysql_close();

	}
	?>
	<style type="text/css">
		.logo{
			width: 30px;
			margin-left: 80px;
			margin-top: 7px;
		}
		.searchinputsbox{
			position: absolute;top: 13px;left: 120px;
			display: inline-block;
		}
        #searchinput{
		  -webkit-transition: all 0.30s ease-in-out;
		  -moz-transition: all 0.30s ease-in-out;
		  -ms-transition: all 0.30s ease-in-out;
		  -o-transition: all 0.30s ease-in-out;
		  outline: none;
		  padding: 3px ;
		  position: relative;
		  border: 1px solid #DDDDDD;
		  width: 450px;  
		  height: 30px;
		  font-size: 20px; 
		  bottom: 12px; 
		  border-radius: 3px 0px 0px 3px;
		  padding-left: 5px;
		}
		 
		#searchinput:focus { 
		  padding-right: 3px;
		}
		.searchbutton{
		    height: 30px;
		    position: relative;
		    top: -6px;
		    right: 4px;
		    font-size: 20px;
		    border-radius: 0px 3px 3px 0px;
		    border: 1px solid #DDDDDD;
		    outline: 0;
		    cursor: pointer;
		      -webkit-transition: all 0.30s ease-in-out;
		  -moz-transition: all 0.30s ease-in-out;
		  -ms-transition: all 0.30s ease-in-out;
		  -o-transition: all 0.30s ease-in-out;
		  background:url(logos/icons/magnifier12.png) no-repeat 15px 6px #ffffff;
            width: 50px;
		}
		.searchbutton:focus{
		  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
		  border: 1px solid rgba(81, 203, 238, 1);
		}
		.searchbutton:hover{
			background-color: rgba(230,230,230,1);
		}
		#aside_img{
            width: 20px;
            height: 20px;
            background-position: 50% 25%;
            background-size: cover;
            -webkit-transition-duration: 500ms;
            -webkit-transition-property: width, height;
            border: 1px solid #274380;
            border-radius: 2px;
            display: inline-block;
        }
        #header_bar{
        	position: absolute;top: 8px;left: 700px;
        }
        #navmain_profile ul li{
        	float: right;
        	border-radius: 3px;
        	padding: 2px 4px 0px 4px;
        }
        #navmain_profile ul li:hover{
        	background-color: #385490;
        }
        #navmain_profile ul li a{
        	color: #fff;
        	text-decoration: none;
        }
        .user_name_header{
        	margin-top: -2px;
        	display: inline-block;
		    max-width: 175px;
		    overflow: hidden;
		    padding-left: 6px;
		    padding-right: 6;
		    text-overflow: ellipsis;
		    vertical-align: top;
		    white-space: nowrap;
		    color: #fff;
	        font-size: 12px;
			font-weight: bold;
			line-height: 27px;
			cursor: pointer;
        }
	</style>
<nav id="navmain_profile">			
	<ul>

		<form action="" method="POST" enctype="multipart/form-data">
			<a href="index.php"><img src="logos/logo_nav_bar.png" class="logo"></a>
			<div class="searchinputsbox">
	            <input type="search" name="search" placeholder="Find friands..." id="searchinput">
	            <input type="submit" name="submit" value class="searchbutton" id="search_button_friend">
	        	<div class="clear"></div>
	        </div>
		</form>
		<div id="header_bar">
			<li>
				<a href="index.php">
					<span class="user_name_header">Home</span>	
				</a>
			</li>
			<li title="profile">
				<a href="profile.php?id=<?php echo $user_data['id']; ?>">
					<?php echo  "<div id='aside_img' style='background-image: url(".$user_data['img'].");'></div>"; ?><span class="user_name_header"><?php echo $user_data['fname']; ?></span>	
				</a>
			</li>
		</div>
	</ul>
</nav>
