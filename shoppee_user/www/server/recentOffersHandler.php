<?php
    //this file provides api to Fetch interested offers
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
        var $mIntActualPrice;
        var $mIntDiscountRate;
        var $mIntDiscountedPrice;
        var $mStrValidityType;
        var $mDateStartDate;
        var $mDateEndDate;
        var $mStrHighlights;
        var $mIntNumberOfCoupons;
        var $mStrOfferGUID;
        var $mStrAdDetailedDescription;

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
                for($i=0;$i<count($this->mStrAdGUID);$i++)
                {
                    $checkQuery = array("adGUID" => $this->mStrAdGUID[$i]);
                    $cursor = $collection->find($checkQuery);
                    if($cursor)
                    {
                        foreach ($cursor as $doc) 
                        {
                            $this->mStrAdId[] = $doc['adId'];
                            $this->mStrAdDescription[] = $doc['adDescription'];
                            $this->mStrAdCategory[] = $doc['adCategory'];
                            $this->mStrAdLocation[] = $doc['adLocation'];
                            $this->mStrAdClick[] = $doc['numberOfClicks'];
                            $this->mStrAdOwner[] = $doc['adOwner'];
                            $this->mDateStartDate[] = $this->convertDate($doc['adStartDate']);
                            $this->mDateEndDate[] = $this->convertDate($doc['adEndDate']);
                            $this->mStrValidityType[] = $doc['adValidityType'];
                            $this->mIntActualPrice[] = $doc['adActualPrice'];
                            $this->mIntDiscountRate[] = $doc['adDiscountRate'];
                            $this->mIntDiscountedPrice[] = $doc['adDiscountedPrice'];
                            $this->mStrHighlights[] = $doc['adHighlights'];
                            $this->mIntNumberOfCoupons[] = $doc['couponsLeft'];
                            $this->mStrAdDetailedDescription[] = $doc['adDetailedDescription'];
                            $this->mStrOfferGUID[] = $doc['adGUID'];
                        }
                    }
                }
                $con -> close();
                return true;
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

    //end of class
    }

    //instantiate the class
    $offersByInterest = new Offers;

    if(isset($_COOKIE['adGUID1'])) 
    {
        $offersByInterest->mStrAdGUID[] = $_COOKIE['adGUID1'];
        $offersByInterest->mStrAdGUID[] = $_COOKIE['adGUID2'];
        $offersByInterest->mStrAdGUID[] = $_COOKIE['adGUID3'];
    }
    else
    {
        //send failure status
        $successValue = array("statusCode" => "0",
                              "errorCode" => "51004",
                              "statusText" => "FAILURE");
        $returnValue = json_encode($successValue);
        ob_clean();
        echo $returnValue;
    }
    //Set values to variables
    $flagMandatoryArguments = $offersByInterest->checkMandatoryArguments();
    if($flagMandatoryArguments == false)
    {
        //send failure status
        $successValue = array("statusCode" => "0",
                              "errorCode" => "51001",
                              "statusText" => "FAILURE",
                              "adGUID" => $_COOKIE['offerGUID']);
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
                            "errorCode" => "51003",
                            "statusText" => "FAILURE");
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;
        }
        else
        {
            $successValue = array("statusCode" => "0",
                            "errorCode" => "51000",
                            "statusText" => "SUCCESS",
                            "data" => array("adId" => $offersByInterest->mStrAdId,
                                            "adDescription" => $offersByInterest->mStrAdDescription,
                                            "adCategory" => $offersByInterest->mStrAdCategory,
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
                                            "adGUID" => $offersByInterest->mStrOfferGUID
                                            ));
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;   
        }
    }
?>                            