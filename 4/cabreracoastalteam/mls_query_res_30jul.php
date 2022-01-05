<?php
if (isset($_GET['start']))
$start=$_GET['start'];
else
$start=0;
$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;
$columns = "select * ";

$sql = "from tbl_listings ";
$cond=" where 1=1 ";

$sortby = "Original_Price desc";

$orgname = $_SESSION['ORGNAME'];
$agentfirstname = $_SESSION['AGENTFIRSTNAME'];
$agentlastname = $_SESSION['AGENTLASTNAME'];
$search_cityind = $_SESSION['SEARCHCITY'];
if($orgname != ""){
	$cond .= "and Org_Name = '$orgname'";
	if($agentfirstname != "" && $agentlastname != ""){
		$cond .= "and agent_firstname = '$agentfirstname' and agent_lastname = '$agentlastname' ";
	}
}


if($_SESSION['searchtype'] == "search_mlsaddress"){	
	$search_addresstext = $_SESSION['ADDRESS'];
	$search_city = $_SESSION['CITY'];
	if($search_addresstext !=""){
		$cond .= " and Address like '%$search_addresstext%'";
	}
	if($search_city !=""){
		$cond .= " and city = '$search_city'";
	}
	
	
}else if($_SESSION['searchtype'] == "search_mlsnumber"){
	$val = $_SESSION['MLSNO'];	
	if ($val!='0' && $val!="")
	{
		$mlsnosearch = $val;
		$cond .= " and MLSno=$mlsnosearch";
	}
}
else if($_SESSION['searchtype'] == "search_mlsadvance"){

	$towns = $_SESSION['TOWNS'];
	$townscount = count($towns);
	if($townscount > 0){
		for($p=0;$p<$townscount; $p++){
			if($p == 0){
				if($towns[$p] != "All"){
					$cond .= " and (";
				}
			}

			if($p == $townscount-1){
				if($towns[$p] != "All"){
					$cond .= " city = '$towns[$p]' )";	
				}
				
			}else{
				if($towns[$p] != "All"){
					$cond .= " city = '$towns[$p]' OR ";
				}
			}
		}
	}
	
	$properties = $_SESSION['PROPERTIES'];
	$propcount = count($properties);
	if($propcount > 0){
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
						//$cond .= " type = '$indexarray[$type]' OR ";
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
						//$cond .= " type = '$indexarray[$type]' OR ";
						if($type == $indexcount-1){
							$cond .= " type = '$indexarray[$type]' OR ";
						}else{
							$cond .= " type = '$indexarray[$type]' OR ";
						}
					}
				}else{
					$cond .= " class = '$properties[$p]' OR type = '$properties[$p]' OR ";
				}
								//				$cond .= " type = '$properties[$p]' OR ";
			}
			/*
			if($p == $propcount-1){
				$property_type = $properties[$p];
				if($property_type == "Modular / Mobile"){
				}
				$cond .= " type = '$properties[$p]' )";
			}else{
				$cond .= " type = '$properties[$p]' OR ";
			}
			*/
		}
	}
	
	$minprice = $_SESSION['MINPRICE'];
	if($minprice !=""){
		$cond .= " and Original_Price >= '$minprice'";
	}
	
	$maxprice = $_SESSION['MAXPRICE'];
	if($maxprice !=""){
		$cond .= " and Original_Price <= '$maxprice'";
	}
	
	$beds = $_SESSION['BEDS'];
	if($beds !=""){
		$cond .= " and Bedrooms >= '$beds'";
	}
	
	$baths = $_SESSION['BATHS'];
	if($baths !=""){
		$cond .= " and Full_Baths >= '$baths'";
	}
	
	$foreclosure = $_SESSION['FORECLOSURE'];
	if($foreclosure !=""){
		if($foreclosure == "Yes"){
			$cond .= " and remarks like '%BANK OWNED%'";
		}else if($foreclosure == "No"){
			$cond .= " and remarks NOT like '%BANK OWNED%'";
		}else{
			//$cond .= " and remarks NOT like '%BANK OWNED%'";
		}
	}
	$soldprop = $_SESSION['SOLD'];
	if($soldprop !=""){
	
		if($soldprop == "Just Sold Properties"){
			$cond .= " and status='sold'";
		}else if($soldprop == "No"){
		
			$cond .= " and status='active'";
		}else{
			//$cond .= " and remarks NOT like '%BANK OWNED%'";
		}
	}
	
	$sortby = $_SESSION['SORTBY'];
	
}else if($_SESSION['searchtype'] == "search_mlshome"){

	$search_city = $_SESSION['HOMECITY'];	
	if($search_city !=""){
		$cond .= " and city = '$search_city'";
	}
	$beds = $_SESSION['HOMEBEDS'];
	if($beds !=""){
		$cond .= " and Bedrooms >= '$beds'";
	}
	$baths = $_SESSION['HOMEBATHS'];
	if($baths !=""){
		$cond .= " and Full_Baths >= '$baths'";
	}
	$minprice = $_SESSION['HOMEMINPRICE'];
	if($minprice !=""){
		$cond .= " and Original_Price >= '$minprice'";
	}
	
	$maxprice = $_SESSION['HOMEMAXPRICE'];
	if($maxprice !=""){
		$cond .= " and Original_Price <= '$maxprice'";
	}
	
	
}else  if($_SESSION['searchtype'] == "search_individual"){
	if($search_cityind == "Lower Township"){
		$cond .= " and (city = 'Lower Township' or city = 'Villas' or city = 'Cold Spring' or city = 'Fishing Creek' or city = 'Townbank' or city = 'Erma' or city = 'Diamond Beach' or city = 'North Cape May') ";
	}
	else if ($search_cityind == "Middle Township"){
		$cond .= " and (city = 'Middle Township' or city = 'Burleigh' or city = 'Cape May Court House' or city = 'Rio Grande' or city = 'Whitesboro' or city = 'Dias Creek' or city = 'Green Creek') ";
	}else if ($search_cityind == "Diamond Beach"){
		$cond .= " and (city = 'Diamond Beach' or city = 'Lower Township') ";
	}
	else
		$cond .= " and city = '$search_cityind'";
	
}



$sql_count = "select count(*) ".$sql.$cond; 
$sql .= $cond." order by ".$sortby." limit $start, $pagesize  ";
//$sql .= $cond." order by Original_Price asc limit $start, $pagesize  ";
$sql = $columns.$sql;
//echo $sql;

$result = mysql_query($sql) or die(db_error($sql));
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