<?php

    //function to write to logFiles
    function writeToLog($message)
    {
        // Get IP address
        if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') 
        {
            $remote_addr = "REMOTE_ADDR_UNKNOWN";
        }
     
        // Get requested script
        if( ($request_uri = $_SERVER['REQUEST_URI']) == '') 
        {
            $request_uri = "REQUEST_URI_UNKNOWN";
        }
        $message = $message;
        $remoteAddress = $remote_addr;
        $requestUri = $request_uri;
        
        try
        {
            $con = new Mongo("localhost");
            //connect to the database
            $db = $con->medha;
            // a new log collection object
            $logCollection = new MongoCollection($db,'logTable');

            //create an array to store the registration data
            $logData = array("id" => $logData['_id'],
                                    "message" => $message,
                                    "remoteAddress" => $remoteAddress,
                                    "requestUri" => $requestUri);
            // insert the data
            $logCollection->insert($logData);

            //close the connection
            $con -> close();
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
?>