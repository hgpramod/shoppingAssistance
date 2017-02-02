<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, width=device-width" name="viewport">
	<title>Offers-MeDHA Client</title>
	<!-- css -->
	<link href="../css/base.min.css" rel="stylesheet">

	<!-- css for this project -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link  rel="stylesheet" href="../css/project.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel='stylesheet' href='../css/elegant-icons-style.css'/>
    <link rel='stylesheet' href='../css/font-awesome.css'/>
    <link rel='stylesheet' href='../css/customcss/registration.css'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"/>
    <script src='//maps.googleapis.com/maps/api/js?sensor=false'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/baseUrl.js"></script>
	<script type="text/javascript" src="../js/changePasswordCalls.js"></script>
</head>

<body class="avoid-fout page-blue" style="background-color:#EEEEEE;">
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
	<!--navigation bar-->
	<nav style="height:50px;background-color:#00aff0; margin:0px auto; width:100%;position:fixed;top:0px;z-index: 500">
		<ul class="nav nav-list pull-left" style="margin-top:0px;">
			<li>
				<button style="align:left;width:80%;text-align:left;margin-left:5px;margin-top:12px;background-color:transparent;border:none;color:#FFFFFF;font-size: 150%; outline: none;" onclick="goBack()"><i class="fa fa-chevron-left"></i></button>
			</li>
		</ul>
		<div class="header-affix pull-left" data-offset-top="108" data-spy="affix">
			<span class="header-logo margin-left-no" style="color:white;">Account Settings</span>
		</div>
	</nav>
	<nav style="height:100px;background-color:#00aff0; margin:0px auto; width:100%;position:absolute;top:50px; z-index: 0">
		<div class="container">
			<h2 class="heading" align="center" style="color:#FFFFFF;text-transform:uppercase;">Account Settings</h2>
		</div>
	</nav>
	<!--end of navigation bar-->
	<div class="container" style="margin-top:160px;";>
		<div class="row">
			<div class="col-lg-8 col-md-10">
				<section class="content-inner">
					<h3 align="center">Update Password</h3>
					<p id="clientDetails"></p>
					<div class="panel panel-default" style="text-align:center;">
						<div class="panel-body">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class='icon_key_alt'></i></i></span>
								<input type="password" class="form-control" placeholder="Current Password" aria-describedby="basic-addon1" id="currentPassword">
							</div>
							<br/>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class='icon_key_alt'></i></i></span>
								<input type="password" class="form-control" placeholder="New Password" aria-describedby="basic-addon1" id="password">
							</div>
							<br/>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class='icon_key_alt'></i></i></span>
								<input type="password" class="form-control" placeholder="Confirm New Password" aria-describedby="basic-addon1" id="confirmPassword">
							</div>
							<br/>
						    <div id='setPasswordStatus'></div>
							<button type="button" style="border-radius: 20px; border:1px solid grey; background-color: #00aff0;outline: none;" onclick='doUpdatePassword()'>Update Password</button>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<script>
		function goBack() 
		{
		    window.history.back();
		}
	</script>
	<!-- js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/base.min.js"></script>
	<!-- js for this project -->
	<script src="../js/project.min.js"></script>
</body>
</html>