<!DOCTYPE html>
<html>
<head>
	<title>Alpha Training Lab</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<style type="text/css">
	 @font-face{
      font-family: NexaLight;
      src: url(asset/fonts/Nexa Light.otf);
    }
    @font-face{
      font-family: NexaBold;
      src: url(asset/fonts/Nexa Bold.otf);
    }
  body{
    font-family: NexaLight;
     font-size: 18px;
  }
#sidebar #profile_img{
	width: 100px;
  height: 100px;
	background-color: #fff;
	border-radius: 50%;
	border: solid thin white;
	margin: 10px;
}
#contact{
      width: 100px;
      height: 120px;
      display: inline-block;
      vertical-align: top;
      margin: 10px;
    }
#contact img{
      width: 100px;
      height: 100px;
    }
#sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
 
  height: 100%;
  overflow: auto;
  text-align: center;
}

#sidebar label {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
  border-bottom: 2px solid #FF6A00;
}
#sidebar label img{
  width: 20px;
  height: 20px;
}
 
#sidebar label.active {
  background-color: #FF6A00;
  color: white;
}

#sidebar label:hover:not(.active) {
  background-color: #778593;
  color: white;
}


div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 600px) {
  #sidebar {
    width: 100%;
    height: 100px;
    position: absolute;
    top: 0px;
    z-index: 1;
    overflow-x: hidden;
    display: inline-flex;
    overflow-y: hidden;
  }
  #sidebar label {float: left; border-bottom: 0px; display: inline-block; font-size: 14px;}
  #sidebar label #profile_img {width: 50px; height: 50px;}
   #sidebar label:hover {border-bottom: 2px solid #FF6A00;}
   #sidebar label:hover:not(.active) {background-color: inherit; color: #FF6A00;}
  div.content {margin-left: 0;}
  #left_panel {top: 150px; position: relative;}
}

@media screen and (max-width: 300px) {
  #sidebar label {
    text-align: center;
    float: none;
  }
}
	
#radio_contacts:checked ~ #inner_right_panel{
	
	flex: 0;	
}
#radio_settings:checked ~ #inner_right_panel{
	
	flex: 0;	
}
#radio_librarys:checked ~ #inner_right_panel{
	
	flex: 0;	
}



#active_contact{
      height: 70px;
      margin: 10px;
      padding: 2px;
      background-color: white;
      color: #444;
      border-radius: 5px;
      width: 350px;
    }
    #active_contact img{
      width: 70px;
      height: 70px;
      float: left;
      margin: 2px;
      border-radius: 50%;
    }
      #message_left{
      margin: 10px;
      padding: 2px;
      padding-right: 10px;
      background-color: #fbffee;
      color: #444;
      float: left;
      box-shadow: 0px 0px 1px #aaa;
      border-radius: 5px;
      position: relative; 
      width: 60%;
      min-width: 200px;
    }
    #message_left #prof_img{
      width: 60px;
      height: 60px;
      float: left;
      margin: 2px;
      border-radius: 50%;
      border: solid 2px white;
    }
    #message_left div{
      width: 20px;
      height: 20px;
      position: absolute;
      left: -10px;
      top: 20px;
      border-radius: 50%;
      background-color: #34474f;
    }
    #message_right{
      margin: 10px;
      padding: 2px;
      padding-right: 10px;
      background-color: #99e69970;
      color: #444;
      float: right;
      box-shadow: 0px 0px 1px #aaa;
      border-radius: 5px;
      position: relative; 
      width: 60%;
      min-width: 200px;
    }

    #message_right #prof_img{
      width: 60px;
      height: 60px;
      float: left;
      margin: 2px;
      border-radius: 50%;
      border: solid 2px white;
    }

    #message_right div img{
      width: 18px;
      height: 18px;
      float: none;
      margin: 0px;
      border-radius: 50%;
      border: none;
      top: 35px;
      position: absolute;
      right: 30px;
    }

    #message_right #trash{
      width: 20px;
      height: 20px;
      top: 15px;
      position: absolute;
      left: -10px;
      cursor: pointer;
    }
    #message_right div{
      width: 20px;
      height: 20px;
      position: absolute;
      right: -10px;
      top: 20px;
      border-radius: 50%;
      background-color: #34474f;
    }
    #image_viewer{
      position: relative;
    }
    .image_on{
      position: absolute;
      height: 450px;
      width: 450px;
      top: 50px;
      left: 50px;
      margin: auto;
      z-index: 10;

    }
    .image_off{
      display: none;
    }
    #left_panel{
      background-color: #eee;
      color: white;
     
    }
