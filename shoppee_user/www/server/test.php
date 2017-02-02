<?php
    try
    {
        $con = new mongo("localhost");
        //connect to Database
        $db = $con->medha;
        $collection = new MongoCollection($db,'advertisementTable');
        $checkQuery = array("adCategory" => "Electronics");
        $cursor1 = $collection->find($checkQuery)->count();
        echo $cursor1;
        $cursor = $collection->find($checkQuery);
        if($cursor)
        {
            echo "element found";
            foreach($cursor as $doc)
            {
                //measure the distance between user and adLocation
                $distance = measureDistance($doc['adLocation']);
                if($distance <= 25)
                {
                    $adId = $doc['adId'];
                    $adDescription = $doc['adDescription'];
                    $adCategory = $doc['adCategory'];
                    $adLocation = $doc['adLocation'];

                    $adDetails = array("adId" => $adId,
                                        "adDescription" => $adDescription,
                                        "adCategory" => $adCategory,
                                        "adLocation" => $adLocation);
                    $adList[] = $adDetails;
                    echo $adList;
                }
            }
        }
        else
        {
            echo "no element found";
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

    //function to measure distance between user and ad
        function measureDistance($adLocation,$miles=false)
        {   
            echo "<br/>measuring the distance";
            //User location        
            $lat1 = "12.96863966614239";
            $lng1 = "77.50255919580081";
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
            echo "<br/>distance is: ".$km;
            return ($miles ? ($km * 0.621371192) : $km);
        }
?>