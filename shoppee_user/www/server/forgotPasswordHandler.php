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
    writeToLog("Forgot password handler");

    class Reset
    {
        //member variables
        var $mStrEmailId;
        var $mStrPassword;

        function setValues($emailId)
        {
            writeToLog("Setting values.".$emailId);
            $this->mStrEmailId = $emailId;
        }
        function checkMandatoryArguments()
        {
            if($this->mStrEmailId == "" || $this->mStrEmailId == null)
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
        //Function to reset password
        function resetPassword()
        {
            //try to connect to database
            try
            {
                $con = new Mongo("localhost");
                //connect to the database
                $db = $con->medha;
                $collection = new MongoCollection($db, 'clientRegistrationTable');
                $checkQuery = array("emailId" => $this->mStrEmailId);
                $cursor = $collection->find($checkQuery);
                $cursorCount= $collection->find($checkQuery)->count();
                writeToLog("Resetting password,cursor".$cursorCount);
                if($cursorCount != 0)
                {
                    foreach ($cursor as $doc) 
                    {
                        $this->mStrPassword = $doc['password'];
                    }
                    writeToLog("Password:".$this->mStrPassword);
                    //close the connection
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
        //Function to send Email containing password
        function sendEmail()
        {
            
            require_once "Mail.php";
            require_once "mime.php";
           
            writeToLog("included header files");
            $from = "no_reply@vivikta.in";
            $to = $this->mStrEmailId;
                  
            //configure the mail
            $subject = "From MeDHA Client App: Reset Password ";
            $html = "<!DOCTYPE html>
                    <html>
                    <body>
                    <h3>Find The Password to Reset your Account</h3>
                    <p>Password : ".$this->mStrPassword;
            $html .= "</p>
                    </body>
                    </html>";
            $crlf = "\n";
            // create a new Mail_Mime for use
            writeToLog("new mailmime");
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
    //End of class
    }

    //instantiate class
    $passwordReset = new Reset;

    $emailId = $_POST['emailId'];

    //set values to variables
    $passwordReset->setValues($emailId);
    //check mandatory Arguments
    $flagCheckMandatoryArguments = $passwordReset->checkMandatoryArguments();
    if($flagCheckMandatoryArguments == false)
    {
        //send failure status
        $successValue = array("statusCode" => "0",
                            "errorCode" => "48001",
                            "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    else
    {
        //check invalid arguments
        $flagCheckInvalidArguments = $passwordReset->checkInvalidArguments();
        if($flagCheckInvalidArguments == false)
        {
            //send failure status
            $successValue = array("statusCode" => "0",
                                "errorCode" => "48002",
                                "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
        else
        {
            //Reset password
            $flagResetPassword = $passwordReset->resetPassword();
            if($flagResetPassword == false)
            {
                //send failure status
                $successValue = array("statusCode" => "0",
                                    "errorCode" => "48003",
                                    "statusText" => "FAILURE");
                $returnValue = json_encode($successValue);
                ob_clean();
                echo $returnValue;  
            }
            else
            {
                //send mail
                $flagSendMail = $passwordReset->sendEmail();
                if($flagSendMail == false)
                {
                    //send failure status
                    $successValue = array("statusCode" => "0",
                                        "errorCode" => "48004",
                                        "statusText" => "FAILURE");
                    $returnValue = json_encode($successValue);
                    ob_clean();
                    echo $returnValue;  
                }
                else
                {
                    //Send success status
                    $successValue = array("statusCode" => "0",
                                        "errorCode" => "48000",
                                        "statusText" => "SUCCES");
                    $returnValue = json_encode($successValue);
                    ob_clean();
                    echo $returnValue;  
                }
            }
        }
    }
?>