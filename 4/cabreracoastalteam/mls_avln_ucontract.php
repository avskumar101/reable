<?php
if (isset($_GET['start']))
$start=$_GET['start'];
else
$start=0;
$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;


$columns = "select * ";

$sql = "from tbl_listings where 1=1 and active='1' ";

$cond .= " and ( city = 'Avalon' OR city = 'Stone Harbor')  and Status like'%UNDER CONTRACT%' ";


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