<?php
	// this file provides API to update the timestamp when user opens the app]
	// start the session
	session_start();
	header('Access-Control-Allow-Origin: *');
	class UpdateTimestamp
	{
		//member variables
		var $mStrUsername;
		var $mIntTimestamp;

		//function to set vvalues for each field
		function setValues($aUsername,$aTimestamp)
		{
			$this->mStrUsername = $aUsername;
			$this->mIntTimestamp = $aTimestamp;
		}

		//function to update the timestamp in DB
		function updateValues()
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
                $newLoginData = array('$set' => array("sessionId" => $sessionId,
                                                    "timestamp" => $this->mIntTimestamp));
                $updateCursor = $collection->update(array("emailId" => $this->mStrUsername),$newLoginData);
                if($updateCursor != 0)
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
	$update = new UpdateTimestamp;

	//fetch the GET parameters
	$username = $_GET['username'];
	$date = date('m/d/Y h:i:s a', time());
	$timestamp = strtotime($date);	
	
	//set the values
	$update->setValues($username,$timestamp);

	//function to update the values
	$flagUpdateStatus = $update->updateValues();
	if($flagUpdateStatus == false)
	{
		$successValues = array("statusCode" => "0",
							"errorCode" => "50003",
							"statusText" => "FAILURE");
		$outstr = json_encode($successValues);
		ob_clean();
		echo $outstr;
	}
	else
	{
		$successValues = array("statusCode" => "0",
							"errorCode" => "50000",
							"statusText" => "SUCCESS");
		$outstr = json_encode($successValues);
		ob_clean();
		echo $outstr;
	}
?>