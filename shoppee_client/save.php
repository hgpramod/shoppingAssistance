<?php


$description2 = $_POST['description1'];
$DetailedDescription2 = $_POST['DetailedDescription1'];
$category2 = $_POST['category1'];
$startDate2 = $_POST['startDate1'];
$endDate2 = $_POST['endDate1'];
$adLocation = $_POST['adLocation'];
$emailid = $_POST['emailId1'];
$adGUID = getGUID();

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
    
     $query = mysqli_query($link,"insert into advertisementtable (adDescription,adCategory,adStartDate,adEndDate,addDeatailedDescription,adLocation,adGUID,adOwner) values ('$description2','$category2','$startDate2','$endDate2','$DetailedDescription2','$adLocation','$adGUID','$emailid')");
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

  //function to create GUID
        function getGUID()
        {
            if (function_exists('com_create_guid'))
             {
                return com_create_guid();
            }
            else
            {
                mt_srand((double)microtime()*10000);
                $charid = strtoupper(md5(uniqid(rand(), true)));
                $hyphen = chr(45);// "-"
                $uuid = chr(123)// "{"
                    .substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12)
                    .chr(125);// "}"
                return $uuid;
            }
        }
//mysqli_close($link); // Connection Closed
?>