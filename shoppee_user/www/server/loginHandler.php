<?php
    //File provides API to client login
    session_start();
    header('Access-Control-Allow-Origin: *');
    //clear the logTable
    //include_once("dropLogTable.php");
    //connect to file to write the log file
    include_once("writeLogTable.php");
    //clear the data of logTable
    dropDataOfLogFile();
    writeToLog("Client registration handler");
    class Login
    {
        //member variables
        var $mStrEmailId;
        var $mStrPassword;
        var $mStrTimeStamp;

        //assining values to variables
        function setValues($aemailId,$aPassword,$currentTimeStamp)
        {
            $this->mStrEmailId = $aemailId; 
            $this->mStrPassword = $aPassword;
            $this->mStrTimeStamp = $currentTimeStamp;
        }

        //checking mandatory arguments
        function checkMandatoryArguments()
        {
            if($this->mStrEmailId == "" || $this->mStrEmailId == null)
                return false;
            else if($this->mStrPassword == "" || $this->mStrPassword == null)
                return false;
            else
                return true;
        }
        //checking invalid arguments
        function checkInvalidArguments()
        {
            //validate emailId
            if(!filter_var($this->mStrEmailId,FILTER_VALIDATE_EMAIL))
                return false;
            else
                return true;
        }

        //function to check registration status
        function checkRegistration()
        {
            //try to connect to database
            try
            {
                $con = new Mongo("localhost");
                //connect to the database
                $db = $con->medha;
                $collection = new MongoCollection($db, 'clientRegistrationTable');
                // check if the emailId alrady exists in the registrationTable
                $checkQuery = array("emailId" => $this->mStrEmailId,
                                    "password" => $this->mStrPassword);
                $cursor = $collection->find($checkQuery)->count();
                if($cursor == 0)
                {
                    //close the connection
                    $con -> close();
                    return false;
                }
                else
                {
                    //close the connection
                    $con -> close();
                    return true;
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
        //function to check login status
        function checkLogin()
        {
            //try to connect to database
            try
            {
                $con = new Mongo("localhost");
                //connect to the database
                $db = $con->medha;
                $collection = new MongoCollection($db, 'clientLoginTable');
                // update the data in login table
                $checkQuery = array("emailId" => $this->mStrEmailId);
                $cursor = $collection->find($checkQuery)->count();
                writeToLog("loginTableCursor".$cursor);
                if($cursor == 0)
                {
                    //if there is no data in login table then insert the new values
                    //try to get the connection for mongodb
                    try
                    {
                        $con = new Mongo("localhost");
                        //connect to the database
                        $db = $con->medha;
                        $collection = new MongoCollection($db, 'clientLoginTable');

                        //create a GUID (session id) for the user
                        $sessionId = $this->getGUID();
                        //create an array to store the registration data
                        $loginData = array("emailId" => $this->mStrEmailId,
                                            "sessionId" => $sessionId,
                                            "timestamp" => $this->mStrTimeStamp);
                        // insert the data
                        $collection->insert($loginData);

                        //check if the registration is done successfully
                        if($loginData['_id'] == "" || $loginData['_id'] == null)
                        {
                            //close the conenction to database and return
                            $con->close();
                            return false;
                        }   
                        else
                        {
                            //close the conenction to database and return
                            $con->close();
                            return true;
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
                else
                {
                    try
                    {
                        $con = new Mongo("localhost");
                        //connect to the database
                        $db = $con->medha;
                        $collection = new MongoCollection($db, 'clientLoginTable');

                        //create a GUID (session id) for the user
                        $sessionId = $this->getGUID();
                        //create an array to store the registration data
                        $newLoginData = array('$set'  => array("sessionId" => $sessionId,
                                                               "timestamp" => $this->mStrTimeStamp));
                        $updateCursor = $collection->update(array("emailId" => $this->mStrEmailId),$newLoginData);
                        if($updateCursor)
                        {
                            $con->close();
                            return true;
                        }               
                        else
                        {
                            $con->close();
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
        //function to create GUID
        function getGUID()
        {
            if (function_exists('com_create_guid'))
            {
                return com_create_guid();
            }
            else
            {
                mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
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

    //end of class
    }
    //instantiate the class
    $loginUser = new Login;

    //fetch values from client
    $emailId = $_POST['emailId'];
    $password = $_POST['password'];
    $currentTimeStamp = $_POST['timeStamp'];

    $loginUser->setValues($emailId,$password,$currentTimeStamp);

    $flagMandatoryStatus = $loginUser->checkMandatoryArguments();
    if($flagMandatoryStatus == false)
    {
        //send failure status
        $successValue = array("statusCode" => "0",
                            "errorCode" => "41001",
                            "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    else 
    {
        //checking invalid values
        $flagInvalidStatus = $loginUser->checkInvalidArguments();
        if($flagInvalidStatus == false)
        {
            //send failure status
             $successValue = array("statusCode" => "0",
                                "errorCode" => "41002",
                                "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
        else
        {
            $flagRegistrationStatus = $loginUser->checkRegistration();
            if($flagRegistrationStatus == false)
            {
                //send failure status
                 $successValue = array("statusCode" => "0",
                                    "errorCode" => "41004",
                                    "statusText" => "FAILURE");
                $returnValue = json_encode($successValue);
                ob_clean();
                echo $returnValue;
            }
            else
            {
                $flagLoginStatus = $loginUser->checkLogin();
                if($flagLoginStatus == false)
                {
                    //send failure status
                    $successValue = array("statusCode" => "0",
                                    "errorCode" => "41003",
                                    "statusText" => "FAILURE");
                    $returnValue = json_encode($successValue);
                    ob_clean();
                    echo $returnValue;
                }   
                else
                {
                    //create a session for the emailId
                    $_SESSION['emailId'] = $emailId;
                    //login is successful          
                    $successValue = array("statusCode" => "0",
                                        "errorCode" => "41000",
                                        "statusText" => "SUCCESS");
                    $returnValue = json_encode($successValue);
                    ob_clean();
                    echo $returnValue;      
                }       
            }
        }
    }
?>