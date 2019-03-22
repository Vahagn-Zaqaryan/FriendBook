<head>
	<?php if (logged_in()=== true){
		echo"<title>".$user_data['fname']." ".$user_data['lname']."-FriendsBook</title>";
	}else{
		echo'<title>FriendsBook</title>';
	} ?>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
	<link rel="stylesheet" type="text/css" href="css/input_style.css">
	<link rel="stylesheet" type="text/css" href="css/search_box.css">
	<link rel="stylesheet" type="text/css" href="css/post_box.css">
	<link rel="stylesheet" type="text/css" href="css/comment_box.css">
	<link rel="stylesheet" type="text/css" href="css/boxmode.css">
	<link rel="icon" type="png/ico" href="logos/logo.png">
</head>