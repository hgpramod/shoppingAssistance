<?php
	// This file provides API to fetch all the Generic and Custom Ad Categories
	header('Access-Control-Allow-Origin: *');
	session_start();
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
		}

		//function to fetch all the categories
		function getGenericCategories()
		{
			$link = mysqli_connect("localhost","root","","shoppingAssist");
            if (!$link) 
            {
                mysqli_close($link);
                return true;
            }
            else
            {
                $query = "SELECT * FROM adCategoryTable";
                $result = $link->query($query);

                if($result->num_rows > 0)
                {
                    foreach($result as $doc)
                    {
                        $this->mStrAdCategories .= $doc['category'];
                        $this->mStrAdCategories .= "-";
                    }
                    $this->mStrAdCategories .= ";";
                    return true;
                }
                else
                {
                    //close the connection
                    return false;
                }
            }
		}
	//end of class
	}

	//instantiate the class
	$getCategories = new GetAdCategories;

	//get the logged in user
	$emailId = $_POST['emailId'];

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