<?php
	include 'core/init.php';
    protect_page();
	include'includes/overall/header.php';
?>
<style type="text/css">
	body{
        color: #000;
    }
    #settings-input{
        color: #000;
        outline: none;
        -webkit-transition: all 0.5s;
        background: -webkit-linear-gradient(top, #ddd , #fff);
        padding: 8px 20px;
        border: solid 1px #aaa;
        border-radius: 5px;
    }
    #settings-input:hover{
        border: solid 1px #000; 
    }
    #settings-input:active{
        background: -webkit-linear-gradient(top, #fff , #ddd);
    }
    input[type="text"] ,input[type="password"]{
        color: #000;
        outline: none;
        -webkit-transition: all 0.5s;
        padding: 8px 5px;
        border: solid 1px #aaa;
        border-radius: 5px;
        width: 200px;
    }
    input[type="text"]:hover,input[type="password"]:hover{
        border: solid 1px #000; 
    }
    #edit{
        float: right;
        display: inline-block;
        margin-top: -30px;
        margin-right: 10px;
    }
    #option{
        margin-left: 10px;
    }
    #option span{
        margin-left: 250px;
        font-size: 15px;
    }
    #deletebox{
        width: 450px;
    }
    #namebox{
        width: 500px;
        height: 250px;
    }
    #userbox{
        width: 500px;
        height: 330px;
    }
    #passbox{
        width: 500px;
        height: 310px;
    }
    .box{
        border-radius: 3px;
        background-color: rgba(255,255,255,1);
        position: absolute;
        z-index: 9999;
        margin: auto;
    }
    .box .title_bar{
        border-radius: 3px 3px 0 0;
        background-color: #F6F7F8;
        border-bottom: 1px solid #E5E5E5;
        padding: 10px 12px;
        height: 20px;
    }
    .title{
        float: left;
        cursor: pointer;
    }
    .title h3{
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
        padding: 15px;
        font-size: 15px;
    }
    #text{
        display: inline-block;
    }
    #button{
        margin: 10px;
        float: right;
    }
    #button a:first-child{
        direction: none;
        background-color: #000;
        color: #fff;
        padding: 3px 5px;
        border-radius: 3px;
        margin-right: 10px;
    }
    #button_bar{
        background-color: #EAE4ED;
        width: 100%;
        height: 40px;
        position: absolute;bottom: 0px;
        margin-left:-15px ;
        border-radius: 0px 0px 3px 3px;
        border-top: 1px solid #C1C1C3;
    }
    #button_bar input{
        margin: 3px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var window_height = $(window).height();
        var window_width = $(window).width();
        var div_height = $('#deletebox').height();
        var div_width = $('#deletebox').width();
        $('#deletebox').css('top', (window_height/3)-(div_height/3)).css('left', (window_width/2)-(div_width/2));
        $('#delaccount').click(function(){
            $('#delet_account').fadeIn();
        });
        $('#close_del').click(function(){
            $('#delet_account').fadeOut();
           //$("#content").empty();
        });
        $('#close_cancel').click(function(){
            $('#delet_account').fadeOut();
           //$("#content").empty();
        });
    }); 
    $(document).keyup(function(e) { 
        if (e.which == 27) {
            $('#delet_account').fadeOut();
        }           
    });
    $(document).ready(function () {
        var window_height = $(window).height();
        var window_width = $(window).width();
        var div_height = $('#namebox').height();
        var div_width = $('#namebox').width();
        $('#namebox').css('top', (window_height/4)-(div_height/4)).css('left', (window_width/2)-(div_width/2));
        $('#name_cbutton').click(function(){
            $('#change_name').fadeIn();
        });
        $('#close_name').click(function(){
            $('#change_name').fadeOut();
           //$("#content").empty();
        });
    }); 
    $(document).keyup(function(e) { 
        if (e.which == 27) {
            $('#change_name').fadeOut();
        }           
    }); 
    $(document).ready(function () {
        var window_height = $(window).height();
        var window_width = $(window).width();
        var div_height = $('#userbox').height();
        var div_width = $('#userbox').width();
        $('#userbox').css('top', (window_height/4)-(div_height/4)).css('left', (window_width/2)-(div_width/2));
        $('#user_cbutton').click(function(){
            $('#change_user').fadeIn();
        });
        $('#close_user').click(function(){
            $('#change_user').fadeOut();
           //$("#content").empty();
        });
    }); 
    $(document).keyup(function(e) { 
        if (e.which == 27) {
            $('#change_user').fadeOut();
        }           
    }); 
    $(document).ready(function () {
        var window_height = $(window).height();
        var window_width = $(window).width();
        var div_height = $('#passbox').height();
        var div_width = $('#passbox').width();
        $('#passbox').css('top', (window_height/4)-(div_height/4)).css('left', (window_width/2)-(div_width/2));
        $('#pass_cbutton').click(function(){
            $('#change_pass').fadeIn();
        });
        $('#close_pass').click(function(){
            $('#change_pass').fadeOut();
           //$("#content").empty();
        });
        <?php 
            $var = $user_data['password'];
            echo "var pass = '{$var}';";
        ?>
        // $('#pass_c').change(function(){
        //     var Value = $(this).val();
        //     if (Value != pass) {
        //         alert("Your current password is incorrect");
        //     };
        // });
        // $('#pass_n').change(function(){
        //     var Valuenew = $(this).val();
        //     if (Valuenew.length < 6 ) {
        //         alert("Your password must be at least 6 characters");
        //     };
        // });
        // $('#pass_a').change(function(){
        //     var Valuenew = $("#pass_n").val();
        //     var Valueagein = $(this).val();
        //     if (Valueagein != Valuenew) {
        //         alert("Your new passwords don't match");
        //     };
        // });          
    });
    
    $(document).keyup(function(e) { 
        if (e.which == 27) {
            $('#change_pass').fadeOut();
        }           
    });
