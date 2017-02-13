function doDelete()
{
	var status = document.getElementById("status");
	var gmailid= localStorage.getItem("loggedInUser");
	var dataString ='&gmailId1='+gmailid;
	

	$.ajax({
			type: "POST",
			url: "deleteOffers.php",
			data: dataString,
			cache: false,
			success: function(responseText) 
			{
								var returnValue =responseText;
						returnValue = returnValue.replace("{","");
						returnValue = returnValue.replace("}","");
						returnValue = returnValue.replace(/["]/g,"");
						
						var arr = new Array();
						var title1 = new Array();
						arr=returnValue.split(",")
						statusCode = arr[0].split(":");
						statusCode = statusCode[1];
						errorCode = arr[1].split(":");
						errorCode = errorCode[1];
						statusText = arr[2].split(":");
						statusText = statusText[1];
						for (i = 3; i < arr.length-1; i++) 
						{
							title=arr[i].split(":");
							title1[i]=title;
						}




						
		
						if(errorCode == 42001)
						{   
							
							status.innerHTML = "Can't open your uploaded offers.!";
							
						}
						else if(errorCode == 42002)
						{

							localStorage.setItem("title", title1);
							window.open("deleteWelcome.php",'_self');
						}

			}
					
		
		});
	
	return false;

}