</style>
</head>
<body>


  <!-- left container-->	
<div style="display: flex;">
  
    <div id="sidebar">
    	<label style="border-bottom: 0px;"> <img id="profile_img" src="asset/images/user_male.jpg">
        <br><div id="firstname"></div></label><br>
    	<label id="label_contacts" for="radio_contacts">Contact <img src="asset/icons/contact.png"></label>
    	<label id="label_chats" for="radio_chat">Chat<img src="asset/icons/chat.png"></label>
    	
    	<label id="label_library" for="radio_library">Library <img src="asset/icons/library.png"></label>
    	<label id="label_settings" for="radio_settings">Settings <img src="asset/icons/settings.png"></label>
    	<label id="logout" for="radio_logout">Logout <img src="asset/icons/logout.png"></label>
    </div>

    <div class="container" style="display: flex;">
     <div id="inner_right_panel" style="background-color: white; width: 250px;"></div>
     <div id="left_panel"></div>
    </div>
</div>

 <input type="radio" id="radio_chats" name="myradio" style="display: none"> 
    <input type="radio" id="radio_contacts" name="myradio" style="display: none"> 
    <input type="radio" id="radio_librarys" name="myradio" style="display: none"> 
    <input type="radio" id="radio_settings" name="myradio" style="display: none">
</body>
</html>
<script>
var CURRENT_CHAT_USER = "";
var SEEN_STATUS = false;

function _(element) {
	return document.getElementById(element);
}

var label_settings = _("label_settings");
  label_settings.addEventListener("click", get_settings);

  var label_library = _("label_library");
  label_library.addEventListener("click", get_library);

   var label_contacts = _("label_contacts");
  label_contacts.addEventListener("click", get_contacts);

var label_chats = _("label_chats");
  label_chats.addEventListener("click", get_chats);

var logout = _("logout");
	logout.addEventListener("click", logout_user);

function get_data(find, type){
	
		var xml = new XMLHttpRequest();

		xml.onload = function(){
			if (xml.status == 200 && xml.readyState == 4) {
				handle_result(xml.responseText, type);	
				//alert(xml.responseText, type);
				//console.log(xml.responseText, type);

			}
		}
		var data = {};
		data.find = find;
		data.data_type = type;
		data = JSON.stringify(data);
		xml.open("POST", "api.php", true);
		xml.send(data);
	}
 

function logout_user()
 	{
 		var answer = confirm("Are you sure you want to Log out?");
 		if (answer) {
 		get_data({}, "logout");
 		}
 	}

