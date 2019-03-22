<?php
	
	$errors = array();

	function req($input){

		if(isset($input) && !empty($input)){
			return true;
		}

		return false;

	}

	function writeErrors(){
		$dom = '';
		global $errors;

		foreach($errors as $error){
			$dom .= '<div class="error">'.$error.'</div>';
		}

		return $dom;
	}
	
	if(isset($_POST['submit'])){

		if(req($_POST['firstName']) && req($_POST['lastName']) && req($_POST['age'])){

			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$age = $_POST['age'];
			//File Upload
			
			$tmp = $_FILES['ppic']['tmp_name'];

			$name = $_FILES['ppic']['name'];

			if( move_uploaded_file($tmp, 'images/'.$name)){
				//Database


					$database = 'data/database.txt';

					$DB = fopen($database, "a");

					$data = PHP_EOL . $firstName . '&' . $lastName . '&' . $age . '&' . 'images/'.$name;

					if(fwrite($DB, $data)){
						array_push($errors, "");

						fclose($DB);
					}
			}

			


		}else {

			array_push($errors, "Some fields is not require");

		}

	}


	function getContent(){
		$endDom = '';

		$database = 'data/database.txt';

		$DB = fopen($database, "r");

		while( !feof($DB) ){
			$data = fgets($DB);

			$user = explode("&", $data);
			if(isset($user[0]) && isset($user[1])){
				$endDom .= '<li>
					<div class="inline profPic">
						<img src="'.$user[3].'" height="120">
					</div>
					<div class="inline profDesc">
						<div class="infoPanel">
							<span class="infoName">First Name:</span>
							<span class="infoDesc">'.$user[0].'</span>
						</div>
						<div class="infoPanel">
							<span class="infoName">Last Name:</span>
							<span class="infoDesc">'.$user[1].'</span>
						</div>
						<div class="infoPanel">
							<span class="infoName">Age:</span>
							<span class="infoDesc">'.$user[2].'</span>
						</div>
					</div>
				</li>';
			}
			
		}


		return $endDom;
	}


?>