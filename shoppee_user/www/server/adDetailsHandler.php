<?php
    //this file provides api to Fetch offer
    session_start();
    header('Access-Control-Allow-Origin: *');
    
    class Offers
    {
        //member variables
        var $mStrAdId;
        var $mStrAdDescription;
        var $mStrAdGUID;
        var $mStrAdCategory;
        var $mStrAdLocation;
        var $mSrDistance;
        var $mStrAdClick;
        var $mStrAdOwner;
        var $mStrLatitude;
        var $mStrLongitude;
        var $mIntActualPrice;
        var $mIntDiscountRate;
        var $mIntDiscountedPrice;
        var $mStrValidityType;
        var $mDateStartDate;
        var $mDateEndDate;
        var $mStrHighlights;
        var $mIntNumberOfCoupons;
        var $mStrAdDetailedDescription;

        //Set values to varibles
        function setValues($adGUID,$latitude,$longitude)
        {
            $this->mStrAdGUID = $adGUID; 
            $this->mStrLatitude = $latitude;
            $this->mStrLongitude = $longitude;
        }

        //Check Mandatory Arguments
        function checkMandatoryArguments()
        {
            if($this->mStrAdGUID == "" || $this->mStrAdGUID == null)
                return false;
            else 
                return true;
        }

        //fetch the offerDetails based on the adGUID
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
                        $this->mStrAdDescription = $doc['adDescription'];
                        $this->mStrAdCategory = $doc['adCategory'];
                        $this->mStrAdLocation = $doc['adLocation'];
                        $this->mStrAdClick = $doc['numberOfClicks'];
                        $this->mStrAdOwner = $doc['adOwner'];
                        
                        $this->mDateStartDate = $this->convertDate($doc['adStartDate']);
                        $this->mDateEndDate = $this->convertDate($doc['adEndDate']);
                        $this->mStrValidityType = $doc['adValidityType'];
                        $this->mIntActualPrice = $doc['adActualPrice'];
                        $this->mIntDiscountRate = $doc['adDiscountRate'];
                        $this->mIntDiscountedPrice = $doc['adDiscountedPrice'];
                        $this->mStrHighlights = $doc['adHighlights'];
                        $this->mIntNumberOfCoupons = $doc['couponsLeft'];
                        $this->mStrAdDetailedDescription = $doc['adDetailedDescription'];
                        if($this->mStrAdLocation ==  null || $this->mStrAdLocation == "" )
                            $this->mStrDistance = "";
                        else
                            $this->mStrDistance = $this->measureDistance($this->mStrAdLocation);
                    }
                    $this->clickCount();
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
        //function to convert the unix timestamp to date
        function convertDate($timestamp)
        {
            return gmdate('Y-d-m',$timestamp);
        }

        //Function to increase Adclick count
        function clickCount()
        {
            try
            {
                $con = new Mongo("localhost");
                //connect to the database
                $db = $con->medha;
                $collection = new MongoCollection($db,'advertisementTable');
                
                $this->mStrAdClick =$this->mStrAdClick+1;
                //Update the Database
                $newData = array('$set' => array("numberOfClicks" => $this->mStrAdClick));
                $collection = $collection->update(array("adGUID"=>$this->mStrAdGUID),$newData);
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
    //end of class
    }

    //instantiate the class
    $offersByInterest = new Offers;
    
    //Fetch values
    $adGUID = $_POST['adGUID'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    
    //store adGUID in a cookie 
    $adGUID1 = $_COOKIE['adGUID1'];
    $adGUID2 = $_COOKIE['adGUID2'];
    $adGUID3 = $_COOKIE['adGUID3'];
    setcookie("adGUID1",$adGUID);
    if($adGUID1 == $adGUID)
    {
        setcookie("adGUID2",$adGUID2);
        setcookie("adGUID3",$adGUID3);
    }
    else if($adGUID2 == $adGUID)
    {
        setcookie("adGUID2",$adGUI1);
        setcookie("adGUID3",$adGUID3);
    }
    else if($adGUID3 == $adGUID)
    {
        setcookie("adGUID2",$adGUID1);
        setcookie("adGUID3",$adGUID2);
    }
    else
    {
        setcookie("adGUID2",$adGUID1);
        setcookie("adGUID3",$adGUID2);
    }
    
    
    //$cookie_name = "offerGUID[one]";
    //$cookie_value = $adGUID;
    //setcookie($cookie_name, $cookie_value, time() + (864000 * 30), "/"); // 864000 = 10 days

    //Set values to variables
    $offersByInterest->setValues($adGUID,$latitude,$longitude);
    $flagMandatoryArguments = $offersByInterest->checkMandatoryArguments();
    if($flagMandatoryArguments == false)
    {
        //send failure status
        $successValue = array("statusCode" => "0",
                              "errorCode" => "49001",
                              "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    else
    {
        $flagCheckOffersFetch = $offersByInterest->fetchOffers();
        if($flagCheckOffersFetch == false)
        {
            //send failure status
            $successValue = array("statusCode" => "0",
                            "errorCode" => "49003",
                            "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
        else
        {
            $successValue = array("statusCode" => "0",
                            "errorCode" => "49000",
                            "statusText" => "SUCCESS",
                            "data" => array("adId" => $offersByInterest->mStrAdId,
                                            "adDescription" => $offersByInterest->mStrAdDescription,
                                            "adCategory" => $offersByInterest->mStrAdCategory,
                                            "adLocation" => $offersByInterest->mStrAdLocation,
                                            "adDistance" => $offersByInterest->mStrDistance,
                                            "adValidityType" => $offersByInterest->mStrValidityType,
                                            "adStartDate" => $offersByInterest->mDateStartDate,
                                            "adEndDate" => $offersByInterest->mDateEndDate,
                                            "adActualPrice" => $offersByInterest->mIntActualPrice,
                                            "adDiscountRate" => $offersByInterest->mIntDiscountRate,
                                            "adDiscountedPrice" => $offersByInterest->mIntDiscountedPrice,
                                            "adHighlights" => $offersByInterest->mStrHighlights,
                                            "numberOfCoupons" => $offersByInterest->mIntNumberOfCoupons,
                                            "adDetailedDescription" => $offersByInterest->mStrAdDetailedDescription,
                                            "adOwner" => $offersByInterest->mStrAdOwner,
                                            "adGUID" => $offersByInterest->mStrAdGUID));
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;   
        }
    }
?>                            