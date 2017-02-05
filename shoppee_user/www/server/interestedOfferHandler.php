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
        var $mStrImageUrl;

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
            $link = mysqli_connect("localhost","root","","shoppingAssist");
            if (!$link) 
            {
                mysqli_close($link);
                return true;
            }
            else
            {
                $Domains = explode(",", $this->mStrDomains);
                for($i=0;$i<count($Domains);$i++)
                {
                    $domain = $Domains[$i];
                    $query = "SELECT * FROM advertisementTable WHERE adCategory = '$domain'";
                    $result = $link->query($query);
                    
                    if($result->num_rows > 0)
                    {
                        foreach($result as $doc)
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

    //instantiate the class
    $offersByInterest = new Offers;
    //Fetch values
    $interestedDomains = $_POST['interestedCategories'];
    //$interestedDomains = "Electronics,";
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
                                            "adActualPrice" => $offersByInterest->mStrAdActualPrice,
                                            "imgUrl" => $offersByInterest->mStrImageUrl));
            $returnValue = json_encode($successValue);
            ob_clean();
            echo $returnValue;   
        }
    }
?>                




                    