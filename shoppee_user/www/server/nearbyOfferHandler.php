<?php
	//this file provides api to Fetch Nearby offers
	session_start();
    header('Access-Control-Allow-Origin: *');

    class Offers
    {
        //member variables
        var $mStrLatitude;
        var $mStrLongitude;
        var $mStrEmailId;
        var $mStrDomains;
        var $mStrAdList;
        var $mStrAdId;
        var $mStrAdGUID;
        var $mStrAdDescription;
        var $mStrAdCategory;
        var $mStrAdDistance;
        var $mStrAdLocation;
        var $mStrAdActualPrice;
        var $mStrAdDiscountedPrice;

        //Set values to varibles
        function setValues($lat,$lng,$emailId)
        {
            $this->mStrEmailId = $emailId; 
            $this->mStrLatitude = $lat;
            $this->mStrLongitude = $lng;
        }

        //Check Mandatory Arguments
        function checkMandatoryArguments()
        {
            if($this->mStrEmailId == "" || $this->mStrEmailId == null)
                return false;
            else if($this->mStrLatitude == "" || $this->mStrLatitude == null && $this->mStrLongitude == "" || $this->mStrLongitude == null)
                return false;
            else 
                return true;
        }

        //Function to fetch interested Domains
        function fetchOffers()
        {
            try
            {
                $con = new mongo("localhost");
                //connect to Database
                $db = $con->medha;
                $collection = new MongoCollection($db,'clientRegistrationTable');
                $checkQuery = array("emailId" => $this->mStrEmailId);
                $cursor = $collection->find($checkQuery);
                if($cursor)
                {
                    foreach($cursor as $doc)
                    {
                        $interestedCategories = $doc['interestedCategories'];
                        $this->mStrDomains = explode(",", $interestedCategories);
                        for($i=0;$i<count($this->mStrDomains);$i++)
                        {
                            //function call to get the corresponding ads based on domains
                            $this->fetchCategoryOffer($this->mStrDomains[$i]);
                        }  
                        return true;                      
                    }
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
        //function to fetch offers according to the categories
        function fetchCategoryOffer($domain)
        {
            try
            {
                $con = new mongo("localhost");
                //connect to Database
                $db = $con->medha;
                $collection = new MongoCollection($db,'advertisementTable');
                $checkQuery = array("adCategory" => $domain);
                $cursor1 = $collection->find($checkQuery)->count();
                $cursor = $collection->find($checkQuery);
                if($cursor != 0)
                {
                    foreach($cursor as $doc)
                    {
                        $couponsLeft = $doc['couponsLeft'];
                        if($couponsLeft >= 1)
                        {
                            //measure the distance between user and adLocation
                            $distance = $this->measureDistance($doc['adLocation']);
                            if($distance <= 25)
                            {
                                $adId = $doc['adId'];
                                $adDescription = $doc['adDescription'];
                                $adCategory = $doc['adCategory'];
                                $adGUID = $doc['adGUID'];
                                $adLocation = $doc['adLocation'];
                                $adActualPrice = $doc['adActualPrice'];
                                $adDiscountedPrice =$doc['adDiscountedPrice'];
                                $adSearchRate = $doc['adSearchRate'];
                                $this->adSearchRateUpdate($adSearchRate,$adGUID);
                                $adDistance = round($distance,2);

                                //create array of ad details
                                $adIdArray = array($adId);
                                $adDescriptionArray = array($adDescription);
                                $adCategoryArray = array($adCategory);
                                $adGUIDArray = array($adGUID);
                                $adLocationArray = array($adLocation);
                                $adDistanceArray = array($adDistance);
                                $adActualPriceArray = array($adActualPrice);
                                $adDiscountedPriceArray = array($adDiscountedPrice);

                                //store the arrays
                                $this->mStrAdId[] = $adIdArray;
                                $this->mStrAdDescription[] = $adDescriptionArray;
                                $this->mStrAdCategory[] = $adCategoryArray;
                                $this->mStrAdGUID[] = $adGUIDArray;
                                $this->mStrAdLocation[] = $adLocationArray;
                                $this->mStrAdDistance[] = $adDistanceArray;
                                $this->mStrAdActualPrice[] = $adActualPriceArray;
                                $this->mStrAdDiscountedPrice[] = $adDiscountedPriceArray;
                            }
                        }
                    }
                }
                else
                {
                    //Return back to fetchOffer()
                    return;
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
        
        //function to measure distance between user and ad
        function measureDistance($adLocation,$miles=false)
        {   
            //User location        
            $lat1 = $this->mStrLatitude;
            $lng1 = $this->mStrLongitude;
            //split AdLocation and extract latitude and longitude
            $adLocation = explode(",",$adLocation);
            $lat2 = $adLocation[0];
            $lng2 = $adLocation[1];

            //measure the distance
            $pi80 = M_PI / 180;
            $lat1 *= $pi80;
            $lng1 *= $pi80;
            $lat2 *= $pi80;
            $lng2 *= $pi80;

            $r = 6372.797; // mean radius of Earth in km
            $dlat = $lat2 - $lat1;
            $dlng = $lng2 - $lng1;
            $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $km = $r * $c;
            return ($miles ? ($km * 0.621371192) : $km);
        }
        //This function updates the adSearchRate
        function adSearchRateUpdate($adSearchRate,$adGUID)
        {
            try
            {
                $con = new Mongo("localhost");
                //connect to the database
                $db = $con->medha;
                $collection = new MongoCollection($db,'advertisementTable');
                
                //Update the Database
                $adSearchRate = $adSearchRate+1;
                $newData = array('$set' => array("adSearchRate" => $adSearchRate));
                $collection = $collection->update(array("adGUID"=>$adGUID),$newData);
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

    //instatiate the class
    $nearByOffers = new Offers;
    //Fetch values
    $emailId = $_SESSION['emailId'];
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    
    //Set values to variables
    $nearByOffers->setValues($lat,$lng,$emailId);
    $flagMandatoryArguments = $nearByOffers->CheckMandatoryArguments();
    if($flagMandatoryArguments == false)
    {
        //send failure status
        $successValue = array("statusCode" => "0",
                        "errorCode" => "44001",
                        "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    else
    {
        $flagCheckOffersFetch = $nearByOffers->fetchOffers();
        if($flagCheckOffersFetch == false)
        {
            //send failure status
            $successValue = array("statusCode" => "0",
                            "errorCode" => "44003",
                            "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
        else
        {
            $successValue = array("statusCode" => "0",
                                "errorCode" => "44000",
                                "statusText" => "SUCCESS",
                                "data" => array("adId" => $nearByOffers->mStrAdId,
                                                "adDescription" => $nearByOffers->mStrAdDescription,
                                                "adCategory" => $nearByOffers->mStrAdCategory,
                                                "adGUID" => $nearByOffers->mStrAdGUID,
                                                "adLocation" => $nearByOffers->mStrAdLocation,
                                                "adDistance" => $nearByOffers->mStrAdDistance,
                                                "adActualPrice" => $nearByOffers->mStrAdActualPrice,
                                                "adDiscountedPrice" => $nearByOffers->mStrAdDiscountedPrice));
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;   
        }
    }
?>                




                    