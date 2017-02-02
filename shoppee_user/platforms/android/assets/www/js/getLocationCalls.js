function getCurrentLocation()
{
	if (navigator.geolocation) 
	{
        navigator.geolocation.getCurrentPosition(showPosition);
    } 
    else 
    { 
    	alert("Please turn of the location service");
    }
}
function showPosition(position) 
{
  	var lat = position.coords.latitude;	
  	var lng = position.coords.longitude;
  	//make asynchrounous call to server and convert the latlong to address
  	xhr_convertLatlng = new XMLHttpRequest();
  	xhr_convertLatlng.onreadystatechange = processAddress;
  	xhr_convertLatlng.open("POST",baseUrl+"/latlngToAddressHandler.php",true);
  	xhr_convertLatlng.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  	xhr_convertLatlng.send("latitude="+lat+"&longitude="+lng);
}
function processAddress()
{
	var currentLocation = document.getElementById("currentLocation");
	if(xhr_convertLatlng.readyState == 4 && xhr_convertLatlng.status == 200)
	{
		var returnValue = xhr_convertLatlng.responseText;
		if(returnValue.length != 0)
		{
			returnValue = returnValue.replace("{","");
			returnValue = returnValue.replace("}","");
			returnValue = returnValue.replace(/["]/g,"");
		
			var arr = new Array();
			arr = returnValue.split(":");
			currentLocation.innerHTML = "Current Location: "+arr[1];
		}
		else
		{
			alert("Could not find the location!");
		}
	}
}