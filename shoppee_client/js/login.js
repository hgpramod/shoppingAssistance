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
				
				if(errorCode == 42004)
				{
					registrationStatus.innerHTML = "Already Registered";
				}
				else if(errorCode == 42000)
				{
					localStorage.setItem("loggedInUser", emailid);
					alert("Registration Successful");
					window.open("welcome.html",'_self');
				}
		
			}
		
		});
	}
	return false;
}
