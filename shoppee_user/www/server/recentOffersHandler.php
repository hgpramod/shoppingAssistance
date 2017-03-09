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
            $link = mysqli_connect("localhost","root","","shoppingAssist");
            if (!$link) 
            {
                mysqli_close($link);
                return true;
            }
            else
            {
                for($i=0;$i<count($this->mStrAdGUID);$i++)
                {
                    $domain = $this->mStrAdGUID[$i];
                    $query = "SELECT * FROM advertisementTable WHERE adGUID = '$domain'";
                    $result = $link->query($query);
                    
                    if($result->num_rows > 0)
                    {
                        foreach($result as $doc)
                        {   
                            $this->mStrAdId[] = $doc['adId'];
                            $this->mStrAdDescription[] = $doc['adDescription'];
                            $this->mStrAdCategory[] = $doc['adCategory'];
                            $this->mStrAdLocation[] = $doc['adLocation'];
                            
                            $this->mStrAdOwner[] = $doc['adOwner'];
                            $this->mDateStartDate[] = $doc['adStartDate'];
                            $this->mDateEndDate[] = $doc['adEndDate'];
                            
                            $this->mIntActualPrice[] = $doc['adActualPrice'];
                            $this->mIntDiscountRate[] = $doc['adDiscountRate'];
                            $this->mIntDiscountedPrice[] = $doc['adDiscountedPrice'];
                            $this->mStrHighlights[] = $doc['adHighlights'];
                            
                            $this->mStrAdDetailedDescription[] = $doc['adDetailedDescription'];
                            $this->mStrOfferGUID[] = $doc['adGUID'];
                            $adGUID = $doc['adGUID'];
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
                    else
                    {
                        break;
                    }
                }
                return true;
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