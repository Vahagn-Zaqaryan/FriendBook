<?php 
function comment_info($id){
		$list='';
		$my_id = $_SESSION['id'];
		$query_get=mysql_query("SELECT * FROM comment WHERE `post_id`='$id'");
		while ($run=mysql_fetch_array($query_get)) {
			$user_id=$run['user_id'];
			if ($user_id == $my_id) {
				$list.='<hr><div class="comment_info">
			            <div id="img_comment" style="background-image: url('.post_info($run['user_id'],'img').');"></div>
			            <span>'.$run['comment'].'</span>
			            <a href="actions.php?action=delcomment&user='.$run['id'].'" title="Delete comments"></a>
			        </div>';
			}else{
				$list.='<hr><div class="comment_info">
			            <div id="img_comment" style="background-image: url('.post_info($run['user_id'],'img').');"></div>
			            <span>'.$run['comment'].'</span>
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
date_default_timezone_set('America/Los_Angeles');
		include 'core/init.php';
		$id = $_SESSION['id'];
		$date=date("d.m.Y");
		$list='';
		$query=mysql_query("SELECT * FROM post WHERE  post_id='$id' ORDER BY id DESC");
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
        	if ($img == null) {
        		$list .='
			<div class="post">
				<a href="actions.php?action=delpost&user='.$info['id'].'" title="Delete post" id="delpost">
					<img src="logos/icons/more.png">
				</a>
				<a href="./friend_profile.php?user='.$info['post_id'].'">
	            	<div id="img_profile" style="background-image: url('.post_info($info['post_id'],'img').');"></div>
	            </a>
	            <div id="post_content">
	                <b>'.post_info($info['post_id'],'fname')." ".post_info($info['post_id'],'lname')." ".'</b><span>'.$info['post_category'].'</span>
	                <p>'.$post_time." ".$post_date." ".'</p><br>
	                <p id="content">'.$info['post_content'].'</p>
	            </div>
	            <div class="view'.$info['id'].'">
	            '.comment_info($info['id']).'
	            </div><br>
	            <div class="comment_box">
		            <div id="img_comment" style="background-image: url('.post_info($id,'img').');"></div>
		            <input class="comment_text" placeholder="Writh a comment..." post_id="'.$info['id'].'" img_pro="'.post_info($id,'img').'" user_id="'.$friend_id.'">
		        	<div class="small_text">Press Enter to post.</div>
		        </div>
	        </div><br><br>';
        	}
			elseif ($user_id == $id) {
				
				 echo '
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
	            <img src="'.$info['post_img'].'"><br><br>

	            <div class="view'.$info['id'].'">
	            '.comment_info($info['id']).'
	            </div>
	            <div class="post_under_bar">
	            	<li><a href=""><img src="logos/icons/like.png"> Like</a></li>
	            	<li id="comment_button" post_id="'.$info['id'].'"><img src="logos/icons/comment.png"> Comment</li>
	            	<li><a href=""><img src="logos/icons/share.png"> Share</a></li>
	            </div>
	            <div class="comment_box none" id="under_bar'.$info['id'].'">
		            <br><br><div id="img_comment" style="background-image: url('.post_info($id,'img').');"></div>
		           	<input class="comment_text" placeholder="Writh a comment..." post_id="'.$info['id'].'" img_pro="'.post_info($id,'img').'" user_id="'.$friend_id.'">
		        	<div class="small_text">Press Enter to post.</div>
		        </div>
	        </div><br><br>';
			}else{
			
				echo '
			<div class="post">
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
 ?>