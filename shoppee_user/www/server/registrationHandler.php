<?php
    //This file provides API to clent registration
    header('Access-Control-Allow-Origin: *');
    session_start();

    //clear the logTable
    include_once("dropLogTable.php");
    //connect to file to write the log file
    include_once("writeLogTable.php");
    //clear the data of logTable
    dropDataOfLogFile();
    writeToLog("Client registration handler");

    class Register
    {
        //member variables
        var $mStrFirstName;
        var $mStrLastName;
        var $mStrPhoneNumber;
        var $mStrEmailId;
        var $mStrToken;
        var $mStrPassword;
        var $mStrConfirmPassword;
        var $mStrTimeStamp;

        //Function to set values to the variables
        function setValues($firstName,$lastName,$phoneNumber,$emailId,$password,$confirmPassword,$currentTimeStamp)
        {
            writeToLog("setting the values");
            $this->mStrFirstName = $firstName;
            $this->mStrLastName = $lastName;
            $this->mStrPhoneNumber = $phoneNumber;
            $this->mStrEmailId = $emailId;
            $this->mStrPassword = $password;  
            $this->mStrConfirmPassword = $confirmPassword; 
            $this->mStrTimeStamp = $currentTimeStamp;       
        }

        //Function to check mandatory arguments
        function checkMandatoryArguments()
        {
            if($this->mStrFirstName == "" || $this->mStrFirstName == null)
                return false;
            else if($this->mStrEmailId == "" || $this->mStrEmailId == null)
                return false;
            else if($this->mStrPassword == "" || $this->mStrPassword == null)
                return false;
            else if($this->mStrConfirmPassword == "" || $this->mStrConfirmPassword == null)
                return false;
            else
                return true;
        }

        //Function to check mandatory arguments
        function checkInvalidArguments()
        {
            if(filter_var($this->mStrEmailId, FILTER_VALIDATE_EMAIL))
            {
                if($this->mStrPassword == $this->mStrConfirmPassword)
                    return true;
            }
            else
                return false;
        }

         //Function to check emailId availability
        function checkEmailIdExists()
        {
            try
            {
                $dbhost = "localhost";
                $dbuser = "root";
                $dbpass = "";
                $dbname="batabase";
   
                $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
                if (!$link) 
                {
                    mysqli_close($link);
                    return false;
                }
                else
                {
                    mysqli_close($link);
                    $query = mysqli_query($link,"insert into sample(name, email, password, contact) values ('$name2', '$email2', '$password2',$contact2)"); //Insert Query
                    return true;
                }



                $con = new mongo("localhost");
                //connect to Database
                $db = $con->medha;
                $collection = new MongoCollection($db,'clientRegistrationTable');
                $checkQuery = array("emailId" => $this->mStrEmailId);
                $collection = $collection->find($checkQuery)->count();
                if($collection != 0)
                {
                    writeToLog("returning true from email availability");
                    //close the connection
                    $con -> close();
                    return true;
                }
                else
                {
                    writeToLog("returning false from email availability");
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

        //function to check the registration
        function checkUserRegistration()
        {
            writeToLog("trying to register the user");
            //generate a token to identify the user during activation
            $this->mStrToken = $this->getGUID();
            //create a timestamp to keep track of user registration
            $date = date('m/d/Y h:i:s a', time());
            $timestamp = strtotime($date);

            //set the activationStatus to zero
            $activationStatus = "0";
            //try to get the connection for database
            try
            {
                $con = new Mongo("localhost");
                //connect to the database
                $db = $con->medha;
                // a new registration collection object
                $collection = $db->clientRegistrationTable;

                //create an array to store the registration data
                $registrationData = array("firstName" => $this->mStrFirstName,
                                    "lastName" => $this->mStrLastName,
                                    "phoneNumber" => $this->mStrPhoneNumber,
                                    "emailId" => $this->mStrEmailId,
                                    "password" => $this->mStrPassword,
                                    "confirmPassword" => $this->mStrConfirmPassword,
                                    "token" => $this->mStrToken,
                                    "activationStatus" => $activationStatus,
                                    "interestedCatagories" => "",
                                    "timestamp" => $timestamp);
                // insert the data
                $collection->insert($registrationData);

                //check if the registration is done successfully
                if($registrationData['_id'] == "" || $registrationData['_id'] == null)
                {
                    //close the connection to database and return
                    $con->close();
                    return false;
                }   
                else
                {
                    //send the activation link to the regstered mail id
                    // along with a token
                    writeToLog("Calling send mail-->");
                    $con->close();
                    return true;

                    /* $flagActivationMail = $this->sendActivationMail();
                    if($flagActivationMail == false)
                    {
                         //write to log
                        writeToLog("Could not send activation mail");
                        $con->close();
                        return false;
                    }
                    else
                    {
                        //write to log
                        writeToLog("Activation mail sent successfully");
                        //close the connection to database and return
                        $con->close();
                        return true;
                    } */
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

        //function to send the activation mail
        function sendActivationMail()
        {
            writeToLog("send activation mail-->");
            dirname(__FILE__)."Mail.php";
            dirname(__FILE__)."mime.php";
           
            writeToLog("included header files");
            $from = "no_reply@vivikta.in";
            $to = $this->mStrEmailId;
       
            //configure the mail
            $subject = "From MeDHA Platform: Activate Account";
            $html = "<!DOCTYPE html>
                    <html>
                    <body>
                    <h3>Use the below link to activate the account and to create a new password</h3>
                    <p><a href=http://localhost/medha/createPassword.php?token=".$this->mStrToken;
            $html .= ">Click Here</a></p>
                    </body>
                    </html>";
            $crlf = "\n";
            // create a new Mail_Mime for use
            $mime = new Mail_mime($crlf); 
            // define body for Text only receipt
            $mime->setTXTBody($text); 
            // define body for HTML capable recipients
            $mime->setHTMLBody($html);
            $host = "www.vivikta.in";
            $username = "no_reply@vivikta.in"; 
            $password = "Junkcrap123";
            $headers = array ('From' => $from,
                            'To' => $to,
                            'Subject' => $subject);
            $smtp = Mail::factory('smtp',array ('host' => $host,
                                        'auth' => true,
                                        'username' => $username,
                                        'password' => $password));
            $body = $mime->get();
            $headers = $mime->headers($headers); 
            $mail = $smtp->send($to, $headers, $body);
            if (PEAR::isError($mail)) 
            {
                return false;
            } 
            else 
            {
                return true;
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
                mt_srand((double)microtime()*10000);
                $charid = strtoupper(md5(uniqid(rand(), true)));
                $hyphen = chr(45);// "-"
                $uuid = chr(123)// "{"
                    .substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12)
                    .chr(125);// "}"
                writeToLog("GUID is: ".$uuid);
                return $uuid;
            }
        }
        //function to login
        function loginUser()
        {
            //try to connect to database
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
    //end of class
    }

    //instatiate the class
    $registerUser = new Register;

     //fetch the values
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $emailId = $_POST['emailId'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $currentTimeStamp = $_POST['currentTimeStamp'];

    //set the values for each field
    $registerUser->setValues($firstName,$lastName,$phoneNumber,$emailId,$password,$confirmPassword,$currentTimeStamp);

    //write to log
    writeToLog("Checking Mandatory Arguments --->");
    //check for mandatory arguments
    $flagMandatoryArguments = $registerUser->checkMandatoryArguments();
    if($flagMandatoryArguments == false)
    {
        writeToLog("Mandatory arguments not met");
        //send failure status
        $successValue = array("statusCode" => "0",
                            "errorCode" => "42001",
                            "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    else
    {
         //write to log
        writeToLog("Checking Invalid Arguments --->");
        //check for invalid arguments
        $flagInvalidArguments =$registerUser-> checkInvalidArguments();
        if($flagInvalidArguments == false)
        {
            writeToLog("invalid arguments");
            //send failure status
             $successValue = array("statusCode" => "0",
                                "errorCode" => "42002",
                                "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
         else
        {
            //write to log
            writeToLog("Checking Email Id --->".$emailId);
            //check if the emailId exists
            $flagEmailIdExists = $registerUser->checkEmailIdExists();
            if($flagEmailIdExists == true)
            {
                //send failure status
                $successValue = array("statusCode" => "0",
                                    "errorCode" => "42004",
                                    "statusText" => "FAILURE");
                $returnValue = json_encode($successValue);
                ob_clean();
                echo $returnValue;
            }
            else
            {
                //write to log
                writeToLog("trying to register --->");
                //try to register the user
                $flagUserRegistration = $registerUser->checkUserRegistration();
                if($flagUserRegistration == false)
                {
                    //send failure status (database error)
                    $successValue = array("statusCode" => "0",
                                        "errorCode" => "42003",
                                        "statusText" => "FAILURE");
                    $returnValue = json_encode($successValue);
                    ob_clean();
                    echo $returnValue;
                }
                else
                {
                    //insert data into login table.
                    $flagUserLoginStatus = $registerUser->loginUser();
                    if($flagUserLoginStatus == false)
                    {
                        //send failure status login failed
                        $successValue = array("statusCode" => "0",
                                        "errorCode" => "42005",
                                        "statusText" => "FAILURE");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue;
                    }
                    else
                    {
                        $_SESSION['emailId'] = $emailId;
                        //send success status
                        $successValue = array("statusCode" => "0",
                                            "errorCode" => "42000",
                                            "statusText" => "SUCCESS");
                        $returnValue = json_encode($successValue);
                        ob_clean();
                        echo $returnValue; 
                    }
                }
            }
        }
    }
?>