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
	<script type="text/javascript" src="../js/accountSettingsCalls.js"></script>
	<script type="text/javascript" src="../js/loadAdCategoryCalls.js"></script>
	<script type="text/javascript" src="../js/clientDetailCalls.js"></script>
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
	<nav aria-hidden="true" class="menu menu-left" id="menu" tabindex="-1">
		<div class="menu-scroll">
			<div class="menu-top">
				<div class="menu-top-img">
					<img alt="John Smith" src="../images/background.jpg">
				</div>
				<div class="menu-top-info">
					<a class="menu-top-user" href="javascript:void(0)"><span class="avatar pull-left"><img alt="alt text for John Smith avatar" src="../images/avatar-001.jpg"></span><p id="userName"></p></a>
				</div>
				<div class="menu-top-info-sub">
					
				</div>
			</div>
			<div class="menu-content">
				<ul class="nav">
					<li>
						<a class="waves-attach" href="welcome.php"><span class="fa fa-home fa-1x"></span>Home</a>
					</li>
					<hr>
					<li>
						<a class="waves-attach" href="nearbyOffers.php"><span class="fa fa-gift fa-1x"></span>Offers Near Me</a>
					</li>
					<hr>
					<li>
						<a class="waves-attach" href="interestedOffersCategory.php"><span class="fa fa-tags fa-1x"></span>Offers By Interest</a>
					</li>
					<hr>
					<li>
						<a class="waves-attach" href="accountSettings.php"><span class="fa fa-cog fa-1x"></span>Account Settings</a>
					</li>
					<hr>
					<li>
						<a class="waves-attach" href="logout.php"><span class="fa fa-sign-out"></span>Logout</a>
					</li>
					<hr>
				</ul>
			</div>
		</div>
	</nav>
	
	<!--navigation bar-->
	<nav style="height:50px;background-color:#00aff0; margin:0px auto; width:100%;position:fixed;top:0px;z-index:1">
		<ul style="display: inline;">
			<li style="float: left;margin-top:15px;margin-left:15px;background-color: transparent;list-style-type: none;display: inline;">
				<a data-toggle="menu" href="#menu" style="outline: none;">
					<i class="fa fa-bars fa-lg"></i>
				</a>
			</li>
		</ul>
		<div class="header-affix pull-left" data-offset-top="108" data-spy="affix">
			<span class="header-logo margin-left-no" style="color:white;">Account Settings</span>
		</div>
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    
	  </div><!-- /.container-fluid -->
	</nav>
	<nav style="height:100px;background-color:#00aff0; margin:0px auto; width:100%;position:absolute;top:50px;">
		<div class="container">
			<h2 class="heading" align="center" style="color:#FFFFFF;text-transform:uppercase;">Account Settings</h2>
		</div>
	</nav>
	<!--end of navigation bar-->
	
	<div class="container" style="margin-top:160px;">
			<div class="row">
				<div class="col-lg-8 col-md-10">
					<section class="content-inner">
						<h3 align="center" color="black">Update Account Details</h3>
						<p align="center" id="clientDetails"></p>
						<div class="panel panel-default" style="text-align:center;">
  							<div class="panel-body" >
								<div class="input-group">
								  <span class="input-group-addon"><i class='icon_profile'></i></span>
								  <input type="text" class="form-control" placeholder="First Name" aria-describedby="basic-addon1" id="firstName" style="z-index: 0;">
								</div>
								<br/>
								<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1"><i class='icon_profile'></i></span>
								  <input type="text" class="form-control" placeholder="Last Name" aria-describedby="basic-addon1" id="lastName" style="z-index: 0;">
								</div>
								<br/>
								<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1"><i class='icon_mobile'></i></i></span>
								  <input type="text" class="form-control" placeholder="Phone Number" aria-describedby="basic-addon1" id="phoneNumber" style="z-index: 0;">
								</div>
								<br/>
								<div class="input-group">
								  <span class="input-group-addon" id="basic-addon1"><i class='icon_mail'></i></i></span>
								  <input type="value" class="form-control" placeholder="Email Id" aria-describedby="basic-addon1" id="emailId" disabled="true" style="background-color: transparent;z-index: 0;">
								</div>
								<br/>
								<div class="panel panel-default">
								  <div class="panel-heading" style="text-align:left;">
								    <h3 class="panel-title">Interested Domains</h3>
								  </div>
								  <div class="panel-body checkbox" style="text-align:left;margin-left:20px;" id="categories">
								    <script>loadCategories()</script>
								    <br/>
		
								  </div>
							    </div>
							    <br/>
							    <div id='setPropertiesStatus'></div>
							    <script>getDetails()</script>
								<button type="button" style="border-radius: 20px; border:1px solid grey; background-color: #00aff0;outline: none;" onclick='doUpdateAccount()'>Update</button>
								<a href="changePassword.php" style="outline: none;">Change Password?</a>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	<script>
		document.getElementById('userName').innerHTML = localStorage.getItem("user");
	</script>
	<!-- js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/base.min.js"></script>
	<!-- js for this project -->
	<script src="../js/project.min.js"></script>
</body>
</html>