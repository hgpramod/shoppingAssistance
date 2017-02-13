//function to get the location of the user
var myLatlng;
var locationArray ="";

function getMultipleLocation()
{
    if(navigator.geolocation)
    {
        // timeout at 60000 milliseconds (60 seconds)
        var options = {timeout:60000};
        navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
    }
    else
    {
        alert("Sorry, browser does not support geolocation!");
    }
}

function showLocation(position) 
{
    //display the map
    document.getElementById("displayMap").style.display = "block";
    //get the current locations
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    locationArray = latitude +","+longitude;
    myLatlng = new google.maps.LatLng(latitude,longitude);
    var myOptions = {
         zoom: 12,
         center: myLatlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP
         }
    
    map = new google.maps.Map(document.getElementById("displayMap"), myOptions); 
    
    var markers;
    
        createMarker(myLatlng,1);   
    
}
//function to handle the geolocation error
function errorHandler(err) 
{
    if(err.code == 1)
    {
        alert("Error: Access is denied!");
    }
    else if( err.code == 2) 
    {
        alert("Error: Position is unavailable!");
    }
}
//function to create markers
function createMarker(pos,iterationValue)
{
    
    markers = new google.maps.Marker
    ({
        map: map,
        position: pos,
        animation: google.maps.Animation.DROP,
        clickable: true,
        draggable: true,
    });

    //function to handle the drag event
    google.maps.event.addListener(markers,'dragend', function (event) 
    {
        newLatitude = this.getPosition().lat();
        newLongitude = this.getPosition().lng();
        myLatlng = new google.maps.LatLng(newLatitude,newLongitude);

        //store the location in an array
        locationArray = newLatitude+","+newLongitude;
    });
}

function doSave()
{
	var status = document.getElementById("status");
	var description = document.getElementById("description").value;
	var DetailedDescription = document.getElementById("detailedDescription").value;
	var category = document.getElementById("category").value;
	var startDate = document.getElementById("startDate").value;
	var endDate = document.getElementById("endDate").value;
	var dataString = '&description1=' + description + '&DetailedDescription1=' + DetailedDescription + '&category1=' + category + '&startDate1=' + startDate + '&endDate1=' + endDate+'&adLocation='+locationArray;
	alert("dataString"+dataString)
	if (description == ''  || DetailedDescription == '' || category  == '' || startDate == '' || endDate  == '' ) 
	{
		alert("Please Fill All Fields");
	} 
	else 
	{
		// AJAX code to submit form.
		$.ajax({
			type: "POST",
			url: "save.php",
			data: dataString,
			cache: false,
			success: function(responseText) 
			{
				var returnValue =responseText;
		returnValue = returnValue.replace("{","");
		returnValue = returnValue.replace("}","");
		returnValue = returnValue.replace(/["]/g,"");
		
		var arr = new Array();
		arr=returnValue.split(",")
		statusCode = arr[0].split(":");
		statusCode = statusCode[1];
		errorCode = arr[1].split(":");
		errorCode = errorCode[1];
		statusText = arr[2].split(":");
		statusText = statusText[1];
		
		
		if(errorCode == 42004)
		{   
			
			status.innerHTML = "Failed to save details.!";
			
		}
		else if(errorCode == 42000)
		{
			status.innerHTML = "Ad saved Successfully.";
		}
	}
		
		});
	}
	return false;
}
