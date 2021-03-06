<?php
	ob_start();	

	session_start();	

	require_once('config_cron.php');

	date_default_timezone_set('UTC');
	error_reporting(E_ERROR | E_PARSE);
	ini_set('max_execution_time', -1);
	ini_set("memory_limit",-1);
			
	
	$soapClient = new SoapClient("http://realtimerental.com/webservice/RTRWSAPI.asmx?WSDL");

	$functions = $soapClient->__getFunctions();

	$getRecordParam = array("RTRKey" => "6A573AD6-4B08-47F6-8D1F-365EF9070E85");

	$ret = $soapClient->RTRPropertyCatalog($getRecordParam);

	$myFile = "Cabreracoastalteam.xml";

	$fh = fopen($myFile, 'w');

	fwrite($fh, $ret->RTRPropertyCatalogResult);

	fclose($fh); 
	
	$xml = simplexml_load_file('Cabreracoastalteam.xml');
	
	$timegetxml=$xml['TimeStamp'];
	

	if(count($xml)>0) {
		
		mysql_query("TRUNCATE TABLE rentals_properties_amenity");
		
		mysql_query("TRUNCATE TABLE rental_properties_rates_rs1");
		
		mysql_query("TRUNCATE TABLE rentals_pictures");

		mysql_query("TRUNCATE TABLE rental_properties_rates");

		mysql_query("TRUNCATE TABLE rental_properties");

		mysql_query("TRUNCATE TABLE rental_properties_images");

		mysql_query("TRUNCATE TABLE rental_properties_rates_rs");

		mysql_query("TRUNCATE TABLE rental_properties_rates_info");		

		mysql_query("TRUNCATE TABLE search_results_temp");

		mysql_query("TRUNCATE TABLE search_results");
	

  $i=1;  

  foreach($xml->children() as $properties) {
	  

	$imgPreview=$properties->PropertyDetails->Photos[0]->Image[0];

	$imgLarge=$properties->PropertyDetails->Photos[0]->Image[1];

	$imgPic1=$properties->PropertyDetails->Photos[0]->Image[2];

	$imgPic2=$properties->PropertyDetails->Photos[0]->Image[3];

	$imgPic3=$properties->PropertyDetails->Photos[0]->Image[4];

	$imgPic4=$properties->PropertyDetails->Photos[0]->Image[5];

	$imgPic5=$properties->PropertyDetails->Photos[0]->Image[6];

	$imgPic6=$properties->PropertyDetails->Photos[0]->Image[7];

	$imgPic7=$properties->PropertyDetails->Photos[0]->Image[8];

	$imgPic8=$properties->PropertyDetails->Photos[0]->Image[9];	

	$property_name=$properties->PropertyDetails->PropertyName;

	$deposit=0;

	$j=$ss+1; 

	$secid=$properties[0]['PropertyID'];	

	$externalreferenceid=$properties[0]['ExternalReferenceID'];		

	$referenceid=$properties[0]['ReferenceID'];
	
	$poid=$properties[0]->PropertyManager[0]['POID'];	
	
	$officeid=$properties[0]->PropertyManager[0]['ID'];	

	$geographyid=$properties->PropertyDetails->Geography[0][ID];
	
	$sid=$properties->PropertyDetails->StreetCode[0][ID];
	
	$condo_id=$properties->PropertyDetails->CondoCode[0][ID];
	
	$streetn=mysql_real_escape_string($properties->PropertyDetails->Street);	

	$streetnn=str_replace('Ave', 'Avenue', $streetn);	

	$rpyheadln=str_replace('Ave.', 'Avenue', $streetnn);	

	$proprtheal=str_replace('St.', 'Street', $rpyheadln);	

	$propethe=str_replace(' St ', ' Street ', $proprtheal);	

	$propertne=str_replace('Avenuenue', 'Avenue', $propethe);	

	$street=str_replace('Street Street', ' Street ', $propertne);
	
	$city=mysql_real_escape_string($properties->PropertyDetails->City);
	 
	 if($property_name!="") {

	  $propertyheading=$properties->PropertyDetails->PropertyName.', '.$street.', '.$city;

	} else {

	  $propertyheading=$properties->PropertyDetails->Street.', '.$city;	  

	}		

	$Streetg=mysql_real_escape_string($properties->PropertyDetails->Street.' - '.$properties[0]['PropertyID']);	  		  

	$rpyhedlin=str_replace('Ave', 'Avenue', $Streetg);	

	$rpyheadlne=str_replace('Ave.', 'Avenue', $rpyhedlin);	

	$proprthealine=str_replace('St.', 'Street', $rpyheadlne);	

	$propethne=str_replace(' St ', ' Street ', $proprthealine);	

	$properthne=str_replace('Avenuenue', 'Avenue', $propethne);	

	$Streetheading=str_replace('Street Street', ' Street ', $properthne);		  


	$zipcode=$properties->PropertyDetails->Zip;	

	$bedroom=$properties->PropertyDetails->BedRooms;	

	$bathroom=$properties->PropertyDetails->Baths;	
	
	$halfbath=$properties->PropertyDetails->HalfBaths;	

	$sleepupto=$properties->PropertyDetails->TotalSleeps;
	
	$occupancylimit=$properties->PropertyDetails->OccupancyLimit;		

	$smoke_value=$properties->PropertyDetails->Smoking;	

	if($smoke_value=='false') {

		$smoke="No";

	} else {
		$smoke="Yes";
	}

	$propertytype=$properties->PropertyDetails->PropertyType;	
	
	$location=$properties->PropertyDetails->LocationCode;
	
	$locationcode=$properties->PropertyDetails->LocationCode[0][ID];	

	$checkin=$properties->weeklyrates->item->checkintime;	

	$checkout=$properties->weeklyrates->item->checkouttime;	

	$propertydesc=mysql_real_escape_string($properties->PropertyDetails->Description);	

	$url=$properties->PropertyDetails->PropertyURL;	

	$city=mysql_real_escape_string($properties->PropertyDetails->City);	

	$rplsheadline=str_replace('"', '', $propertyheading);	

	$rpyhedline=str_replace('Ave', 'Avenue', $rplsheadline);	

	$rpyheadline=str_replace('Ave.', 'Avenue', $rpyhedline);	

	$properthealine=str_replace('St.', 'Street', $rpyheadline);	

	$properthne=str_replace(' St ', ' Street ', $properthealine);	

	$properthne=str_replace('Avenuenue', 'Avenue', $properthne);	

	$propertheadline=str_replace('Street Street', ' Street ', $properthne);	

	$propertyheadline=mysql_real_escape_string($propertheadline);	

	$created_date=time();

	$modified_date=time();	

	$state=mysql_real_escape_string($properties->PropertyDetails->State);	

	$meta_desc=$streetaddress.' - '.$cityname.', '.$state.' Vacation Rental';	

	$meta_keyword=$streetaddress.', '.$cityname.', '.$state.', Vacation Rental';	 

	$king=0;

	$queen=0;

	$doubles=0;

	$single=0;

	$bunk=0;

	$sofa=0;

	$air=0;

	$cable=0;

	$fire=0;

	$hottub=0;

	$beach=0;

	$deck=0;

	$grill=0;

	$internet=0;

	$beachpasses=0;

	$deckfur=0;

	$handicap=0;

	$outdoor=0;

	$boartslip=0;

	$elevator=0;

	$hardwood=0;

	$swimming=0;

	$AddFeatures='';

	$blend=0;

	$dvd=0;

	$iron=0;

	$tel=0;

	$coffee=0;

	$free=0;

	$micro=0;

	$tele=0;

	$dish=0;

	$hair=0;

	$oven=0;

	$toaster=0;

	$dishes=0;

	$ice=0;

	$ref=0;

	$wash=0;

	$AddApp='';

	$mdes='';

	$mkey='';

	$HideList=0;

	$company = $properties->PropertyManager[0]['Office'];

	if($company=='Cabrera Coastal Real Estate'){

		$company='Cabrera Coastal Team';

	} else {

		$company=$company;
	}		

	$user=75;			

	$blocks='';

	$pets='';

	$linen='';

	$offstreet='';

	$cancel='';

	$addfees='';

	$reqstay='';		

	$len=count($properties->PropertyDetails->Amenities->Amenity);

	for ($kk=0;$kk<$len;$kk++) {

		switch($properties->PropertyDetails->Amenities->Amenity[$kk]['Label']) {

			case "King Beds" : 	$king=$properties->PropertyDetails->Amenities->Amenity[$kk]['Value'];break;

			case "Double Beds" : $doubles =$properties->PropertyDetails->Amenities->Amenity[$kk]['Value'];break;

			case "Queen Beds" : $queen=$properties->PropertyDetails->Amenities->Amenity[$kk]['Value'];break;

			case "Single Beds" : $single=$properties->PropertyDetails->Amenities->Amenity[$kk]['Value'];break;

			case "Bunks" ; $bunk =$properties->PropertyDetails->Amenities->Amenity[$kk]['Value'];break;

			case "Sofa Beds (Double)" : $sofa =$properties->PropertyDetails->Amenities->Amenity[$kk]['Value'];break;

			case "Sofa Beds (Queen)" : $sofa =$properties->PropertyDetails->Amenities->Amenity[$kk]['Value'];break;

			case "Sofa Beds (Single)" : $sofa =$properties->PropertyDetails->Amenities->Amenity[$kk]['Value'];break;

			case "Parking" : $offstreet="Yes";break;

			case "No Pets Accepted" : $pets="No";break;

			case "Pets Accepted" : $pets="Yes";break;
			
			case "Allow Pets" : $pets="Yes";break;

			case "Central A/C" :  $air=1;break;

			case "Window A/C" :  $air=1;break;

			case "Washer": $wash=1; break;

			case "Dryer": $wash=1; break;

			case "Outside Shower": $outdoor=1; break;

			case "Cable TV": $cable=1; break;

			case "Gas Log Fireplace" :$fire=1;break;

			case "Community Hot Tub" :  $hottub=1; break;

			case "Sun/Open Deck" :  $deck=1;break;

			case "Deck Furniture" : $deckfur=1; break;

			case "Handicap Interior" : $handicap=1;break;

			case "Outdoor Pool" : $outdoor=1; break;

			case "Elevator To Ground" : $elevator=1; break;

			case "Blender":  $blend=1; break;

			case "DVD": $dvd=1; break;

			case "Iron": $iron=1; break;

			case "Microwave": $micro=1; break;

			case "Television": $tele=1; break;

			case "Dishwasher": $dish=1; break;

			case "Oven": $oven=1; break;

			case "Stove": $oven=1; break;

			case "Toaster": $toaster=1; break;

			case "Full Size Refrigerator": $ref=1; break;

			case "Coffee Maker": $coffee=1; break;

		}
	}
 

	if ($properties->PropertyManager[0]['Email']!="") {

		$email=$properties->PropertyManager[0]['Email'];

	} else {

		$email='';
	}


	if ($properties->PropertyManager[0]['Phone1']!=""){

		$phone=$properties->PropertyManager[0]['Phone1'];

	} else {

		$phone='';	

	}


	$deplen=count($properties->PropertyDetails->Deposits->Deposit);
	

	if ($deplen>0) {

		for ($d1=0;$d1<$deplen;$d1++) {

			 $deposit=$properties->PropertyDetails->Deposits->Deposit[0]['Amount'];

		}
	}
		

	$sql_check_referenceid=mysql_query("select * from rental_properties where referenceid='".$referenceid."'");

		
	$num_refereceid=mysql_num_rows($sql_check_referenceid);

		
	$nowdate=date(Y).'-'.date(m).'-'.date(d);
	
	$secid=$properties[0]['PropertyID'];

	$referenceid=$properties[0]['ReferenceID'];
	

	if($referenceid!='') {
		
		
		$insert_rental = "insert into rental_properties(user,propertyheadline,street,streetheadline,city,zipcode,bedroom,bathroom,halfbath,sleepupto,blocks,pets,smoke,email,propertytype,linen,offstreet,king,queen,doubles,single,bunk,sofa,phone,cancel,deposit,addfees,reqstay,checkin,checkout,propertydesc,rateurl,HideList,creation_date,modified_date,referenceid,cid,externalreferenceid,poid,officeid,geographyid,sid,condo_id,location,locationcode,occupancylimit,lastupdate) values ('75','".$propertyheadline."','".$street."','".$Streetheading."','".$city."','".$zipcode."','".$bedroom."','".$bathroom."','".$halfbath."','".$sleepupto."','".$blocks."','".$pets."','".$smoke."','".$email."','".$propertytype."','".$linen."','".$offstreet."','".$king."','".$queen."','".$doubles."','".$single."','".$bunk."','".$sofa."','".$phone."','".$cancel."','".$deposit."','".$addfees."','".$reqstay."','".$checkin."','".$checkout."','".$propertydesc."','".$url."','".$HideList."','".time()."','".time()."','".$referenceid."','".$secid."','".$externalreferenceid."','".$poid."','".$officeid."','".$geographyid."','".$sid."','".$condo_id."','".$location."','".$locationcode."','".$occupancylimit."','".$nowdate."')";
		

		$insertnew = mysql_query($insert_rental);

		
		$sql_select_max_id=mysql_query("select max(id) as maxid from rental_properties");

		
		$res_select_max_id=mysql_fetch_array($sql_select_max_id);

		
		$max_id=$res_select_max_id['maxid'];

		$rental_id=$max_id;
		

			
		$insertpic="insert into rental_properties_images(referenceid,property_id,cid,imgPreview,imgLarge,imgPic1,imgPic2,imgPic3,imgPic4,imgPic5,imgPic6,imgPic7,imgPic8) values ('".$referenceid."','".$rental_id."','".$secid."','".$imgPreview."','".$imgLarge."','".$imgPic1."','".$imgPic2."','".$imgPic3."','".$imgPic4."','".$imgPic5."','".$imgPic6."','".$imgPic7."','".$imgPic8."')";

		$execpic=mysql_query($insertpic); 		 

		
		 // Add Images 
		
		$Propertyid=$properties[0]['PropertyID'];

		$referenceid=$properties[0]['ReferenceID'];		

		$virtualtoururl=$properties->PropertyDetails->VirtualTourUrl;		
		
		$imagecount = count($properties->PropertyDetails->Photos[0]->Image);
	  
		for ($r=0 ; $r < $imagecount ;$r++) {	
		
		$imageurl = $properties->PropertyDetails->Photos[0]->Image[$r];
			 
			mysql_query("insert into rentals_pictures(cid,referenceid,propertyid,imageurl,virtualtoururl,lastupdate) values ('".$Propertyid."','".$referenceid."','".$rental_id."','".$imageurl."','".$virtualtoururl."','".$nowdate."')");
			
		}

		 
		 // Amenities

		$Amenity = count($properties ->PropertyDetails-> Amenities ->Amenity);

		
		for ($r=0 ; $r < $Amenity ;$r++)
		{	
			$Propertyid=$properties[0]['PropertyID'];
			$Amenityid = $properties ->PropertyDetails-> Amenities->Amenity[$r]['ID'];
			$AmenityType = $properties -> PropertyDetails->Amenities->Amenity[$r]['Type'];
			$AmenityLabel = $properties ->PropertyDetails-> Amenities->Amenity[$r]['Label'];
			$AmenityValue = $properties ->PropertyDetails-> Amenities->Amenity[$r]['Value'];
			$AmenityDescription = $properties ->PropertyDetails-> Amenities->Amenity[$r]['Description'];	
			
			$properties_amenity=mysql_query("insert into rentals_properties_amenity(referenceid,cid,property_id,amenity_id,amenity_type,amenity_label,amenity_value,amenity_description) values ('".$referenceid."','".$secid."','".$rental_id."','".$Amenityid."','".$AmenityType."','".$AmenityLabel."','".$AmenityValue."','".$AmenityDescription."')");
				
		}
	
		// AvailabilityInfo
		
		$ratecount = count($properties -> AvailabilityInfo->Availability );

			
	for ($a=0; $a < $ratecount ;$a++) {

			$strtDate = $properties -> AvailabilityInfo->Availability[$a]['CheckInDate'];

			$endDate = $properties -> AvailabilityInfo->Availability[$a]['CheckOutDate'];

			$startDateWeekCnt = round(floor( date('d',strtotime($strtDate)) / 7)) ;

			$endDateWeekCnt = round(ceil( date('d',strtotime($endDate)) / 7)) ;

			$datediff = strtotime(date('Y-m',strtotime($endDate))."-01") - strtotime(date('Y-m',strtotime($strtDate))."-01");

			$totalnoOfWeek = round(floor($datediff/(60*60*24)) / 7) + $endDateWeekCnt - $startDateWeekCnt;
		

				$weekdate = $properties -> AvailabilityInfo->Availability[$a]['CheckInDate'];

				$date = new DateTime($weekdate);

				$week = $date->format("W");

				$year = $date->format("Y");

				$rates = $properties -> AvailabilityInfo->Availability[$a]['AverageRate'];

			

		for($r=1; $r< $totalnoOfWeek; $r++) {		
		

		$sql_insert_rental_properties_rates=mysql_query("insert into rental_properties_rates(referenceid,property_id,cid,year,week,amount) values ('".$referenceid."','".$rental_id."','".$secid."','".$year."','".$week."','".$rates."')");

		$week++;		

		}	


		$strtDate = $properties -> AvailabilityInfo->Availability[$a]['CheckInDate'];

		$endDate = $properties -> AvailabilityInfo->Availability[$a]['CheckOutDate'];

		$Propertyid=$properties[0]['PropertyID'];	


	

		$sql_insert=mysql_query("insert into rental_properties_rates_rs(referenceid,PropertyID,CheckInDate,CheckOutDate,AverageRate,property_id,updatetime) values ('".$referenceid."','".$Propertyid."','".$strtDate."','".$endDate."','".$rates."','".$rental_id."','".$timegetxml."')");	

					
		$date1=date("Y", strtotime($strtDate)); 

		$date2=date("Y", strtotime($endDate)); 

	if($date1 < $date2){
		
		$datenew = $strtDate;

		$end_date=date("Y-m-d", strtotime("-1 day", strtotime($endDate)));		
		
		while (strtotime($datenew) <= strtotime($end_date)) {			
			
			$sql_insert=mysql_query("insert into rental_properties_rates_rs1(referenceid,PropertyID,CheckInDate,CheckOutDate,AverageRate,property_id,updatetime) values ('".$referenceid."','".$Propertyid."','".$datenew."','".$datenew."','".$rates."','".$rental_id."','".$timegetxml."')");	

			$datenew = date ("Y-m-d", strtotime("+1 day", strtotime($datenew)));		
		  }


	} else {
		
		$enddate=date("Y-m-d", strtotime("-1 day", strtotime($endDate)));
		
		$sql_insert=mysql_query("insert into rental_properties_rates_rs1(referenceid,PropertyID,CheckInDate,CheckOutDate,AverageRate,property_id,updatetime) values ('".$referenceid."','".$Propertyid."','".$strtDate."','".$enddate."','".$rates."','".$rental_id."','".$timegetxml."')");	
	}	  
}

		// RateInfo		

		$ratecountin = count($properties -> RateInfo ->Rate);		

	for ($r=0 ; $r < $ratecountin ;$r++) {	

			$Propertyid=$properties[0]['PropertyID'];

			$Description = $properties -> RateInfo->Rate[$r]['Description'];

			$strtDate = $properties -> RateInfo->Rate[$r]['CheckInDate'];

			$endDate = $properties -> RateInfo->Rate[$r]['CheckOutDate'];

			$DailyRate = $properties -> RateInfo->Rate[$r]['DailyRate'];

			$CheckInDay = $properties -> RateInfo->Rate[$r]['CheckInDay'];

			$Rate1 = $properties -> RateInfo->Rate[$r]['Rate'];	

			$newrate=explode('.',$Rate1);	
			
			$Rate = $newrate[0];
			

		$sql_insert_rental_properties_rates=mysql_query("insert into rental_properties_rates_info(referenceid,property_id,PropertyID,Description,CheckInDate,CheckOutDate,DailyRate,CheckInDay,Rate,updatetime) values ('".$referenceid."','".$rental_id."','".$Propertyid."','".$Description."','".$strtDate."','".$endDate."','".$DailyRate."','".$CheckInDay."','".$Rate."','".$timegetxml."')");

		}
	}
 } 	

	$yearnm=date('Y')-1;	

	$usernames='Cabrera Coastal Real Estate - Diamond Beach, Wildwood Crest, Wildwood & North Wildwood';


	
	mysql_query("insert into search_results_temp(propertyid,cid,location,locationcode,occupancylimit,referenceid,user,propertyheadline,street,city_name,city,zipcode,bedroom,bathroom,halfbath,sleepupto,blocks,pets,smoke,email,propertytype,linen,offstreet,king,queen,doubles,single,bunk,sofa,phone,cancel,deposit,addfees,reqstay,checkin,checkout,propertydesc,rateurl,HideList,full_name,imgPreview,Modified_Date,Id,available) Select rental_properties.id as propertyid,rental_properties.cid,rental_properties.location,rental_properties.locationcode,rental_properties.occupancylimit,rental_properties.referenceid,rental_properties.user,propertyheadline,street,rental_properties.streetheadline,city,zipcode,bedroom,bathroom,halfbath,sleepupto,blocks,pets,smoke,rental_properties.email,propertytype,linen,offstreet,king,queen,doubles,single,bunk,sofa,rental_properties.phone,cancel,deposit,addfees,reqstay,checkin,checkout,propertydesc,rateurl,HideList,'".$usernames."',imgPreview,Modified_date,'7',(select group_concat(week separator ',')  from rental_properties_rates WHERE amount >0 and year!='".$yearnm."' AND property_id = rental_properties.id  group by property_id) as available from rental_properties inner join rental_properties_images on rental_properties_images.property_id=rental_properties.id where HideList!='1' and rental_properties.user='75' order by Modified_date desc");	 

	mysql_query("SET @row_num:=0;");	

	mysql_query("insert into search_results(referenceid,propertyid,cid,user,propertyheadline,street,city_name,city,zipcode,bedroom,bathroom,halfbath,sleepupto,blocks,pets,smoke,email,propertytype,linen,offstreet,king,queen,doubles,single,bunk,sofa,phone,cancel,deposit,addfees,reqstay,checkin,checkout,propertydesc,rateurl,HideList,full_name,imgPreview,location,locationcode,occupancylimit,Modified_Date,TheNumber,Id,available) Select referenceid,propertyid,cid,user,propertyheadline,street,city_name,city,zipcode,bedroom,bathroom,halfbath,sleepupto,blocks,pets,smoke,email,propertytype,linen,offstreet,king,queen,doubles,single,bunk,sofa,phone,cancel,deposit,addfees,reqstay,checkin,checkout,propertydesc,rateurl,HideList,full_name,imgPreview,location,locationcode,occupancylimit,Modified_date,@row_num:=@row_num+1,Id,available from search_results_temp where user='75'");
	

	mysql_query("TRUNCATE TABLE search_results_temp");	
	

	echo date(Y).'-'.date(m).'-'.date(d);	

	echo '<br><br>';

	echo 'Cabrera Coastal Team Rentals Properties Updated successfully';
	
	$defaultgettime=date("m/d/Y-h:i:sA");

	$timegetxml=$xml['TimeStamp'];

	mysql_query("update tbl_availability set rates='$timegetxml',availability='$timegetxml',lastupdate='$defaultgettime'");

	exit;
			

	} else {

	echo 'Cabrera Coastal Team Rentals Properties Not Updated';

	exit;	

	}
?>