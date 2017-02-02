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
	                <p class='login-img'>LOGIN</i></p>
	                <div class='input-group'>
	                  <span class='input-group-addon'><i class='icon_profile'></i></span>
	                  <input type='text' class='form-control' id='emailId' name='emailId' placeholder='Email Id' autofocus>
	                </div>
	                <div class='input-group'>
	                    <span class='input-group-addon'><i class='icon_key_alt'></i></span>
	                    <input type='password' class='form-control' id='password' name='password' placeholder='Password'>
	                </div>
	                <label class='checkbox'  style='color:white;'>
	                    <span class='pull-right' > <a href='forgotPassword.php'> Forgot Password?</a></span>
	                </label>
	                 <div id='loginStatus' style='color:white;text-align:center;'></div>
	                <button class='btn btn-primary btn-lg btn-block' type='button' onclick='doLogin()'>Login</button>
	                <button class='btn btn-info btn-lg btn-block' type='button' onclick='openRegistrationPage()'>Signup</button>
	            </div>
	          </form>
	        </div>
        </div>
	</body>
</html>