<?php 
	include 'core/init.php';
	protect_page();
	$id=$_SESSION['id'];
	$img=$_GET['img'];
	$category=$_GET['category'];
	$option=$_GET['option'];
	date_default_timezone_set('America/Los_Angeles');
	$date=date("d.m.Y");
	$time=date("H:i");
	if ($category == 'cover') {
		if ($option == 'take') {
			$quary=mysql_query("UPDATE  `database`.`data` SET  `imgcover` =  '$img' WHERE  `data`.`id` = \"$id\" ");       
	        $quary_post=mysql_query("INSERT INTO `database`.`post` (`post_id`, `post_img`, `post_category`, `post_date`,`post_time`) VALUES ('$id', '$img', 'update cover photo', '$date', '$time');");
	    	header ('Location: profile.php?id='.$id);
		}elseif ($option == 'upload') {
			$rand_img = rand();
			$tmp = $_FILES['img']['tmp_name'];
			$name = $_FILES['img']['name'];
		 	if(move_uploaded_file($tmp, 'images/'.$rand_img.$name)){
		        $quary=mysql_query("UPDATE  `database`.`data` SET  `imgcover` =  'images/$rand_img$name' WHERE  `data`.`id` = \"$id\" ");       
		        $quary_post=mysql_query("INSERT INTO `database`.`post` (`post_id`, `post_img`, `post_category`, `post_date`,`post_time`) VALUES ('$id', 'images/$rand_img$name', 'update cover photo', '$date', '$time');");
			    $quary_photo=mysql_query("INSERT INTO `database`.`photo` (`id`,`user_id`,`img`) VALUES ('','$id','images/$rand_img$name');");
		    	header ('Location: profile.php?id='.$id);
		    }
		}
	}elseif ($category == 'profile') {
		if ($option == 'take') {
			$quary=mysql_query("UPDATE  `database`.`data` SET  `img` =  '$img' WHERE  `data`.`id` = \"$id\" ");       
	        $quary_post=mysql_query("INSERT INTO `database`.`post` (`post_id`, `post_img`, `post_category`, `post_date`,`post_time`) VALUES ('$id', '$img', 'update profile photo', '$date', '$time');");
	    	header ('Location: profile.php?id='.$id);
		}elseif ($option == 'upload') {
			$rand_img = rand();
			$tmp = $_FILES['img']['tmp_name'];
			$name = $_FILES['img']['name'];
		 	if(move_uploaded_file($tmp, 'images/'.$rand_img.$name)){
		        $quary=mysql_query("UPDATE  `database`.`data` SET  `img` =  'images/$rand_img$name' WHERE  `data`.`id` = \"$id\" ");        
		        $quary_post=mysql_query("INSERT INTO `database`.`post` (`post_id`, `post_img`, `post_category`, `post_date`,`post_time`) VALUES ('$id', 'images/$rand_img$name', 'update profile photo', '$date', '$time');");
			    $quary_photo=mysql_query("INSERT INTO `database`.`photo` (`id`,`user_id`,`img`) VALUES ('','$id','images/$rand_img$name');");
		    	header ('Location: profile.php?id='.$id);
		    }
	}
		}
?>