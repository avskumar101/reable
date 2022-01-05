<?php
if (isset($_GET['start']))
$start=$_GET['start'];
else
$start=0;
$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;
$columns = "select * ";

$sql = "from tbl_listings ";
$cond=" where 1=1 and active=1 and lat!='' and lon!=''";
$sortby = "Asking_Price asc";
if($_SESSION['searchtype'] == "search_mlsmap"){
	$search_city = $_SESSION['CITY'];
	if($search_city !=""){
            if ($search_city == "Diamond Beach"){
		$cond .= " and (Area = 'Diamond Beach') ";
	    }else{
		$cond .= " and city = '$search_city'";
            }
	}
	$search_zip = $_SESSION['ZIPCODE'];
	if($search_zip !=""){
		$cond .= " and zip = '$search_zip'";
	}

	$properties = $_SESSION['PROPERTIES'];
	$propcount = count($properties);
	if($propcount > 0){
		$cond .= " and (";
		for($p=0;$p<$propcount; $p++){


			if($p == $propcount-1){
				$property_type = $properties[$p];

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
			}
		}
	}

	$minprice = $_SESSION['MINPRICE'];
	if($minprice !=""){
		$cond .= " and Asking_Price >= '$minprice'";
	}

	$maxprice = $_SESSION['MAXPRICE'];
	if($maxprice !=""){
		$cond .= " and Asking_Price <= '$maxprice'";
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
		if($foreclosure == "yes"){
			$cond .= " and remarks like '%BANK OWNED%'";
		}else{
			$cond .= " and remarks NOT like '%BANK OWNED%'";
		}
	}

	$sortby = $_SESSION['SORTBY'];

}

$mapsql = $sql;
$mapsql .= $cond;

$sql_count = "select count(*) ".$sql.$cond;
$sql .= $cond."  limit $start, $pagesize  ";
$sql = $columns.$sql;
$mapsql = $columns.$mapsql;


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