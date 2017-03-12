function updateOffers()
{
	
		var emailid= localStorage.getItem("loggedInUser");

		var adGUIDForUpdate = getParameter("adGUID");
		
		var updateDataString ='&adGUIDForUpdate='+adGUIDForUpdate;
		
		$.ajax({

						type: "POST",
						url: "fetchEdit.php",
						data: updateDataString,
						cache: false,
						success: function(responseText) 
						{

									var returnValue =responseText;
									var jsonData = JSON.parse(returnValue);
						    		var statusCode = jsonData.statusCode;
						    		var errorCode = jsonData.errorCode;
						    		var statusText = jsonData.statusText;
						    		alert(responseText);
						    		var adId = jsonData.data.adId;
									var adDescription = jsonData.data.adDescription;
									var adGUID = jsonData.data.adGUID;
									var adCategory=jsonData.data.adCategory;
									var adStartDate=jsonData.data.adStartDate;
									var adEndDate=jsonData.data.adEndDate;
									var addDeatailedDescription=jsonData.data.addDeatailedDescription;
									alert(adDescription);
									
									if(errorCode == 42001)
									{  
											
											document.getElementById("description").value =adDescription;
											document.getElementById("category").value =adCategory ;
											document.getElementById("startDate").value = adStartDate;
											document.getElementById("endDate").value = adEndDate;
											document.getElementById("detail").value = addDeatailedDescription;
											//window.open("edit.html",'_self');
					
									}
									else if(errorCode == 42002)
									{
										status.innerHTML = "Can't edit offers";
										
									}
									else if(errorCode == 42003)
									{
										status.innerHTML = "Can't get emailid";
										
									}
									else if(errorCode == 42004)
									{
										status.innerHTML = "Can't get guid";
										
									}
						}
				});
	
}



