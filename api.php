<?php
session_start();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);
$info = (object)[];
//echo '<pre>';
//print_r($DATA_OBJ);
//echo '</pre>';
//die;

if (!isset($_SESSION['userid'])) 
{
	if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != 'login' && $DATA_OBJ->data_type != 'signup') 
	{
		$info->logged_in = false;
		echo json_encode($info);
		die;
	}
	
}

require_once("classes/autoload.php");

$DB = new Database();


$Error = "";
if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'signup') 
{
	
	include("includes/signup.php");
}elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'login') 
{
	require_once("includes/login.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'logout') 
{
	require_once("includes/logout.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'settings') 
{
	require_once("includes/settings.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'save_settings') 
{
	require_once("includes/save_settings.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'user_info') 
{
	require_once("includes/user_info.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'library') 
{
	require_once("includes/librarys.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'contact') 
{
	require_once("includes/contact.php");
}
elseif (isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == 'chats' || $DATA_OBJ->data_type == 'chats_refresh')) 
{
	require_once("includes/chat.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'send_message') 
{
	require_once("includes/send_message.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'delete_message') 
{
	require_once("includes/delete_message.php");
}
elseif (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'delete_thread') 
{
	require_once("includes/delete_thread.php");
}


function message_left($data, $row)
{
	$image = ($row->gender == "Male") ? "asset/images/user_male.jpg" : "asset/images/user_female.jpg";
				if (file_exists($row->image)) {
					$image = $row->image;
				}
				$row->image = $image;

	$a = "
	<div id='message_left'>
			<div></div>
				<img id='prof_img' src='$image'>
				<b>$row->firstname</b><br>
				$data->message<br>";
	if ($data->files !="" && file_exists($data->files)) {
		$a .= "<img src='$data->files' style='width: 100%; cursor: pointer;' onclick='image_show(event)'><br>";
	}
	$a .="<span style='font-size: 11px; color: #888'>".date("jS M Y H:i:s a", strtotime($data->date))."</span>
				<span style='float: right; cursor: pointer; font-size: 11px; color: #888' onclick='delete_message(event)' msgid='$data->id'>delete</span>

			</div>";
	return $a;
}

function message_right($data, $row)
{
	$a = "";
	$image = ($row->gender == "Male") ? "asset/images/user_male.jpg" : "asset/images/user_female.jpg";
				if (file_exists($row->image)) {
					$image = $row->image;
				}
				$row->image = $image;

	$a .= "
		<div id='message_right'>
		<div>";	

	if ($data->seen) {
		$a .= "<img src='asset/icons/tick_green.png'>";
	}elseif($data->received){
		$a .= "<img src='asset/icons/tick.jpg'>";
	}
	
	
	$a .= "</div>
				<img id='prof_img' src='$image' style='float: right'>
				<b>$row->firstname</b><br>
				$data->message<br>";
				if ($data->files !="" && file_exists($data->files)) {
						$a .= "<img src='$data->files' style='width: 100%; cursor: pointer;' onclick='image_show(event)'><br>";
					}
				$a .="<span style='font-size: 11px; color: #888'>".date("jS M Y H:i:s a", strtotime($data->date))."</span><span style='float: right;  cursor: pointer; font-size: 11px; color: #888' onclick='delete_message(event)' msgid='$data->id'>delete</span>

			</div>";

	return $a;
}

function message_controls()
{
	return "</div>
				<span style='cursor: pointer; font-size: 12px; color: purple;' onclick='delete_thread(event)'>Delete this thread</span>
				<div style='display: flex; width: 100%; height: 40px;'>
				<label for='message_file'><img src='asset/icons/clip.jpg' style='opacity: .8; width: 30px; margin: 5px; cursor: pointer;'></label>
				<input type='file' id='message_file' name='file' style='display: none;' onchange='send_image(this.files)'>
					<input id='message_text' onkeyup='enter_pressed(event)' style='flex: 6; border: solid thin #ccc; border-bottom: none; font-size: 14px; padding: 4px;' type='text' placeholder='Type your message...'>
					<input style='flex: 1; cursor: pointer;' type='button' value='send' onclick='send_message(event)'>
				</div>
			</div>

							";
}