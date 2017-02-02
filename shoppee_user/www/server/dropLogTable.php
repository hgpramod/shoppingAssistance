<?php
	//clear the data of logTable
    function  dropDataOfLogFile()
    {
        //try to connect to database
        try
        {
            $con = new Mongo("localhost");
            //connect to the database
            $db = $con->medha;
            $collection = new MongoCollection($db, 'logTable');
            //remove all the entries in the logTable
            $collection = $collection->remove();
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