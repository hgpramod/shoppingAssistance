function doRegister()
{
	var fullname = document.getElementById("fullName").value;
	var emailid = document.getElementById("emailId").value;
	var password = document.getElementById("regPassword").value;
	var dataString = 'fullname1=' + fullname + '&email1=' + emailid + '&password1=' + password;
	if (fullname == '' || emailid == '' || password == '') 
	{
		alert("Please Fill All Fields");
	} 
	else 
	{
		// AJAX code to submit form.
		$.ajax({
			type: "POST",
			url: "register.php",
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
		
		if(errorCode == 42001)
		{
			registrationStatus.innerHTML = "Mandatory Fields cannot be blank";
		}
		else if(errorCode == 42002)
		{
			registrationStatus.innerHTML = "Invalid Values";
		}
		else if(errorCode == 42003)
		{
			registrationStatus.innerHTML = "Database Error";
		}
		else if(errorCode == 42004)
		{
			registrationStatus.innerHTML = "Already Registered";
		}
		else if(errorCode == 42005)
		{
			alert("Registration Successful \n Error in Login.!");
			window.open("login.php",'_self');
		}
		else if(errorCode == 42000)
		{
			
		}
	}
		
		});
	}
	return false;
}
