<?php
		require_once('config.php');
$sql = "select mlsno,Address,City,State,Zip from tbl_listings where (lat is null or lat = '') and city = 'Cape May' order by Asking_price desc";
		$query=mysql_query($sql);
		$i=0;
		while($query1=mysql_fetch_array($query))
		{
		
			$address=$query1['Address'];
			$city=$query1['City'];
			$state=$query1['State'];
			$zip=$query1['Zip'];
			$mlsno=$query1['mlsno'];
			
			 // Get lat and long by address         
			$address = "$address,$city,$state,$zip"; // Google HQ

			$prepAddr = str_replace(' ','+',$address);
$prepAddr = rawurlencode($address);
	        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
	        $output= json_decode($geocode);
	        echo $latitude = $output->results[0]->geometry->location->lat;	
	        echo $longitude = $output->results[0]->geometry->location->lng;
			echo "update tbl_listings set lat='".$latitude."',lon='".$longitude."' where mlsno=$mlsno<br>";
			mysql_query("update tbl_listings set lat='".$latitude."',lon='".$longitude."' where mlsno=$mlsno");
			
			$i++;
			
		}
		echo $i;
		
?>
