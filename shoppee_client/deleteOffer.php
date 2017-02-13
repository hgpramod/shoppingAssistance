<?php
  $emailId=$_POST['emailId'];
  //$emailId = "a@b.co";
  $mStrAdGUID=$_POST['adGUID'];

  $link = mysqli_connect("localhost","root","","shoppingAssist");
  if (!$link) 
  {
      die('Could not connect: ' . mysqli_error());
      $successValue = array("statusCode" => "0",
                            "errorCode" => "43001",
                            "statusText" => "FAILURE");
      $returnValue = json_encode($successValue);
      ob_clean();
      echo $returnValue;
  }
  else
  {
    $query = "DELETE FROM advertisementTable WHERE adOwner = '$emailId' and adGUID='$mStrAdGUID'";
    $result = $link->query($query);
    $successValue = array("statusCode" => "0",
                          "errorCode" => "43000",
                          "statusText" => "SUCCESS");
    $returnValue = json_encode($successValue);
    ob_clean();
    echo $returnValue;         
  }
?>