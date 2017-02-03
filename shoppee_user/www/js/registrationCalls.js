//Register to client 
function doRegistration () 
{
	var currentTimeStamp = Math.floor(Date.now()/1000);
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var phoneNumber = document.getElementById("phoneNumber").value;
	var emailId = document.getElementById("emailId").value;
	var password = document.getElementById("password").value;
	var confirmPassword = document.getElementById("confirmPassword").value;

	emailId = emailId.toUpperCase();
	//validate fields
	if(firstName == "" || firstName == null)
	{
		document.getElementById("firstName").style.border='1px solid #00aff0';
	}
	else if(phoneNumber == "" || phoneNumber == null)
	{
		document.getElementById("password").style.border='1px solid #00aff0';
	}
	else if(emailId == "" || emailId == null)
	{
		document.getElementById("emailId").style.border='1px solid #00aff0';
	}
	else if(password == "" || password == null)
	{
		document.getElementById("password").style.border='1px solid #00aff0';
	}
	else if(confirmPassword == "" || confirmPassword == null)
	{
		document.getElementById("confirmPassword").style.border='1px solid red';
	}
	else 
	{
		//make asynchronous call to server and send user data
		xhrDoRegister = new XMLHttpRequest();
		xhrDoRegister.onreadystatechange = processRegister;
		xhrDoRegister.open("POST",baseUrl+"/registrationHandler.php",true);
		xhrDoRegister.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhrDoRegister.send("firstName="+firstName+"&lastName="+lastName+"&phoneNumber="+phoneNumber+"&emailId="+emailId+"&password="+password+"&confirmPassword="+confirmPassword+"&currentTimeStamp="+currentTimeStamp);
	}
}
//function to handle the Registration
function processRegister()
{
	var registrationStatus = document.getElementById("registrationStatus");
	if(xhrDoRegister.readyState == 4 && xhrDoRegister.status == 200)
	{
		var returnValue = xhrDoRegister.responseText;
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
			registrationStatus.innerHTML = "Mandatory Fields cannot be blank..!";
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
			registrationStatus.innerHTML = "EmailId Already Exist";
		}
		else if(errorCode == 42005)
		{
			alert("Registration Successful \n Error in Login.!");
			window.open("login.php",'_self');
		}
		else if(errorCode == 42000)
		{
			var timeStamp = Math.floor(Date.now()/1000);
			if(typeof(Storage)!="undefined")
			{
				var emailId = document.getElementById("emailId").value;
				emailId = emailId.toUpperCase();
				localStorage.setItem("user",emailId);
				localStorage.setItem("timestamp",timeStamp);
				window.open("welcome.php","_self");
			}
		}
	}
}