<?php
	ob_start();	

	session_start();	

	require_once('config_cron.php');
	error_reporting(E_ERROR | E_PARSE);
		ini_set('max_execution_time', -1);
		ini_set("memory_limit",-1);
	
		
	date_default_timezone_set('UTC');

	$defaultgettime=date("m/d/Y-h:i:sA");

	mysql_query("update tbl_availability set lastupdate='$defaultgettime'");	
	
		
	$getresults = mysql_fetch_array(mysql_query('SELECT rates FROM tbl_availability'));
	
	$updatetime=$getresults['rates'];
	

	$soapClient = new SoapClient("http://realtimerental.com/webservice/RTRWSAPI.asmx?WSDL");

	$functions = $soapClient->__getFunctions();

	$getRecordParam = array("RTRKey" => "6A573AD6-4B08-47F6-8D1F-365EF9070E85", "options" => "32", "changesFromDate" => "$updatetime");
	
	$ret = $soapClient->RTRPropertyChangeLogCatalog($getRecordParam);

	$respns=$ret->RTRPropertyChangeLogCatalogResult;
		
	// converting
	$response1 = str_replace("<soap:Body>","",$respns);
	
	$response2 = str_replace("</soap:Body>","",$response1);

	// convertingc to XML
	$xml = simplexml_load_string($response2);
	
	
	
	$timegetxml=$xml['TimeStamp'];
	
		
  $i=1;
  foreach($xml->children() as $properties) {	  
	  
	  
	  $referenceid=$properties[0]['ReferenceID'];
	  
	  $Propertyid=$properties[0]['PropertyID'];
	  
	  $nowdate=date(Y).'-'.date(m).'-'.date(d);	  
	  
	 	  	
	$changecount=mysql_num_rows(mysql_query("SELECT * FROM rental_properties_rates_info WHERE PropertyID='$Propertyid' and referenceid='$referenceid'"));
	

	if($changecount>0) {
		
		
		mysql_query("DELETE FROM rental_properties_rates_info WHERE PropertyID ='$Propertyid' and referenceid ='$referenceid'");
		
		// RateInfo
		$ratecountin = count($properties -> RateInfo ->Rate);		

	for ($r=0 ; $r < $ratecountin ;$r++) {	

			$Propertyid=$properties[0]['PropertyID'];
			
			$Description = $properties -> RateInfo->Rate[$r]['Description'];

			$strtDate = $properties -> RateInfo->Rate[$r]['CheckInDate'];

			$endDate = $properties -> RateInfo->Rate[$r]['CheckOutDate'];

			$DailyRate = $properties -> RateInfo->Rate[$r]['DailyRate'];

			$CheckInDay = $properties -> RateInfo->Rate[$r]['CheckInDay'];
			
			$MinimumStay = $properties -> RateInfo->Rate[$r]['MinimumStay'];

			$Rate1 = $properties -> RateInfo->Rate[$r]['Rate'];	

			$newrate=explode('.',$Rate1);	
			
			$Rate = $newrate[0];

		$sql_insert_rental_properties_rates=mysql_query("insert into rental_properties_rates_info(referenceid,PropertyID,Description,CheckInDate,CheckOutDate,DailyRate,CheckInDay,Rate,updatetime) values ('".$referenceid."','".$Propertyid."','".$Description."','".$strtDate."','".$endDate."','".$DailyRate."','".$CheckInDay."','".$Rate."','".$timegetxml."')");

		}	
		
	}	
 } 	


$timegetxml=$xml['TimeStamp'];

mysql_query("update tbl_availability set rates='$timegetxml'");		

echo date("d/m/Y h:i:sa");

echo '<br><br>';

echo 'Rentals Availability Updated successfully';

exit;

?>