function getOfferLocationDetails()
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
  fetchOfferDetails(adGUID,latitude,longitude);
}
function fetchOfferDetails(adGUID,latitude,longitude)
{
  xhrAdLocationDetails = new XMLHttpRequest();
  xhrAdLocationDetails.onreadystatechange = processOfferLocationDetails;
  xhrAdLocationDetails.open("POST",baseUrl+"/adDetailsHandler.php",true);
  xhrAdLocationDetails.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhrAdLocationDetails.send("adGUID="+adGUID+"&latitude="+latitude+"&longitude="+longitude);
}
//Processing Return data from server
function processOfferLocationDetails()
{
  if(xhrAdLocationDetails.readyState == 4 && xhrAdLocationDetails.status == 200)
  {
    var returnValue = xhrAdLocationDetails.responseText;
    var jsonData = JSON.parse(returnValue);
    var statusCode = jsonData.statusCode;
    var errorCode = jsonData.errorCode;
    var statusText = jsonData.statusText;

    if(errorCode == 49000)
    {
      var adLocation = jsonData.data.adLocation;
      if(adLocation == null || adLocation == "")
        document.getElementById("offerAddress").innerHTML = "";
      else
      {
        //convert the latlong to address
        getAddress(adLocation);
        //load the map and place the marker for the location
        loadLocationMap(adLocation);
      }
    }
  }
}

//Function to load location on map
function loadLocationMap(adLocation)
{
  adLocation = adLocation.split(",");
  var latitude = adLocation[0];
  var longitude = adLocation[1];
  myLatlng = new google.maps.LatLng(latitude,longitude);
  var myOptions = 
  {
      zoom: 16,
    center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

  map = new google.maps.Map(document.getElementById("displayMap"), myOptions); 
  markers = new google.maps.Marker
    ({
        map: map,
        position: myLatlng,
        animation: google.maps.Animation.DROP,
        clickable: true,
        draggable: false,
    });
}
//Function to get the adress using lattitude and longitude
function getAddress(adLocation) 
{          
  var latlng = adLocation.split(",");
  var lat = latlng[0];
  var lng = latlng[1];	
  //make asynchronous call to server and send lat and lng of offer
  xhrconvertLatlng = new XMLHttpRequest();
  xhrconvertLatlng.onreadystatechange = processAddress;
  xhrconvertLatlng.open("POST",baseUrl+"/latlngToAddressHandler.php",true);
  xhrconvertLatlng.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhrconvertLatlng.send("latitude="+lat+"&longitude="+lng);
}
//Process the return data from server
function processAddress()
{
  var offerAddress = document.getElementById("offerAddress");
  if(xhrconvertLatlng.readyState == 4 && xhrconvertLatlng.status == 200)
  {
    var returnValue = xhrconvertLatlng.responseText;
    returnValue = returnValue.replace(/[{"'()}]/g,"");
    returnValue = returnValue.split(":");
    offerAddress.innerHTML = returnValue[1];
  }
}