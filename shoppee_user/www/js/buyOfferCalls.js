function buyOffer()
{
	var url = window.location.href;

	//split the URL and fetch all the details
	var adDetails = url.split("?");
	adDetails = adDetails[1];
	//Fetch interested categories
	var adGUID = adDetails.split("=");
	adGUID = adGUID[1];

	window.open("../templates/buyOffer.php?adGUID="+adGUID,"_self");
}