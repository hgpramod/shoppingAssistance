//This file provides API to fetch user details 
function clientDetails()
{	
	xhrClientDetails = new XMLHttpRequest();
	xhrClientDetails.onreadystatechange = processDetails;
	xhrClientDetails.open("POST",baseUrl+"/clientDetailHandler.php",true);
	xhrClientDetails.send("emailId="+localStorage.getItem("user"));
}
//function to process user details from server
function processDetails()
{
	var name = document.getElementById("name");
	var firstName = document.getElementById("firstName");
	var phoneNumber = document.getElementById("phoneNumber");
	var emailId = document.getElementById("emailId");
	var clientDetails = document.getElementById("clientDetails");
	var userName = document.getElementById("userName");
	var categoryNotification = document.getElementById("categoryNotification");
	if(xhrClientDetails.readyState == 4 && xhrClientDetails.status == 200)
	{
		var returnValue = xhrClientDetails.responseText;
	    var jsonData = JSON.parse(returnValue);
	    var statusCode = jsonData.statusCode;
	    var errorCode = jsonData.errorCode;
	    var statusText = jsonData.statusText;
	    userName.innerHTML = localStorage.getItem("user");
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
		    name.innerHTML = "Hello "+clientFName;
		    firstName.innerHTML = "Name: "+clientFName+" "+clientLName;
		    emailId.innerHTML = "Email Id: "+clientEmailId;
		    phoneNumber.innerHTML = "Phone Number: "+clientPhoneNumber;
		    
		    if(clientInterestedCategories == null || clientInterestedCategories == "")
		    {
		    	var span = document.createElement("span");
		        span.style.color="blue";

		        var anchor = document.createElement("a");
		        anchor.href = "accountSettings.php";
		        anchor.innerHTML = "Please update your account";

		        span.appendChild(anchor);
		        categoryNotification.appendChild(span);
		    }
		}
	}
}