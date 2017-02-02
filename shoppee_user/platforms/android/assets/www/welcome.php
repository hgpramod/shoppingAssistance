<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, width=device-width" name="viewport">
	<title>Welcome-MeDHA Client</title>
	<!-- css -->
	<link href="css/base.min.css" rel="stylesheet">

	<!-- css for this project -->
	<link href="css/project.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel='stylesheet' href='css/elegant-icons-style.css'/>
    <link rel='stylesheet' href='css/font-awesome.css'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
</head>
<body class="avoid-fout page-blue">
	<div class="avoid-fout-indicator avoid-fout-indicator-fixed">
		<div class="progress-circular progress-circular-alt progress-circular-center progress-circular-blue">
			<div class="progress-circular-wrapper">
				<div class="progress-circular-inner">
					<div class="progress-circular-left">
						<div class="progress-circular-spinner"></div>
					</div>
					<div class="progress-circular-gap"></div>
					<div class="progress-circular-right">
						<div class="progress-circular-spinner"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<header class="header header-transparent header-waterfall">
		<ul class="nav nav-list pull-left">
			<li>
				<a data-toggle="menu" href="#menu">
					<span class="icon icon-lg">menu</span>
				</a>
			</li>
		</ul>
		<div class="header-affix-hide pull-left" data-offset-top="108" data-spy="affix">
			<a class="header-logo margin-left-no" href="welcome.php"></a>
		</div>
		<div class="header-affix pull-left" data-offset-top="108" data-spy="affix">
			<span class="header-logo margin-left-no">Account Settings</span>
		</div>
	</header>
	<nav aria-hidden="true" class="menu" id="menu" tabindex="-1">
		<div class="menu-scroll"   style="background-color:#EC407A;">
			<div class="menu-content">
				<a class="menu-logo" href="welcome.php">Home</a>
				<a class="menu-logo" href="accountSettings.php">Account Settings</a>
				<a class="menu-logo" href="logout.php">Logout</a>
			</div>
		</div>
	</nav>
	<div class="content">
		<div class="content-heading">
			<div class="container">
				<h1 class="heading">Welcome</h1>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-10">
					<br/>
					<div class="panel panel-primary">
					  <div class="panel-heading">
					    <h3 class="panel-title">Your Details</h3>
					  </div>
					  <div class="panel-body">
					    <p> Username</p>
					    <p>Ph No:
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/base.min.js"></script>

	<!-- js for this project -->
	<script src="js/project.min.js"></script>
</body>
</html>