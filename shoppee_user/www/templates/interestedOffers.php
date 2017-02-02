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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"/>
	<script type="text/javascript" src="../js/baseUrl.js"></script>
	<script type="text/javascript" src="../js/interestedOffersCategoryCalls.js"></script>
	<script type="text/javascript" src="../js/loadAdCategoryCalls.js"></script>
    <script src='//maps.googleapis.com/maps/api/js?sensor=false'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/baseUrl.js"></script>
	<script src="../js/fetchOffersCalls.js"></script>
	<script type="text/javascript" src="../js/refreshLocationCalls.js"></script>
</head>
<body class="avoid-fout page-blue" style="background-color:#EEEEEE;" onload="fetchOffers()">
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
	<nav style="height:50px;background-color:#00aff0; margin:0px auto; width:100%;position:fixed;top:0px;">
		<ul class="nav nav-list pull-left" style="margin-top:0px;">
			<li>
				<button style="align:left;width:80%;text-align:left;margin-left:5px;margin-top:12px;background-color:transparent;border:none;color:#FFFFFF;font-size: 150%; outline: none;" onclick="goBack()"><i class="fa fa-chevron-left"></i></button>
			</li>
		</ul>
	    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		   	<div class="container" align="center">
	    		<img src="../images/offerMonklogo.png" height="40px" style="margin-top: 0px;">
			</div>
		</div>
	</nav>
	<!--end of navigation bar-->
	<div align="center" style="margin-top: 50px">
		<div id="errorImage"></div>
		<p id="offerStatus"></p>
	</div>
	<div class="container">
			<br>
			<br>
			<div class="row" id="UIcontainer"></div>
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