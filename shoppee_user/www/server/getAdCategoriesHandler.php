<?php
	// This file provides API to fetch all the Generic and Custom Ad Categories
	header('Access-Control-Allow-Origin: *');
    // start the session
	session_start();

	//clear the logTable
    include_once("dropLogTable.php");
    //connect to file to write the log file
    include_once("writeLogTable.php");
    //clear the data of logTable
    dropDataOfLogFile();
    writeToLog("get ad categories handler");

	class GetAdCategories
	{
		//member variables
		var $mStrEmailId;
		var $mStrAdCategories;
        var $mStrCategories;

		//function to set the values for each field
		function setValues($aEmailId)
		{
			if($aEmailId == "" || $aEmailId == null)
				$this->mStrEmailId = "";
			else
				$this->mStrEmailId = $aEmailId;
			writeToLog("values are set");
		}

		//function to fetch all the categories
		function getGenericCategories()
		{
			try
            {
                $con = new Mongo("localhost");
                //connect to the database
                $db = $con->medha;
                $collection = new MongoCollection($db, 'adCategoryTable');
                $checkQuery = array("categoryType" => "generic");
                $cursor = $collection->find($checkQuery);
                if($cursor)
                {
                	writeToLog("found generic category");
                    foreach($cursor as $doc)
                    {
                        //fetch the generic categories
                        $this->mStrAdCategories .= $doc['categories'];
                    }
                    $this->mStrAdCategories .= ";";
                    writeToLog("generic categories are: ".$this->mStrAdCategories);
                    
                    //close the connection
                    $con->close();
                    return true;
                }
                else
                {
                    //close the connection
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
	//end of class
	}

	//instantiate the class
	$getCategories = new GetAdCategories;

	//get the logged in user
	$emailId = $_SESSION['emailId'];

	//set the values
	$getCategories->setValues($emailId);

	$flagGetCategories = $getCategories->getGenericCategories();
	if($flagGetCategories == false)
	{
		//send failure status
		$successValue = array("statusCode" => "0",
							"errorCode" => "26003",
							"statusText" => "FAILURE",
							"data" => "null");
		$outstr = json_encode($successValue);
		ob_clean();
		echo $outstr;
	}
	else
	{
		//send success status
		$successValue = array("statusCode" => "0",
							"errorCode" => "26000",
							"statusText" => "SUCCESS",
							"data" => $getCategories->mStrAdCategories);
		$outstr = json_encode($successValue);
		ob_clean();
		echo $outstr;
	}
?>