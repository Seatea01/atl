<?php
$id = $_SESSION['userid'];
$sql = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
$data = $DB->read($sql, ['userid'=>$id]);

$mydata = "";
if (is_array($data)) {
		$data = $data[0];
		//check if image exist
		$image = ($data->gender == "Male") ? "asset/images/user_male.jpg" : "asset/images/user_female.jpg";
				if (file_exists($data->image)) {
					$image = $data->image;
				}

		$gender_male = "";
		$gender_female = "";

		if ($data->gender == 'Male') {
			$gender_male = "checked";
		}else{
			$gender_female = "checked";
		}

	$mydata ='
		<style type="text/css">

			@keyframes appear{
				0%{opacity:0; transform: translateY(50px) rotate(5deg); transform-origin: 100% 100%;}
				100%{opacity:1; transform: translateY(0px) rotate(0deg); transform-origin: 100% 100%;}
			}
	
			.shelf{
				text-align: left;
				width: 100%;
				max-width: 400px;
				margin: auto;
				padding: 10px;
				color: black;
				font-size: 12px;
			}
			input[type=text], input[type=password], input[type=button]{
				border-top: none;
				border-left: none;
				border-right: none;
				border-radius: 0px;
			}
			input[type=button]{
				width: 200px;
				 background-color: #FB6A0291;
				 color: white;
				 cursor: pointer;
			}
			input[type=radio]{
				cursor: pointer;
			}
			input:hover{
				border: solid thin #1b6879;
			}
			#error{
				text-align: center; 
				padding: 0.5em; 
				background-color: #ecaf91; 
				color: white; 
				display: none;
			}
			.dragging{
				border: dashed 2px #aaa;
			}
			.library{
				display: flex;
				animation: appear 1s ease;
			}
			@media screen and (max-width: 700px) {
			  .library {
			    flex-direction: column;
			  }
			}
		</style>
		<div id="error"></div>
		<div class="library">
		<div style="margin: 5px; text-align: center; width: 270px;">
			<div style="margin: 5px; border-bottom-right-radius: 110%; padding-bottom: 20px; border-bottom: 5px solid #FF6A00; z-index: 1"><span style="font-size: 11px;">Drag an drop e-book to upload</span><br>
			
				<img ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" src="'.$image.'" style="width: 200px; height: 200px;"><br>	
			</div>
			<label for="change_image_input" id="change_image_button" style="background-color: #FB6A0291; display: inline-block; padding: 0.5em; margin-top: 20%; border-radius: 2px; cursor: pointer;" >Upload E-book
				</label>
				<input type="file" onchange="upload_profile_image(this.files)" id="change_image_input" style="display: none;">
			</div>
			
			<div class="shelf text-primary">
				<div>
					<div><img src="asset/images/book.jpg" style="width: 150px;"></div>
					<div>Title: Zero Excuses<br>Discription: 2021 is a year of zero excuses...</div>
				</div><br>

				<div>
					<div><img src="asset/images/book.jpg" style="width: 150px;"></div>
					<div>Title: Zero Excuses<br>Discription: 2021 is a year of zero excuses...</div>
				</div><br>

				<div>
					<div><img src="asset/images/book.jpg" style="width: 150px;"></div>
					<div>Title: Zero Excuses<br>Discription: 2021 is a year of zero excuses...</div>
				</div>
			</div>
		</div>

		';

	

	//$result = $result[0];
	$info->message = $mydata;
	$info->data_type = "settings";
	echo json_encode($info);
}else{


	$info->message = "Error occured";
	$info->data_type = "error";
	echo json_encode($info);
}


?>


