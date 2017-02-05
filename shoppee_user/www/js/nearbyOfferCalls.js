//this file provides API to get current location and fetch offers nearby
function getLocation() 
{          
  var latLng = localStorage.getItem('latLng');
  latLng = latLng.split(",")
  var lat = latLng[0]; 
  var lng = latLng[1];
  xhrnearByOffer = new XMLHttpRequest();
  xhrnearByOffer.onreadystatechange = processOffers;
  xhrnearByOffer.open("POST",baseUrl+"/nearbyOfferHandler.php",true);
  xhrnearByOffer.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhrnearByOffer.send("latitude="+lat+"&longitude="+lng+"&emailId="+localStorage.getItem("user"));
}

//Processing Return data from server
function processOffers()
{
  var adId = new Array();
  var adDescription = new Array();
  var adCategory = new Array();
  var adGUID = new Array();
  var adLocation = new Array();
  var adDistance = new Array();
  var imgUrl = new Array();
  if(xhrnearByOffer.readyState == 4 && xhrnearByOffer.status == 200)
  {
    var UIcontainer = document.getElementById("UIcontainer");
    var offerStatus = document.getElementById("offerStatus");
    var errorImage = document.getElementById("errorImage");
    var returnValue = xhrnearByOffer.responseText;
    var jsonData = JSON.parse(returnValue);
    var statusCode = jsonData.statusCode;
    var errorCode = jsonData.errorCode;
    var statusText = jsonData.statusText;

    if(errorCode == 44001)
    {
      var image = document.createElement("img");
      image.setAttribute("src", "../images/sad.gif");
      image.setAttribute("height", "120px");
      image.setAttribute("width","auto");
      errorImage.appendChild(image);
      offerStatus.innerHTML = "Error Loading EmailId or Location";
    }
    else if(errorCode == 44003)
    {
      var image = document.createElement("img");
      image.setAttribute("src", "../images/sad.gif");
      image.setAttribute("height", "120px");
      image.setAttribute("width","auto");
      errorImage.appendChild(image);
      offerStatus.innerHTML = "No Nearby Offers Found At This Time";
    }
    else if(errorCode == 44000)
    {
      adId = jsonData.data.adId;
      adDescription = jsonData.data.adDescription;
      adCategory = jsonData.data.adCategory;
      adGUID = jsonData.data.adGUID;
      adDistance = jsonData.data.adDistance;
      imgUrl = jsonData.data.imgUrl;
      var adActualPrice = jsonData.data.adActualPrice;
      var adDiscountedPrice = jsonData.data.adDiscountedPrice;
      //Sort the offers based on distance using bubble sort
      var n = adId.length;
      for(var i=0; i<n-1; i++)
      {
        for(j=0;j<n-i-1;j++)
        {
          if(adDistance[j] > adDistance[j+1])
          {
            var adGUIDTemp = adGUID[j];
            adGUID[j] = adGUID[j+1];
            adGUID[j+1] = adGUIDTemp;

            var adCategoryTemp = adCategory[j];
            adCategory[j] = adCategory[j+1];
            adCategory[j+1] = adCategoryTemp;

            var adDescriptionTemp = adDescription[j];
            adDescription[j] = adDescription[j+1];
            adDescription[j+1] = adDescriptionTemp;

            var adDistanceTemp = adDistance[j];
            adDistance[j] = adDistance[j+1];
            adDistance[j+1] = adDistanceTemp;

            var adActualPriceTemp = adActualPrice[j];
            adActualPrice[j] = adActualPrice[j+1];
            adActualPrice[j+1] = adActualPriceTemp;

            var adDiscountedPriceTemp = adDiscountedPrice[j];
            adDiscountedPrice[j] = adDiscountedPrice[j+1];
            adDiscountedPrice[j+1] = adDiscountedPriceTemp;
          }
        }
      }
      for(var i=0;i<n;i++)
      {
        var divBody = document.createElement("div");
        divBody.id = adGUID[i];
        divBody.className = "panelHead";
        divBody.style.backgroundColor = '#FFFFFF';

        var divPanel = document.createElement("div");
        divPanel.className = "panel-body";
        
        var image = document.createElement("img");
        image.setAttribute("src", imageUrl+"/"+imgUrl[i]);
        image.setAttribute("height", "auto");
        image.setAttribute("width","100%");

        var adDescriptionParagraph = document.createElement("p");
        adDescriptionParagraph.id = adDescription[i];
        adDescriptionParagraph.innerHTML = adDescription[i];

        var adDistanceParagraph = document.createElement("p");
        adDistanceParagraph.id = adCategory[i];
        adDistanceParagraph.innerHTML = "Distance: "+adDistance[i];;

        var adCategoryParagraph = document.createElement("span");
        adCategoryParagraph.id = adCategory[i];
        adCategoryParagraph.innerHTML = "Category: "+adCategory[i];

        var spanDiscountedPrice = document.createElement("span");
        spanDiscountedPrice.style.color = "#00aff0";
        spanDiscountedPrice.style.fontSize = "15px";
        var icon = document.createElement("i");
        icon.className = "fa fa-inr";
        var label = document.createElement("label");
        label.innerHTML = adDiscountedPrice[i];

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
        if(adActualPrice[i] == null || adActualPrice[i] == "")
        {
          rupeeIcon.style.display = "none";
        }
        divPanel.appendChild(image);
        divPanel.appendChild(adDescriptionParagraph);
        divPanel.appendChild(adDistanceParagraph);
        divPanel.appendChild(adCategoryParagraph);
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
      offerStatus.innerHTML = "Unkown Error";
    }
  }
}

function getAdDetails(adGUID)
{
  window.open("../templates/adDetailedView.php?adGUID="+adGUID,"_self");
}