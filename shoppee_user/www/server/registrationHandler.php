<?php
    //This file provides API to clent registration
    header('Access-Control-Allow-Origin: *');
    session_start();

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
            //writeToLog("setting the values");
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
                    mysqli_close($link);
                    return true;
                }
                else
                {
                    mysqli_close($link);
                    return false;
                }
                
            }         
        }

        function userRegistration()
        {
            $dbhost = "localhost";
            $dbuser = "root";
            $dbpass = "";
            $dbname="shoppingAssist";

            $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
            if (!$link) 
            {
                mysqli_close($link);
                return false;
            }
            else
            {
                $query = mysqli_query($link,"insert into user_reg_table(firstName, lastName, emailId, phone,password) values ('$this->mStrFirstName', '$this->mStrLastName', '$this->mStrEmailId','$this->mStrPhoneNumber','$this->mStrPassword')");
                mysqli_close($link);
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
                return $uuid;
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

    $flagMandatoryArguments = $registerUser->checkMandatoryArguments();
    if($flagMandatoryArguments == false)
    {
        $successValue = array("statusCode" => "0",
                            "errorCode" => "42001",
                            "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    else
    {
        $flagInvalidArguments =$registerUser-> checkInvalidArguments();
        if($flagInvalidArguments == false)
        {
             $successValue = array("statusCode" => "0",
                                "errorCode" => "42002",
                                "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
         else
        {
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
                $flagUserRegistration = $registerUser->userRegistration();
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
                    //$flagUserLoginStatus = $registerUser->loginUser();
                    $flagUserLoginStatus = true;
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