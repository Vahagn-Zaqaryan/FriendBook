<style type="text/css">
	#upload_pbox{
		cursor: pointer;
		border: dashed 4px #aaa;
		width: 150px;
		height: 150px;
		margin: 40px auto; 
	}
	#upload_pbox img{
		cursor: pointer;
		width: 100px;
		margin: 26px;
		opacity: 0.4;
	}
	#discription h3{
		color: #aaa;
		margin: 5px 275px;
		font-size: 30px;
	}
	#button_bar{
		background-color: #EAE4ED;
		width: 100%;
		height: 50px;
		position: absolute;bottom: 0px;
		margin-left:-2px ;
		border-radius: 0px 0px 3px 3px;
		border-top: 1px solid #C1C1C3;
	}
	#button_bar input{
		-webkit-transition: all 0.5s;
		background: rgb(0, 90, 250);
		color: white;
        border-radius: 8px;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        padding: 8px 16px;
        margin: 7px;
        float: right;
        border: 1px solid #fff;
        box-shadow: inset  0 0 3px rgba(255,255,255,1)
	}
	#button_bar input:hover{
		background: rgb(0, 130, 250);
	}
	#upload_pbox input {
	   	width: 0.1px;
		height: 0.1px;
		opacity: 0;
		overflow: hidden;
		position: absolute;
		z-index: -1;
	}
</style>
<form action="./photo_put.php?category=cover&option=upload" method="POST" enctype="multipart/form-data">
	<div id="upload_pbox">
		<label>
			<input type="file" name="img">
			<img src="logos/icons/image6.png">
		</label>			
	</div>
	<div id="discription">
		<h3>Upload Photo</h3>
	</div>
	<div id="button_bar">
		<input type="submit" value="Save">
	</div>
</form>