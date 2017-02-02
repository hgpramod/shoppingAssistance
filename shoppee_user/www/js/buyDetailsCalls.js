//This file provides API to  fetch offer Details
function detailedOffer()
{
	//fetch the URL which contains data
	var url = window.location.href;

	//split the URL and fetch all the details
	var adDetails = url.split("?");
	adDetails = adDetails[1];
	//Fetch interested categories
	var adGUID = adDetails.split("=");
	adGUID = adGUID[1];
	
	var arr = adGUID;
	var json_str = JSON.stringify(arr);
	createCookie('offerGUID', json_str,365);
	//Search details
	fetchDetails(adGUID);
}
//Function to fetch details of the Offer
function fetchDetails(adGUID)
{
	xhrAdDetails = new XMLHttpRequest();
    xhrAdDetails.onreadystatechange = processOfferDetails;
    xhrAdDetails.open("POST",baseUrl+"/adDetailsHandler.php",true);
    xhrAdDetails.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhrAdDetails.send("adGUID="+adGUID);
}
//Processing Return data from server
function processOfferDetails()
{
	if(xhrAdDetails.readyState == 4 && xhrAdDetails.status == 200)
    {
		var offerStatus = document.getElementById("offerStatus");
	    var returnValue = xhrAdDetails.responseText;
	    var jsonData = JSON.parse(returnValue);
	    var statusCode = jsonData.statusCode;
	    var errorCode = jsonData.errorCode;
	    var statusText = jsonData.statusText;
	    if(errorCode == 49001)
	    {
	      offerStatus.innerHTML = "Error Loading Offer Details";
	    }
	    else if(errorCode == 49003)
	    {
	      offerStatus.innerHTML = "Database Error";
	    }
	    else if(errorCode == 49000)
	    {
			var offerImage = document.getElementById("offerImage");
			var adDescription = jsonData.data.adDescription;
			var adGUID = jsonData.data.adGUID;
			var adDiscountedPrice = jsonData.data.adDiscountedPrice;
			var numberOfCoupons = jsonData.data.numberOfCoupons;

			//fill the UI with the details
			var image = document.createElement("img");
	        image.src = imageUrl+"/"+adGUID;
	        image.setAttribute("height", "150px");
	        image.setAttribute("width","100%");

	        offerImage.appendChild(image);
			document.getElementById("offerDescription").innerHTML = adDescription;
			document.getElementById("price").value = adDiscountedPrice;
			document.getElementById("availableCoupons").value = numberOfCoupons;
			var total = document.getElementById("total").value = adDiscountedPrice;
			var quantity = document.getElementById("quantity");
			//Dynamically generating dropdown for quantity
			for(var i=1; i<= numberOfCoupons; i++)
			{
				var option = document.createElement("option");
				option.value= option.text=i;
				quantity.add(option);
			}
		}
	}
}
function createCookie(cname, cvalue, exdays) 
{
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}