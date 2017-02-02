//Set the timer, if the user is inactive for 2minutes refreshLocation
setTimeout(
function refreshLocation()
{
  if (navigator.geolocation) 
  {     
	navigator.geolocation.getCurrentPosition(savePosition);	
	
  } 
  else 
  {
    alert("Turn on geolocation");
  }
}, 3000);
function savePosition(position) 
{  
	var lat = position.coords.latitude;	
	var lng = position.coords.longitude; 	
	var latLng = lat+","+lng;
	localStorage.setItem('latLng',latLng);
	var url = window.location.href;
	window.open(url,'_self');	
}