function handle_result(result, type)
 {
  //alert(result);
    if (result.trim() != "") {
    var inner_right_panel = _("inner_right_panel");
    var left_panel = _("left_panel");
    left_panel.style.overflow = "visible";
    var obj = JSON.parse(result);
    if (typeof(obj.logged_in) != "undefined" && !obj.logged_in) {
      window.location = "login.php";
    }else{

      switch(obj.data_type){

        case "user_info":
          var firstname = _("firstname");
          //var email = _("email");
          var profile_img = _("profile_img");

          firstname.innerHTML = obj.firstname;
          //email.innerHTML = obj.email;
          profile_img.src = obj.image;
          break;

        case "settings":
          var left_panel = _("left_panel");
           inner_right_panel.style.overflow = "hidden";
           inner_right_panel.style.display = "none";
          left_panel.innerHTML = obj.message;
          break;

         case "library":
          var left_panel = _("left_panel");
          inner_right_panel.style.overflow = "hidden";
           inner_right_panel.style.display = "none";
          left_panel.innerHTML = obj.message;
          break;

        case "contact":
          var left_panel = _("left_panel");
           var inner_right_panel = _("inner_right_panel");
           inner_right_panel.style.overflow = "hidden";
           inner_right_panel.style.display = "none";
           left_panel.style.width = "100%";
          left_panel.innerHTML = obj.message;
          
          break;

        case "chats_refresh":
          SEEN_STATUS = false;
          var messages_holder = _("messages_holder");
          messages_holder.innerHTML = obj.messages;
         // if (typeof obj.new_message != 'undefined') {
           // if (obj.new_message) {
             // received_audio.play();
            //}
          //}
          //setTimeout(function(){
            //messages_holder.scrollTo(0,messages_holder.scrollHeight);
            //var message_text = _("message_text");
            //message_text.focus();
          //},100);
          break;

        case "send_message":
        case "chats":
          SEEN_STATUS = false;
          var left_panel = _("left_panel");
          var inner_right_panel = _("inner_right_panel");
            inner_right_panel.style.display = "block";
          // left_panel.style.width = "100%";
          inner_right_panel.innerHTML = obj.user;
          left_panel.innerHTML = obj.messages;
          //to scroll down the page immediately a msg is posted
          var messages_holder = _("messages_holder");
          
          setTimeout(function(){
            messages_holder.scrollTo(0,messages_holder.scrollHeight);
            var message_text = _("message_text");
            message_text.focus();
          },100);
          break;

      case "save_settings":
        alert(obj.message);
        get_data({}, "user_info");
        get_settings(true);
        break;

        case "send_image":
        alert(obj.message);
        break;
        }

      }
    }

  }

get_data({}, "user_info");
get_data({}, "contact");

function get_settings(e)
{
  get_data({}, "settings");
}
function get_library(e)
{
  get_data({}, "library");
}
function get_contacts(e)
{
  get_data({}, "contact");
}
function get_chats(e)
{
  get_data({}, "chats");
}

function send_message(e)
{
  var message_text = _("message_text");
  if (message_text.value.trim() == "") {
    alert("Pleae type something to send");
    return;
  }
  //alert(message_text.value);
  get_data({
    message:message_text.value.trim(),
    userid:CURRENT_CHAT_USER
  }, "send_message");
}

function enter_pressed(e)
{
  if(e.keyCode == 13)
  {
    send_message(e);
  }

  SEEN_STATUS = true;

}
</script>


<script type="text/javascript">

//this performs the job for save_settings page 
  function collect_data(){
    var save_settings_button = _("save_settings_button");
    save_settings_button.disabled = true;
    save_settings_button.value = "Loading... Please wait...";
    var myform = _("myform");
    var inputs = myform.getElementsByTagName("INPUT");

    
    var data = {};
    for (var i = inputs.length - 1; i >= 0; i--) {
        var key = inputs[i].name;

      switch(key){
        case "firstname":
        data.firstname = inputs[i].value;
        break
        case "lastname":
        data.lastname = inputs[i].value;
        break;
        case "password":
        data.password = inputs[i].value;
        break;
        case "confirm_password":
        data.confirm_password = inputs[i].value;
        break;
        case "gender":
        if (inputs[i].checked) {
          data.gender = inputs[i].value;
          };
        break;
        case "email":
        data.email = inputs[i].value;
        break;
      }
    }
  
    send_data(data, "save_settings");
    
  }

  function send_data(data, type){
    var xml = new XMLHttpRequest();

    xml.onload = function(){
      if (xml.readyState == 4 && xml.status == 200) {
        handle_result(xml.responseText);
        //alert(xml.responseText);
        var save_settings_button = _("save_settings_button");
        save_settings_button.disabled = false;
        save_settings_button.value = "Save Settings";
      }
    }

    data.data_type = type;
    var data_string = JSON.stringify(data);
    xml.open("POST", "api.php", true);
    xml.send(data_string);
  }

  function upload_profile_image(files)
{
  var filename = files[0].name;
  var ext_start = filename.lastIndexOf(".");
  var ext = filename.substr(ext_start +1, 3);
  if (!(ext == "jpg" || ext == "JPG" || ext == "PNG" || ext == "png")) 
  {
    alert("This file type is not allowed!");
    return;
  }

  var change_image_button = _("change_image_button");
  change_image_button.disabled = true;
  change_image_button.value = "uploading Image...";
  //var myfiles = files[0].name;

  var myform = new FormData();
  var xml = new XMLHttpRequest();

    xml.onload = function(){
      if (xml.readyState == 4 && xml.status == 200) {
        //handle_result(xml.responseText);
        alert(xml.responseText);
        get_data({}, "user_info");
        get_settings(true);
        change_image_button.disabled = false;
        change_image_button.value = "Change Image";
      }
    }

    myform.append('file',files[0]);
    myform.append('data_type',"change_profile_user");
    xml.open("POST", "uploader.php", true);
    xml.send(myform);
}

