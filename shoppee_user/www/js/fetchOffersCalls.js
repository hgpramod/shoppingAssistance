//This file provides API to fetch offers
function fetchOffers()
{
	//fetch the URL which contains data
	var url = window.location.href;
	//split the URL and fetch all the details
	var adDetails = url.split("?");
	adDetails = adDetails[1];
	//Fetch interested categories
	var interestedCategories = adDetails.split("=");
	interestedCategories = interestedCategories[1];
	//Make asynchronous call to server and send details
	xhrFetchOffer = new XMLHttpRequest();
	xhrFetchOffer.onreadystatechange = processOffers;
    xhrFetchOffer.open("POST",baseUrl+"/interestedOfferHandler.php",true);
    xhrFetchOffer.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhrFetchOffer.send("interestedCategories="+interestedCategories);
}
//Process return data from server
function processOffers()
{
	var adId = new Array();
	var adDescription = new Array();
	var adCategory = new Array();
	var adGUID = new Array();
	var UIcontainer = document.getElementById("UIcontainer");
	var offerStatus = document.getElementById("offerStatus");
	var errorImage = document.getElementById("errorImage");
	if(xhrFetchOffer.readyState == 4 && xhrFetchOffer.status == 200)
  	{
	    var returnValue = xhrFetchOffer.responseText;
	    var jsonData = JSON.parse(returnValue);
	    var statusCode = jsonData.statusCode;
	    var errorCode = jsonData.errorCode;
	    var statusText = jsonData.statusText;
	    if(errorCode == 45001)
	    {
	      UIcontainer.innerHTML = "Please Select Category";
	    }
	    else if(errorCode == 45003)
	    {
		    var image = document.createElement("img");
	        image.setAttribute("src", "../images/sad.gif");
	        image.setAttribute("height", "120px");
	        image.setAttribute("width","auto");
	        errorImage.appendChild(image);
	        offerStatus.innerHTML = "No Offers Found At This Time";
	    }
	    else if(errorCode == 45000)
	    {
	    	
	    	adId = jsonData.data.adId;
	    	adDescription = jsonData.data.adDescription;
	    	adCategory = jsonData.data.adCategory;
	    	adGUID = jsonData.data.adGUID;
	    	adPrice = jsonData.data.adPrice;
	    	adActualPrice = jsonData.data.adActualPrice;
	    	for(var i=0; i<adId.length; i++)
	    	{
		    	var divBody = document.createElement("div");
		        divBody.id = adGUID[i];
		        divBody.className = "panelHead";
		        divBody.style.backgroundColor = '#FFFFFF';

		        var divPanel = document.createElement("div");
		        divPanel.className = "panel-body";
		        
		        var image = document.createElement("img");
		        image.setAttribute("src", imageUrl+"/"+adGUID[i]);
		        image.setAttribute("height", "auto");
		        image.setAttribute("width","100%");

		        var adDescriptionParagraph = document.createElement("p");
		        adDescriptionParagraph.id = adDescription[i];
		        adDescriptionParagraph.innerHTML = adDescription[i];

		        var adCategoryParagraph = document.createElement("span");
		        adCategoryParagraph.id = adCategory[i];
		        adCategoryParagraph.innerHTML = "Category: "+adCategory[i];

		        var spanDiscountedPrice = document.createElement("span");
		        spanDiscountedPrice.style.color = "#00aff0";
		        spanDiscountedPrice.style.fontSize = "15px";
		        var icon = document.createElement("i");
		        icon.className = "fa fa-inr";
		        var label = document.createElement("label");
		        label.innerHTML = adPrice[i];

		        var spanActualPrice = document.createElement("span");
		        spanActualPrice.style.color = "grey";
		        spanActualPrice.style.fontSize = "12px";
		        spanActualPrice.style.marginLeft = "25%";
		        var rupeeIcon = document.createElement("i");
		        rupeeIcon.className = "fa fa-inr";
		        rupeeIcon.style.textDecoration = "line-through";
		        var priceLabel = document.createElement("label");
		        priceLabel.innerHTML = adActualPrice[i];
		        priceLabel.style.textDecoration = "line-through";

		        var anchorTag = document.createElement("a");
		        anchorTag.id = adGUID[i];
		        anchorTag.href = "view";
		        var breakTag = document.createElement("br");

		        divPanel.appendChild(image);
		        divPanel.appendChild(adDescriptionParagraph);
		        divPanel.appendChild(adCategoryParagraph);
		        if(adActualPrice[i] == null || adActualPrice[i] == "")
		        {
		        	rupeeIcon.style.display = "none";
		        }
	        	spanActualPrice.appendChild(rupeeIcon);
	        	spanActualPrice.appendChild(priceLabel);
	        	divPanel.appendChild(spanActualPrice);

		        spanDiscountedPrice.appendChild(icon);
		        spanDiscountedPrice.appendChild(label);
		        divPanel.appendChild(spanDiscountedPrice);
		        divBody.appendChild(divPanel);
		        divBody.appendChild(anchorTag);
		        UIcontainer.appendChild(divBody);
		        UIcontainer.appendChild(breakTag);
		    }
		    //Click event Handler
	        $(".panelHead").click(function()
	        {
	          getAdDetails($(this).attr('id'));
	        });
	    }
	    else
	    {
	    	UIcontainer.innerHTML = "Unknown Error";
	    }
	}
}
//This function opens addetailedview page and displays offer
function getAdDetails(adGUID)
{
  window.open("../templates/adDetailedView.php?adGUID="+adGUID,"_self");
}