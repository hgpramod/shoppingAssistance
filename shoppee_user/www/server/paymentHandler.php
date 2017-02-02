<?php
    //this file provides API to handle buy offer.
    session_start();
    header('Access-Control-Allow-Origin: *');
    
    class buyOffer
    {
    	//member variables
    	var $mStrAdGUID;
    	var $mStrQuantity;
    	var $mStrAvailableCoupons;

    	function setValues($adGUID,$quantity)
    	{
    		$this->mStrAdGUID = $adGUID;
    		$this->mStrQuantity = $quantity;
    	}

    	//check for mandatory arguments
    	function checkMandatoryArguments()
    	{
    		if($this->mStrAdGUID == "" || $this->mStrAdGUID == null)
    			return false;
    		else if($this->mStrQuantity == "" || $this->mStrQuantity == null)
    			return false;
    		else
    			return true;
    	}
    	//Fetch the particular offer
    	function fetchOffers()
        {
            try
            {
                $con = new mongo("localhost");
                //connect to Database
                $db = $con->medha;
                $collection = new MongoCollection($db,'advertisementTable');
                $checkQuery = array("adGUID" => $this->mStrAdGUID);
                $cursor = $collection->find($checkQuery);
                if($cursor)
                {
                    foreach ($cursor as $doc) 
                    {
                        $this->mStrAdId = $doc['adId'];
                        $this->mStrAvailableCoupons = $doc['couponsLeft'];
                    }
                    $con -> close();
                    return true;
                }
                else
                {
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
        //Update available coupons
        function updateOfferCoupon()
        {
        	try
            {
                $con = new mongo("localhost");
                //connect to Database
                $db = $con->medha;
                $collection = new MongoCollection($db,'advertisementTable');
                $couponsLeft = $this->mStrAvailableCoupons - $this->mStrQuantity;
                //Update the Database
	            $newData = array('$set' => array("couponsLeft" =>$couponsLeft));
	            $collection = $collection->update(array("adGUID"=>$this->mStrAdGUID),$newData);
                if($collection)
                {
                    $con -> close();
                    return true;
                }
                else
                {
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
    //End of class
    }

    //instantiate the class
    $buy = new buyOffer;

    //fetch the values
    $adGUID = $_POST['adGUID'];
    $quantity = $_POST['quantity'];

    //set values to variable
    $buy->setValues($adGUID,$quantity);

    $flagCheckMandatoryArguments = $buy->checkMandatoryArguments();
    if($flagCheckMandatoryArguments == false)
    {
    	//send failure status
        $successValue = array("statusCode" => "0",
                              "errorCode" => "50001",
                              "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    else
    {
    	//Fetch offer based on GUID
    	$flagFetchOffer = $buy->fetchOffers();
    	if($flagFetchOffer == false)
    	{
    	//send failure status
        $successValue = array("statusCode" => "0",
                              "errorCode" => "50003",
                              "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    	}
    	else
    	{
    		$flagUpdateOffer = $buy->updateOfferCoupon();
    		if($flagUpdateOffer == false)
    		{
    			//send failure status
		        $successValue = array("statusCode" => "0",
		                              "errorCode" => "50004",
		                              "statusText" => "FAILURE");
		        $returnValue = json_encode($successValue);
		        ob_clean();
		        echo $returnValue;
    		}
    		else
    		{
    			//send success status
		        $successValue = array("statusCode" => "0",
		                              "errorCode" => "50000",
		                              "statusText" => "SUCCESS");
		        $returnValue = json_encode($successValue);
		        ob_clean();
		        echo $returnValue;
    		}
    	}
    }
?>