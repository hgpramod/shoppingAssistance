//login to client 
var currentTimeStamp = Math.floor(Date.now()/1000);

function doLogin () 
{
	var emailId = document.getElementById("emailId").value;
	var password = document.getElementById("password").value;	
	emailId = emailId.toUpperCase();
	//validate fields
	if(emailId == "" || emailId == null)
	{
		document.getElementById("emailId").style.border='1px solid red';
	}
	else if(password == "" || password == null)
	{
		document.getElementById("password").style.border='1px solid red';
	}
	else
	{
		window.open("welcome.php","_self");
		//make asynchronous call to server and send user data
		xhrDoLogin = new XMLHttpRequest();
		xhrDoLogin.onreadystatechange = processLogin;
		xhrDoLogin.open("POST",baseUrl+"/loginHandler.php",true);
		xhrDoLogin.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhrDoLogin.send("emailId="+emailId+"&password="+password+"&timeStamp="+currentTimeStamp);
	}
}
//function to handle the login
function processLogin()
{
	var loginStatus = document.getElementById("loginStatus");
	if(xhrDoLogin.readyState == 4 && xhrDoLogin.status == 200)
	{
		var returnValue = xhrDoLogin.responseText;
		returnValue = returnValue.replace("{","");
		returnValue = returnValue.replace("}","");
		returnValue = returnValue.replace(/["]/g,"");
		window.open("welcome.php","_self");
		var arr = new Array();
		arr=returnValue.split(",")
		statusCode = arr[0].split(":");
		statusCode = statusCode[1];
		errorCode = arr[1].split(":");
		errorCode = errorCode[1];
		statusText = arr[2].split(":");
		statusText = statusText[1];
		
		if(errorCode == 41001)
		{
			loginStatus.innerHTML = "Mandatory Fields cannot be blank";
		}
		else if(errorCode == 41002)
		{
			loginStatus.innerHTML = "Invalid Values";
		}
		else if(errorCode == 41003)
		{
			loginStatus.innerHTML = "Database Error";
		}
		else if(errorCode == 41004)
		{
			loginStatus.innerHTML = "EmailId and Password Doesnot Match ";
		}
		else if(errorCode == 41000)
		{
			if(typeof(Storage)!="undefined")
			{
				var emailId = document.getElementById("emailId").value;
				emailId = emailId.toUpperCase();
				localStorage.setItem("user",emailId);
				localStorage.setItem("timestamp",currentTimeStamp);
				window.open("welcome.php","_self");
			}
		}
		else
		{
			loginStatus.innerHTML = "Unknown error";
		}
	}
}