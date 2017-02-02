<?php
    //this file provides api to Fetch Client Details
    session_start();
    header('Access-Control-Allow-Origin: *');

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
            try
            {
                $con = new mongo("localhost");
                //connect to Database
                $db = $con->medha;
                $collection = new MongoCollection($db,'clientRegistrationTable');
                $checkQuery = array("emailId" => $this->mStrEmailId);
                $cursor = $collection->find($checkQuery);
                if($cursor)
                {
                    foreach($cursor as $doc)
                    {
                        $this->mStrFirstName = $doc['firstName'];
                        $this->mStrLastName = $doc['lastName'];
                        $this->mStrPhoneNumber = $doc['phoneNumber'];
                        $this->mStrInterestedCategories = $doc['interestedCategories'];
                    }
                    $con -> close();
                    return true;
                }
                else
                {
                    //close the connection
                    $con -> close();
                    return false;
                }
            }
            catch ( MongoConnectionException $e )
            {
                // if there was an error,catch the exception
                echo $e->getMessage();
            }
            catch ( MongoException $e )
            {
                echo $e->getMessage();
            }
        }
    //end of class
    }

    //instatiate the class
    $clientDetails = new Details;
    //Fetch values
    $emailId = $_SESSION['emailId'];
    
    //Set values to variables
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




                    