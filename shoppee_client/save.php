<?php


$description2 = $_POST['description1'];
$DetailedDescription2 = $_POST['DetailedDescription1'];
$category2 = $_POST['category1'];
$startDate2 = $_POST['startDate1'];
$endDate2 = $_POST['endDate1'];
$adLocation = $_POST['adLocation'];
$adGUID = '123456';

$dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "";
   $dbname="shoppingassist";
   
 
 $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (!$link) {
    die('Could not connect: ' . mysqli_error());
     $successValue = array("statusCode" => "0",
                                        "errorCode" => "42004",
                                        "statusText" => "FAILURE");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue;
}
//echo 'Connected successfully';

else
  
  {
     //$query = mysqli_query($link,"insert into advertisementtable (adDescription,adCategory,adGUID,adLocation,adOwner,adStartDate,adEndDate,adHighlights,addDetailedDescription) values ('$description2 ', '$category2','123456789','10,12','jayashree','$startDate2','$endDate2','hello','$DetailedDescription2')");
     $query = mysqli_query($link,"insert into advertisementtable (adDescription,adCategory,adStartDate,adEndDate,addDeatailedDescription,adLocation,adGUID) values ('$description2','$category2','$startDate2','$endDate2','$DetailedDescription2','$adLocation','$adGUID')");
     if(!$query)
     {
      echo("error");
     } //Insert Query
     $successValue = array("statusCode" => "0",
                                        "errorCode" => "42000",
                                        "statusText" => "FAILURE");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue;
     
  }
//mysqli_close($link); // Connection Closed
?>