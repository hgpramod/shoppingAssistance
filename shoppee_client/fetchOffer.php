<?php
  $emailId=$_POST['emailId'];
  //$emailId = "a@b.co";
  $mStrAdId;
  $mStrAdDescription;
  $mStrAdGUID;

  $link = mysqli_connect("localhost","root","","shoppingAssist");
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
    $query = "SELECT * FROM advertisementTable WHERE adOwner = '$emailId'";
    $result = $link->query($query);
    
    if($result->num_rows > 0)
    {
      foreach($result as $doc)
      {   
        $mStrAdId[] = $doc['adId'];
        $mStrAdDescription[] = $doc['adDescription'];
        $mStrAdGUID[] = $doc['adGUID'];
      }

      $successValue = array("statusCode" => "0",
                          "errorCode" => "42000",
                          "statusText" => "SUCCESS",
                          "data" => array("adId" => $mStrAdId,
                                          "adDescription" => $mStrAdDescription,
                                          "adGUID" => $mStrAdGUID));
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
  }
?>