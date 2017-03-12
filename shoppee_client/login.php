<?php


  $_SESSION[email2] = $_POST['email1'];
  $_SESSION[password2] = $_POST['password1'];
  if(!($_SESSION[email2]))
  {
    header("Location: index.php");
  }
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname="shoppingassist";
   
 
  $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  if (!$link) 
  {
      die('Could not connect: ' . mysqli_error());
  }
  $sql=mysqli_query($link,"SELECT fullName,emailId,password FROM client_reg_table WHERE emailId='$_SESSION[email2]' AND password='$_SESSION[password2] '");
  if((mysqli_num_rows($sql))>=1)
  {
        
        $successValue = array("statusCode" => "0",
                              "errorCode" => "42001",
                              "statusText" => "SUCCESS");
                              $returnValue = json_encode($successValue);
                              ob_clean();
                              echo $returnValue;
  }
  else
  {
      
        $successValue = array("statusCode" => "0",
                              "errorCode" => "42002",
                              "statusText" => "FAILURE");
                              $returnValue = json_encode($successValue);
                              ob_clean();
                              echo $returnValue;
     
  }

?>