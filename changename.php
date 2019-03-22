<?php
	include 'core/init.php';
    protect_page();
	$id = $_SESSION['id'];
    if(!empty($_POST['fnamec']) && !empty($_POST['lnamec'])){
        $fnamec=$_POST['fnamec'];
        $lnamec=$_POST['lnamec'];
        $query= mysql_query("UPDATE  `database`.`data` SET  `fname` =  '$fnamec', `lname` =  '$lnamec' WHERE  `data`.`id` = \"$id\" ");
        header("Location: profile.php?id=".$id);
    }
?>
