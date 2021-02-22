<?php

	$arr['userid'] = 'null';
	if (isset($DATA_OBJ->find->userid)) {
		$arr['userid'] = $DATA_OBJ->find->userid;
		//print_r($arr);
		//die;	
	}
	
	$refresh = false;
	$seen = false;
	if ($DATA_OBJ->data_type == 'chats_refresh') {
		$refresh = true;
		$seen = $DATA_OBJ->find->seen;
	}
	$sql = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
	$result = $DB->read($sql, $arr);
	if (is_array($result)) {
		//user found
		$row = $result[0];
		$image = ($row->gender == "Male") ? "asset/images/user_male.jpg" : "asset/images/user_female.jpg";
				if (file_exists($row->image)) {
					$image = $row->image;
				}
				$row->image = $image;

				$mydata = "";
				if (!$refresh) {
				
					$mydata = "<div style='background-color: purple; height: 50px'>
								<div class='row'>
									<div class='col-sm-2'><img style='width: 50px; height: 50px; border-radius: 50%' src='$image'></div>
									<div class='col-sm-8'>header</div>
									<div class='col-sm-2'>search<img src=''></div>
								</div>
								</div>
								Now Chatting with:<br>
									<div id='active_contact'>
										<img src='$image'>
										$row->lastname $row->firstname
									</div>";
				}

				$messages = "";
				$new_message = false;
				if (!$refresh) {
					$messages = "<div style='background-color: gray; height: 50px; padding-left: 10px'>
									<div class='row'>
									<div class='col-sm-2'><img style='width: 50px; height: 50px; border-radius: 50%' src='$image'>online</div>
									<div class='col-sm-8'>header</div>
									<div class='col-sm-2'>search<img src=''></div>
								</div>
								</div>
							<div id='messages_holder_parent' onclick='set_seen(event)' style='height: 630px;'>
								<div id='messages_holder' style='height: 480px; overflow-y: scroll;'>";
						}
								//read from DB
								$a['sender'] = $_SESSION['userid'];
								$a['receiver'] = $arr['userid'];
								
								$sql = "SELECT * FROM messages WHERE (sender = :sender  && receiver = :receiver && deleted_sender = 0) || (receiver = :sender  && sender = :receiver && deleted_receiver = 0) order by id desc LIMIT 10";
								$result2 = $DB->read($sql, $a);
								if (is_array($result2)) 
								{
									$result2 = array_reverse($result2);
									
									foreach ($result2 as $data) {

										$myuser = $DB->get_user($data->sender);
										//check for new messages
										if ($data->receiver == $_SESSION['userid'] && $data->received == 0) {
											$new_message = true;
										}

										if ($data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen == true) 
										{
											$DB->write("update messages set seen = 1 where id = '$data->id' limit 1");
										}
										if ($data->receiver == $_SESSION['userid']) 
										{
											$DB->write("update messages set received = 1 where id = '$data->id' limit 1");
										}
										if ($_SESSION['userid'] == $data->sender) {

											$messages .= message_right($data, $myuser);
										}else{
											$messages .= message_left($data, $myuser);
										}
										
									}
								}
							
						 
				if (!$refresh) 
							{			
								$messages .= message_controls();
							}
		//$mydata .= $result->username;
		$info->user = $mydata;
		$info->messages = $messages;
		$info->data_type = "chats";
		$info->new_message = $new_message;
		if ($refresh) {
			$info->data_type = "chats_refresh";
		}
		
		echo json_encode($info);

	}else{

			//read from DB
			$a['userid'] = $_SESSION['userid'];
		
			
			$sql = "SELECT * FROM messages WHERE (sender = :userid  || receiver = :userid) group by msgid desc";
			$result2 = $DB->read($sql, $a);

			$mydata = "<div style='background-color: green; border-radius: 10px;'>header</div>
			Previous Chats:<br>";
			if (is_array($result2)) 
			{
				$result2 = array_reverse($result2);
				foreach ($result2 as $data) {
					
						
						$other_user = $data->sender;
						if ($data->sender == $_SESSION['userid']) 
						{
							$other_user = $data->receiver;
						}

						$myuser = $DB->get_user($other_user);
						
						$image = ($myuser->gender == "Male") ? "asset/images/user_male.jpg" : "asset/images/user_female.jpg";
						if (file_exists($myuser->image)) {
							$image = $myuser->image;
						}

					$mydata .= "
					
						<div id='active_contact' userid='$myuser->userid' onclick='start_chat(event)' style=''>
							<img src='$image'>
							$myuser->lastname $myuser->firstname<br>
							<span style='font-size: 11px;'>'$data->message'</span>
						</div>
						</div>
						</div><hr>";	
					
				}
			}
		$info->user = $mydata;
		$info->messages = "";
		$info->data_type = "chats";
		
		echo json_encode($info);
	}
	/*

	
<div class="container">
	<div class="inner_left_panel bg-primary">
		<div class="left_header"></div>
		<div class="container">
			<div class="left_search"></div>
			<div class="row"></div>
			<div class="col-sm-3"><img class="profile_image" src="asset/images/user_male.jpg">message one</div>
			<div class="col-sm-8"></div>
		</div>
	</div>
	<div class="right_panel bg-success">
		<div class="right_header bg-gray"></div>
		<div class="container"></div>
	</div>
</div>

	$mydata = $DATA_OBJ->find->userid;

	//$result = $result[0];
	$info->message = $mydata;
	$info->data_type = "contacts";
	echo json_encode($info);

	die;

	$info->message = "No contact found";
	$info->data_type = "error";
	echo json_encode($info);
	*/
?>