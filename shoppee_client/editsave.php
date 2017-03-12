<?php


$description2 = $_POST['description1'];
$DetailedDescription2 = $_POST['DetailedDescription1'];
$category2 = $_POST['category1'];
$startDate2 = $_POST['startDate1'];
$endDate2 = $_POST['endDate1'];
$adLocation = $_POST['adLocation'];
$emailid = $_POST['emailId1'];
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
    
     $query = mysqli_query($link,"UPDATE advertisementtable SET adDescription='$description2',adCategory='$category2',adGUID='$adGUID',adLocation='$adLocation',adStartDate='$startDate2',adEndDate='$endDate2',addDeatailedDescription='$DetailedDescription2'
WHERE adOwner='$emailid' AND adDescription='$description2'");
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