<?php

$gmailId=$_POST['gmailId1'];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname="shoppingassist";
   
 
$link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (!$link) 
{

    die('Could not connect: ' . mysqli_error());
    $successValue = array("statusCode" => "0",
                                        "errorCode" => "42001",
                                        "statusText" => "FAILURE");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue;
}
else
{
     
            $result = mysqli_query($link,"SELECT adDescription FROM advertisementtable WHERE emailId = '$gmailId'");
            if (!$result)
             {
                echo 'Could not run query: ' . mysqli_error();
                exit;
              }
              $row=array();
              $row[] = mysqli_fetch_row($result);
              $num=mysqli_num_rows($result);
              for ($i = 1; $i <= $num; $i++)
              {
                 $row[] = mysqli_fetch_assoc($result);
                      
              }
              
              $successValue = array("statusCode" => "0",
                                                "errorCode" => "42002",
                                                "statusText" => "FAILURE",
                                                "title" => $row);
                                $returnValue = json_encode($successValue);
                                ob_clean();
                                echo $returnValue;
               
}

// $row=array();
// $row[] = mysqli_fetch_row($result);
// $num=mysqli_num_rows($result);

// for ($i = 1; $i <= $num; $i++)
// {
//    $row[] = mysqli_fetch_assoc($result);
  

// }
//  print_r($row);


?>