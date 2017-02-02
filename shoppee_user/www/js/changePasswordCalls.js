//This file provides API to Change user password
function doUpdatePassword()
{
	var currentPassword = document.getElementById("currentPassword").value;
	var password = document.getElementById("password").value;
	var confirmPassword = document.getElementById("confirmPassword").value;

	if(currentPassword == "" || currentPassword == null)
	{
		document.getElementById("currentPassword").focus();	
	}
	else if(password == "" || password == null)
	{
		document.getElementById("password").focus();
	}
	else if(confirmPassword == "" || confirmPassword == null)
	{
		document.getElementById("confirmPassword").focus();
	}

	//make asynchronous call to server and send data
	xhrUpdatePassword = new XMLHttpRequest();
    xhrUpdatePassword.onreadystatechange = processPassword;
    xhrUpdatePassword.open("POST",baseUrl+"/changePasswordHandler.php",true);
    xhrUpdatePassword.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhrUpdatePassword.send("currentPassword="+currentPassword+"&password="+password+"&confirmPassword="+confirmPassword);
}

//Process return value from server
function processPassword()
{
	var setPasswordStatus = document.getElementById("setPasswordStatus");
	if(xhrUpdatePassword.readyState == 4 && xhrUpdatePassword.status == 200)
	{
		var returnValue = xhrUpdatePassword.responseText;
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

		if(errorCode == 47001)
		{
			setPasswordStatus.innerHTML="Mandatory Fields cannot be blank";
		}
		else if(errorCode == 47002)
		{
			setPasswordStatus.innerHTML="Password Doesnot Match";
		}
		else if(errorCode == 47003)
		{
			setPasswordStatus.innerHTML="Database Error";
		}
		else if(errorCode == 47004)
		{
			setPasswordStatus.innerHTML="Current Password is incorrect.!";
		}
		else if(errorCode == 47000)
		{
			setPasswordStatus.innerHTML="Password Updated Successfuly";
		}
		else
		{
			setPasswordStatus.innerHTML="Unknown Error";
		}
	}
}