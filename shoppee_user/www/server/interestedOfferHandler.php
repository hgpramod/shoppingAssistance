<?php
    //this file provides api to Fetch interested offers
    session_start();
    header('Access-Control-Allow-Origin: *');

    class Offers
    {
        //member variables
        var $mStrEmailId;
        var $mStrDomains;
        var $mStrAdList;
        var $mStrAdId;
        var $mStrAdDescription;
        var $mStrAdGUID;
        var $mStrAdCategory;
        var $mStrAdLocation;
        var $mStrAdPrice;
        var $mStrAdActualPrice;

        //Set values to varibles
        function setValues($interestedDomains)
        {
            $this->mStrDomains = $interestedDomains; 
        }

        //Check Mandatory Arguments
        function checkMandatoryArguments()
        {
            if($this->mStrDomains == "" || $this->mStrDomains == null)
                return false;
            else 
                return true;
        }

        //fetch the offers based on the Domains
        function fetchOffers()
        {
            try
            {
                $con = new mongo("localhost");
                //connect to Database
                $db = $con->medha;
                $collection = new MongoCollection($db,'advertisementTable');
                $this->mStrDomains = explode(",", $this->mStrDomains);
                for($i=0;$i<count($this->mStrDomains);$i++)
                {
                    $checkQuery = array("adCategory" => $this->mStrDomains[$i]);
                    $cursorCount = $collection->find($checkQuery)->count();
                    $cursor = $collection->find($checkQuery);
                    if($cursorCount != 0)
                    {
                        foreach($cursor as $doc)
                        {
                            //fetch no. of coupons left show offer only coupons left is >0
                            $couponsLeft = $doc['couponsLeft'];
                            if($couponsLeft >= 1)
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
                                //create array of ad details
                                $adIdArray = array($adId);
                                $adDescriptionArray = array($adDescription);
                                $adCategoryArray = array($adCategory);
                                $adGUIDArray = array($adGUID);
                                $adLocationArray = array($adLocation);
                                $adPriceArray = array($adPrice);
                                $adActualPriceArray = array($adActualPrice);

                                //store the arrays
                                $this->mStrAdId[] = $adIdArray;
                                $this->mStrAdDescription[] = $adDescriptionArray;
                                $this->mStrAdCategory[] = $adCategoryArray;
                                $this->mStrAdGUID[] = $adGUIDArray;
                                $this->mStrAdLocation[] = $adLocationArray;
                                $this->mStrAdPrice[]  = $adPriceArray;
                                $this->mStrAdActualPrice[] = $adActualPriceArray;
                            }
                        }
                    }
                    else
                    {
                        break;
                    }
                }
                if(count($this->mStrAdId) == 0)
                {
                    $con -> close();
                    return false;
                }
                else
                {
                    $con -> close();
                    return true;
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

    //instantiate the class
    $offersByInterest = new Offers;
    //Fetch values
    $interestedDomains = $_POST['interestedCategories'];

    //Set values to variables
    $offersByInterest->setValues($interestedDomains);
    $flagMandatoryArguments = $offersByInterest->checkMandatoryArguments();
    if($flagMandatoryArguments == false)
    {
        //send failure status
        $successValue = array("statusCode" => "0",
                        "errorCode" => "45001",
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
                            "errorCode" => "45003",
                            "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
        else
        {
            $successValue = array("statusCode" => "0",
                            "errorCode" => "45000",
                            "statusText" => "SUCCESS",
                            "data" => array("adId" => $offersByInterest->mStrAdId,
                                            "adDescription" => $offersByInterest->mStrAdDescription,
                                            "adCategory" => $offersByInterest->mStrAdCategory,
                                            "adGUID" => $offersByInterest->mStrAdGUID,
                                            "adPrice" => $offersByInterest->mStrAdPrice,
                                            "adActualPrice" => $offersByInterest->mStrAdActualPrice));
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;   
        }
    }
?>                




                    