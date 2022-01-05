<?php

require_once('config.php');

	
	$checkindate=date('Y-m-d', strtotime($_REQUEST['checkin']));	

	$checkoutdate=date('Y-m-d', strtotime($_REQUEST['checkout']));	
		
	// Availability
	$dataavl="";		
			
	$cond=" and (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ";
		
	$STM2 = mysql_query("SELECT * FROM rental_properties_rates_rs where CheckInDate!='' $cond group by referenceid");
		
	
	$rfid='';
	$i=0;	
	while($avl=mysql_fetch_array($STM2)) {
		
		if($available=='') {
			
			$rfid.=" and ( referenceid='".$avl['referenceid']."'";
			$available='property';
			
		} else {
			
			$rfid.=" or referenceid='".$avl['referenceid']."'";
		}	

	$i++;
	}	
	
	if($available=='property') {		
		$avble= $rfid.')';		
	}

	
	// Price Range
	
	$miniprice=$_REQUEST['mpr'];
	
	if($miniprice!='undefined' && $miniprice!=''){
		
		$miniprice=$_REQUEST['mpr'];
		
	} else {
		$miniprice="";
	}
	
	$maxmprice=$_REQUEST['mxp'];
	
	if($maxmprice!='undefined' && $maxmprice!=''){
		
		$maxmprice=$_REQUEST['mxp'];
		
	} else {
		$maxmprice="";
	}
	
	if($miniprice!='' || $maxmprice!='') {
	
		$cnd=$avble;
		$minprice= $_REQUEST['mpr'];
		$maxprice= $_REQUEST['mxp'];
		
		$ratein = " and  Rate >= 1 and Rate BETWEEN '".$minprice."' AND '".$maxprice."' AND (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ".$cnd." group by referenceid";
		
		$ssrt = mysql_num_rows(mysql_query("SELECT * FROM rental_properties_rates_info where referenceid!='0' $ratein"));
		
		if($ssrt>0){

			$rateinf = " and  Rate >= 1 and Rate BETWEEN '".$minprice."' AND '".$maxprice."' AND (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ".$cnd." group by referenceid";


		} else {

			$rateinf = " and  Rate >= 1 and Rate BETWEEN '".$minprice."' AND '".$maxprice."' AND (CheckInDate >= '".$checkindate."' AND CheckOutDate <= '".$checkoutdate."') ".$cnd." group by referenceid";
		
		}	

		$STM1 = mysql_query("SELECT * FROM rental_properties_rates_info where referenceid!='0' $rateinf");
			
		$rts='';
		$p=1;	
		while($avln=mysql_fetch_array($STM1)) {
								
			if($prc=='') {
				
				$rts.=$avln['referenceid'];
				$prc='available';
				
			} else {
				
				$rts.="','".$avln['referenceid'];
			}
							
		$p++;		
		}
						
		if($rts!="") {
		
			$rtsn.= " and referenceid in ('".$rts."')";
			
		} else {
			
			$rtsn.= " and referenceid in ()";
		}

		
		if($prc=='available') {	
		
			$avbles= $rtsn;
			$dataavl="available";		
		}
		
				
	} else {
		
		$avbles= $avble;
		$dataavl="available";
	}
			
	$wherecond= $avbles;	
	
	if($dataavl=='available') {
		
		$mysql= $wherecond;
	}
	
		

	$propertiesarray = $_REQUEST['amm'];

	$properties = explode(',',$propertiesarray);

	$propcount = count($properties);

	if($properties[0] != ""){		
						
			if($_REQUEST['internet']==1) {

			$amcnd.= ",Wifi,High Speed Internet";
			
			}
			
	} else {
		
		if($_REQUEST['internet']==1) {

			$amcnd.= "Wifi,High Speed Internet";
			
		}
	}			
		
	$propertiesarray = $_REQUEST['amm'].$amcnd;

	$properties = explode(',',$propertiesarray);

	$propcount = count($properties);
	
	
	if($properties[0] != ""){
		
		$amcond .= " and (";
		
		for($p=0;$p<$propcount; $p++){			

			if($p == $propcount-1){
				
				$property_type = $properties[$p];
								
				$amcond .= " amenity_label like '%$properties[$p]%' )";
				
			}else{
				
				$property_type = $properties[$p];
								
				$amcond .= " amenity_label like '%$properties[$p]%' OR ";
							
			}			
		}
	}
	
	
	if($amcond!='') {
					
		$STM3 =mysql_query("SELECT * FROM rentals_properties_amenity where referenceid!='0' $mysql $amcond group by cid");
					
		$i=0;
		while($rowq=mysql_fetch_array($STM3)){

			if($i==0)	
			{
				$condinsert.=$rowq['cid'];
				
			} else {
				
				$condinsert.="','".$rowq['cid'];
			}			
			
		$i=$i+1;	
		}

		// 	Selected Ucode Only //	
		if($condinsert!="") {
		
			$mysql.= " and cid in ('".$condinsert."')";
			
		} else {
			
			$mysql.= " and cid in ()";
		}		
	}		
	
	// bedrooms	
	if($_REQUEST['bdrm']!='undefined' && $_REQUEST['bdrm']!='') {			
		$mysql.=" and bedroom >= '".$_REQUEST['bdrm']."'";		
	}	
	// bathrooms	
	if($_REQUEST['bthrm']!='undefined' && $_REQUEST['bthrm']!='') {
		$mysql.=" and bathroom+halfbath >= '".$_REQUEST['bthrm']."'";
	}	
	// sleeps	
	if($_REQUEST['sleeps']!='undefined' && $_REQUEST['sleeps']!='') {
		$mysql.=" and sleepupto >= '".$_REQUEST['sleeps']."'";
	}			
	// Pets	
	if($_REQUEST['pet']!='undefined' && $_REQUEST['pet']!='') {
		
		
		if($_REQUEST['pet']==0) {
			
			$mysql.=" and pets='No' ";
			
		} else {
			
			$mysql.=" and pets='Yes' ";
		}
	}	
	
	// Location	
	if($_REQUEST['town']!='undefined' && $_REQUEST['town']!='') {
		
		$lcn=$_REQUEST['town'];
			
		$mysql.=" and city='".$lcn."'";
	}	
	
	// Location	
	if($_REQUEST['SF']!='undefined' && $_REQUEST['SF']!='') {
		
		$SFY=$_REQUEST['SF'];
			
		$mysql.=" and propertytype like '%".$SFY."%'";
	}	
	
	//echo "SELECT * FROM search_results where HideList='0' $mysql order by propertyheadline asc";
	
	$ss = mysql_num_rows(mysql_query("SELECT * FROM search_results where HideList='0' $mysql order by propertyheadline asc"));

	if($ss==0){
		
		echo '0';
		
	} else {

		echo $ss;
	}	
?>