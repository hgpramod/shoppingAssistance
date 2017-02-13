<?php
// Fetching Values From URL

$email2 = $_POST['email1'];
$password2 = $_POST['password1'];


$dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "";
   $dbname="shoppingassist";
   
 
 $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (!$link) {
    die('Could not connect: ' . mysqli_error());
}
//echo 'Connected successfully';

$sql=mysqli_query($link,"SELECT fullName,emailId,password FROM client_reg_table WHERE emailId='$email2' AND password='$password2'");
 if((mysqli_num_rows($sql))>=1)
   {
    
    $successValue = array("statusCode" => "0",
                                        "errorCode" => "42001",
                                        "statusText" => "FAILURE");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue;


     
   }
   else
  {
      //Insert Query
     $successValue = array("statusCode" => "0",
                                        "errorCode" => "42002",
                                        "statusText" => "FAILURE");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue;
     
  }
//mysqli_close($link); // Connection Closed
?>