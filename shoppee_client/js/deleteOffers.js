function fetchOffers()
{
	var adId = new Array();
	var adDescription = new Array();
	var adGUID = new Array();
	var status = document.getElementById("status");
	var emailid= localStorage.getItem("loggedInUser");
	var dataString ='&emailId='+emailid;
	
	$.ajax({
			type: "POST",
			url: "fetchOffer.php",
			data: dataString,
			cache: false,
			success: function(responseText) 
			{
				var returnValue =responseText;
				var jsonData = JSON.parse(returnValue);
	    		var statusCode = jsonData.statusCode;
	    		var errorCode = jsonData.errorCode;
	    		var statusText = jsonData.statusText;
				
				var adId = jsonData.data.adId;
				var adDescription = jsonData.data.adDescription;
				var adGUID = jsonData.data.adGUID;

				if(errorCode == 42001)
				{   
					status.innerHTML = "Can't open your uploaded offers.!";
				}
				else if(errorCode == 42002)
				{
					status.innerHTML = "No offers found..!";
				}
				else if(errorCode == 42000)
				{
					var data = "";
					for(var i=0; i<adId.length; i++)
	    			{
	    				data += "<tr><td align='right' width='40%'>"+adDescription[i]+"<td><td align='left' width='40%'><a onclick='doDelete(\""+adGUID[i]+"\")'>Delete Offer</a></td></tr>";
	    			}
	    			document.getElementById("dataTable").innerHTML = data;
				}
			}
		});
}

function doDelete(adGUID)
{
	if(confirm("Are you sure to delete this offer.?"))
	{
		var emailid= localStorage.getItem("loggedInUser");
		var dataString ='&emailId='+emailid+"&adGUID="+adGUID;
		var status = document.getElementById("status");
		$.ajax({
			type: "POST",
			url: "deleteOffer.php",
			data: dataString,
			cache: false,
			success: function(responseText) 
			{
				var returnValue =responseText;
				var jsonData = JSON.parse(returnValue);
	    		var statusCode = jsonData.statusCode;
	    		var errorCode = jsonData.errorCode;
	    		var statusText = jsonData.statusText;

				if(errorCode == 43001)
				{   
					status.innerHTML = "Can't delete offer.! DB error.";
				}
				else if(errorCode == 43000)
				{
					status.innerHTML = "Offer Deleted";
					fetchOffers();
				}
			}
		});
	}
}