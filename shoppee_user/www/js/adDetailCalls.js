//This file provides API to  fetch Offer Details
function getOfferDetails()
{
 	var latLng = localStorage.getItem('latLng');
  	latLng = latLng.split(",")
 	var latitude = latLng[0];	
  	var longitude = latLng[1]; 
 	//fetch the URL which contains data
	var url = window.location.href;

	//split the URL and fetch all the details
	var adDetails = url.split("?");
	adDetails = adDetails[1];
	//Fetch interested categories
	var adGUID = adDetails.split("=");
	adGUID = adGUID[1];
	//localStorage.setItem("offerGUID",adGUID);
	fetchDetails(adGUID,latitude,longitude);
}

//Function to fetch details of the Offer
function fetchDetails(adGUID,latitude,longitude)
{
	xhrAdDetails = new XMLHttpRequest();
    xhrAdDetails.onreadystatechange = processOfferDetails;
    xhrAdDetails.open("POST",baseUrl+"/adDetailsHandler.php",true);
    xhrAdDetails.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhrAdDetails.send("adGUID="+adGUID+"&latitude="+latitude+"&longitude="+longitude);
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
	      offerStatus.innerHTML = "Error Loading Offer";
	    }
	    else if(errorCode == 49003)
	    {
	      offerStatus.innerHTML = "Database Error";
	    }
	    else if(errorCode == 49000)
	    {
			var offerImage = document.getElementById("offerImage");
			var adDescription = jsonData.data.adDescription;
			var adCategory = jsonData.data.adCategory;
			var adLocation = jsonData.data.adLocation;
			var adGUID = jsonData.data.adGUID;
			var adDistance = jsonData.data.adDistance;
			
			var adStartDate = jsonData.data.adStartDate;
			var adEndDate = jsonData.data.adEndDate;
			var adValidityType = jsonData.data.adValidityType;
			var adActualPrice = jsonData.data.adActualPrice;
			var adDiscountRate = jsonData.data.adDiscountRate;
			var adDiscountedPrice = jsonData.data.adDiscountedPrice;
			var adHighlights = jsonData.data.adHighlights;
			var numberOfCoupons = jsonData.data.numberOfCoupons;
			var adDetailedDescription = jsonData.data.adDetailedDescription;

			//fill the UI with the details
			var image = document.createElement("img");
	        image.src = imageUrl+"/"+adGUID;
	        image.setAttribute("height", "150px");
	        image.setAttribute("width","100%");

	        offerImage.appendChild(image);
			document.getElementById("offerDescription").innerHTML = adDescription;
			if(adCategory == null || adCategory == "")
				document.getElementById("categoryIcon").style.display = "none";
			else
				document.getElementById("offerCategory").innerHTML = adCategory;
			if(adActualPrice == null || adActualPrice == "")
			{
				document.getElementById('actualPriceIcon').style.display = "none";
			}
			else
			{
				document.getElementById("actualPrice").innerHTML = adActualPrice;
				document.getElementById("actualPrice").style.textDecoration = "line-through";
			}
			if(adDistance == null || adDistance == "")
			{
				document.getElementById("distanceInfo").innerHTML = "";
				document.getElementById("distanceIcon").style.display = "none";
			}
			else
			{
				adDistance = adDistance.toFixed(2);
				document.getElementById("distanceInfo").innerHTML = "Distance: "+adDistance+"KM";
			}
			if(adDiscountedPrice == null || adDiscountedPrice == "")
			{
				document.getElementById("discountedPrice").innerHTML = "";
				document.getElementById("discountedPriceIcon").style.display = "none";
			}
			else
			{
				document.getElementById("discountedPrice").innerHTML = adDiscountedPrice;
			}
			if(adDiscountRate == null || adDiscountRate == "")
			{
				document.getElementById("discountRate").innerHTML = "";
				document.getElementById("discount").style.display = "none";
			}
			else
			{
				document.getElementById("discountRate").innerHTML = adDiscountRate+"%";
			}
			if(numberOfCoupons == "" || numberOfCoupons == null)
			{
				document.getElementById("availableCoupons").innerHTML = "";
				document.getElementById("coupons").style.display = "none";
			}
			else
				document.getElementById("availableCoupons").innerHTML = numberOfCoupons;
			//load the highlights section
			if(adHighlights == null || adHighlights == "")
				document.getElementById("highlightsList").innerHTML = "";
			else
			{
				var highlightsArray = adHighlights.split(",");
				for(var i=0;i<highlightsArray.length;i++)
				{
					if(highlightsArray[i] == "")
						break;
					else
					{
						//dynamically create the list and append it to highlights UI
						var list = document.createElement("li");
						text = document.createTextNode(highlightsArray[i]);
						list.appendChild(text);
						document.getElementById("highlightsList").appendChild(list);
					}
				}
			}
			
			//content to be loaded for about this offer
			document.getElementById("aboutOffer").innerHTML = adDetailedDescription;
		}
	}
}
