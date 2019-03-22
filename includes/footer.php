<?php
	if (logged_in() === true) {
			echo "
					<footer>
						FriendBook © 2015
					</footer>
				";
		}
		else{
			echo "<div id='footer_logout'>
 					FriendBook © 2015
 				  </div>
				";
		}
 ?>
