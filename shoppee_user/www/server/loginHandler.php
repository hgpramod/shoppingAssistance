<?php
    //File provides API to client login
    session_start();
    header('Access-Control-Allow-Origin: *');
    
    class Login
    {
        //member variables
        var $mStrEmailId;
        var $mStrPassword;

        //assining values to variables
        function setValues($aemailId,$aPassword)
        {
            $this->mStrEmailId = $aemailId; 
            $this->mStrPassword = $aPassword;
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
                $query = "SELECT * FROM user_reg_table WHERE emailId = '$this->mStrEmailId' and password='$this->mStrPassword'";
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
    //end of class
    }
    //instantiate the class
    $loginUser = new Login;

    //fetch values from client
    $emailId = $_POST['emailId'];
    $password = $_POST['password'];

    $loginUser->setValues($emailId,$password);

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
?>