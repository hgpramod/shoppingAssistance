<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="styles.css"/>
		<link href='css/elegant-icons-style.css' rel='stylesheet' />
        <link href='css/font-awesome.css' rel='stylesheet' />
        <link rel="stylesheet" href="css/style.css"/>
        <link href='css/style-responsive.css' rel='stylesheet' />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="js/buttonFunctions.js"></script>
	</head>
	<body>
		<div class="bodyContainer">
			<div class='container'>
	          <form class='login-form'>        
	            <div class='login-wrap'>
	                <p class='login-img'>REGISTER</i></p>
	                <div class='input-group'>
	                  <span class='input-group-addon'><i class='icon_profile'></i></span>
	                  <input type='text' class='form-control' id='firstName' name='firstName' placeholder='First Name' autofocus>
	                </div>
	                <div class='input-group'>
	                  <span class='input-group-addon'><i class='icon_profile'></i></span>
	                  <input type='text' class='form-control' id='lastName' name='lastName' placeholder='Last Name' autofocus>
	                </div>
	                <div class='input-group'>
	                    <span class='input-group-addon'><i class='icon_mobile'></i></span>
	                    <input type='text' class='form-control' id='phoneNumber' name='phoneNumber' placeholder='Phone Number'>
	                </div>
	                <div class='input-group'>
	                    <span class='input-group-addon'><i class='icon_mail'></i></span>
	                    <input type='text' class='form-control' id='emailId' name='emailId' placeholder='Email Id'>
	                </div>
	                <button class='btn btn-primary btn-lg btn-block' type='button' onclick='doRegistration()'>Register</button> 
	            </div>
	          </form>
	        </div>
        </div>
	</body>
</html>