<?php
    //this file provides api to Fetch Client Details
    header('Access-Control-Allow-Origin: *');
    session_start();
    class Details
    {
        //member variables
        var $mStrEmailId;
        var $mStrFirstName;
        var $mStrLastName;
        var $mStrPhoneNumber;
        var $mStrInterestedCategories;
        //Set values to varibles
        function setValues($emailId)
        {
            $this->mStrEmailId = $emailId; 
        }

        //Check Mandatory Arguments
        function checkMandatoryArguments()
        {
            if($this->mStrEmailId == "" || $this->mStrEmailId == null)
                return false;
            else 
                return true;
        }

        //Function to fetch client details
        function fetchDetails()
        {
            
            $link = mysqli_connect("localhost","root","","shoppingAssist");
            if (!$link) 
            {
                mysqli_close($link);
                return true;
            }
            else
            {
                $query = "SELECT * FROM user_reg_table WHERE emailId = '$this->mStrEmailId'";
                $result = $link->query($query);

                if($result->num_rows > 0)
                {
                    foreach($result as $doc)
                    {
                        $this->mStrFirstName = $doc['firstName'];
                        $this->mStrLastName = $doc['lastName'];
                        $this->mStrPhoneNumber = $doc['phone'];
                        $this->mStrInterestedCategories = $doc['interestedCategories'];
                    }
                    
                    return true;
                }
                else
                {
                    //close the connection
                    return false;
                }
            }
            
        }
    //end of class
    }

    //instatiate the class
    $clientDetails = new Details;
    //Fetch values
    //$emailId = $_SESSION['emailId'];
    $emailId = $_POST['emailId'];
    $clientDetails->setValues($emailId);
    $flagMandatoryArguments = $clientDetails->checkMandatoryArguments();
    if($flagMandatoryArguments == false)
    {
        //send failure status
        $successValue = array("statusCode" => "0",
                        "errorCode" => "43001",
                        "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    else
    {
        $flagFetchDetails = $clientDetails->fetchDetails();
        if($flagFetchDetails == false)
        {
            //send failure status
            $successValue = array("statusCode" => "0",
                            "errorCode" => "43003",
                            "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
        else
        {
            $successValue = array("statusCode" => "0",
                            "errorCode" => "43000",
                            "statusText" => "SUCCESS",
                            "data" => array("firstName" => $clientDetails->mStrFirstName,
                                            "lastName" => $clientDetails->mStrLastName,
                                            "emailId" => $clientDetails->mStrEmailId,
                                            "phoneNumber" => $clientDetails->mStrPhoneNumber,
                                            "interestedCategories" => $clientDetails->mStrInterestedCategories));
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;   
        }
    }
?>                




                    