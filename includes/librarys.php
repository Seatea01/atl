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
				0%{opacity:0; transform: translateY(50px)}
				100%{opacity:1; transform: translateY(0px)}
			}
			.col-sm-3{
				cursor: pointer;
				transition: all 0.5s cubic-bezier(0.68, -2, .265, 1.55);
			}
			.col-sm-3:hover{
				transform: scale(1.1);
			}
	
			.shelf{
				margin: auto;
				padding: 10px;
				color: black;
				font-size: 12px;
			}
		
			.library{
				display: flex;
				animation: appear 1s ease;
			}
			@media screen and (max-width: 700px) {
			  .library {
			    flex-direction: column;
			  }
			  .col-sm-3{
			  	margin-top: 10px;
			  }
			}
		</style>
		<div>
			<div class="library" style="margin: auto; text-align: center; padding-top: 50px;">
			
				<div class="row shelf" style="font-size: 17px;">
					<div class="col-sm-3">
						<img src="asset/images/book.jpg" style="width: 150px;">
						<div>Books</div>
					</div>

					<div class="col-sm-3">
						<img src="asset/images/book.jpg" style="width: 150px;">
						<div>Music</div>
					</div>

					<div class="col-sm-3">
						<div><img src="asset/images/book.jpg" style="width: 150px;"></div>
						<div>Pictures</div>
					</div>

					<div class="col-sm-3 text-center">
						<div><img src="asset/images/book.jpg" style="width: 150px;"></div>
						<div>videos</div>
					</div>
				</div>
			</div>

			<div class="text-center" style="margin-top: 50px; font-size: 72px; color: black;">"2021 A Year of Zero Excuses"</div>

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


