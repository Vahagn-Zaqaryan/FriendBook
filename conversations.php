<?php
	include 'core/init.php';
	protect_page();
	include'includes/overall/header.php';
	include 'function_friend.php';
?>
<?php $my_id=$_SESSION['id']; ?>
<style type="text/css">
.post_maker{
	margin-left: 300px;
	background-color: #ffffff;
	padding: 10px;
	width: 400px;
	border-radius: 3px;
	border: 1px solid #aaa;
}
.post_maker textarea{
	font-size: 12px;
    padding: 5px;
    width: 100%;
    overflow: hidden;
    resize: none;
    max-width: 100%;
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
}
.box_over{
	width: 400px;
	max-height: 350px;
	display: inline-block;
	overflow: auto;
}
		.message_box{
            width: 150px;
            margin-left: 240px;
        }
        .message_box #mess_box_con{
            background-color: #4C67fF;
            color: #fff;
            font-size: 15px;
            padding: 5px;
            border-radius: 20px;
            word-wrap: break-word;
            min-width: 150px;
            max-width: 200px;
            float: right;
            padding-left: 10px;
        }
        .message_box_user{
            width: 150px;
            margin-left:0px;
        }
        .message_box_user #mess_img{
            width: 30px;
            height: 30px;
            background-position: 50% 25%;
            background-size: cover;
            -webkit-transition-duration: 500ms;
            -webkit-transition-property: width, height;
            border: 1px solid #000;
            border-radius: 100%; 
            display: inline-block;
        }
        .message_box_user #mess_box_con{
            background-color: #AB75B8;
            color: #fff;
            font-size: 15px;
            padding: 5px;
            border-radius: 20px;
            word-wrap: break-word;
            min-width: 100px;
            max-width: 200px;
            float: right;
            padding-left: 10px;
        }
        .icon2{
        	width: 30px;
        }
        .middle_text{
        	margin:20px;
        	margin-left: 150px; 
        }
        .box_over::-webkit-scrollbar {
		   width: 10px;
		}
		/* Track */
		::-webkit-scrollbar-track {
			background-color: rgba(150,150,150,0.5);
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
		function  closebox() {
			var x =document.getElementById('searchbox');
			x.style.display="none";
		}
	</script>
<script type="text/javascript">
	$(document).ready(function(){
        $('.message_input').keyup(function(e){
            if (e.keyCode == 13) {
            	$('.middle_text').empty();
            	var hash = $(this).attr('hash');
            	var user = $(this).attr('user');
                var message = $(this).val();
                $.post('message_quary.php', {hash: hash, message: message, user: user});
            	$('.message_input').val('');
            }
        });
          
    });
	 $(document).ready(function(){
		var hash = $('.message_input').attr('hash');
	var cacheData;
var data = $('.box_over').html();
var auto_refresh = setInterval(
function ()
{
    $.ajax({
        url: 'message_content.php?hash='+ hash +' ',
        type: 'POST',
        data: data,
        hash: hash,
        dataType: 'html',
        success: function(data) {
            if (data !== cacheData){
                cacheData = data;
                $('.box_over').html(data);
            }          
        }
    })
}, 100);
// $( "#press_enter_send" ).change(function() {
// 	if ($("#press_enter_send").prop( "checked" ) === false) {
// 		$(".message_button").show();
// 		$(".message_button").click(function(){
//         	var hash = $(this).attr('hash');
//         	var user = $(this).attr('user');
//             var message = $(".message_input").val();
//             $.post('message_quary.php', {hash: hash, message: message, user: user});
//         	$('.message_input').val('');
//         });
//     }else{
//     	$(".message_button").hide();
//     	$('.message_input').keyup(function(e){
//             if (e.keyCode == 13) {
//             	$('.middle_text').empty();
//             	var hash = $(this).attr('hash');
//             	var user = $(this).attr('user');
//                 var message = $(this).val();
//                 $.post('message_quary.php', {hash: hash, message: message, user: user});
//             	$('.message_input').val('');
//             }
//         });
//     }
// });	    
	 	
});
</script>
				<div class="post_maker">
						<div><a href="conversations_user.php" style="color:#000;"><img src="logos/icons/directional (1).png" id="icons"> Go to back </a><div class='small_text' style="display: inline-block;">Click in message to delete it.</div></div>
						<div class="box_over"> 
							<?php 

								if (isset($_GET['hash']) && !empty($_GET['hash'])) {
						
								$hash = $_GET['hash'];
								$my_id=$_SESSION['id'];
								$mess_query=mysql_query("SELECT user_one, user_two FROM message_group WHERE (user_one='$my_id' OR user_two='$my_id')");
								while ($run_mess=mysql_fetch_array($mess_query)) {
									$user_one=$run_mess['user_one'];
									$user_two=$run_mess['user_two'];
									if ($user_one == $my_id) {
										$user=$user_two;
									}else{
										$user=$user_one;
									}
								}
								mysql_query("DELETE FROM `inbox_message` WHERE `from`='$user' AND `to`='$my_id'");	
							echo '</div>
										<textarea role="textbox" rows="3" placeholder="Write a reply..." style="height: 45px;" name="new_message" class="message_input" hash="'.$hash.'" user="'.$user.'"></textarea>
									</div>';
							 ?>
						


	<?php
		}
	?>	
		<!-- <input type="checkbox" id="press_enter_send"><label for="press_enter_send">Press Enter to send</label>
		<button class="message_button">send</button>
 -->	<div id="searchbox">
		<button onclick="closebox()"></button>
		<div class="container">
			<ul class="contList">
				<?php echo getinfo(); ?>
			</ul>			
		</div>
	</div>			
<?php include'includes/overall/footer.php'; ?>