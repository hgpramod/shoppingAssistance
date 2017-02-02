//This file provides api to fetch client data
function getDetails() 
{            
  xhrClientDetails = new XMLHttpRequest();
  xhrClientDetails.onreadystatechange = processDetails;
  xhrClientDetails.open("GET",baseUrl+"/clientDetailHandler.php",true);
  xhrClientDetails.send();
}

function processDetails()
{
	var firstName = document.getElementById("firstName");
	var lastName = document.getElementById("lastName");
	var phoneNumber = document.getElementById("phoneNumber");
	var emailId = document.getElementById("emailId");
	var clientDetails = document.getElementById("clientDetails");
	if(xhrClientDetails.readyState == 4 && xhrClientDetails.status == 200)
	{
		var returnValue = xhrClientDetails.responseText;
	    var jsonData = JSON.parse(returnValue);
	    var statusCode = jsonData.statusCode;
	    var errorCode = jsonData.errorCode;
	    var statusText = jsonData.statusText;

	    if(errorCode == 43001)
	    {
	      clientDetails.innerHTML = "Error Loading Details";
	    }
	    else if(errorCode == 43003)
	    {
	      clientDetails.innerHTML = "Database Error";
	    }
	    else if(errorCode == 43000)
	    {
		    var clientFName = jsonData.data.firstName;
		    var clientLName = jsonData.data.lastName;
		    var clientEmailId = jsonData.data.emailId;
		    var clientPhoneNumber = jsonData.data.phoneNumber;
		    var clientInterestedCategories = jsonData.data.interestedCategories;
		    firstName.value = clientFName;
		    lastName.value = clientLName;
		    emailId.value = clientEmailId;
		    phoneNumber.value = clientPhoneNumber;

	      	//get the categories present on UI
	      	var categories = document.querySelectorAll('input[name="adCategories[]"]');
	      	var clientCategories = clientInterestedCategories.split(",");
	      	for(var i=0;i<clientCategories.length;i++) 
			{
			 	for(var j=0,n=categories.length;j<n;j++)
			 	{
			 		if(clientCategories[i] == categories[j].value)
			 			categories[j].checked = true;
			 	}
			}
		}
	}
}