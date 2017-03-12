<?php
  
  $emailId1=$_POST['emailId'];
  $adGUID1=$_POST['adGUIDForUpdate'];

  $mStrAdId;
  $mStrAdDescription;
  $mStrAdGUID;
  $mStrAdCategory;
  $mStrAdStartDate;
  $mStrAdEndDate;
  $mStrAddDeatailedDescription;

  if($emailId1 == "" || $emailId1 == null)
  {
    $successValue = array("statusCode" => "0",
                            "errorCode" => "42003",
                            "statusText" => "FAILURE");
      $returnValue = json_encode($successValue);
      ob_clean();
      echo $returnValue;
  }
  if($adGUID1 == "" || $adGUID1 == null)
  {
    $successValue = array("statusCode" => "0",
                            "errorCode" => "42004",
                            "statusText" => "FAILURE");
      $returnValue = json_encode($successValue);
      ob_clean();
      echo $returnValue;
  }

  $link = mysqli_connect("localhost","root","","shoppingassist");
  if (!$link) 
  {
      die('Could not connect: ' . mysqli_error());
      $successValue = array("statusCode" => "0",
                            "errorCode" => "42000",
                            "statusText" => "FAILURE",
                            "adGUID" => $adGUID1);
      $returnValue = json_encode($successValue);
      ob_clean();
      echo $returnValue;
  }
  else
  {
        $query = "SELECT * FROM advertisementtable WHERE adGUID='$adGUID1'";
        $result = $link->query($query);

        if($result->num_rows > 0)
        {
            foreach($result as $doc)
            {   
                    $mStrAdId = $doc['adId'];
                    $mStrAdDescription = $doc['adDescription'];
                    $mStrAdGUID = $doc['adGUID'];
                    $mStrAdCategory=$doc['adCategory'];
                    $mStrAdStartDate=$doc['adStartDate'];
                    $mStrAdEndDate=$doc['adEndDate'];
                    $mStrAddDeatailedDescription=$doc['mStrAddDeatailedDescription'];

            }
            $successValue = array("statusCode" => "0",
                                "errorCode" => "42001",
                                "statusText" => "SUCCESS",
                                "data" => array("adId" => $mStrAdId,
                                                "adDescription" => $mStrAdDescription,
                                                "adGUID" => $mStrAdGUID,
                                                "adCategory" => $mStrAdCategory,
                                                "adStartDate" => $mStrAdStartDate,
                                                "adEndDate" => $mStrAdEndDate,
                                                "mStrAddDeatailedDescription" => $mStrAddDeatailedDescription));
                                                
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