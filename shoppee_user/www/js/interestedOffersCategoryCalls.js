//This file provides API to fetch offers based on interest
function interestedOffers()
{
  if(categoryArray == "")
  {
    alert("Please select a Category");
  }
  else
  {
    window.open("../templates/interestedOffers.php?interestedCategories="+categoryArray,"_self");   
  }
}