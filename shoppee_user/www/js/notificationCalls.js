//this file provides API to get current location and fetch offers nearby
function loadNotifications() 
{
  if (navigator.geolocation) 
  {     
    navigator.geolocation.getCurrentPosition(sendPosition);   
  } 
  else 
  {
    alert("Turn on geolocation");
  }
}

function sendPosition(position) 
{          
  var lat = position.coords.latitude; 
  var lng = position.coords.longitude;  
  xhrnearByOffer = new XMLHttpRequest();
  xhrnearByOffer.onreadystatechange = processNotifications;
  xhrnearByOffer.open("POST",baseUrl+"/nearbyOfferHandler.php",true);
  xhrnearByOffer.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhrnearByOffer.send("latitude="+lat+"&longitude="+lng);
}

//Processing Return data from server
function processNotifications()
{
  if(xhrnearByOffer.readyState == 4 && xhrnearByOffer.status == 200)
  {
    var notification = document.getElementById("offerNotification");
    var notificationStatus = document.getElementById('notificationStatus');
    var returnValue = xhrnearByOffer.responseText;
    var jsonData = JSON.parse(returnValue);
    var statusCode = jsonData.statusCode;
    var errorCode = jsonData.errorCode;
    var statusText = jsonData.statusText;

    if(errorCode == 44001)
    {
      notificationStatus.innerHTML = "Error Loading Notifications";
    }
    else if(errorCode == 44003)
    {
      notificationStatus.innerHTML = "No notification at this time";
    }
    else if(errorCode == 44000)
    {
      var adId = jsonData.data.adId;
      var nearbyOfferCount = adId.length;
      if(nearbyOfferCount != null)
      {
        var span = document.createElement("span");
        span.style.color="blue";

        var anchor = document.createElement("a");
        anchor.href = "nearbyOffers.php";
        anchor.innerHTML = "You have "+nearbyOfferCount+" Offers Nearby.!";

        span.appendChild(anchor);
        notification.appendChild(span);
      }
    }
  }
}