</script>
<h1><img class="title_icons"src="logos/icons/settings.png"> Settings</h1>
	<div class="boxsett">
        <li>
            <div class="setting_row">
                <div id="option">
                    <h3>Name</h3> <span><?php echo $user_data['fname']; ?> <?php echo $user_data['lname']; ?></span>
                </div>
                <div id="edit">
                    <a href="#" id="name_cbutton"><img src="logos/icons/edit_settings.png" id="icons"> Edit</a>
                    <div class="clear"></div>
                </div>  
            </div>
        </li>
        <li>
            <div class="setting_row">
                <div id="option">
                    <h3>Username</h3> <span><?php echo $user_data['uname'];?></span>
                </div>
                <div id="edit">
                    <a href="#" id="user_cbutton"><img src="logos/icons/edit_settings.png" id="icons"> Edit</a>
                    <div class="clear"></div>
                </div>  
            </div>
        </li>
        <li>
            <div class="setting_row">
                <div id="option">
                    <h3>Password</h3> <span></span>

                </div>
                <div id="edit">
                    <a href="#" id="pass_cbutton"><img src="logos/icons/edit_settings.png" id="icons"> Edit</a>
                    <div class="clear"></div>
                </div>  
            </div>
        </li>
        <li>
            <div class="setting_row">
                <div id="option">
                    <h3>Delete account</h3> <span></span>
                </div>
                <div id="edit">
                    <a href="#" id="delaccount"><img src="logos/icons/delacc.png" id="icons"> Delete</a>
                    <div class="clear"></div>
                </div>  
            </div>
        </li>
    </div>
    <div class="black_screen" id="change_pass">
        <div id="passbox" class="box">
            <div class="title_bar">
                <div class="title">
                    <h3>Change Your Password</h3>
                </div>
                <div class="close" id="close_pass" title="Press Esc to close">
                    <img src="logos/icons/cancel.png">
                </div>
            </div><br>
            <div id="content">
                <form action="changepassword.php" method="post">         
                    Current Password:    <input type="password" name="current_password" placeholder="Current Password" style="margin-left: 20px;" required id="pass_c">
                    <br><br>
                    New Password:        <input type="password" name="password" placeholder="New Password" style="margin-left: 40px;" required id="pass_n">
                    <br><br>
                    New Password Again:  <input type="password" name="password_again" placeholder="New Password Again" style="margin-left: 0px;" required id="pass_a">
                    <br><br>
                    <b style="color: #5050ff;">Info</b>
                    <br>
                    1.Your password must be at least 6 characters
                    <div id="button_bar">
                        <input type="submit" class="blue-input-style right" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="black_screen" id="change_user">
        <div id="userbox" class="box">
            <div class="title_bar">
                <div class="title">
                    <h3>Change Your Username</h3>
                </div>
                <div class="close" id="close_user" title="Press Esc to close">
                    <img src="logos/icons/cancel.png">
                </div>
            </div><br>
            <div id="content">
                <form action="changeusername.php" method="post">         
                    Current Username:    <input type="text" name="current_username" placeholder="Current Username" style="margin-left: 20px;">
                    <br><br>
                    New Username:        <input type="text" name="username" placeholder="New Username" style="margin-left: 40px;">
                    <br><br>
                    New Username Again:  <input type="text" name="username_again" placeholder="New Username Again" style="margin-left: 0px;">
                    <br><br>
                    <b style="color: #5050ff;">Info</b>
                    <br>
                    1.Your username must be at least 6 characters <br>
                    2.Your new username must not contain any spaces
                    <div id="button_bar">
                        <input type="submit" class="blue-input-style right" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="black_screen" id="change_name">
        <div id="namebox" class="box">
            <div class="title_bar">
                <div class="title">
                    <h3>Change Your Name</h3>
                </div>
                <div class="close" id="close_name" title="Press Esc to close">
                    <img src="logos/icons/cancel.png">
                </div>
            </div><br>
            <div id="content">
                <form action="changename.php" method="post">
                    First name: <input type="text" value="<?php echo $user_data['fname'] ?>" name="fnamec">
                <br><br>
                    Last name: <input type="text" value="<?php echo $user_data['lname'] ?>" name="lnamec">
                
                    <div id="button_bar">
                        <input type="submit" class="blue-input-style right" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="black_screen" id="delet_account">
        <div id="deletebox" class="box">
            <div class="title_bar">
                <div class="title">
                    <h3>Delete Your accuunt</h3>
                </div>
                <div class="close" id="close_del" title="Press Esc to close">
                    <img src="logos/icons/cancel.png">
                </div>
            </div><br>
            <div id="content">
                <div id="text">
                    Are you sure that you want to delete your account
                </div><br><br>
                <div id="button">
                    <a href="del.php">Delete</a>
                    <a href="#" id="close_cancel"> Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function  closebox() {
            var x =document.getElementById('searchbox');
            x.style.display="none";
        }
    </script>
    <div id="searchbox">
        <button onclick="closebox()"></button>
        <div class="container">
            <ul class="contList">
                <?php echo getinfo(); ?>
            </ul>           
        </div>
    </div>
<?php include'includes/overall/footer.php'; ?>