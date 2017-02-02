<?php
	//This file provides API to Client Logout
	header('Access-Control-Allow-Origin: *');
	session_start();
	$emailId = $_SESSION['emailId'];
	if($emailId == ''||$emailId == null)
	{
		$successValue = array("statusCode" => "0",
                              "errorCode" => "46001",
                              "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue; 
	}
	unset($_SESSION['emailId']);
	session_destroy();
	$flagClearLoginData = clearLoginData($emailId);
	if($flagClearLoginData == true)
	{
		$successValue = array("statusCode" => "0",
                              "errorCode" => "46000",
                              "statusText" => "SUCCESS");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue; 
	}
	else
	{
		$successValue = array("statusCode" => "0",
                              "errorCode" => "46003",
                              "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue; 
	}
	//Clear login data from login Table
	function clearLoginData($emailId)
	{
		//Try to Connect Database
		try
		{
			$con = new Mongo("localhost");
			//connect to the database
			$db = $con->medha;
			echo "<script> window.alert($emailId) </script>";
			$collection = new MongoCollection($db,'clientLoginTable');
			$collection = $collection->remove(array("emailId"=>$emailId));
			if($collection != 0)
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
?>