<?php

require_once("config.php");

  
	$results=mysql_query("SELECT * FROM tbl_listings WHERE MLSNo!=''");

	$i=1;
	while($result = mysql_fetch_array($results)) {

	$mlsno=$result['MLSNo'];
	

		if (mysql_num_rows(mysql_query("SELECT * FROM tbl_maps WHERE propertyno = '$mlsno' and type='SALES'"))>0) {

		} else {
			

		$Street=str_replace("Street Street","Street",$result['Address']);

		$Drive=str_replace("Drive Drive","Drive",$Street);

		$Lane=str_replace("Lane Lane","Lane",$Drive);

		$Lane=str_replace("Road Road","Road",$Lane);

		$seaisle=str_replace("Avenue Avenue","Avenue",$Lane);

		$addres=str_replace("Sea Isle","SeaIsle",$seaisle);	 
		
		$addres_value=trim($addres).",".trim($result['City']).",".trim($result['State']).",".trim($result['Zip']);

		$mlsno=$result['MLSNo'];

     // Get lat and long by address         
        $address = $addres_value; // Google HQ
        $prepAddr = str_replace('#','+',$address);
        $prepAddr = str_replace(' ','+',$prepAddr);		

		$url = "http://maps.google.com/maps/api/geocode/json?address=".$prepAddr."&sensor=false";
		$ch = curl_init();

			// define options
			$optArray = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true
			);

			// apply those options
			curl_setopt_array($ch, $optArray);

			// execute request and get response
			$geocode = curl_exec($ch);
			//print_r($geocode);
			$output= json_decode($geocode);
			$latitude = $output->results[0]->geometry->location->lat;
			$longitude = $output->results[0]->geometry->location->lng;
		
		if($latitude!='') {

		mysql_query("insert into tbl_maps(propertyno,latitude,longitude,last_update,type,delete_status) values ('".$mlsno."','".$latitude."','".$longitude."','".$lastupade."','SALES','0')");

		}
		
	
	}
		
	$i=$i+1;
	}
	
	// Sales End //
	
	
	
	
	
	// Rentals //
	
	
	$resultsrent=mysql_query("SELECT * FROM rental_properties WHERE cid!=''");

	$i=1;
	while($resultrnt = mysql_fetch_array($resultsrent)) {

	$propertyid=$resultrnt['cid'];
	
		if (mysql_num_rows(mysql_query("SELECT * FROM tbl_maps WHERE propertyno = '$propertyid' and type='RENTALS'"))>0) {

		} else {
			
			$propertyid=$resultrnt['cid'];

			$lastupade=date('Y').'-'.date('m').'-'.date('d');

			$resultn=mysql_fetch_array(mysql_query('SELECT * FROM rental_properties WHERE cid="'.$propertyid.'"'));

			$addres=$resultn['propertyheadline'].', '. $resultn['zipcode']; 

			$addres_value=trim($addres); 
		
		// Get lat and long by address         
        $address = $addres_value; // Google HQ
        $prepAddr = str_replace('#','+',$address);
        $prepAddr = str_replace(' ','+',$prepAddr);		

		$url = "http://maps.google.com/maps/api/geocode/json?address=".$prepAddr."&sensor=false";
		$ch = curl_init();

			// define options
			$optArray = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true
			);

			// apply those options
			curl_setopt_array($ch, $optArray);

			// execute request and get response
			$geocode = curl_exec($ch);
			//print_r($geocode);
			$output= json_decode($geocode);
			$latitude = $output->results[0]->geometry->location->lat;
			$longitude = $output->results[0]->geometry->location->lng;
		
		if($latitude!='') {

		mysql_query("insert into tbl_maps(propertyno,latitude,longitude,last_update,type,delete_status) values ('".$propertyid."','".$latitude."','".$longitude."','".$lastupade."','RENTALS','0')");
		
		
		}
	
	}
		
	$i=$i+1;
	}


echo 'latitude\longitude updated';	
exit;
?>