//This file provides API to update client account
function doUpdateAccount()
{
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var phoneNumber = document.getElementById("phoneNumber").value;
	var interestedCategories = document.querySelectorAll('input[name="adCategories[]"]:checked');
	var interestedCategoriesArray = "";
	for (var i=0, n=interestedCategories.length;i<n;i++) 
	{
	  	interestedCategoriesArray += interestedCategories[i].value+",";
	}
	//validate the parameters
	if(firstName == "" || firstName == null)
	{
		document.getElementById("firstName").focus();
	}
	else if(phoneNumber == "" || phoneNumber == null)
	{
		document.getElementById("phoneNumber").focus();
	}
	else if(interestedCategories.checked == false)
	{
		document.getElementById("interestedCategories").focus();
	}
	else
	{
		//make a asynchronous call to server and send the data
		xhrDoUpdateAccount = new XMLHttpRequest();
		xhrDoUpdateAccount.onreadystatechange = processUpdateAccount;
		xhrDoUpdateAccount.open("POST",baseUrl+"/accountSettingsHandler.php",true);
		xhrDoUpdateAccount.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhrDoUpdateAccount.send("firstName="+firstName+"&lastName="+lastName+"&phoneNumber="+phoneNumber+"&interestedCategories="+interestedCategoriesArray);
	}
}
//function to process the UpdateAccount
function processUpdateAccount()
{
	var setPropertiesStatus = document.getElementById("setPropertiesStatus");
	if(xhrDoUpdateAccount.readyState == 4 && xhrDoUpdateAccount.status == 200)
	{
		var returnValue = xhrDoUpdateAccount.responseText;
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

		if(errorCode == 43001)
		{
			setPropertiesStatus.innerHTML="Mandatory Fields cannot be blank";
		}
		else if(errorCode == 43003)
		{
			setPropertiesStatus.innerHTML="Database Error";
		}
		else
		{
			window.open("../templates/welcome.php","_self");
		}
	}
}