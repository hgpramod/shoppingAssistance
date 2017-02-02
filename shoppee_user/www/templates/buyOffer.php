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
	<script type="text/javascript" src="../js/buyDetailsCalls.js"></script>
	<script type="text/javascript" src="../js/paymentCalls.js"></script>
	<script type="text/javascript" src="../js/refreshLocationCalls.js"></script>
</head>
<body class="avoid-fout page-blue" style="background-color:#EEEEEE;" onload="detailedOffer();">
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
				<button style="align:left;width:80%;text-align:left;margin-left:10px;margin-top:12px;background-color:transparent;border:none;color:#FFFFFF;font-size: 150%; outline: none;" onclick="goBack()"><i class="fa fa-chevron-left"></i></button>
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
					<h2 class="heading" id="offerInfo" align="center" style="color:#FFFFFF;text-transform:uppercase;transform:translateY(-50%);font-family: 'Montserrat';font-size:18px;">Buy Offer</h2>
		    	</div>
		    </div>
	  </div><!-- /.container-fluid -->
	</nav>
	<!--end of navigation bar-->
	<div class="panel panel-default" style="margin-top:50px;">
	  <div class="panel-body" >
	    <div id="offerStatus"></div>
	    <div id="offerImage"></div>
	    <div id="offerDescription">
	    	Description goes here
	    </div>
	  </div>
	</div>
	<form style="background-color: white">        
        <div class='login-wrap'>
            <table class="table">
	            <tr>
		            <div class='input-group'>
		            	<td><span style="background-color: transparent;">Coupons Left <i class="fa fa-gift"></i></span></td>
		            	<td><input type="text" class="form-control" id="availableCoupons" name="availableCoupons" disabled="true" style="background-color: transparent;"></td>
		            </div>
		        </tr>
	            <tr>
		            <div class='input-group'>
		            	<td> <span style="background-color:white;">Price <i class="fa fa-inr"></i></span></td>
		            	<td><input type="text" class="form-control" id="price" name="price" disabled="true" style="background-color:transparent;"></td>
		            </div>
		        </tr>
		        <tr>
		            <div class='input-group'>
		            	<td><span style="background-color:white;">Quantity <i class="fa fa-shopping-cart"></i></span></td>
		                <td><select name="quantity" class='form-control' id="quantity" onchange="calculateTotal()">
						</select></td>
		            </div>
		        </tr>
		        <tr>
		            <div class='input-group'>
		            	<td><span style="background-color:white;">Total  <i class="fa fa-inr"></i></span></td>
		            	<td><input type="text" class="form-control" id="total" name="subtotal" disabled="true" style="background-color:white;"></td>
		            </div>
		        </tr>
            </table>
            <div style="text-align:center">
                <p>Please press continue to make payment</p>
                <div id='buyStatus'></div>
			</div>      
			<div id="paymentStatus"></div>    
        </div>
	</form>
	<nav style="height:50px;background-color:#424242; margin:0px auto; width:100%;position:fixed;height:60px;bottom:0px;">
	    
	    <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		    	<div class="container" style="text-align:center;">
		    		<button  type='button' onclick='makePayment()' style="width:80%;text-align:center;margin-top:5px;background-color:#0095cd !important;border:none;color:white;height:30px;">Make Payment</button>
		    		<label style="color:#9E9E9E;font-size:10px;"><i class="fa fa-lock"></i>&nbsp;Information is sent over a secure connection</label>
		    	</div>
		    </div>
	    </div><!-- /.container-fluid -->
	</nav>
	<script type="text/javascript">
		function calculateTotal()
		{
			var coupons = document.getElementById('availableCoupons').value;
			var price = document.getElementById('price').value;
			var quantity = document.getElementById('quantity').value;
			var total = price * quantity;
			document.getElementById('total').value = total;
		}

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