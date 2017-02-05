<?php
	//this file provides api to Fetch Nearby offers
	header('Access-Control-Allow-Origin: *');
    session_start();
    

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
        var $mStrImageUrl;

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
            $link = mysqli_connect("localhost","root","","shoppingAssist");
            if (!$link) 
            {
                mysqli_close($link);
                return false;
            }
            else
            {
                $query = "SELECT * FROM user_reg_table WHERE emailId = '$this->mStrEmailId'";
                $result = $link->query($query);

                if($result->num_rows > 0)
                {
                    foreach($result as $doc)
                    {
                        $interestedCategories = $doc['interestedCategories'];
                        $Domains = explode(",", $interestedCategories);
                        for($i=0;$i<count($Domains);$i++)
                        {
                            //function call to get the corresponding ads based on domains
                            $domain = $Domains[$i];
                            $this->fetchCategoryOffer($domain);
                        }  
                        return true;  
                    }
                    
                    return true;
                }
                else
                {
                    //close the connection
                    return false;
                }
            }
        }
        //function to fetch offers according to the categories
        function fetchCategoryOffer($domain)
        {
            $link = mysqli_connect("localhost","root","","shoppingAssist");
            if (!$link) 
            {
                mysqli_close($link);
                return false;
            }
            else
            {
                $query = "SELECT * FROM advertisementTable WHERE adCategory = '$domain'";
                $result = $link->query($query);
                
                if($result->num_rows > 0)
                {
                    foreach($result as $doc)
                    {   
                        $distance = $this->measureDistance($doc['adLocation']);
                        if($distance <= 25)
                        {
                            $adId = $doc['adId'];
                            $adDescription = $doc['adDescription'];
                            $adCategory = $doc['adCategory'];
                            $adGUID = $doc['adGUID'];
                            $adLocation = $doc['adLocation'];
                            $adSearchRate = $doc['adSearchRate'];
                            $adPrice = $doc['adDiscountedPrice'];
                            $adActualPrice = $doc['adActualPrice'];
                            $this->adSearchRateUpdate($adSearchRate,$adGUID);
                            $adDistance = round($distance,2);
                            //create array of ad details
                            $adIdArray = array($adId);
                            $adDescriptionArray = array($adDescription);
                            $adCategoryArray = array($adCategory);
                            $adGUIDArray = array($adGUID);
                            $adLocationArray = array($adLocation);
                            $adPriceArray = array($adPrice);
                            $adActualPriceArray = array($adActualPrice);
                            $adDistanceArray = array($adDistance);

                            //store the arrays
                            $this->mStrAdId[] = $adIdArray;
                            $this->mStrAdDescription[] = $adDescriptionArray;
                            $this->mStrAdCategory[] = $adCategoryArray;
                            $this->mStrAdGUID[] = $adGUIDArray;
                            $this->mStrAdLocation[] = $adLocationArray;
                            $this->mStrAdPrice[]  = $adPriceArray;
                            $this->mStrAdActualPrice[] = $adActualPriceArray;
                            $this->mStrAdDistance[] = $adDistanceArray;
                            $exts = array('png', 'gif', 'jpg', 'jpeg'); 
                            $file = "offerImages/".$adGUID;         // <-- You'd have to define $script_id 

                            $src = ''; 
                            foreach ($exts as $ext) 
                            { 
                                if (file_exists("$file.$ext")) 
                                { 
                                    $src = "$adGUID.$ext"; 
                                    break; 
                                } 
                            } 
                            $url = array($src);
                            $this->mStrImageUrl[] = $url;
                        }
                    }
                    return true;
                }
                return false;
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
            $link = mysqli_connect("localhost","root","","shoppingAssist");
            if (!$link) 
            {
                mysqli_close($link);
            }
            else
            {
                $adSearchRate = $adSearchRate+1;
                $query = "UPDATE advertisementTable SET adSearchRate = '$adSearchRate' WHERE adGUID = '$adGUID'";
                $result = $link->query($query);
            }
        }
    //end of class
    }

    //instatiate the class
    $nearByOffers = new Offers;
    //Fetch values
    $emailId = $_POST['emailId'];
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    
    /*$emailId = "pramod@awpl.co";
    $lat= "12";
    $lng = "77";*/
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
                                                "adDiscountedPrice" => $nearByOffers->mStrAdPrice,
                                                "imgUrl" => $nearByOffers->mStrImageUrl));
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;   
        }
    }
?>                




                    