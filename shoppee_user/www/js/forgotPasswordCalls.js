//This file provides API to reset password
function doReset()
{
	var emailId = document.getElementById("emailId").value;
	emailId = emailId.toUpperCase();

	if(emailId == "" || emailId == null)
	{
		document.getElementById("emailId").style.border='1px solid red';
	}
	else
	{
		//make asynchronous call to server and send user data
		xhrDoReset = new XMLHttpRequest();
		xhrDoReset.onreadystatechange = processPassword;
		xhrDoReset.open("POST",baseUrl+"/forgotPasswordHandler.php",true);
		xhrDoReset.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhrDoReset.send("emailId="+emailId);
	}
}

//process return data from server
function processPassword()
{
	var passwordStatus = document.getElementById("passwordStatus");
	if(xhrDoReset.readyState == 4 && xhrDoReset.status == 200)
	{
		var returnValue = xhrDoReset.responseText;
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
		if(errorCode == 48001)
		{
			passwordStatus.innerHTML = "Mandatory Fields cannot be blank";
		}
		else if(errorCode == 48002)
		{ 
			passwordStatus.innerHTML = "Invalid Email Id";
		}
		else if(errorCode == 48003)
		{
			passwordStatus.innerHTML = "Not a Registered User";
		}
		else if(errorCode == 48004)
		{
			passwordStatus.innerHTML = "Error Sending Mail";
		}
		else if(errorCode == 48000)
		{
			alert("Password has been sent to your EmailId");
			window.open("login.php","_self");
		}
		else
		{
			passwordStatus.innerHTML = "Unknown error";
		}
	}
}