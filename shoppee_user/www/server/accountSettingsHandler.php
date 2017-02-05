<?php
	//This file provides Client Account Update API
	header('Access-Control-Allow-Origin: *');
	session_start();

    class UpdateAccount
    {
    	//member variables
    	var $mStrFirstName;
    	var $mStrLastName;
    	var $mStrPhoneNumber;
    	var $mStrEmailId;
    	var $mStrInterestedCategories;

    	//Function to set values to variables
   		function setValues($firstName,$lastName,$phoneNumber,$emailId,$interestedCategories)
    	{
    		$this->mStrFirstName = $firstName;
    		$this->mStrLastName  = $lastName;
    		$this->mStrPhoneNumber = $phoneNumber;
    		$this->mStrEmailId = $emailId;
    		$this->mStrInterestedCategories = $interestedCategories;
    	}
    	//function to check mandatory arguments
		function checkMandatoryArguments()
		{
			if($this->mStrFirstName == "" ||  $this->mStrFirstName == null)
				return false;
			else if($this->mStrPhoneNumber == "" || $this->mStrPhoneNumber == null)
				return false;
			else if($this->mStrInterestedCategories == "" || $this->mStrInterestedCategories == null)
				return false;
			else
				return true;
		}
		
		//function to update the Client info
		function updateClientInfo()
		{
			
			$link = mysqli_connect("localhost","root","","shoppingAssist");
            if (!$link) 
            {
                mysqli_close($link);
                return false;
            }
            else
            {
                $query = "UPDATE user_reg_table SET firstName='$this->mStrFirstName', lastName = '$this->mStrLastName', phone = '$this->mStrPhoneNumber',interestedCategories = '$this->mStrInterestedCategories'  WHERE emailId = '$this->mStrEmailId'";
                $result = $link->query($query);

                if($result)
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
    //end of class UpdateAccount
    }

    //instantiate the class
	$updateClientAccount = new UpdateAccount;
	//fetch the GET parameters
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phoneNumber = $_POST['phoneNumber'];
	$emailId = $_POST['emailId'];
	$interestedCategories = $_POST['interestedCategories'];
	
	//set the values
	$updateClientAccount->setValues($firstName,$lastName,$phoneNumber,$emailId,$interestedCategories);
    //check for mandatory arguments
	$flagMandatoryArguments = $updateClientAccount->checkMandatoryArguments();
	if($flagMandatoryArguments == false)
	{
		//send failure status
		$successValue = array("statusCode" => "0",
							  "errorCode" => "43001",
							  "statusText" => "FAILURE");
		$outstr = json_encode($successValue);
		ob_clean();
		echo $outstr;
	}
	else
	{	
		//update the Client Details in RegistrationTable
		$flagUpdateInfoStatus = $updateClientAccount->updateClientInfo();
		if($flagUpdateInfoStatus == false)
		{
			//send failure status
			$successValue = array("statusCode" => "0",
								  "errorCode" => "43003",
								  "statusText" => "FAILURE");
				$outstr = json_encode($successValue);
				ob_clean();
				echo $outstr;
		}
		else
		{
			//send success status
			$successValue = array("statusCode" => "0",
								  "errorCode" => "43000",
								  "statusText" => "SUCCESS");
			$outstr = json_encode($successValue);
			ob_clean();
			echo $outstr;
		}
	}
?>