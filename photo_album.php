<style type="text/css">
	#input_album{
		border-radius: 0px;
		color: #000;
		width: 180px;
		padding-left: 5px;
		height: 25px;
	}
</style>
<form action="" method="POST" enctype="multipart/form-data">
	<input type="text" name="name_album" placeholder="Write name of album" id="input_album"><br>
	<label>Choose image for album</label>
	<input type="file" name="album_img"><br><br>
	<input type="submit" class="blue-input-style" value="Create album">
</form>
