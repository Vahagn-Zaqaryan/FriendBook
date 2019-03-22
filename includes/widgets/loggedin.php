<?php 
	function number_rows(){
		$my_id=$_SESSION['id'];
		$quary=mysql_query("SELECT * FROM `friend_req` WHERE `to`='$my_id'");
		$num_rows=mysql_num_rows($quary);
		if ($num_rows == 0) {
			echo "";
		}
		elseif ($num_rows > 9) {
			echo "<div class='num_rows'><p>+9</p></div>";
		}
		else{
			echo "<div class='num_rows'><p>".$num_rows."</p></div>";
		}
	}
	function message_rows(){
		$my_id=$_SESSION['id'];
		$quary=mysql_query("SELECT * FROM `inbox_message` WHERE `to`='$my_id'");
		$num_rows=mysql_num_rows($quary);
		if ($num_rows == 0) {
			echo "";
		}
		elseif ($num_rows > 9) {
			echo "<div class='num_rows'><p>+9</p></div>";
		}
		else{
			echo "<div class='num_rows'><p>".$num_rows."</p></div>";
		}
		
	}
	function notifications_rows(){
		$my_id=$_SESSION['id'];
		$query=mysql_query("SELECT * FROM `notifications_inbox` WHERE `user_two`='$my_id'");
		$run=mysql_fetch_array($query);
		$num_rows=mysql_num_rows($query);
		$user_id=$run['user_one'];
			if ($num_rows == 0) {
				echo "";
			}
			elseif ($num_rows > 9) {
				echo "<div class='num_rows'><p>+9</p></div>";
			}else{
				echo "<div class='num_rows'><p>".$num_rows."</p></div>";
			}
	}
	if (!empty($_POST['problam_text'])) {
		$id=$_SESSION['id'];
		$content=$_POST['problam_text'];
		$category=$_POST['category'];
		mysql_query("INSERT INTO `database`.`problam` (`user_id`,`category`,`content`) VALUES ('$id','$category','$content');");
	}
 ?>
<div class="widget">
	<style type="text/css">
		li a{
			color:#000;
		}
		a:hover{
			color:#000;
			text-decoration: underline;
		}
        .num_rows{
	        background-color: #F50000;
	        border-radius: 100%;
	        height: 14px;
	        width: 14px;
	        padding: 2px 2px 2px 2px;
	        display: inline-block;
	    }
	    .num_rows p{
	        color: #fff;
	        font-family: arial;
	        margin-top: 0px;
	        text-align: center;
	        font-size: 11px;
	    }
	    #info_box{
	    	color: #fff;
	    	display: none;
	    	margin: none;
	    }
	    
	    /*.inner li a{
	    	font-size: 13.5px;
	    	font-weight: 300;
	    	opacity: 0.7;
	    	text-decoration: none;
	    } 
	    .inner li a:hover{
	    	opacity: 2;
	    }*/
	    #box_report{
	        border-radius: 3px;
	        background-color: rgba(255,255,255,1);
	        width: 450px;
	        position: fixed;top: 150px;
	        z-index: 9999;
	    }
	    #box_report #title_barp{
	        border-radius: 3px 3px 0 0;
	        background-color: #F6F7F8;
	        border-bottom: 1px solid #E5E5E5;
	        padding: 10px 12px;
	        height: 20px;
	    }
	    #title{
	        float: left;
	        cursor: pointer;
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
	    #close_report{
	        float: right;
	        cursor: pointer;
	    }
	    #close_report img{
	        margin: 5px;
	        width: 10px;
	        opacity: 0.5;
	    }
	    #close_report img:hover{
	        opacity: 1;
	    }
	    .clear{
	        clear: both;
	    }
	    #content_report{
	        padding: 15px;
	        font-size: 15px;
	    }
	    #content_report #textarea{
	    	font-size: 12px;
	    	overflow: hidden;
	    	resize: none;
	    	max-width: 100%;
	    	border: 1px solid #bdc7d8;
		    margin: 0;
		    padding: 3px;
		    -webkit-appearance: none;
		    -webkit-border-radius: 0;
		    -webkit-rtl-ordering: logical;
		    -webkit-user-select: text;
		    flex-direction: column;
		    white-space: pre-wrap;
    		word-wrap: break-word;
    		font: 13px Arial;
		    text-rendering: auto;
		    color: initial;
		    letter-spacing: normal;
		    word-spacing: normal;
		    text-transform: none;
		    text-indent: 0px;
		    text-shadow: none;
		    display: inline-block;
		    text-align: start;
		    height: 100px;
	    }
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
	        var window_width = $(window).width();
	       	var div_width = $('#box_report').width();
	        $('#box_report').css('left', (window_width/2)-(div_width/2));
	        $('#problam').click(function(){
	            $('#problam_box').fadeIn();
	        });
	        $('.close').click(function(){
	            $('#problam_box').fadeOut();
	           //$("#content").empty();
	        });
	    }); 
	    $(document).keyup(function(e) { 
	        if (e.which == 27) {
	            $('#problam_box').fadeOut();
	        }           
	    });
	</script>
	<div class="inner">
		<ul>
			<li><a href="logout.php"><img id="icons"src="logos/icons/logout.png"> Log Out</a></li>
			<li><a href="req.php"><img id="icons"src="logos/icons/req.png"> Requests <?php number_rows() ?></a></li>
			<li><a href="conversations_user.php"><img id="icons"src="logos/icons/messanger.png"> Messanger <?php message_rows() ?></a></li>
			<li><a href="notifications.php"><img id="icons"src="logos/icons/notification.png"> Notifications <?php notifications_rows() ?></a></li>
			<li><a href="setting.php"><img id="icons"src="logos/icons/settings.png"> Settings</a></li>
			<li><a href="#" id="problam"><img id="icons"src="logos/icons/problam.png"> Report a Problam</a></li>
			<li><a href="info.php"><img id="icons"src="logos/icons/info.png"> Help</a></li>
		</ul>
	</div>
</div>
<div class="black_screen" id="problam_box">
    <div id="box_report">
        <div id="title_barp">
            <div id="title">
                <h3>Report a Problem</h3>
            </div>
            <div id="close_report" title="Press Esc to close" class="close">
                <img src="logos/icons/cancel.png">
            </div>
        </div>
        <div id="content_report">
            <h4>Where is the problem?</h4>
            <form method="POST" action="">
	            <select name="category">
	            	<option value="" selected="1">Select a product</option>
	            	<option value="friend_req">Friend Requests</option>
	            	<option value="message">Messages or Chat</option>
	            	<option value="notification">Notifications</option>
	            	<option value="page">Pages</option>
	            	<option value="photo">Photos</option>
	            	<option value="profile">Profile</option>
	            	<option value="search">Search</option>
	            	<option value="status">Updating My Status</option>
	            	<option value="video">Videos</option>
	            	<option value="other">Other</option>
	            </select>
	            <h4>What happened?</h4>
	            <textarea title="Briefly explain what happened and what steps we can take to reproduce the problem ..." id="textarea" name="problam_text" rows="7" placeholder="Briefly explain what happened and what steps we can take to reproduce the problem ..." style="width:415px"></textarea>
            	<hr>
            	<input type="submit" value="Send" class="blue-input-style">
            </form>
        </div>
    </div>
</div>