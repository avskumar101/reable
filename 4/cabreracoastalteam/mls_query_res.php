<?php
if (isset($_GET['start']))
$start=$_GET['start'];
else
$start=0;
$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;


$columns = "select * ";

$sql = "from tbl_listings ";

if($_GET['Mls']!='' || $_GET['Address']!='' || $_GET['MLSNO']!='') {
	
	$cond=" where 1=1 and active='1'";

} else {
	
	$cond=" where 1=1 and active='5'";
}	


if($_GET['Mls']=="Cabrera"){
	
	//$cond .= "and Org_Name like 'Cabrera Coastal Real Estate%'";

	$agentfirstname = "Jeanine";

	$agentlastname = "Cabrera";

	if($agentfirstname != "" && $agentlastname != ""){		

		$list_resagents=mysql_query("select * from tbl_listingsagent where delete_status!=1");
	
		$co = 0;
		while($agentlist=mysql_fetch_array($list_resagents)){
		
			$firstname = $agentlist['agent_firstname'];
			$lastname = $agentlist['agent_lastname'];
			
			if($co == 0){
			
			$cond .= " and ((agent_firstname='$firstname' and agent_lastname='$lastname')";
			
			}else{
			
			$cond .= " or (agent_firstname='$firstname' and agent_lastname='$lastname')";
			
			}
			
			$co++;
		}
		
		if($co != 0){
			
		 $cond .= " ) ";
                               
	   }
	
	}
}


