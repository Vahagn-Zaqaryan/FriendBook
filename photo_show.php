<?php 
	include 'core/init.php';
	protect_page();
	include'includes/overall/header.php';
	$id = $_GET['id'];
	$my_id = $_SESSION['id'];
 ?>
 <?php 
 error_reporting(0);
	$tmp = $_FILES['addphoto']['tmp_name'];
	$name = $_FILES['addphoto']['name'];
	$rand_img = rand();
 	if(move_uploaded_file($tmp, 'images/'.$rand_img.$name)){
		$errors = "connection error";
		$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
		mysql_select_db("database",$con);
		$id= $user_data['id'];
        $post_date=date("d.m.Y");
        $post_time=date("H:i:s");       
        $quary_post=mysql_query("INSERT INTO `database`.`post` (`post_id`, `post_img`, `post_category`, `post_date`,`post_time`) VALUES ('$id', 'images/$rand_img$name', 'change cover photo', '$post_date', '$post_time');");
	    $quary_photo=mysql_query("INSERT INTO `database`.`photo` (`id`,`user_id`,`img`) VALUES ('','$id','images/$rand_img$name');");
    	header("Location: index.php");
    	
    }
?>
<?php

	
	function getinfophoto($id){	
		$id = $_GET['id'];
		$my_id = $_SESSION['id'];
		$list='';
		$query=mysql_query("SELECT * FROM photo WHERE user_id='$id' ORDER BY id DESC");
		$num_rows=mysql_num_rows($query);
		if ($num_rows == 0) {
			$list .="<div class='big_text'>No activity to show</div>";
		}
		while ($info=mysql_fetch_array($query)) {
			if ($id == $my_id) {
				$list .='
				<div class="photo">
			        <div id="photo_img" style="background-image: url('.$info['img'].');" img_url="'.$info['img'].'" data-src="'.$info['img'].'">
				        <a href="'.$info['img'].'" title="Download photo" download id="download">
				        	<img src="logos/icons/download.png">
				        </a>
				        <a href="actions.php?action=delphoto&user='.$info['id'].'" title="Delete photo" id="del">
				        	<img src="logos/icons/delete.png">
				        </a>
			        </div>
			    </div>
			';
			}else{
				$list .='
				<div class="photo">
			        <div id="photo_img" style="background-image: url('.$info['img'].');" img_url="'.$info['img'].'" data-src="'.$info['img'].'">
				        <a href="'.$info['img'].'" title="Download photo" download id="download">
				        	<img src="logos/icons/download.png">
				        </a>
			        </div>
			    </div>
			';
			}
		}
	return $list;
	mysql_close();
	}
	function getinfophoto_next_prev($id){	
		$errors = "connection error";
		$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
		mysql_select_db("database",$con);
		$list='';
			$query=mysql_query("SELECT * FROM photo WHERE user_id='$id' ORDER BY id DESC");
			$num_rows=mysql_num_rows($query);
			if ($num_rows == 0) {
				$list .="<div class='big_text'>No activity to show</div>";
			}
			while ($info=mysql_fetch_array($query)) {
				$list .='
					<img src="'.$info['img'].'" id="big_img">
				';
			}
		return $list;
		mysql_close();

	}
	function friend_rows(){
		$id = $_GET['id'];
		$quary=mysql_query("SELECT * FROM `friends` WHERE `user_one`='$id' OR `user_two`='$id'");
		$num_rows=mysql_num_rows($quary);
		if ($num_rows == 0) {
			echo "";
		}else{
			echo $num_rows;
		}
	}
	function info($id, $field){
		$query_get=mysql_query("SELECT $field FROM data WHERE `id`='$id'");
		$run=mysql_fetch_array($query_get);
		return $run[$field];
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/user_profile.css">
	<style type="text/css">
		.photo{
			display: inline-block;
		}
		 #photo_img{
                width: 206px;
                height: 206px;
                background-position: 50% 25%;
                background-size: cover;
                -webkit-transition-duration: 500ms;
                -webkit-transition-property: width, height;
                border: 1px solid #aaa;
                display: inline-block;
            } 

        #content_show .photo #photo_img #del{
        	padding: 4px;
        	background-color: rgba(255,255,255,1);
            margin: 5px;
            width: 14px;
            height: 14px;
            border: 1px #aaa solid;
            float: right;
            cursor: pointer;
            outline: 0;
            border-radius: 100%;
        }
        #content_show .photo #photo_img #download{
        	padding: 4px;
        	background-color: rgba(255,255,255,1);
            margin: 5px;
            width: 14px;
            height: 14px;
            border: 1px #aaa solid;
            float: left;
            cursor: pointer;
            outline: 0;
            border-radius: 100%;
        }
        .photo img{
        	width: 14px;
        	opacity: 0.8;
        }
        .photo img:hover{
        	opacity: 1;
        }
        #black_screen{
	        background-color: rgba(0,0,0,0.6);
	        width: 99%;
	        padding: 10px;
	        height: 100%;
	        box-shadow: 0px 0px 5px #ccc;
	        position: fixed;left: 0px;top: 0px;
	        display: none;
	        z-index: 9999;
	        margin: auto;
	    }
	    .photo_box .photo_zoom_bar{
	    	margin-top: 0;
	    	background-color: #F6F7F8;
	    	border: 1px solid #ddd;
	    	width: 330px;
	    	height: 648px;
	    }
	    .photo_zoom_bar .title_bar{
	    	border-radius: 3px 3px 0 0;
	        background-color: rgb(240,240,240);
	        border-bottom: 1px solid #E5E5E5;
	        padding: 10px 12px;
	        height: 20px;
	    }
	    .close{
	        float: right;
	        cursor: pointer;
	    }
	    .close img{
	    	margin: 5px;
	    	width: 10px;
	    	opacity: 0.5;
	    }
	    .close img:hover{
	    	opacity: 1;
	    }
	    .photo_box{
	    	margin: 20px auto;
	    	background-color: rgba(0,0,0,0.8);
	    	width: 1100px;
	    	height: 650px;
	    }
	    #curr_img img{
	    	max-width: 740px;
	    	min-height: 500px;
	    	margin: 40px 10px;
	    	max-height: 620px;
	    }
	    .clear{
	        clear: both;
	    }
		.slideshow img {
		    display: none;
		}
		.slideshow img:first-child {
		    display: inline-block;
		}
		.big_text{
			margin: 70px 300px;
		}
		.right{
			margin-top: 15px;
		}
		.right a{
			background-color: #fff;
			padding: 5px 10px; 
			border: 1px solid #aaa;
			border-radius: 3px;

		}
		#addphotobox{
	        border-radius: 3px;
        	background-color: rgba(255,255,255,1);
        	width: 450px;
        	height: 150px;
        	position: fixed;top: 250px;
        	z-index: 9999;
        	margin: auto;
	    }
	    #addphotobox #title_bar{
	        border-radius: 3px 3px 0 0;
	        background-color: #F6F7F8;
	        border-bottom: 1px solid #E5E5E5;
	        padding: 10px 12px;
	        height: 20px;
	    }
	    #addphotobox #title{
	        float: left;
	        cursor: pointer;
	    }
	    #addphotobox #title h3{
	        margin: 0;
	        padding: 0;
	        float: left;
	        cursor: pointer;
	        color: #141823;
	        font-size: 14px;
	        line-height: 19px;
	    }
	    #addphotobox #addphotoclose{
	        float: right;
	        cursor: pointer;
	    }
	    #addphotobox #addphotoclose img{
	        margin: 5px;
        	width: 10px;
        	opacity: 0.5;
	    }
	    #addphotobox #addphotoclose img:hover{
	        opacity: 1;
	    }
	    .clear{
	        clear: both;
	    }
	    #addphotobox #content{
	        padding: 5px;
	    }
	    #button_bar{
	        background-color: #EAE4ED;
	        width: 100%;
	        height: 40px;
	        position: absolute;bottom: 0px;
	        margin-left:-5px ;
	        border-radius: 0px 0px 3px 3px;
	        border-top: 1px solid #C1C1C3;
	    }
	    #button_bar input{
	        margin: 3px;
	    } 
	    #big_img{
	    	max-width: 740px;
	    	min-height: 500px;
	    	margin: 40px 10px;
	    	max-height: 620px;
	    }
	</style>
		<title></title>
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript">
			function  closebox() {
				var x =document.getElementById('searchbox');
				x.style.display="none";
			}
			
            $(document).ready(function () {
            	
                $('.photo').click(function(){
                    $('#black_screen').show();
                });
                $('#zoom_close').click(function(){
                    $('#black_screen').hide();
                    $("#curr_img").empty();
                });
                $(document).keyup(function(e) { 
			        if (e.which == 27) {
			            $('#black_screen').hide();
			            $("#curr_img").empty();
			        }           
			    }); 
        $('#content_show div div').click(function(){
            var src = $(this).attr('img_url');
            $("#curr_img").append("<img src='"+ src +"' id='big_img'>");
         });  
        $("#imgNext").click(function () {
	     	$("#curr_img").empty();
	         var $curr = $('.slideshow img:visible');
	             $next = ($curr.next().length) ? $curr.next() : $('.slideshow img').first();
	         $next.css('z-index', 2).show(function () {
	             $curr.hide().css('z-index', 0);
	             $next.css('z-index', 1);
	         });
	     });

	     $("#imgPrev").click(function () {

	     	$("#curr_img").empty();
	         var $curr = $('.slideshow img:visible'),
	             $prev = ($curr.prev().length) ? $curr.prev() : $('.slideshow img').last();
	         $prev.css('z-index', 2).show(function () {
	             $curr.hide().css('z-index', 0);
	             $prev.css('z-index', 1);
	         });
	     });
	 	});
		 $(document).ready(function () {
		 	var window_height = $(window).height();
	        var window_width = $(window).width();
	        var div_height = $('#deletebox').height();
	        var div_width = $('#deletebox').width();
	        $('#addphotobox').css('left', (window_width/3)-(div_width/3));

		 	$('#add_photo').click(function(){
	            $('#photo_ad').fadeIn();
	        });
	        $('#addphotoclose').click(function(){
	            $('#photo_ad').fadeOut();
	        });
	   //      $('.photo').mouseover(function() {
				// $('#del').fadeIn();
				// $('#download').fadeIn();
		  //   });
		  //   $('.photo').mouseout(function() {
				// $('#del').fadeIn();
				// $('#download').fadeIn();
		  //   });
	    });
		$(document).keyup(function(e) { 
	        if (e.which == 27) {
	            $('#photo_ad').fadeOut();
	        }           
	    });
		</script>	
	</head>
	<body>

		<div>
			<?php 
					if ($id == $my_id) {
				?>
				<div id="imgcoverboxforfile">
					<a href="#" id="photobutton"><img src="logos/icons/camera3.png"></a>
				</div>
				<?php 
					}else {
				?>
						<div class="coverbox">
						<?php
							$chack_frnds_query=mysql_query("SELECT id FROM friends WHERE (user_one='$my_id' AND user_two='$id') OR (user_one='$id' AND user_two='$my_id')");
							if (mysql_num_rows($chack_frnds_query) == 1) {
								echo "<a href='' class='friend_req_box'>Already, friands</a> | <a href='actions.php?action=unfriend&user=$id' class='friend_req_box'>Unfriend ".info($id,'fname')."</a>";
							}else{
								$form_query=mysql_query("SELECT `id` FROM `friend_req` WHERE `from`='$id' AND `to`='$my_id'");
								$to_query=mysql_query("SELECT `id` FROM `friend_req` WHERE `from`='$my_id' AND `to`='$id'");
								if (mysql_num_rows($form_query)) {
								 echo "<a href='' class='friend_req_box'>Ignore</a> | <a href='actions.php?action=accept&user=$id' class='friend_req_box' style='color:#000;'>Accept</a>";
								}elseif (mysql_num_rows($to_query)) {
								 echo "<a href='actions.php?action=cancel&user=$id' class='friend_req_box' style='color:#000;'>Cancel Request</a>";
								}else{
								 echo "<a href='actions.php?action=send&user=$id' class='friend_req_box' style='color:#000;'>Send Friend Request</a>";
								}
							}
						?>
						</div>
				<?php
					}		
				?>
			<div id='imgcover' style='background-image: url(<?php echo info($id,'imgcover');?>);'></div>
		</div>
		<?php 
		if ($id == $my_id) {
		?>
			<div id="imgcoverboxforfile" style="margin-top: -15px;margin-left: 20px;;">
				<a href="#" id="photobuttonp"><img src="logos/icons/camera3.png"></a>
			</div>
		<?php 
			}
		?>
		<div id='img' style='background-image: url(<?php echo info($id,'img');?>);'></div>
		<div class="fl"><h2 id="fl"><?php echo info($id,'fname') ." ". info($id,'lname'); ?></h2></div>
		<div id="navcontent">
			<ul>
				<a id="nav_a" href="profile.php?id=<?php echo $id; ?>"><li id="TB">Timeline</li></a>
				<a id="nav_a" href="friend_show.php?id=<?php echo $id; ?>"><li>Friands <?php friend_rows(); ?></li></a>
				<a id="nav_a" href="photo_show.php?id=<?php echo $id; ?>"><li class="active">Photos</li></a>
			</ul>
		</div><br>
		<div id="box">
			<div id="title_bar">
				<h1><img src="logos/icons/photo19.png"> Photos</h1>
				<?php 
					if ($id == $my_id) {
				?>
					<div class="right">
						<a href="#" id="add_photo"><img id="icons"src="logos/icons/plus.png"> Add Photos</a>
					</div>
				<?php		
					}
				?>
				
			</div>
			<div id="content_show">
				<?php
					$id=$user_data['id'];
					echo getinfophoto($id); 
				?>
			</div>
		</div>
	</div>

	<div id="searchbox">
		<button onclick="closebox()"></button>
		<div class="container">
			<ul class="contList">
				<?php echo getinfo(); ?>
			</ul>			
		</div>
	</div>
		<div id="black_screen">
			<div class="photo_box">
				<div class="photo_zoom left">
	            	<div id="curr_img">

					</div>
                	<div class="slideshow">
							<?php
							$id=$user_data['id'];
							echo getinfophoto_next_prev($id); 
						?>
					</div>
            		<img src="logos/icons/prev_arrow.png" id="imgPrev">
					<img src="logos/icons/next_arrow.png" id="imgNext">
				</div>
				<div class="photo_zoom_bar right">
					<div class="title_bar">
	                	<div class="close" id="zoom_close">
	                    	<img src="logos/icons/cancel.png">
	                	</div>  
	                	<div class="clear"></div>
	            	</div>
				</div>	
	           <!--  
	            <div id="content" align="center">
	                <div class="clear"></div>
	            </div> -->
			</div>
        </div>
        <div class="black_screen" id="photo_ad">
		   	<div id="addphotobox">
		        <div id="title_bar">
		            <div id="title">
		                <h3>Add Photo</h3>
		            </div>
		            <div id="addphotoclose" title="Press Esc to close">
		                <img src="logos/icons/cancel.png">
		            </div>
		        </div><br>
		        <div id="content">
	                <form action="" method="POST" enctype="multipart/form-data">
	                	<input type="file" name="addphoto">
	                	<div id="button_bar">
	                		<input type="submit" value="Add Photo" class="blue-input-style right">
	                	</div>
	                </form>
		        </div>
		    </div>
        </div>
	</body>
</html> 
<?php include'includes/overall/footer.php'; ?>