function handle_drag_and_drop(e){
  if (e.type == 'dragover') {
    e.preventDefault();
    e.target.className = 'dragging';

  }else if(e.type == "drop"){
    e.preventDefault();
    e.target.className = '';
    upload_profile_image(e.dataTransfer.files);
  }else if(e.type == "ondragleave"){
    e.preventDefault();
  }
  else{
    e.target.className = '';  
  }
} 

setInterval(function(){

  //var radio_chat = _("radio_chat");
  //var radio_contacts = _("radio_contacts");

  if(CURRENT_CHAT_USER != "")
  {
    get_data({
      seen: SEEN_STATUS,
      userid:CURRENT_CHAT_USER
    }, "chats_refresh");
  }

 /* if(radio_contacts.checked)
  {
    get_data({}, "contacts");
  }
  */
},5000);

function set_seen(e){
  SEEN_STATUS = true;

}

function delete_message(e){
  if (confirm("Are you sure you want to delete this message?")) {

    var msgid = e.target.getAttribute('msgid');
    get_data({
      rowid:msgid
    }, "delete_message");

    get_data({
      seen: SEEN_STATUS,
      userid:CURRENT_CHAT_USER
    }, "chats_refresh");
  }

}

function delete_thread(e){
  if (confirm("Are you sure you want to delete this thread?")) {

    
    get_data({
      userid:CURRENT_CHAT_USER
    }, "delete_thread");

    get_data({
      seen: SEEN_STATUS,
      userid:CURRENT_CHAT_USER
    }, "chats_refresh");
  }

} 

function start_chat(e){
  var userid = e.target.getAttribute("userid");
  if (e.target.id == "") {
    userid = e.target.parentNode.getAttribute("userid");
  }
  CURRENT_CHAT_USER = userid;

  //var radio_chat = _("radio_chat");
  //radio_chat.checked = true;
  get_data({userid:CURRENT_CHAT_USER}, "chats");
}

function send_image(files)
{
  var filename = files[0].name;
  var ext_start = filename.lastIndexOf(".");
  var ext = filename.substr(ext_start +1, 3);
  if (!(ext == "jpg" || ext == "JPG" || ext == "PNG" || ext == "png")) 
  {
    alert("This file type is not allowed!");
    return;
  }

  /*
  var file  = files[0];
  
  for (var i = 0; i < files.length; i++) {
    files[i]
  
    */
  var myform = new FormData();
  var xml = new XMLHttpRequest();

    xml.onload = function(){
      if (xml.readyState == 4 && xml.status == 200) {
        handle_result(xml.responseText, "send_image");
        //alert(xml.responseText);
        get_data({
        seen: SEEN_STATUS,
        userid:CURRENT_CHAT_USER
        }, "chats_refresh");
      }
    }

    myform.append('file',files[0]);
    myform.append('data_type',"send_image");
    myform.append('userid',CURRENT_CHAT_USER);

    xml.open("POST", "uploader.php", true);
    xml.send(myform);
}


</script>