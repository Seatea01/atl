<?php
	$arr['userid'] = 'null';
	if (isset($DATA_OBJ->find->userid)) {
		$arr['userid'] = $DATA_OBJ->find->userid;	
	}
	$sql = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
	$result = $DB->read($sql, $arr);
	if (is_array($result)) {
		//user found
		$arr['message'] = $DATA_OBJ->find->message;
		$arr['date'] = date("Y-m-d H:i:s");
		$arr['sender'] = $_SESSION['userid'];
		$arr['msgid'] = get_random_string_max(60);

			$arr2['sender'] = $_SESSION['userid'];
			$arr2['receiver'] = $arr['userid'];
			
			$sql = "SELECT * FROM messages WHERE (sender = :sender  && receiver = :receiver) || (receiver = :sender  && sender = :receiver) LIMIT 1";
			$result2 = $DB->read($sql, $arr2);

			if (is_array($result2)) 
			{
				$arr['msgid'] = $result2[0]->msgid;
			}

		$query = "INSERT INTO messages (sender, receiver, message, date, msgid) VALUES(:sender, :userid, :message, :date, :msgid)";
		$DB->write($query, $arr);


		$row = $result[0];
		$image = ($row->gender == "Male") ? "asset/images/user_male.jpg" : "asset/images/user_female.jpg";
				if (file_exists($row->image)) {
					$image = $row->image;
				}
				$row->image = $image;

				$mydata = "<div style='background-color: gray;'>
							</div>
				Now Chatting with:<br>
						<div id='active_contact'>
							<img src='$image'>
							$row->lastname $row->firstname
						</div>";

				$messages = "<div style='background-color: gray; height: 50px; padding-left: 10px'>
									<div class='row'>
									<div class='col-sm-2'><img style='width: 50px; height: 50px; border-radius: 50%' src='$image'>online</div>
									<div class='col-sm-8'>header</div>
									<div class='col-sm-2'>search<img src=''></div>
								</div>
								</div>

							<div id='messages_holder_parent' style='height: 630px;'>
								<div id='messages_holder' style='height: 480px; overflow-y: scroll;'>";

								//read from DB
								$a['msgid'] = $arr['msgid'];

								$arr2['sender'] = $_SESSION['userid'];
								$arr2['receiver'] = $arr['userid'];
								
								$sql = "SELECT * FROM messages WHERE msgid = :msgid order by id desc";
								$result2 = $DB->read($sql, $a);
								if (is_array($result2)) 
								{
									$result2 = array_reverse($result2);
									foreach ($result2 as $data) {
										$myuser = $DB->get_user($data->sender);
										if ($_SESSION['userid'] == $data->sender) {

											$messages .= message_right($data, $myuser);
										}else{
											$messages .= message_left($data, $myuser);
										}
										
									}
								}
									
								$messages .= message_controls();
		//$mydata .= $result->username;
		$info->user = $mydata;
		$info->messages = $messages;
		$info->data_type = "send_message";
		echo json_encode($info);

	}else{
		//users not found
		$info->message = "That contact was not found";
		$info->data_type = "chats";
		echo json_encode($info);
	}

	function get_random_string_max($length)
	{
		$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$text = "";

		$length = rand(4,$length);
		for ($i=0; $i < $length ; $i++) { 
			$random = rand(0,61);
			$text .= $array[$random];
		}
		return $text;
	}
	/*
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