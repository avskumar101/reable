<?php

if (isset($_GET['start']))

$start=$_GET['start'];

else

$start=0;

$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;

$columns = "select * ";



$sql = "from tbl_listings ";

$cond=" where 1=1 and active = 1 ";

$sortby = "Asking_Price desc";


$orgname = $_SESSION['ORGNAME'];

$agentfirstname = $_SESSION['AGENTFIRSTNAME'];

$agentlastname = $_SESSION['AGENTLASTNAME'];

$search_cityind = $_SESSION['SEARCHCITY'];

if($orgname != ""){

	$cond .= "and Org_Name like '$orgname'";

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


if($_SESSION['searchtype'] == "search_mlsaddress"){	

	$search_addresstext = $_SESSION['ADDRESS'];

	$search_city = $_SESSION['CITY'];

	if($search_addresstext !=""){

		$cond .= " and Address like '%$search_addresstext%'";

	}

if($search_city !=""){


        if ($search_city == "Diamond Beach"){

			$cond .= " and (Area = 'Diamond Beach') ";

	    }		else if($search_city == "Seapointe Village")		{													$cond .= " Org_Name = 'SEAPOINTE VILLAGE REALTY CO' )";																}		else{

			$cond .= " and city = '$search_city'";

        }
}


} else if($_SESSION['searchtype'] == "search_mlsnumber"){

	$val = $_SESSION['MLSNO'];	

	if ($val!='0' && $val!="")	{

		$mlsnosearch = $val;

		$cond .= " and MLSno=$mlsnosearch";

	}

} else if($_SESSION['searchtype'] == "search_mlsadvance"){

	$towns = $_SESSION['TOWNS'];

	if($towns != "All"){

        if ($towns == "Diamond Beach"){

			$cond .= " and (Area = 'Diamond Beach') ";

	    }		else if($towns == "Seapointe Village")		{								$cond .= " Org_Name = 'SEAPOINTE VILLAGE REALTY CO' )";																}		else{

			$cond .= " and city = '$towns'";
        }
}
	
	$properties = $_SESSION['PROPERTIES'];

	if($properties !=""){

		$cond .= " and (type = '$properties') ";

	}

	$minprice = $_SESSION['MINPRICE'];

	if($minprice !=""){

		$cond .= " and Asking_Price >= '$minprice'";

	}

	$maxprice = $_SESSION['MAXPRICE'];

	if($maxprice !=""){

		$cond .= " and Asking_Price <= '$maxprice'";

	}
	

	$selbedsmin = $_SESSION['BEDSMIN'];
		
	if($selbedsmin !=""){
		
		$cond .= " and bedrooms >= '$selbedsmin'";
	}
	
	$selbedsmax = $_SESSION['BEDSMAX'];
	
	if($selbedsmax !=""){
		
		$cond .= " and bedrooms <= '$selbedsmax'";
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

} else if($_SESSION['searchtype'] == "search_mlshome"){

	$search_city = $_SESSION['HOMECITY'];	

	if($search_city !=""){

		$cond .= " and city = '$search_city'";

	}

	$selbedsmin = $_SESSION['BEDSMIN'];
		
	if($selbedsmin !=""){
		
		$cond .= " and bedrooms >= '$selbedsmin'";
	}
	
	$selbedsmax = $_SESSION['BEDSMAX'];
	
	if($selbedsmax !=""){
		
		$cond .= " and bedrooms <= '$selbedsmax'";
	}

	$baths = $_SESSION['HOMEBATHS'];

	if($baths !=""){

		$cond .= " and Full_Baths >= '$baths'";

	}

	$minprice = $_SESSION['HOMEMINPRICE'];

	if($minprice !=""){

		$cond .= " and Asking_Price >= '$minprice'";

	}

	$maxprice = $_SESSION['HOMEMAXPRICE'];

	if($maxprice !=""){

		$cond .= " and Asking_Price <= '$maxprice'";

	}	

} else  if($_SESSION['searchtype'] == "search_individual"){

	if($search_cityind == "Lower Township"){

		$cond .= " and (city = 'Lower Township' or city = 'Villas' or city = 'Cold Spring' or city = 'Fishing Creek' or city = 'Townbank' or city = 'Erma' or city = 'Diamond Beach' or city = 'North Cape May') ";

	} else if ($search_cityind == "Middle Township"){

		$cond .= " and (city = 'Middle Township' or city = 'Burleigh' or city = 'Cape May Court House' or city = 'Rio Grande' or city = 'Whitesboro' or city = 'Dias Creek' or city = 'Green Creek') ";

	}else if ($search_cityind == "Diamond Beach"){

		$cond .= " and (Area = 'Diamond Beach') ";

	}	else if($search_cityind == "Seapointe Village")	{								$cond .= " Org_Name = 'SEAPOINTE VILLAGE REALTY CO' )";														    } 	else {

		$cond .= " and city = '$search_cityind'";
	}	

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