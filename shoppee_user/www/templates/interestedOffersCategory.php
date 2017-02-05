<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="initial-scale=1.0, width=device-width" name="viewport">
	<title>Shopping Assistance</title>
	<!-- css -->
	<link href="../css/base.min.css" rel="stylesheet">

	<!-- css for this project -->
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
	<script type="text/javascript" src="../js/refreshLocationCalls.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
    $(document).ready(function() {
        $('body').hide().fadeIn('fast');
    });
</script>
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
	<nav style="height:50px;background-color:#00aff0; margin:0px auto; width:100%;position:fixed;top:0px;">
	<ul style="display: inline;">
			<li style="float: left;margin-top:15px;margin-left:15px;background-color: transparent;list-style-type: none;display: inline;">
				<a data-toggle="menu" href="#menu" style="outline: none;">
					<i class="fa fa-bars fa-lg"></i>
				</a>
			</li>
		</ul>
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	    	<div class="container" align="center">
	    		<img src="../images/offerMonklogo.png" height="40px" style="margin-top: -15px;">
			</div>
	    </div>
	  </div><!-- /.container-fluid -->
	</nav>
	<div class="content">
		<div  style="text-align:center;">
			<div class="panel-body" align="center">
				<div>
					<br>
					<h2>Please Select Categories</h2>
				</div>
				<div class="panel panel-default" style="width: 262px;" align="center">
		  			<div class="panel-body" align="center">
				  		<div style="border: 1px solid #BDBDBD; width: 232px;" >
					  		<div id="Electronics" class="panel-body" style="background-image:url('../images/categoryImages/Electronics');height:150px;width:auto;background-repeat:no-repeat;top:-20px;">
							</div>
					  	</div>
					  	<hr>
					  	<div style="border: 1px solid #BDBDBD; width: 232px;" >
					  		<div id="Automobiles" class="panel-body" style="background-image:url('../images/categoryImages/Automobiles');height:150px;width:auto;background-repeat:no-repeat;top:-20px;">
							</div>
					  	</div>
					  	<hr>
						<div style="border: 1px solid #BDBDBD; width: 232px;" >
					  		<div id="BooksAndMedia" class="panel-body" style="background-image:url('../images/categoryImages/BooksAndMedia');height:150px;width:auto;background-repeat:no-repeat;top:-20px;">
							</div>
					  	</div>
					  	<hr>
						<div style="border: 1px solid #BDBDBD; width: 232px;" >
					  		<div id="Clothings" class="panel-body" style="background-image:url('../images/categoryImages/Clothings');height:150px;width:auto;background-repeat:no-repeat;top:-20px;">
							</div>
					  	</div>
					  	<hr>
					  	<div style="border: 1px solid #BDBDBD; width: 232px;" >
					  		<div id="HomeAppliances" class="panel-body" style="background-image:url('../images/categoryImages/Home Appliances');height:150px;width:auto;background-repeat:no-repeat;top:-20px;">
							</div>
					  	</div>
					  	<br>
						<button type="button" style="background-color:#00aff0;color:white;border-radius: 20px;border: 1px solid grey;font-weight: bold;outline: none;" onclick='interestedOffers()'>Search Offers</button>
			  		</div>
				</div>
			</div>
		</div>
		
	</div>
	<p id = "offerStatus"></p>
	<div id="UIcontainer"></div>
	<!-- js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../js/base.min.js"></script>
	<!-- js for this project -->
	<script src="../js/project.min.js"></script>
	<script>
		document.getElementById('userName').innerHTML = localStorage.getItem("user");
		var categoryArray = new Array();
		var flagElectronicsClick = 0;
		$('#Electronics').click(function()
		{
			var categoryId= $("#Electronics").attr('id');
	        var clickImage = document.createElement("img");
          	clickImage.id="ElectronicTickImage";
          	if(flagElectronicsClick == 0)
          	{
	          	clickImage.src = "../images/tick.png";
	          	clickImage.width = "50";
	          	clickImage.height = "50";
	          	$("#"+categoryId).fadeTo("fast",0.5);
	          	flagElectronicsClick =1;
	          	$("#"+categoryId).append(clickImage);
	          	categoryArray.push(categoryId);
            }
            else
            {
	          	$("#"+categoryId).fadeTo("fast",1.0);
	          	$("#ElectronicTickImage").remove();
	          	flagElectronicsClick =0;
	          	var index = categoryArray.indexOf(categoryId);
	          	delete categoryArray[index];
            }
        });
        var flagAutomobilesClick = 0;
        $('#Automobiles').click(function()
		{
			var categoryId= $("#Automobiles").attr('id');
	        var clickImage = document.createElement("img");
          	clickImage.id="AutomobileTick";
          	if(flagAutomobilesClick == 0)
          	{
	          	clickImage.src = "../images/tick.png";
	          	clickImage.width = "50";
	          	clickImage.height = "50";
	          	$("#"+categoryId).fadeTo("fast",0.5);
	          	flagAutomobilesClick =1;
	          	$("#"+categoryId).append(clickImage);
	          	categoryArray.push(categoryId);
            }
            else
            {
	          	$("#"+categoryId).fadeTo("fast",1.0);
	          	$("#AutomobileTick").remove();
	          	flagAutomobilesClick =0;
	          	var index = categoryArray.indexOf(categoryId);
	          	delete categoryArray[index];
            }
        });
        var flagClothingsClick = 0;
        $('#Clothings').click(function()
		{
			var categoryId= $("#Clothings").attr('id');
	        var clickImage = document.createElement("img");
          	clickImage.id="ClothingsTick";
          	if(flagClothingsClick == 0)
          	{
	          	clickImage.src = "../images/tick.png";
	          	clickImage.width = "50";
	          	clickImage.height = "50";
	          	$("#"+categoryId).fadeTo("fast",0.5);
	          	flagClothingsClick =1;
	          	$("#"+categoryId).append(clickImage);
	          	categoryArray.push(categoryId);
            }
            else
            {
	          	$("#"+categoryId).fadeTo("fast",1.0);
	          	$("#ClothingsTick").remove();
	          	flagClothingsClick =0;
	          	var index = categoryArray.indexOf(categoryId);
	          	delete categoryArray[index];
            }
        });
        var flagBooksAndMediaClick = 0;
        $('#BooksAndMedia').click(function()
		{
			var categoryId= $("#BooksAndMedia").attr('id');
	        var clickImage = document.createElement("img");
          	clickImage.id="BooksAndMediaTick";
          	if(flagBooksAndMediaClick == 0)
          	{
	          	clickImage.src = "../images/tick.png";
	          	clickImage.width = "50";
	          	clickImage.height = "50";
	          	$("#"+categoryId).fadeTo("fast",0.5);
	          	flagBooksAndMediaClick =1;
	          	$("#"+categoryId).append(clickImage);
	          	categoryArray.push(categoryId);
            }
            else
            {
	          	$("#"+categoryId).fadeTo("fast",1.0);
	          	$("#BooksAndMediaTick").remove();
	          	flagBooksAndMediaClick =0;
	          	var index = categoryArray.indexOf(categoryId);
	          	delete categoryArray[index];
            }
        });
        var flagHomeAppliancesClick = 0;
        $('#HomeAppliances').click(function()
		{
			var categoryId= $("#HomeAppliances").attr('id');
	        var clickImage = document.createElement("img");
          	clickImage.id="HomeAppliancesTick";
          	if(flagHomeAppliancesClick == 0)
          	{
	          	clickImage.src = "../images/tick.png";
	          	clickImage.width = "50";
	          	clickImage.height = "50";
	          	$("#"+categoryId).fadeTo("fast",0.5);
	          	flagHomeAppliancesClick = 1;
	          	$("#"+categoryId).append(clickImage);
	          	categoryArray.push(categoryId);
            }
            else
            {
	          	$("#"+categoryId).fadeTo("fast",1.0);
	          	$("#HomeAppliancesTick").remove();
	          	flagHomeAppliancesClick = 0;
	          	var index = categoryArray.indexOf(categoryId);
	          	delete categoryArray[index];
            }
        });
	</script>
</body>
</html>