<!DOCTYPE html> 
<html lang="en">
<head> 
<title>Welcome-MeDHA Client</title> 
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!-- Style Sheets --> 
	<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/trunk.css" />
	<link rel="stylesheet" type="text/css" media="all" href="styles.css" />
	<link href='css/elegant-icons-style.css' rel='stylesheet' />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href='css/font-awesome.css' rel='stylesheet' />
	<link rel="stylesheet" href="css/style.css"/>
	<link href='css/style-responsive.css' rel='stylesheet' />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="styles.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<!-- Scripts --> 
	<script type="text/javascript">
		if (typeof jQuery == 'undefined')
			document.write(unescape("%3Cscript src='js/jquery-1.9.js'" + 
																"type='text/javascript'%3E%3C/script%3E"))
	</script>
	<script type="text/javascript" language="javascript" src="js/trunk.js"></script>
	<script type="text/javascript" src="js/getLocationCalls.js"></script>
	<script type="text/javascript" src="js/baseUrl.js"></script>
</head> 
<body> 
	<div class="container">

		<header class="slide">     <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
			<ul id="navToggle" class="burger slide">    <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
				<li></li><li></li><li></li>
			</ul>
			<h1>Welcome</h1>
		</header>
		<nav class="slide" style="background-color:#EC407A;">
			<ul>
				<li><a href="trunk.html" style="color:white !important;">HOME</a></li>
				<li><a href="linkOne.html" style="color:white !important;">LINK TWO</a></li>
				<li><a href="#" style="color:white !important;">LINK THREE</a></li>
				<li><a href="#" style="color:white !important;">LINK FOUR</a></li>
				<li><a href="#" style="color:white !important;">LINK FIVE</a></li>
				<li><a href="accountSettings.php"  class="active"  style="color:white !important;">Account Settings</a></li>
				<li><a href="#" style="color:white !important;">Logout</a></li>
			</ul>
		</nav>
		<div class="content slide">     <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
			<ul class="responsive">
				<li class="header-section">
					<div class="panel panel-primary">
					  <div class="panel-heading">
					    <h3>Account Info</h3>
					  </div>
					  <div class="panel-body">
					  <br/>
					   <input type="text" style="margin-left:15px;border-radius:2px;width:80%;"/>
					    <br/>
					    <p id="emailId" style="margin-left:15px;">Email Id:abc@example.com</p>
					    <br/>
					    <p id="currentLocation" style="margin-left:15px;">Current Location:</p>
					    <script>
					    	//get the current location of user
					    	getCurrentLocation();
					    </script>
					  </div>
					</div>
				</li>
				<li class="body-section">
					<p class="placefiller">BODY</p>
				</li>
			</ul>
		</div>
	</div>
</body> 
</html>