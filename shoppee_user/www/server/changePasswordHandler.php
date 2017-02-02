<?php
	//this file provides API to change user password
	header('Access-Control-Allow-Origin: *');
	session_start();
	//clear the logTable
    include_once("dropLogTable.php");
    //connect to file to write the log file
    include_once("writeLogTable.php");
    //clear the data of logTable
    dropDataOfLogFile();
    writeToLog("Password change handler");
	class UpdatePassword
	{
		//member variables
		var $mStrEmailId;
		var $mStrCurrentPassword;
		var $mStrPassword;
		var $mStrConfirmPassword;

		//Funnction to set values to variables
		function setValues($emailId,$currentPassword,$password,$confirmPassword)
		{
			$this->mStrEmailId = $emailId;
			$this->mStrCurrentPassword = $currentPassword;
			$this->mStrPassword = $password;
			$this->mStrConfirmPassword = $confirmPassword;
		}

		//Function to check mandatory arguments
		function checkMandatoryArguments()
		{
			if($this->mStrCurrentPassword == "" || $this->mStrCurrentPassword == null)
				return false;
			else if($this->mStrPassword == "" || $this->mStrPassword == null)
				return false;
			else if($this->mStrConfirmPassword == "" || $this->mStrConfirmPassword == null)
				return false;
			else
				return true;
		}
		//
		function checkInvalidArguments()
		{
			if($this->mStrPassword != $this->mStrConfirmPassword)
				return false;
			else
				return true;
		}

		//Function to check password
		function checkPassword()
		{
			try
			{
				$con = new Mongo("localhost");
	            //connect to the database
	            $db = $con->medha;
	            $collection = new MongoCollection($db,'clientRegistrationTable');
	            //Update the Database
	            $checkQuery = array("emailId" => $this->mStrEmailId,
                                    "password" => $this->mStrCurrentPassword);
                $cursor = $collection->find($checkQuery)->count();
                if($cursor == 1)
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
		//Function to check EmailId
		function checkEmail()
		{
			if($this->mStrEmailId == "" || $this->mStrEmailId == null)
				return false;
			else
				return true;
		}

		//Function to Update Password
		function changePassword()
		{
			try
			{
				$con = new Mongo("localhost");
	            //connect to the database
	            $db = $con->medha;
	            $collection = new MongoCollection($db,'clientRegistrationTable');
	            //Update the Database
	            $newData = array('$set' => array("password" => $this->mStrPassword,
	            								 "confirmPassword" => $this->mStrConfirmPassword));
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
	//End of class UpdatePassword	
	}

	//instantiate the class
	$updateClientPassword = new UpdatePassword;

	//Fetch the parameters
	$emailId = $_SESSION['emailId'];
	$currentPassword = $_POST['currentPassword'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];

	//Set the values to variables
	$updateClientPassword->setValues($emailId,$currentPassword,$password,$confirmPassword);

	//check mandatory arguments
	$flagCheckMandatoryArguments = $updateClientPassword->checkMandatoryArguments();
	if($flagCheckMandatoryArguments == false)
	{
		//send failure status
		$successValue = array("statusCode" => "0",
							  "errorCode" => "47001",
							  "statusText" => "FAILURE");
		$outstr = json_encode($successValue);
		ob_clean();
		echo $outstr;
	}
	else
	{
		//Check invalid arguments
		$flagCheckInvalidArguments = $updateClientPassword->checkInvalidArguments();
		if($flagCheckInvalidArguments == false)
		{
			//send failure status
			$successValue = array("statusCode" => "0",
							  "errorCode" => "47002",
							  "statusText" => "FAILURE");
			$outstr = json_encode($successValue);
			ob_clean();
			echo $outstr;
		}
		else
		{
			$flagCheckPassword = $updateClientPassword->checkPassword();
			if($flagCheckPassword == false)
			{
				//send failure status
				$successValue = array("statusCode" => "0",
								  "errorCode" => "47004",
								  "statusText" => "FAILURE");
				$outstr = json_encode($successValue);
				ob_clean();
				echo $outstr;
			}
			else
			{
				//update old password with new password
				$flagCheckUpdatePassword = $updateClientPassword->changePassword();
				if($flagCheckUpdatePassword == false)
				{
					//send failure status
					$successValue = array("statusCode" => "0",
									  "errorCode" => "47003",
									  "statusText" => "FAILURE");
					$outstr = json_encode($successValue);
					ob_clean();
					echo $outstr;
				}
				else
				{
					//send succes status
					$successValue = array("statusCode" => "0",
									  "errorCode" => "47000",
									  "statusText" => "SUCCESS");
					$outstr = json_encode($successValue);
					ob_clean();
					echo $outstr;
				}
			}
		}
	}
?>
