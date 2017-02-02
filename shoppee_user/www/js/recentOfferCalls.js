//this file provides API to get current location and fetch offers nearby
function loadRecentOffers() 
{    
  xhrRecentOffers = new XMLHttpRequest();
  xhrRecentOffers.onreadystatechange = processRecentOffers;
  xhrRecentOffers.open("GET",baseUrl+"/recentOffersHandler.php",true);
  xhrRecentOffers.send();
}

function processRecentOffers()
{
  if(xhrRecentOffers.readyState == 4 && xhrRecentOffers.status == 200)
  {
    var returnValue = xhrRecentOffers.responseText;
    var jsonData = JSON.parse(returnValue);
    var statusCode = jsonData.statusCode;
    var errorCode = jsonData.errorCode;
    var statusText = jsonData.statusText;
    var UIcontainer = document.getElementById("UIcontainer");
    var offerStatus = document.getElementById("offerStatus");
    if(errorCode == 51001)
    {
      offerStatus.innerHTML = "No Recent Offers Found";
    }
    else if(errorCode == 51003)
    {
      offerStatus.innerHTML = "Error Loading Recent Offers";
    }
    else if(errorCode == 51004)
    {
      offerStatus.innerHTML = "No Recent Offers Found";
    }
    else if(errorCode == 51000)
    {
      var adId = jsonData.data.adId;
      var adDescription = jsonData.data.adDescription;
      var adCategory = jsonData.data.adCategory;
      var adGUID = jsonData.data.adGUID;
      for(var i=0;i<adId.length;i++)
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

        var adCategoryParagraph = document.createElement("p");
        adCategoryParagraph.id = adCategory[i];
        adCategoryParagraph.innerHTML = "Category: "+adCategory[i];

        var adDescriptionParagraph = document.createElement("p");
        adDescriptionParagraph.innerHTML = adDescription[i];

        var anchorTag = document.createElement("a");
        anchorTag.id = adGUID[i];
        anchorTag.href = "view";
        var breakTag = document.createElement("hr");

        divPanel.appendChild(image);
        divPanel.appendChild(adDescriptionParagraph);
        divPanel.appendChild(adCategoryParagraph);
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
  }
}
function getAdDetails(adGUID)
{
  window.open("../templates/adDetailedView.php?adGUID="+adGUID,"_self");
}