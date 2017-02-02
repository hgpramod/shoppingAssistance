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
	<link rel="stylesheet" href="../css/project.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel='stylesheet' href='../css/elegant-icons-style.css'/>
    <link rel='stylesheet' href='../css/font-awesome.css'/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"/>
	<script type="text/javascript" src="../js/index.js"></script>
	<script type="text/javascript" src="../js/baseUrl.js"></script>
	<script type="text/javascript" src="../js/interestedOffersCategoryCalls.js"></script>
	<script type="text/javascript" src="../js/loadAdCategoryCalls.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script type="text/javascript" src="../js/adDetailCalls.js"></script>
	<script type="text/javascript" src="../js/adDetailLocationCalls.js"></script>
	<script type="text/javascript" src="../js/buyOfferCalls.js"></script>
	<script type="text/javascript" src="../js/refreshLocationCalls.js"></script>
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
	<nav style="height:50px;background-color:#00aff0; margin:0px auto; width:100%;
    position:fixed;
    top:0px;">
	    <ul class="nav nav-list pull-left" style="margin-top:0px;">
			<li>
				<button style="align:left;width:80%;text-align:left;margin-left:5px;margin-top:12px;background-color:transparent;border:none;color:#FFFFFF;font-size: 150%;outline: none;" onclick="goBack()"><i class="fa fa-chevron-left"></i></button>
			</li>
		</ul>
		<ul class="nav nav-list pull-right" style="margin-top:0px;">
			<li>
				<button style="align:left;width:80%;margin-right:10px;margin-top:12px;background-color:transparent;border:none;color:#FFFFFF;font-size: 150%;outline: none;" onclick=""><i class="fa fa-share-alt"></i></button>
			</li>
		</ul>
		<div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		    	<div class="container">
					<h2 class="heading" id="offerInfo" align="center" style="color:#FFFFFF;text-transform:uppercase;transform:translateY(-50%);font-family: 'Montserrat';font-size:22px;top:50%;">Offer Info</h2>
		    	</div>
		    </div>
		</div><!-- /.container-fluid -->
	</nav>
	<!--end of navigation bar-->
	<div class="panel panel-default" style="margin-top:50px;">
	  	<div>
		    <div id="offerImage"></div>
		    <div style="margin-left: 5px;">
		    <table style="border: none;">
		    	<tr>
		    		<td><h5 id="offerDescription"></h5></td>
		    	</tr>
		    	<tr>
		    		<td><i class="fa fa-location-arrow" id="distanceIcon" style="color:#757575;">&nbsp;</i><label id="distanceInfo" style="color:#757575;font-size:12px;"></label></td>
		    	</tr>
		    	<tr>
			    	<td><i class="fa fa-tags" id="categoryIcon"></i>&nbsp;<label id="offerCategory"></label></td>
		   		</tr>
		    	<tr>
			    	<td><span style="color:#757575;" >
		    			<i class="fa fa-inr" id="actualPriceIcon"></i>
		    			<label id="actualPrice"></label>
		    			</span>
		    			&nbsp;
		    			<span style="color:#00aff0;font-size:18px;">
		    			<i class="fa fa-inr" id="discountedPriceIcon"></i>
		    			<label id="discountedPrice" ></label>
		 				</span>
		 				&nbsp;<span style="color:#757575;" id="discount">
		    			Discount: <label id="discountRate"></label>
		    			</span>
		    		</td>
		    	</tr>
				<tr>
					<td><span style="color: red;" id="coupons">Coupons Available: <label id="availableCoupons" style="font-size:12px;"></label></span></td>
				</tr>
		    </table>
		    </div>
	  	</div>
	</div>
	<!--highlights section-->
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h5>Highlights</h5>
	  	<hr/>
	  	<ul id="highlightsList" style="color:#757575;">
	  	</ul>
	  </div>
  	</div>
  	<script>getOfferDetails();</script>
	<!--end of highlights section-->
	<!--map/location section-->
	<div id="displayMap" style="height:150px;"></div>
	<div class="panel panel-default">
	  <div class="panel-body" style="color:#757575">
	  	<div>
	  		<i class="fa fa-share fa-1x"></i>
	  		<label id="offerAddress"></label>
	  		<script>getOfferLocationDetails();</script>
	  	</div>
	  </div>
  	</div>
  	<!--end of map/location section-->
  	<!--about the offer section-->
  	<div class="panel panel-default">
	  <div class="panel-body">
	  	<h5>About this offer</h5>
	  	<hr/>
	  	<div id="aboutOffer" style="color:#757575;">
	  	</div>
	  </div>
  	</div>
  	<!--end of about section-->
  	<nav style="height:50px;background-color:#424242; margin:0px auto; width:100%;position:fixed;height:50px;bottom:0px;">
	    <div class="container-fluid">
		    <div class="navbar-header">
		    	<div class="container" style="text-align:center;">
		    		<button  type='button' onclick='buyOffer()' style="width:100%;text-align:center;margin-top:5px;background-color:#0095cd !important;border:none;color:white;height:40px;"><b>BUY</b></button>
		    	</div>
		    </div>
	    </div>
	</nav>
	<!-- js -->
	<script>
		function goBack() 
		{
		    window.history.back();
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/base.min.js"></script>
	<!-- js for this project -->
	<script src="../js/project.min.js"></script>
</body>
</html>