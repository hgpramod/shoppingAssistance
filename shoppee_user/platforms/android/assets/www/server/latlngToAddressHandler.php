<?php
	header('Access-Control-Allow-Origin: *');
	//fetch the values
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];

	$address = getaddress($latitude,$longitude);
	$success = array("address" => $address);
	$outstr = json_encode($success);
	echo $outstr;

	function getaddress($latitude,$longitude)
  	{
	    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false';
	    $json = @file_get_contents($url);
	    $data=json_decode($json);
	    $status = $data->status;
	    if($status=="OK")
	    return $data->results[0]->formatted_address;
	    else
	    return false;
  	}
?>