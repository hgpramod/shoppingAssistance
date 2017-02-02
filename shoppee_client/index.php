<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Assistance</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<link href="css/style.css" rel="stylesheet">
		<script src="javaScript/registration.js"></script>
	</head>
	<body>
		<div id="mainform">
			<div class="innerdiv">
				<form id="form" name="form">
					<h3>Fill Your Information</h3>
					<div>
						<label>Name :</label>
						<input id="name" type="text"/>
						<label>Email :</label>
						<input id="email" type="text"/>
						<label>Password :</label>
						<input id="password" type="password"/>
						<label>Contact No :</label>
						<input id="contact" type="text"/>
						<input id="submit" onclick="myFunction()" type="button" value="Submit"/>
					</div>
				</form>
				<div id="clear"></div>
			</div>
			<div id="clear"></div>
		</div>
	</body>
</html>