if($_GET['Address'] !=""){	

	$search_addresstext = $_GET['Address'];
	
	$search_city = $_GET['Town'];
	
	if($search_addresstext !=""){
		
		$cond .= " and Address like '%$search_addresstext%'";
	}
	
	if($search_city !=""){

        if ($search_city == "Diamond Beach"){
				
			$cond .= " and (Area = 'Diamond Beach') ";
	   
	   }	   else if($search_city == "Seapointe Village"){													$cond .= " Org_Name = 'SEAPOINTE VILLAGE REALTY CO' )";																				}						else{
			
			$cond .= " and city = '$search_city'";
	   }
	}	
	
	
} else if($_GET['MLSNO']!="") {
	
	
	$val = $_GET['MLSNO'];	
	
	if ($val!='0' && $val!="")
	{
		$mlsnosearch = $val;		
		$cond .= " and MLSno in ($mlsnosearch)";
	}
	
	
} else if($_GET['Mls'] == "Search" || $_GET['Mls'] == "Home") {
		
		
	// Select Town		
		
	$towns = $_GET['Town'];	

	if($towns!="All"){
		
		$townscount = explode(",",$_GET['Town']);

		for($p=0; $p<count($townscount); $p++) {
			
				if($p == 0){
					
					if($townscount[$p] != "All"){
						
						$cond .= " and (";
					}
				}			
				if($p == count($townscount)-1){
					
					if($townscount[$p] != "All"){
						
						if ($townscount[$p] == "Diamond Beach"){
							   
							$cond .= " Area = '$townscount[$p]' )";	
							
						}						else if($townscount[$p] == "Seapointe Village")						{													$cond .= " Org_Name = 'SEAPOINTE VILLAGE REALTY CO' )";																				}						else{
						   
							$cond .= " city = '$townscount[$p]' )";	
						}					
					}
									
				} else {				
					
					if($townscount[$p] != "All"){
						
						if ($townscount[$p] == "Diamond Beach"){
						
							$cond .= " Area = '$townscount[$p]' OR ";	
						
						}                       else if($townscount[$p] == "Seapointe Village"){													$cond .= " Org_Name = 'SEAPOINTE VILLAGE REALTY CO' )";																				}						else {
							
							$cond .= " city = '$townscount[$p]' OR ";	
						}
					}				
				}
			}
	}
	
	// End Town
	
	// Type 
	
	$properties = explode(",",$_GET['Type']);
	
	$propcount = count($properties);
	
	if($properties[0]!=''){
		
		$cond .= " and (";
		
		for($p=0;$p<$propcount; $p++){			

			if($p == $propcount-1){
				
				$property_type = $properties[$p];
				
				if($property_type == "CONDO" || $property_type == "TOWNHOUSE"){
					//$properties[$p] = "CONDO/TOWNHOUSE";
				}
				
				if($property_type == "Modular/Mobile"){
					
					$indexarray = explode("/",$property_type);
					
					$indexcount = count($indexarray);
					
					for($type=0;$type<count($indexarray);$type++){
									
						if($type == $indexcount-1){
							
							$cond .= " type = '$indexarray[$type]') ";
							
						}else{
							
							$cond .= " type = '$indexarray[$type]' OR ";
						}
					}
					
				}else{
					
					$cond .= "class = '$properties[$p]' OR type = '$properties[$p]' )";
				}
				
			}else{
				
				$property_type = $properties[$p];
				
				if($property_type == "CONDO" || $property_type == "TOWNHOUSE"){
					//$properties[$p] = "CONDO/TOWNHOUSE";
				}
				if($property_type == "Modular/Mobile"){
					
					$indexarray = explode("/",$property_type);
					
					$indexcount = count($indexarray);
					
					for($type=0;$type<count($indexarray);$type++){
						
						if($type == $indexcount-1){
							
							$cond .= " type = '$indexarray[$type]' OR ";
							
						}else{
							
							$cond .= " type = '$indexarray[$type]' OR ";
						}
					}
					
				}else{
					$cond .= " class = '$properties[$p]' OR type = '$properties[$p]' OR ";
				}
			}
		}
	}
	
	// Type End 
	
	
	// Price
	$minprice = $_GET['MinPrice'];
	
	if($minprice !=""){
		
		$cond .= " and Asking_Price >= '$minprice'";
	}
	$maxprice = $_GET['MaxPrice'];
	
	if($maxprice !=""){
		
		$cond .= " and Asking_Price <= '$maxprice'";
	}	
	if($minprice==""){
		
		$cond .= " and Asking_Price >= '0'";
	}
	if($maxprice==""){
		
		$cond .= " and Asking_Price <= '99999999'";
	}
	// Price End 
	
		
	// Beds 
	
	$selbedsmin = $_GET['BedsMin'];
		
	if($selbedsmin !=""){
		
		$cond .= " and bedrooms >= '$selbedsmin'";
	}	
	$selbedsmax = $_GET['BedsMax'];
	
	if($selbedsmax !=""){
		
		$cond .= " and bedrooms <= '$selbedsmax'";
	}		
	
	$baths = $_GET['BTH'];
	
	if($baths !=""){
		
		$cond .= " and Full_Baths >= '$baths'";
	}
	
	// Beds End
		
	$foreclosure = $_GET['FC'];
	
	if($foreclosure !=""){
		
		if($foreclosure == "Yes"){
			
			$cond .= " and bankowned != 'No'";
			
		}else if($foreclosure == "No"){
			
			$cond .= " and bankowned = 'No'";
			
		}else{
			//$cond .= " and remarks NOT like '%BANK OWNED%'";
		}
	}
		
	 // MLS Search End 	 
 }

 if($_GET['OB']!=''){
	 
	$sortby = ' Asking_Price '.$_GET['OB'];
 
 } else {
	 
	$sortby = ' Asking_Price desc';
 }
 
 
$sql_count = "select count(*) ".$sql.$cond; 

$mapsql = $sql;

$mapsql .= $cond." order by ".$sortby;

$sql .= $cond." order by ".$sortby." limit $start, $pagesize  ";

$sql = $columns.$sql;

$mapsql = $columns.$mapsql;

//echo $sql;

//echo $mapsql;

$result = mysql_query($sql) or die(db_error($sql));

$mapresult = mysql_query($mapsql) or die(db_error($mapsql));

$rows = mysql_num_rows($result);

$reccnt = db_scalar($sql_count);

function db_scalar($sql, $dbcon2 = null)
{
	$result	= mysql_query($sql) or	die(db_error($sql));
	if ($line =	mysql_fetch_array($result))	{
		$response =	$line[0];
	}
	return $response;
}

function qry_str($arr, $skip = '')
{
	$s = "?";
	$i = 0;
	foreach($arr as	$key =>	$value)	{
		if ($key !=	$skip) {
			if (is_array($value)) {
				foreach($value as $value2) {
					if ($i == 0) {
						$s .= $key . '[]=' . $value2;
						$i = 1;
					} else {
						$s .= '&' .	$key . '[]=' . $value2;
					}
				}
			} else {
				if ($i == 0) {
					$s .= "$key=$value";
					$i = 1;
				} else {
					$s .= "&$key=$value";
				}
			}
		}
	}
	return $s;
}

?>