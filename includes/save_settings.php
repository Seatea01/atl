<?php
$info = (Object)[];

$data = false;
	$data['userid'] = $_SESSION['userid'];


$data['firstname'] = $DATA_OBJ->firstname;
	if (empty($DATA_OBJ->firstname)) {
		$Error .= "Please enter a valid firstname<br>";
	}else{
		if (!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->firstname)) {
			$Error .= "Firstname Can Only Contain Alphabets .<br>";
		}
		if (strlen($DATA_OBJ->firstname)<3) {
			$Error .= "First Nmae must be at least 3 characters long .<br>";
		}
	}

$data['lastname'] = $DATA_OBJ->lastname;
	if (empty($DATA_OBJ->lastname)) {
		$Error .= "Please enter a valid lastname<br>";
	}else{
		if (!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->lastname)) {
			$Error .= "Last Name Can Only Contain Alphabets<br>";
		}
		if (strlen($DATA_OBJ->lastname)<3) {
			$Error .= "Last Name must be at least 3 characters long<br>";
		}
	}

$data['email'] = $DATA_OBJ->email;
	if (empty($DATA_OBJ->email)) {
	$Error .= "Please enter a valid email <br>";
	}else{
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email)) 
		{
			$Error .= "Please enter a valid email .<br>";
		}
	}

	$data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
	if (empty($DATA_OBJ->gender)) {
	$Error .= "Please select a gender <br>";
	}else{
		if ($DATA_OBJ->gender != 'Male' && $DATA_OBJ->gender != 'Female') {
			$Error .= "Please select a valid gender . <br>";
		}
	}

$data['password'] = $DATA_OBJ->password;
$password = $DATA_OBJ->confirm_password;
	if (empty($DATA_OBJ->password)) {
	$Error .= "Please enter a valid password <br>";
	}else{
		if ($DATA_OBJ->password != $DATA_OBJ->confirm_password) {
			$Error .= "Passwords do not match<br>";
		}
		if (strlen($DATA_OBJ->password)<3) {
			$Error .= "Password must be at least 3 characters long<br>";
		}
	}
	
	if ($Error =="") {
	
		$query = "UPDATE users SET userid= :userid,firstname= :firstname,lastname= :lastname,email= :email,gender= :gender,password= :password WHERE userid = :userid LIMIT 1";
		$result = $DB->write($query, $data);
		if ($result) {
			$info->message = "Your data was saved!";
		    $info->data_type = "save_settings";
		    echo json_encode($info);
		}else{
			//echo "";
			$info->message = "Your data was not saved due to an error!";
		    $info->data_type = "error";
		    echo json_encode($info);
		}
	}else{
		//echo $Error;
		$info->message = $Error;
		$info->data_type = "error";
		echo json_encode($info);
	}