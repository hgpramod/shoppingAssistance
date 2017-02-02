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
			try
        	{
	            $con = new Mongo("localhost");
	            //connect to the database
	            $db = $con->medha;
	            $collection = new MongoCollection($db,'clientRegistrationTable');
	            
	            //Update the Database
	            $newData = array('$set' => array("firstName" => $this->mStrFirstName,
	            								"lastName" => $this->mStrLastName,
	            								"phoneNumber" => $this->mStrPhoneNumber,
	            								"interestedCategories" => $this->mStrInterestedCategories));
	            $collection = $collection->update(array("emailId"=>$this->mStrEmailId),$newData);
	            if($collection)
	            {
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
    //end of class UpdateAccount
    }

    //instantiate the class
	$updateClientAccount = new UpdateAccount;
	//fetch the GET parameters
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phoneNumber = $_POST['phoneNumber'];
	$emailId = $_SESSION['emailId'];
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