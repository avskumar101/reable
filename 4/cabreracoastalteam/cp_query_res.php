<?php
if (isset($_GET['start']))
$start=$_GET['start'];
else
$start=0;
$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;
$columns = "select * ";

$sql = "from tbl_listings ";
$cond=" where 1=1 ";




if($_POST['search_address'] == "search_mlsaddress"){
	$search_addresstext = $_POST['search_addresstext'];
	$search_city = $_POST['pSearchCities'];
	if($search_addresstext !=""){
		$cond .= " and Address like '%$search_addresstext%'";
	}
	if($search_city !=""){
		$cond .= " and city = '$search_city'";
	}
	
	
}else if($_POST['search_number'] == "search_mlsnumber"){
	$val = $_POST['mlsnumbersearch'];	
	if ($val!='0' && $val!="")
	{
		$mlsnosearch = $val;
		$cond .= " and MLSno=$mlsnosearch";
	}
}


$sql_count = "select count(*) ".$sql.$cond; 
$sql .= $cond." order by Original_Price asc limit $start, $pagesize  ";
$sql = $columns.$sql;


echo $sql;
 
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