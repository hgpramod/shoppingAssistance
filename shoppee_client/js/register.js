function doLogin()
{
	//alert("login");
	var emailid = document.getElementById("emailId1").value;
	var password = document.getElementById("regPassword1").value;
	var dataString = '&email1=' + emailid + '&password1=' + password;
	if (emailid == '' || password == '') 
	{
		alert("Please Fill All Fields");
	} 
	else 
	{
		// AJAX code to submit form.
		$.ajax({
			type: "POST",
			url: "login.php",
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
			localStorage.setItem("loggedInUser", emailid);
			LoginStatus.innerHTML = "success";
			window.open("welcome.html",'_self');
		}
		else if(errorCode == 42002)
		{
			LoginStatus.innerHTML = "Account does not exists register first";
		}
		else if(errorCode == 42003)
		{
			LoginStatus.innerHTML = "Database Error";
		}
		else if(errorCode == 42004)
		{
			LoginStatus.innerHTML = "Already Registered";
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
