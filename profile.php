<?php
	include 'core/init.php';
	protect_page();
	include'includes/overall/header.php';
	error_reporting(0);
	$id = $_GET['id'];
	$my_id = $_SESSION['id'];
	date_default_timezone_set('America/Los_Angeles');
	$date=date("d.m.Y");
	$time=date("H:i");
	$errors = "connection error";
	$con = mysql_connect('localhost', 'root', 'usbw') or die($errors);
	mysql_select_db("database",$con);
	
	error_reporting();
	function photo_num_rows(){
		$id = $_GET['id'];
		$query=mysql_query("SELECT * FROM photo WHERE user_id='$id' ORDER BY id DESC");
		$num_rows=mysql_num_rows($query);
		echo $num_rows;
	}
	function comment_info($id){
		$list='';
		$my_id = $_SESSION['id'];
		$query_get=mysql_query("SELECT * FROM comment WHERE `post_id`='$id' ORDER BY `id` DESC LIMIT 5");
		while ($run=mysql_fetch_array($query_get)) {
			$user_id=$run['user_id'];
			if ($user_id == $my_id) {
				$list.='<div class="comment_info">
			            <div id="img_comment" style="background-image: url('.post_info($run['user_id'],'img').');"></div>
			            <b>'.post_info($run['user_id'],'fname')." ".post_info($run['user_id'],'lname')." ".'</b><span>'.$run['comment'].'</span>
			            <a href="actions.php?action=delcomment&user='.$run['id'].'" title="Delete comment"><img src="logos/icons/cancel.png"></a>
			        </div>';
			}else{
				$list.='<div class="comment_info">
			            <div id="img_comment" style="background-image: url('.post_info($run['user_id'],'img').');"></div>
			            <b>'.post_info($run['user_id'],'fname')." ".post_info($run['user_id'],'lname')." ".'</b><span>'.$run['comment'].'</span>
			        </div>';
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
	function getinfopost($var){	
		$id = $_GET['id'];
		$my_id = $_SESSION['id'];
		$date=date("d.m.Y");
		$list='';
		$query=mysql_query("SELECT * FROM post WHERE  post_id='$id' ORDER BY id DESC");
		$num_post=mysql_num_rows($query);
		if ($num_post == 0) {
        	$list .="<div class='big_text'>No activity to show</div>";
        }
		while ($info=mysql_fetch_array($query)) {
			$user_id=$info['post_id'];
			$post_id=$info['id'];
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
				<a href="./profile.php?user='.$info['post_id'].'">
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
				<a href="./profile.php?user='.$info['post_id'].'">
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
		            <br><br><div id="img_comment" style="background-image: url('.post_info($my_id,'img').');"></div>
		            <input class="comment_text" placeholder="Writh a comment..." post_id="'.$info['id'].'" img_pro="'.post_info($my_id,'img').'" user_id="'.$friend_id.'">
		        	<div class="small_text">Press Enter to post.</div>
		        </div>
	        </div><br><br>';
        	}
			if ($user_id == $my_id && $var != $post_id) {
				$friend_id=$id;
				$list .='
			<div class="post">
				<img src="logos/icons/more.png" id="morepost" post_id="'.$info['id'].'">
				<div class="more none" id="'.$info['id'].'">
					<a href=""><li>Edit Post</li></a>
					<a href="actions.php?action=hidepost&user='.$info['id'].'"><li>Hide Post</li></a>
					<a href="actions.php?action=delpost&user='.$info['id'].'"><li>Delete Post</li></a>
				</div>
				<a href="profile.php?user='.$info['post_id'].'">
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
			elseif($user_id != $my_id && $var != $post_id){
				$friend_id=$user_id;
				$list .='
			<div class="post">
				<img src="logos/icons/more.png" id="morepost" post_id="'.$info['id'].'">
				<div class="more none" id="'.$info['id'].'">
					<a href=""><li>Hide Post</li></a>
					<a href="actions.php?action=delpost&user='.$info['id'].'"><li>Hide All Post From '.post_info($info['post_id'],'fname').'</li></a>
				</div>
				<a href="./profile.php?user='.$info['post_id'].'">
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
		}
		//While End	
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
        #photochangecover{
        	border-radius: 3px;
        	color: #000;
	        background-color: rgba(255,255,255,1);
	        width: 750px;
	        height: 590px;
	        position: fixed;top: 49px;
	        z-index: 9999;
	        margin: auto;
	    }
	    #photochangeprofile{
	    	border-radius: 3px;
        	color: #000;
	        background-color: rgba(255,255,255,1);
	        width: 750px;
	        height: 590px;
	        position: fixed;top: 49px;
	        z-index: 9999;
	        margin: auto;
	    }
	    #photochangecover #title_bar{
	    	background-color: #F6F7F8;
	    	border-bottom: 1px solid #E5E5E5;
	    	padding: 10px 12px;
	    	height: 20px;
	    }
	    #photochangeprofile #title_bar{
	    	background-color: #F6F7F8;
	    	border-bottom: 1px solid #E5E5E5;
	    	padding: 10px 12px;
	    	height: 20px;
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
	    	font-size: 13px;
	    }
	    .big_text{
	    	margin-left: 90px;
	    }
	    #photos_all{
	    	max-height: 460px;
	    	overflow: auto;
	    }
	    #photos_all::-webkit-scrollbar {
		   width: 10px;
		}
		/* Track */
		::-webkit-scrollbar-track {
			background-color: rgba(150,150,150,0.5);
			-webkit-border-radius: 10px;
		}
		/* Handle */
		::-webkit-scrollbar-thumb {
		    -webkit-border-radius: 10px;
		    border-radius: 10px;
		    background: rgba(255,0,0,0.8); 
			background-color: rgba(100,100,100,0.5); 
		}
		::-webkit-scrollbar-thumb:window-inactive {
		    background-color: rgba(100,100,100,0.2); 
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
		            $('#photo_cover').fadeIn();
		        });
		        $('#close_cover').click(function(){
		            $('#photo_cover').fadeOut();
		          //$("#content").empty();
		        });

		    });
		    $(document).keyup(function(e) { 
		        if (e.which == 27) {
		        	$('#photo_cover').fadeOut();
		        } 			
		    });
		    $(document).ready(function () {
		    	var window_width_pro = $(window).width();
		    	var div_width_pro = $('#photochangeprofile').width();
		    	$('#photochangeprofile').css('left', (window_width_pro/2)-(div_width_pro/2));
		        $('#photobuttonp').click(function(){
		            $('#photo_profile').fadeIn();
		        });
		        $('#close_profile').click(function(){
		            $('#photo_profile').fadeOut();
		        });
		    });
		    $(document).keyup(function(e) { 
		        if (e.which == 27) {
		        	$('#photo_profile').fadeOut();
		        } 			
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
                    	<?php 
                    		$fname = $user_data['fname'];
                    		$lname = $user_data['lname'];
            				echo "var fname = '{$fname}';";
            				echo "var lname = '{$lname}';";
                    	 ?>
                        var post_id = $(this).attr('post_id');
                        var img = $(this).attr('img_pro');
                        var friend_id = $(this).attr('user_id');
                        var comment = $(this).val();
                        $.post('comment.php', { post_id: post_id, comment: comment, friend_id: friend_id});
                    	$('.comment_text').val('');
                    	$(".view"+ post_id).append("<div class='comment_info'><div id='img_comment' style='background-image: url(" + img + ");'></div><b> "+ fname +" "+ lname +"</b><span> " + comment + "</span></div>");
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
			$(document).ready(function(){
                $('#photos_all').load('cover/take_photo.php'); 
            	$('.content_cover .content_menu a').click(function(){
            		var page = $(this).attr('href');
            		$('#photos_all').load('cover/' + page + '.php');
            		return false;
            	});
            }); 
            $(document).ready(function(){
                $('.photos_all').load('profile/take_photo.php'); 
            	$('.content_profile .content_menu a').click(function(){
            		var page = $(this).attr('href');
            		$('.photos_all').load('profile/' + page + '.php');
            		return false;
            	});
            });
            $(document).ready(function(){
            	$('.post #morepost').click(function(){
            		var id = $(this).attr('post_id');
            		$('#'+id+'').fadeToggle();
            	});
            });
            $(document).ready(function(){
            	$('.post .post_under_bar li').click(function(){
            		var id = $(this).attr('post_id');
            		$('#under_bar'+id+'').fadeToggle();
            	});
    //         	var cacheData;
	   //          var data = $('.post_box').html();
				// var auto_refresh = setInterval(
				// function ()
				// {
				//     $.ajax({
				//         url: 'post_ajax.php',
				//         type: 'POST',
				//         data: data,
				//         dataType: 'html',
				//         success: function(data) {
				//             if (data !== cacheData){
				//                 cacheData = data;
				//                 $('.post_box').html(data);
				//             }          
				//         }
				//     })
				// }, 100);
            });
		</script>
	</head>
	<body>
		<div onclick="click();" id="up" align="center">
           	<img src="logos/icons/pointing5.png">
        </div>
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
								echo "<a href='' class='friend_req_box'><img src='logos/icons/accept.png' id='icons'> Friands</a> | <a href='actions.php?action=unfriend&user=$id' class='friend_req_box'><img src='logos/icons/unfriend.png' id='icons'> Unfriend</a>";
							}else{
								$form_query=mysql_query("SELECT `id` FROM `friend_req` WHERE `from`='$id' AND `to`='$my_id'");
								$to_query=mysql_query("SELECT `id` FROM `friend_req` WHERE `from`='$my_id' AND `to`='$id'");
								if (mysql_num_rows($form_query)) {
								 echo "<a href='' class='friend_req_box'><img src='logos/icons/cancel.png' id='icons'> Ignore</a> | <a href='actions.php?action=accept&user=$id' class='friend_req_box' style='color:#000;'><img src='logos/icons/accept.png' id='icons'> Accept</a>";
								}elseif (mysql_num_rows($to_query)) {
								 echo "<a href='actions.php?action=cancel&user=$id' class='friend_req_box' style='color:#000;'><img src='logos/icons/cancel.png' id='icons'> Cancel Request</a>";
								}else{
								 echo "<a href='actions.php?action=send&user=$id' class='friend_req_box' style='color:#000;'><img src='logos/icons/add_frnd.png' id='icons'> Add Friend</a>";
								}
							}
						?>
						</div>
				<?php
					}		
				?>
			
			<div id='imgcover' style='background-image: url(<?php echo post_info($id,'imgcover');?>);'></div>
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
		<div id='img' style='background-image: url(<?php echo post_info($id,'img');?>);'></div>
		<div class="fl"><h2 id="fl"><?php echo post_info($id,'fname') ." ". post_info($id,'lname'); ?></h2></div>
		<div id="navcontent">
			<ul>
				<a id="nav_a" href="profile.php?id=<?php echo $id; ?>"><li class="active" id="TB">Timeline</li></a>
				<a id="nav_a" href="friend_show.php?id=<?php echo $id; ?>"><li>Friands <?php friend_rows(); ?></li></a>
				<a id="nav_a" href="photo_show.php?id=<?php echo $id; ?>"><li>Photos</li></a>
			</ul>
		</div><br>
		<div>
		<div id="left_bar">
			<?php 
				if ($id == $my_id) {
			?>
			 <div class="box_mode_profile_left">
			 	<div id="title_bar" style="margin-bottom: 5px;">
		    		<a href="status_update" style="color: #000;" id="a"><img id="icons"src="logos/icons/arrow95.png"> Update Status</a>
		    		<a href="add_photo" style="color: #000;margin-left: 10px;" id="a"><img id="icons"src="logos/icons/image6.png"> Add Photo</a>
			 		<a href="photo_album" style="color: #000;margin-left: 10px;" id="a"><img id="icons"src="logos/icons/photo212.png"> Create Album</a>
			 	</div>
			 	<div id="content_sp">
			 		<?php 
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
			<?php		
				}
			?>
	        
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
					$query=mysql_query("SELECT * FROM hide_post WHERE `my_id`='$my_id'");
					while ($run=mysql_fetch_array($query)) {
						$id=$run['post_id'];
					 	echo getinfopost($id);
					} 
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
	<div class="black_screen" id="photo_cover">
		<div id="photochangecover">
	        <div id="title_bar">
	            <div id="title">
	                <h3>Update Cover Picture</h3>
	            </div>
	            <div class="close" id="close_cover">
	                <img src="logos/icons/cancel.png">
	            </div>
	        </div>
	        <div id="content" class="content_cover">
	            <div class="content_menu">
	            	<a href="take_photo"><div><h3>Take Photo</h3></div></a>
	            	<a href="upload_photo"><div><h3>Upload Photo</h3></div></a>
	            </div>
	            <div id="photos_all">
	            	<h3>Your Photos</h3>
	            
	            </div>
	        </div>
	    </div>
	</div>
	<div class="black_screen" id="photo_profile">
		<div id="photochangeprofile">
	        <div id="title_bar">
	            <div id="title">
	                <h3>Update Profile Picture</h3>
	            </div>
	            <div class="close" id="close_profile">
	                <img src="logos/icons/cancel.png">
	            </div>
	        </div>
	        <div id="content" class="content_profile">
	            <div class="content_menu">
	            	<a href="take_photo"><div><h3>Take Photo</h3></div></a>
	            	<a href="upload_photo"><div><h3>Upload Photo</h3></div></a>
	            </div>
	            <div id="photos_all" class="photos_all">
	            	<h3>Your Photos</h3>
	            	
	            </div>
	        </div>
	    </div>
	</div>
	</body>
</html> 
<?php include'includes/overall/footer.php'; ?>