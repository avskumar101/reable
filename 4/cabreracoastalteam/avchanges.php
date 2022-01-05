<?php
	ob_start();	

	//session_start();	

	require_once('config_cron.php');
	error_reporting(E_ERROR | E_PARSE);
	ini_set('max_execution_time', -1);
	ini_set("memory_limit",-1);
	
	
	date_default_timezone_set('UTC');
	
	$defaultgettime=date("m/d/Y-h:i:sA");
	
	mysql_query("update tbl_availability set lastupdate='$defaultgettime'");	

	
	
	$getresults = mysql_fetch_array(mysql_query('SELECT availability FROM tbl_availability'));
	
	$updatetime=$getresults['availability'];
	


	$soapClient = new SoapClient("http://realtimerental.com/webservice/RTRWSAPI.asmx?WSDL");

	$functions = $soapClient->__getFunctions();

	$getRecordParam = array("RTRKey" => "6A573AD6-4B08-47F6-8D1F-365EF9070E85", "options" => "8", "changesFromDate" => "$updatetime");

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
	  
	 	  	
	$changecount=mysql_num_rows(mysql_query("SELECT * FROM rental_properties_rates_rs WHERE PropertyID='$Propertyid' and referenceid='$referenceid'"));
	
	
	if($changecount>0) {		
		
		
		mysql_query("DELETE FROM rental_properties_rates_rs WHERE PropertyID='$Propertyid' and referenceid='$referenceid '");
		
		mysql_query("DELETE FROM rental_properties_rates_rs1 WHERE PropertyID='$Propertyid' and referenceid='$referenceid '");

				
		$ratecount = count($properties -> AvailabilityInfo->Availability );
			
			
	for ($a=0 ; $a < $ratecount ;$a++) {		
				
		$referenceid=$properties[0]['ReferenceID'];	

		$Propertyid=$properties[0]['PropertyID'];

		$strtDate = $properties -> AvailabilityInfo->Availability[$a]['CheckInDate'];

		$endDate = $properties -> AvailabilityInfo->Availability[$a]['CheckOutDate'];

		$rates = $properties -> AvailabilityInfo->Availability[$a]['AverageRate'];
		
		
		
		$sql_insert=mysql_query("insert into rental_properties_rates_rs(referenceid,PropertyID,CheckInDate,CheckOutDate,AverageRate,updatetime) values ('".$referenceid."','".$Propertyid."','".$strtDate."','".$endDate."','".$rates."','".$timegetxml."')");
			
						
						
						
		$date1=date("Y", strtotime($strtDate)); 

		$date2=date("Y", strtotime($endDate)); 

	if($date1 < $date2){
		
		$datenew = $strtDate;

		$end_date=date("Y-m-d", strtotime("-1 day", strtotime($endDate)));		
		
		while (strtotime($datenew) <= strtotime($end_date)) {			
			
			$sql_insert=mysql_query("insert into rental_properties_rates_rs1(referenceid,PropertyID,CheckInDate,CheckOutDate,AverageRate,updatetime) values ('".$referenceid."','".$Propertyid."','".$datenew."','".$datenew."','".$rates."','".$timegetxml."')");	

			$datenew = date ("Y-m-d", strtotime("+1 day", strtotime($datenew)));		
		  }


	} else {
		
		$enddate=date("Y-m-d", strtotime("-1 day", strtotime($endDate)));
		
		$sql_insert=mysql_query("insert into rental_properties_rates_rs1(referenceid,PropertyID,CheckInDate,CheckOutDate,AverageRate,updatetime) values ('".$referenceid."','".$Propertyid."','".$strtDate."','".$enddate."','".$rates."','".$timegetxml."')");	
	}		
			
			
	
		}
	}
	
 } 	
  	
	
	$timegetxml=$xml['TimeStamp'];
		
	mysql_query("update tbl_availability set availability='$timegetxml'");		

	echo date("d/m/Y h:i:sa");

	echo '<br><br>';
	
	echo 'Rentals Availability Updated successfully';

	exit;		
?>