//This file provides API to make payment
function makePayment()
{
	//fetch the URL which contains data
	var url = window.location.href;

	//split the URL and fetch all the details
	var adDetails = url.split("?");
	adDetails = adDetails[1];
	//Fetch interested categories
	var adGUID = adDetails.split("=");
	adGUID = adGUID[1];

	var quantity = document.getElementById('quantity').value;

	xhrPayment = new XMLHttpRequest();
    xhrPayment.onreadystatechange = processPayment;
    xhrPayment.open("POST",baseUrl+"/paymentHandler.php",true);
    xhrPayment.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhrPayment.send("adGUID="+adGUID+"&quantity="+quantity);
}
//Process return data from server
function processPayment()
{
	var totalBill = document.getElementById('total').value;
	if(xhrPayment.readyState == 4 && xhrPayment.status == 200)
    {
		var paymentStatus = document.getElementById("paymentStatus");
	    var returnValue = xhrPayment.responseText;
	    var jsonData = JSON.parse(returnValue);
	    var statusCode = jsonData.statusCode;
	    var errorCode = jsonData.errorCode;
	    var statusText = jsonData.statusText;
	    if(errorCode == 50001)
	    {
	      paymentStatus.innerHTML = "Error";
	    }
	    else if(errorCode == 50003)
	    {
	      paymentStatus.innerHTML = "Database Error";
	    }
	    else if(errorCode == 50000)
	    {
			window.open("../templates/makePayment.php?totalBill="+totalBill,'_self');
		}
	}
}