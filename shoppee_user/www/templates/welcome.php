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
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDj1D0RGK5Qs4WlVksRg_eCC0DMNLS-how"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/baseUrl.js"></script>
	<script src="../js/locationCalls.js"></script>
	<script src="../js/welcomeCalls.js"></script>
	<script src="../js/recentOfferCalls.js"></script>
	<script type="text/javascript" src="../js/notificationCalls.js"></script>
</head>
<body class="avoid-fout page-blue" style="background-color:#EEEEEE;" onload='loadNotifications()'>
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
	<nav style="height:50px;background-color:#880E4F; margin:0px auto; width:100%;position:fixed;top:0px;z-index:1">
		<ul style="display: inline;background-color:#880E4F;">
			<li style="float: left;margin-top:15px;margin-left:15px;background-color: transparent;list-style-type: none;display: inline;">
				<a data-toggle="menu" href="#menu" style="outline: none;">
					<i class="fa fa-bars fa-lg" style="color:grey"></i>
				</a> 
			</li>
			<li id='alert_notificatoin_bar' class='dropdown pull-right' style="list-style-type: none;float: right;margin-top:10px;margin-right:15px;display: inline;">
                <a data-toggle='dropdown' class='dropdown-toggle' href='#' style="outline: none;">
                    <i class="fa fa-globe fa-2x" style="color:grey"></i>
                </a>
                <ul class='dropdown-menu extended notification'>
                    <li>
                        <div id='categoryNotification'></div>
                    </li>
                    <li>
                        <div id='offerNotification'></div>
                    </li>
                    <hr>
                    <li>
                        <a id="notificationStatus">See all notifications</a>
                    </li>
                </ul>
 			</li>
		</ul>
    	<div class="header-affix pull-left" data-offset-top="108" data-spy="affix">
			<span class="header-logo margin-left-no" style="color:white;">Welcome</span>
		</div>
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    
	  </div><!-- /.container-fluid -->
	</nav>
	<nav style="height:100px;background-color:#880E4F; margin:0px auto; width:100%;position:absolute;top:50px;">
		<div class="container">
			<h2 class="heading" align="center" style="color:#FFFFFF;text-transform:uppercase;">Welcome</h2>
		</div>
	</nav>
	<!--end of navigation bar-->
	<div class="container" style="margin-top:160px;">
		<div class="row">
			<div class="column">
				<br/>
				<div class="panel-blue">
				  <div class="panel-heading" style="background-color:#880E4F;">
				    <h3 class="panel-title" style="text-align: center; color: white; font-weight: bold;" id="name">Username</h3>
				  </div>
				  <div class="panel-body">
				  	<p id="clientDetails"></p>
				    <p id="firstName" ></p>
				    <p id="phoneNumber"></p>
				    <p id="emailId"></p>
				    <p id="currentLocation"></p>
				    <script>getLocation();</script>
				    <script>clientDetails();</script>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-top:-10px;">
		<div class="row">
			<div class="column">
				<br/>
				<div class="panel-blue">
					<div class="panel-heading" style="background-color:#880E4F;">
				    	<h3 class="panel-title" style="text-align: center; color: white; font-weight: bold;">Recently Viewed Offers</h3>
					</div>
				  	<div class="panel-body">
					  	<div id="offerStatus" align="center"></div>
					  	<div id="UIcontainer"></div>
					  	<script>
					  		loadRecentOffers();
					  	</script>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/base.min.js"></script>
	<!-- js for this project -->
	<script src="../js/project.min.js"></script>
</body>
</html>