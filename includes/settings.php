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
	
			form{
				text-align: left;
				width: 100%;
				max-width: 400px;
				margin: auto;
				padding: 10px;
				color: black;
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
			.setting{
				display: flex;
				animation: appear 1s ease;
			}
			@media screen and (max-width: 700px) {
			  .setting {
			    flex-direction: column;
			  }
			}
		</style>
		<div id="error"></div>
		<div class="setting">
			<div style="margin: 5px; text-align: center;"><span style="font-size: 11px;">Drag an drop image to upload</span><br>
			
				<img ondragover="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" src="'.$image.'" style="width: 200px; height: 200px;"><br>
				<label for="change_image_input" id="change_image_button" style="background-color: #FB6A0291; display: inline-block; padding: 0.5em; margin-top: 2px; border-radius: 2px; cursor: pointer;" >Change Image
				</label>
				<input type="file" onchange="upload_profile_image(this.files)" id="change_image_input" style="display: none;">
				
			</div>
			
			<form id="myform">
				<input type="text" name="firstname" id="firstname" class="form-control form-control-sm" placeholder="First Name" value="'.$data->firstname.'"><br><br>
				<input type="text" name="lastname" id="lastname" class="form-control form-control-sm"placeholder="Last Name" value="'.$data->lastname.'"><br><br>
				<input type="text" name="email" id="email" class="form-control form-control-sm"placeholder="Email" value="'.$data->email.'"><br>
				<div style="padding: 5px;">
					Gender:<br>
					<input type="radio" name="gender" id="gender" value="Male" '.$gender_male.'>Male<br>
					<input type="radio" name="gender" id="gender" value="Female" '.$gender_female.'>Female
				</div>
				<input type="password" name="password" id="password" placeholder="Password" value="'.$data->password.'"><br><br>
				<input type="password" name="confirm_password" class="form-control form-control-sm"placeholder="Retype Password" value="'.$data->password.'"><br><br>
				<input type="button" id="save_settings_button" value="Save Settings" onclick="collect_data(event)"><br><br>
			
				<br>
			</form>
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

