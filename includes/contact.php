<?php
	$myid = $_SESSION['userid'];
	$sql = "SELECT * FROM users WHERE userid != '$myid' LIMIT 10";
	$myusers = $DB->read($sql, []);
	$mydata = '

	<style>
			@keyframes appear{
				0%{opacity:0; transform: translateY(50px)}
				100%{opacity:1; transform: translateY(0px)}
			}
			#contact{
				cursor: pointer;
				transition: all 0.5s cubic-bezier(0.68, -2, .265, 1.55);
			}
			#contact:hover{
				transform: scale(1.1);

			}
		</style>
		<div style="text-align: center;">';

		
		if (is_array($myusers)) 
		{
			//check for new messages
			$msgs = array();
			$me = $_SESSION['userid'];
			$query = "select * from messages where receiver = '$me' && received = 0";
			$mymsg = $DB->read($query, []);

			if (is_array($mymsg)) {
				foreach ($mymsg as $row2) {
					$sender = $row2->sender;

					if (isset($msgs[$sender])) {
						$msgs[$sender]++;
						
					}else{
						$msgs[$sender] = 1;
					}
					
				}
			}

			foreach ($myusers as $row) 
			{
				$image = ($row->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
				if (file_exists($row->image)) {
					$image = $row->image;
				}
				
				$mydata .= "<div id='contact' style='position: relative; color: black;' userid='$row->userid' onclick='start_chat(event)'>
					<img src='$image'>
					<br>$row->firstname $row->lastname";

					if (count($msgs) > 0 && isset($msgs[$row->userid])) 
					{
						
					$mydata .="<div style='width:20px; border-radius: 50%; background-color: orange; color: white; position: absolute; left:0px; top: 0px;'>".$msgs[$row->userid]."</div>";
					}
					$mydata .="</div>";
			}
		}
	

	$mydata .= '</div>';

	//$result = $result[0];
	$info->message = $mydata;
	$info->data_type = "contact";
	echo json_encode($info);

	die;

	$info->message = "No contact found";
	$info->data_type = "error";
	echo json_encode($info);
?>
