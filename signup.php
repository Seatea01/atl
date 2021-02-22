<!DOCTYPE html>
<html>
<head>
	<title>ATL | signup</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      src: url(asset/fonts/Nexa bold.otf);
    }
  body{
    font-family: NexaLight;
    font-size: 18px;
  }
input[type=text],[type=email],[type=password],[type=phone]{
	border-top: none;
	border-left: none;
	border-right: none;
	border-radius: 0px;
}
#error{
	text-align: center; 
	padding: 0.5em; 
	background-color: #ecaf91; 
	color: white; 
	display: none;
	border-left: 3px solid red;
	border-radius: 2px;
}
</style>
</head>
<body>

	<div class="container" style="max-width: 500px; margin: auto; box-sizing: 0px;">
		<div style="font-family: NexaBold; font-size: 20px; margin-top: 30px;">Create Account</div><br>
		<div id="error" style="display: none;"></div>
		<form id="myform">
		<input type="text" id="firstname" name="firstname" placeholder="First Name" class="form-control form-control-sm"><br>
		<input type="text" name="lastname" placeholder="Last Name" class="form-control form-control-sm"><br>
		<input type="email" name="email" placeholder="Email" class="form-control form-control-sm"><br>
		<div style="padding: 5px;">
				Gender:<br>
				<input type="radio" name="gender_male" id="gender" value="Male">Male<br>
				<input type="radio" name="gender_female" id="gender" value="Female">Female
			</div><br>
		<input type="phone" name="phone" placeholder="Phone" class="form-control form-control-sm"><br>
		<input type="password" name="password" placeholder="Password" class="form-control form-control-sm"><br>
		<input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control form-control-sm"><br>
		<input type="button" id="signup_button" class="btn btn-sm" style="background-color: #FF6A00; color: #ffffff;" value="Create Account" style=""><br>


		<div style="text-align: center;">By clicking Create Account you agree to Alpha Training Lab <a href="#">Terms of use</a>  and acknowledge you have read the <a href="#">Privacy Policy</a>.</div>
	</form>
	</div>
</body>
</html>

<script>

function _(element) {
	return document.getElementById(element);
}
	var signup_button = _("signup_button");
signup_button.addEventListener("click", collect_data);

	

function collect_data(){

	signup_button.disabled = true;
	signup_button.value = "Loading... Please wait...";
	var myform = _("myform");
	var inputs = myform.getElementsByTagName("INPUT");

	
	var data = {};
	for (var i = inputs.length - 1; i >= 0; i--) {
			var key = inputs[i].name;

		switch(key){
			case "firstname":
			data.firstname = inputs[i].value;
			break;
			case "lastname":
			data.lastname = inputs[i].value;
			break;
			case "password":
			data.password = inputs[i].value;
			break;
			case "phone":
			data.phone = inputs[i].value;
			break;
			case "confirm_password":
			data.confirm_password = inputs[i].value;
			break;
			case "gender_male":
			case "gender_female":
			if (inputs[i].checked) {
				data.gender = inputs[i].value;
				};
			break;
			case "email":
			data.email = inputs[i].value;
			break;
		}
	}
//alert(JSON.stringify(data));
	send_data(data, "signup");
	
}

function send_data(data, type){
	var xml = new XMLHttpRequest();

	xml.onload = function(){
		if (xml.readyState == 4 && xml.status == 200) {
			handle_result(xml.responseText);
			//alert(xml.responseText);
			signup_button.disabled = false;
			signup_button.value = "Signup";
		}
	}

	data.data_type = type;
	var data_string = JSON.stringify(data);
	xml.open("POST", "api.php", true);
	xml.send(data_string);
}

function handle_result(result){

	var data = JSON.parse(result);
	if (data.data_type == "info") {
		window.location = "login.php";
		
	}else{
		var error = _("error");
		error.innerHTML = data.message;
		error.style.display = "block";
	}
}
	
</script>
