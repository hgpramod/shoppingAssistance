<?php
// Fetching Values From URL
$name2 = $_POST['fullname1'];
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

$sql=mysqli_query($link,"SELECT fullName,password FROM client_reg_table WHERE fullName='$name2' AND password='$password2'");
 if((mysqli_num_rows($sql))>=1)
   {
    
    $successValue = array("statusCode" => "0",
                                        "errorCode" => "42004",
                                        "statusText" => "FAILURE");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue;
     
   }
   else
  {
     $query = mysqli_query($link,"insert into client_reg_table(fullName, emailId, password) values ('$name2', '$email2', '$password2')"); //Insert Query
     $successValue = array("statusCode" => "0",
                                        "errorCode" => "42000",
                                        "statusText" => "FAILURE");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue;
     
  }
//mysqli_close($link); // Connection Closed
?>