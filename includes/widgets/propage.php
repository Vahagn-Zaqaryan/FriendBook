<?php
	protect_page();
	$rand_img = rand();
	$id = $_SESSION['id'];
	date_default_timezone_set('America/Los_Angeles');
	$date=date("d.m.Y");
	$time=date("H:i");
	$errors = "connection error";
	$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
	mysql_select_db("database",$con);
	error_reporting();
	function friend_rows(){
		$id = $_SESSION['id'];
		$quary=mysql_query("SELECT * FROM `friends` WHERE `user_one`='$id' OR `user_two`='$id'");
		$num_rows=mysql_num_rows($quary);
		if ($num_rows == 0) {
			echo "";
		}else{
			echo $num_rows;
		}
	}
	function photo_num_rows(){
		$id = $_SESSION['id'];
		$query=mysql_query("SELECT * FROM photo WHERE user_id='$id' ORDER BY id DESC");
		$num_rows=mysql_num_rows($query);
		echo $num_rows;
	}
	function comment_info($id){
		$list='';
		$my_id = $_SESSION['id'];
		$query_get=mysql_query("SELECT * FROM comment WHERE `post_id`='$id'");
		while ($run=mysql_fetch_array($query_get)) {
			$user_id=$run['user_id'];
			if ($user_id == $my_id) {
				$list.='<div class="comment_info">
			            <div id="img_comment" style="background-image: url('.post_info($run['user_id'],'img').');"></div>
			            <span>'.$run['comment'].'</span>
			            <a href="actions.php?action=delcomment&user='.$run['id'].'" title="Delete comments"></a>
			        </div><hr>';
			}else{
				$list.='<div class="comment_info">
			            <div id="img_comment" style="background-image: url('.post_info($run['user_id'],'img').');"></div>
			            <span>'.$run['comment'].'</span>
			        </div><hr>';
			}
		}
		//While End
		return $list;
		mysql_close();
	}
	function post_info($id, $field){
		$query_get=mysql_query("SELECT $field FROM data WHERE `id`='$id'");
		$run=mysql_fetch_array($query_get);
		return $run[$field];
	}
	function getinfopost($friend_id){	
		$my_id = $_SESSION['id'];
		$date=date("d.m.Y");
		$list='';
			$query=mysql_query("SELECT * FROM post WHERE  post_id='$friend_id' || post_id='$my_id' ORDER BY id DESC");

		
		$num_post=mysql_num_rows($query);
		if ($num_post == 0) {
        	$list .="<div class='big_text'>No activity to show</div>";
        }
		while ($info=mysql_fetch_array($query)) {
			$user_id=$info['post_id'];
			$img=$info['post_img'];
        	$p_date=$info['post_date'];
        	if ($date == $p_date) {
        		$post_date="Today";
        		$post_time=$info['post_time'];
        	}else{
        		$post_date=$info['post_date'];
        		$post_time=$info['post_time'];
        	}
        	if ($img == null && $user_id == $my_id) {
        		$list .='
			<div class="post">
				<img src="logos/icons/more.png" id="morepost" post_id="'.$info['id'].'">
				<div class="more none" id="'.$info['id'].'">
					<a href=""><li>Edit Post</li></a>
					<a href="actions.php?action=delpost&user='.$info['id'].'"><li>Delete Post</li></a>
				</div>
				<a href="./friend_profile.php?user='.$info['post_id'].'">
	            	<div id="img_profile" style="background-image: url('.post_info($info['post_id'],'img').');"></div>
	            </a>
	            <div id="post_content">
	                <b>'.post_info($info['post_id'],'fname')." ".post_info($info['post_id'],'lname')." ".'</b><span>'.$info['post_category'].'</span>
	                <p>'.$post_time." ".$post_date." ".'</p><br>
	                <p id="content">'.$info['post_content'].'</p>
	            </div><br>

	            <div class="view'.$info['id'].'">
	            '.comment_info($info['id']).'
	            </div>
	            <div class="post_under_bar">
	            	<li><img src="logos/icons/like.png"> Like</li>
	            	<li id="comment_button" post_id="'.$info['id'].'"><img src="logos/icons/comment.png"> Comment</li>
	            	<li><img src="logos/icons/share.png"> Share</li>
	            </div>
	            <div class="comment_box none" id="under_bar'.$info['id'].'">
		            <br><br><div id="img_comment" style="background-image: url('.post_info($my_id,'img').');"></div>
		           	<input class="comment_text" placeholder="Writh a comment..." post_id="'.$info['id'].'" img_pro="'.post_info($my_id,'img').'" user_id="'.$friend_id.'">
		        	<div class="small_text">Press Enter to post.</div>
		        </div>
	        </div><br><br>';
        	}elseif ($img == null && $user_id != $my_id) {
        		$list .='
			<div class="post">
				<img src="logos/icons/more.png" id="morepost" post_id="'.$info['id'].'">
				<div class="more none" id="'.$info['id'].'">
					<a href=""><li>Hide Post</li></a>
					<a href="actions.php?action=delpost&user='.$info['id'].'"><li>Hide All Post From '.post_info($info['post_id'],'fname').'</li></a>
				</div>
				<a href="./friend_profile.php?user='.$info['post_id'].'">
	            	<div id="img_profile" style="background-image: url('.post_info($info['post_id'],'img').');"></div>
	            </a>
	            <div id="post_content">
	                <b>'.post_info($info['post_id'],'fname')." ".post_info($info['post_id'],'lname')." ".'</b><span>'.$info['post_category'].'</span>
	                <p>'.$post_time." ".$post_date." ".'</p><br>
	                <p id="content">'.$info['post_content'].'</p>
	            </div><br>

	            <div class="view'.$info['id'].'">
	            '.comment_info($info['id']).'
	            </div>
	            <div class="comment_box">
		            <div id="img_comment" style="background-image: url('.post_info($my_id,'img').');"></div>
		            <input class="comment_text" placeholder="Writh a comment..." post_id="'.$info['id'].'" img_pro="'.post_info($my_id,'img').'" user_id="'.$friend_id.'">
		        	<div class="small_text">Press Enter to post.</div>
		        </div>
	        </div><br><br>';
        	}
			if ($user_id == $my_id) {
				$friend_id=$id;
				$list .='
			<div class="post">
				<img src="logos/icons/more.png" id="morepost" post_id="'.$info['id'].'">
				<div class="more none" id="'.$info['id'].'">
					<a href=""><li>Edit Post</li></a>
					<a href=""><li>Hide Post</li></a>
					<a href="actions.php?action=delpost&user='.$info['id'].'"><li>Delete Post</li></a>
				</div>
				<a href="./friend_profile.php?user='.$info['post_id'].'">
	            	<div id="img_profile" style="background-image: url('.post_info($info['post_id'],'img').');"></div>
	            </a>
	            <div id="post_content">
	                <b>'.post_info($info['post_id'],'fname')." ".post_info($info['post_id'],'lname')." ".'</b><span>'.$info['post_category'].'</span>
	                <p>'.$post_time." ".$post_date." ".'</p><br>
	                <p id="content">'.$info['post_content'].'</p>
	            </div><br>
	            <img src="'.$info['post_img'].'"><br><br>

	            <div class="view'.$info['id'].'">
	            '.comment_info($info['id']).'
	            </div>
	            <div class="post_under_bar">
	            	<li><img src="logos/icons/like.png"> Like</li>
	            	<li id="comment_button" post_id="'.$info['id'].'"><img src="logos/icons/comment.png"> Comment</li>
	            	<li><img src="logos/icons/share.png"> Share</li>
	            </div>
	            <div class="comment_box none" id="under_bar'.$info['id'].'">
		            <br><br><div id="img_comment" style="background-image: url('.post_info($my_id,'img').');"></div>
		           	<input class="comment_text" placeholder="Writh a comment..." post_id="'.$info['id'].'" img_pro="'.post_info($my_id,'img').'" user_id="'.$friend_id.'">
		        	<div class="small_text">Press Enter to post.</div>
		        </div>
	        </div><br><br>';
			}
			else{
				$friend_id=$user_id;
				$list .='
			<div class="post">
				<img src="logos/icons/more.png" id="morepost" post_id="'.$info['id'].'">
				<div class="more none" id="'.$info['id'].'">
					<a href=""><li>Hide Post</li></a>
					<a href="actions.php?action=delpost&user='.$info['id'].'"><li>Hide All Posts From '.post_info($info['post_id'],'fname').'</li></a>
				</div>
				<a href="./friend_profile.php?user='.$info['post_id'].'">
	            	<div id="img_profile" style="background-image: url('.post_info($info['post_id'],'img').');"></div>
	            </a>
	            <div id="post_content">
	                <b>'.post_info($info['post_id'],'fname')." ".post_info($info['post_id'],'lname')." ".'</b><span>'.$info['post_category'].'</span>
	                <p>'.$post_time." ".$post_date." ".'</p><br>
	                <p id="content">'.$info['post_content'].'</p>
	            </div><br>
	            <img src="'.$info['post_img'].'"><br><br>

	            <div class="view'.$info['id'].'">
	            '.comment_info($info['id']).'
	            </div>
	            <div class="comment_box">
		            <div id="img_comment" style="background-image: url('.post_info($my_id,'img').');"></div>
		            <input class="comment_text" placeholder="Writh a comment..." post_id="'.$info['id'].'" img_pro="'.post_info($my_id,'img').'" user_id="'.$friend_id.'">
		        	<div class="small_text">Press Enter to post.</div>
		        </div>
	        </div><br><br>';
			}
		}
		//While End	
		return $list;
		mysql_close();
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/user_profile.css">
	<style type="text/css">
		.status_bar{
			margin: 0;
            box-shadow: 0 0 6px rgb(140,140,140);
            width: 330px;
            padding: 10px;
            border: 1px solid rgb(120,120,120);
            background:-webkit-linear-gradient(top,#ffffff 0%,rgba(209,215,241,0.91) 100%); 
            border-radius: 5px;
            display: block;
        }
        #up{
        	box-shadow: 0 0 6px rgb(140,140,140);
        	-webkit-transition:all 0.2s;
        	border: solid 1px #888;
		    position: fixed;
		    right:10px;
		    bottom: 10px;
		    width: 80px;
		    height: 80px;
		    background: white;
		    color: #000;
		    font-size: 35px;
		    font-family: arial,sans-serif;
		    border-radius: 10px;
		    z-index: 500;
		  	cursor: pointer;
		  	opacity: 0.5;
		  }
		  #up:hover{
		  	border: solid 1px #000;
		  	opacity: 1;
		  }
		  #up img{
		  	width: 50px;
		  	margin-top: 15px;
		  }
		.comment_box input{
			width: 300px;
            height: 32px;
            border:solid 1px rgba(0, 0, 0, 0.5);
            outline: none;
            font-family: helvetica, arial, sans-serif;
    		font-size: 12px;
    		line-height: 16px;
    		padding-left: 5px;
        }
        .comment_box #img_comment{
            vertical-align: top;
            width: 30px;
            height: 30px;
            border: 1px solid rgba(0, 0, 0, 0.4);
            background-size: cover;
            -webkit-transition-duration: 500ms;
            -webkit-transition-property: width, height;
            background-position: 50% 25%;
            display: inline-block;
        }
        .comment_info #img_comment{
            vertical-align: top;
            width: 30px;
            height: 30px;
            border: 1px solid rgba(0, 0, 0, 0.4);
            background-size: cover;
            -webkit-transition-duration: 500ms;
            -webkit-transition-property: width, height;
            background-position: 50% 25%;
            display: inline-block;
        }
        .comment_info a{
        	background-color: transparent;
			background-position: -668px -19px;
			background-image: url(http://ssl.gstatic.com/inputtools/images/ita_sprite2.png);
			width: 15px;
			height: 15px;
			border: none;
			opacity: 0.5;
			float: right;
			cursor: pointer;
			outline: 0;
        }
        .comment_info a:hover{
        	opacity: 1;
        }
	    #title h3{
	    	margin: 0;
	    	padding: 0;
	        float: left;
	        cursor: pointer;
	        color: #141823;
    		font-size: 14px;
    		line-height: 19px;
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
	    .clear{
	        clear: both;
	    }
	    #content{
	        padding: 2px;
	    }
	    #content_sp{
	    	padding: 5px;
	    }
	    .content_menu{
	    	height: 80px;
	    	border-bottom: 1px solid #E5E5E5;
	    	padding: 0px;
	    }
	    .content_menu div{
	    	display: inline-block;
	    	width: 360px;
	    	height: 72px;
	    }
	    .content_menu div h3{
	    	color: #4E5665;
    		font-size: 20px;
    		line-height: 19px;
    		text-align: center;
	    }
	    .content_menu div:hover{
	    	background-color: #E5E5E5;
	    }
	    .content_menu div:first-child{
	    	border-right: 1px solid #E5E5E5;
	    }
	    #text{
	        display: inline-block;
	    }
	    #button{
	        float: right;
	    }
	    #button a:first-child{
	        direction: none;
	        background-color: #fff;
	        color: #000;
	        padding: 3px;
	        border-radius: 3px;
	        margin-right: 10px;
	    }
	    #img_left{
	    	background-size: cover;
	    	-webkit-transition-duration: 500ms;
	    	-webkit-transition-property: width, height;
			background-position: 50% 25%;
			float: left;
			width: 106px;
			height: 106px;
			margin: 1px;
			border: 1px #E9EAED solid;
	    }
	    #img_left:hover{
	    	opacity: 0.8;
	    }
	    #fname_lname{
	    	color: #fff;
	    	background:-webkit-linear-gradient(top,rgba(0,0,0,0.8) 0%,rgba(0,0,0,0) 100%); 
	    	height: 40px;
	    	text-transform: capitalize;
	    	padding-left: 5px;
	    }
	    .big_text{
	    	margin-left: 90px;
	    }
	</style>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript">
			function  closebox() {
				var x =document.getElementById('searchbox');
				x.style.display="none";
			}

			$(document).ready(function () {
		        var window_width = $(window).width();
		        var div_width = $('#photochangecover').width();
		        $('#photochangecover').css('left', (window_width/2)-(div_width/2));

		        $('#photobutton').click(function(){
		            $('#photocc').fadeIn();
		        });
		        $('#close_cover').click(function(){
		            $('#photocc').fadeOut();
		          //$("#content").empty();
		        });

		    });
		    $(document).keyup(function(e) { 
		        if (e.which == 27) {
		        	$('#photocc').fadeOut();
		        } 			
		    });
		    $(document).ready(function () {
		        $('#photobuttonp').click(function(){
		            $('#photochangeprofile').fadeIn();
		        });
		        $('#closep').click(function(){
		            $('#photochangeprofile').fadeOut();
		          //$("#content").empty();
		        });
		    });
			$(document).ready(function(){
			  $('#up').fadeOut();

			    $(window).scroll(function(){
			    if ($(this).scrollTop() > 100) {
			      $('#up').fadeIn();
			    } else {
			      $('#up').fadeOut();
			    }
			  });
			  $('#up').click(function(){
			    $('html, body').animate({scrollTop : 0},800);
			    return false;
			  });
			});
			 $(document).ready(function(){
                $('.comment_text').keyup(function(e){
                    if (e.keyCode == 13) {
                        var post_id = $(this).attr('post_id');
                        var img = $(this).attr('img_pro');
                        var friend_id = $(this).attr('user_id');
                        var comment = $(this).val();
                        $.post('comment.php', { post_id: post_id, comment: comment, friend_id: friend_id});
                    	$('.comment_text').val('');
                    	$(".view"+ post_id).append("<div class='comment_info'><div id='img_comment' style='background-image: url(" + img + ");'></div><span> " + comment + "</span></div><hr>");
                    }
                });   
            });
			 $(document).ready(function(){
                $('#content_sp').load('status_update.php'); 
            	$('.box_mode_profile_left #title_bar #a').click(function(){
            		var page = $(this).attr('href');
            		$('#content_sp').load('' + page + '.php');
            		return false;
            	});
            });
		</script>
	</head>
	<body>
		<div onclick="click();" id="up" align="center">
           	<img src="logos/icons/pointing5.png">
        </div>
		<div>
		<div id="left_bar">
			 <div class="box_mode_profile_left">
			 	<div id="title_bar" style="margin-bottom: 10px;">
		    		<a href="status_update" style="color: #000;" id="a"><img id="icons"src="logos/icons/arrow95.png"> Update Status</a>
		    		<a href="add_photo" style="color: #000;margin-left: 10px;" id="a"><img id="icons"src="logos/icons/image6.png"> Add Photo</a>
			 		<a href="photo_album" style="color: #000;margin-left: 10px;" id="a"><img id="icons"src="logos/icons/photo212.png"> Create Album</a>
			 	</div>
			 	<div id="content_sp">
			 		<?php
			 		error_reporting(0); 
						$tmp = $_FILES['post_img']['tmp_name'];
						$name = $_FILES['post_img']['name'];
					 	if(move_uploaded_file($tmp, 'images/'.$rand_img.$name)){
							$post_content=$_POST['post_content'];      
					        $quary_post=mysql_query("INSERT INTO `database`.`post` (`post_id`, `post_img`, `post_category`, `post_date`, `post_time`,`post_content`) VALUES ('$id', 'images/$rand_img$name', 'added new photo', '$date', '$time', '$post_content');");
					        $quary_photo=mysql_query("INSERT INTO `database`.`photo` (`id`,`user_id`,`img`) VALUES ('','$id','images/$rand_img$name');");
					    }
				 		if(!empty($_POST['status_content'])){
							$status_content=$_POST['status_content'];
				        	$quary_post=mysql_query("INSERT INTO `database`.`post` (`post_id`, `post_category`, `post_date`,`post_time`,`post_content`) VALUES ('$id', 'update status', '$date', '$time', '$status_content');");    
				        	$quary_status_insert_into=mysql_query("INSERT INTO `database`.`status` (`user_id`, `status_content`, `status_date`, `status_time`) VALUES ('$id', '$status_content', '$status_date', '$status_time');");
						}
						$tmp = $_FILES['album_img']['tmp_name'];
						$name = $_FILES['album_img']['name'];
						if (move_uploaded_file($tmp, 'images/'.$rand_img.$name)) {
							if (!empty($_POST['name_album'])) {
								$name_album=$_POST['name_album'];
								$hash=rand();    
					        	$quary_album=mysql_query("INSERT INTO `database`.`album` (`user_id`, `name`, `hash`) VALUES ('$id', '$name_album', '$hash');");
							}
						}
					 ?>
			 	</div>
			 </div><br><br>

	        <div class="box_mode_profile_left">
	        	<div id="title_bar">
	        		<a href="photo_show.php?id=<?php echo $id; ?>"><div class="title_text">Photos · 
 <?php photo_num_rows(); ?></div></a>
	        	</div>
	        	<div id="content">
	        		
	        		 <?php 
						$query=mysql_query("SELECT * FROM photo WHERE user_id='$id' ORDER BY id DESC LIMIT 0,9");
						$num_rows=mysql_num_rows($query);
						if ($num_rows == 0) {
							echo "<div class='big_text'>No activity to show</div>";
						}
						while ($info=mysql_fetch_array($query)) {
							echo '<div id="img_left" style="background-image: url('.$info['img'].');"></div>';
						}
	        		 ?>
	        	</div>
			</div><br><br>
	        <div class="box_mode_profile_left">
	        	<div id="title_bar">
	        		<a href="friend_show.php?id=<?php echo $id; ?>"><div class="title_text">Friends · 
 <?php friend_rows(); ?></div></a>
	        	</div>
	        	<div id="content">
	        		<?php 
						$query=mysql_query("SELECT * FROM friends WHERE (user_one='$id' OR user_two='$id') ORDER BY `id` DESC LIMIT 0,9");
						$numrows=mysql_num_rows($query);
						while ($run=mysql_fetch_array($query)) {
							$user_one=$run['user_one'];
							$user_two=$run['user_two'];
							if ($user_one == $id) {
								$user=$user_two;
							}else{
								$user=$user_one;
							}
							echo '
								<a href="profile.php?id='.$user.'">
						            <div id="img_left" style="background-image: url('.post_info($user,'img').');"><div id="fname_lname">'.post_info($user,'fname').' '.post_info($user,'lname').'</div></div>
						        </a>
							';
						}
						if ($numrows == 0) {
							echo "<div class='big_text'>No activity to show</div>";
						}
	        		 ?>
	        	</div>
	       	</div>
	        
		</div>
	        <div class="post_box">
				<?php 
					$frnd_query=mysql_query("SELECT user_one, user_two FROM friends WHERE (user_one='$id' OR user_two='$id')");
					while ($run_frnd=mysql_fetch_array($frnd_query)) {
						$user_one=$run_frnd['user_one'];
						$user_two=$run_frnd['user_two'];
						if ($user_one == $id) {
							$user=$user_two;
						}else{
							$user=$user_one;
						}
						
					}
					 echo getinfopost($user);
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
	</body>
</html> 
