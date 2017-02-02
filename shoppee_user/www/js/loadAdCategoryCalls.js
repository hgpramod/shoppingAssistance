//function to load the categories from server
var categoryArray = new Array();
function loadCategories()
{
	//make asynchronous call to server and fetch the categories
	xhrFetchCategories = new XMLHttpRequest();
	xhrFetchCategories.onreadystatechange = processFetchedCategories;
	xhrFetchCategories.open("GET",baseUrl+"/getAdCategoriesHandler.php",true);
	xhrFetchCategories.send();
}
function processFetchedCategories()
{
	if(xhrFetchCategories.readyState == 4 && xhrFetchCategories.status == 200)
	{
		var categories = document.getElementById("categories");
		var returnValue = xhrFetchCategories.responseText;
		returnValue = returnValue.replace("{","");
		returnValue = returnValue.replace("}","");
		returnValue = returnValue.replace(/["]/g,"");

		var arr = new Array();
		arr = returnValue.split(",")
		statusCode = arr[0].split(":");
		statusCode = statusCode[1];
		errorCode = arr[1].split(":");
		errorCode = errorCode[1];
		statusText = arr[2].split(":");
		statusText = statusText[1];
		
		if(errorCode == 26003)
		{
			categories.innerHTML = "Error Loading Categories";
		}
		else if(errorCode == 26000)
		{
			data = arr[3].split(":");
			data = data[1];

			//get generic categories from data
			var fetchedCategories = data.split(";");
			var genericCategories = fetchedCategories[0].split("-");
			
			//load the generic categories
			for(var i=0;i<genericCategories.length;i++)
			{
				if(genericCategories[i] == "" || genericCategories[i] == null)
					break;
				else
				{
					var genericCategoryCheckbox = document.createElement('input');
					genericCategoryCheckbox.type = "checkbox";
					genericCategoryCheckbox.name = "adCategories[]";
					genericCategoryCheckbox.value = genericCategories[i];
					genericCategoryCheckbox.id = genericCategories[i];

					var label = document.createElement('label')
					label.htmlFor = genericCategories[i];
					label.appendChild(document.createTextNode(genericCategories[i]));

					categories.appendChild(genericCategoryCheckbox);
					categories.appendChild(label);
					var breakTag = document.createElement("br");
					categories.appendChild(breakTag);
				}
			}
			
		}
	}
}