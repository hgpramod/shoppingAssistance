function getLocation() 
{
  if (navigator.geolocation) 
  {     
    navigator.geolocation.getCurrentPosition(savePosition);		
  } 
  else 
  {
    alert("Turn on geolocation");
  }
}

function savePosition(position) 
{          
  var lat = position.coords.latitude;	
  var lng = position.coords.longitude; 	
  var latLng = lat+","+lng;
  localStorage.setItem('latLng',latLng);
  xhrconvertLatlng = new XMLHttpRequest();
  xhrconvertLatlng.onreadystatechange = process;
  xhrconvertLatlng.open("POST",baseUrl+"/latlngToAddressHandler.php",true);
  xhrconvertLatlng.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhrconvertLatlng.send("latitude="+lat+"&longitude="+lng);
}

function process()
{
  var currentLocation = document.getElementById("currentLocation");
  if(xhrconvertLatlng.readyState == 4 && xhrconvertLatlng.status == 200)
  {
    var returnValue = xhrconvertLatlng.responseText;
    returnValue = returnValue.replace(/[{"'()}]/g,"");
    returnValue = returnValue.split(":");
    currentLocation.innerHTML = "Current Location: "+returnValue[1];
  }
}

