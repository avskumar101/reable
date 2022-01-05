<?php
if (isset($_GET['start']))
$start=$_GET['start'];
else
$start=0;
$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;


$sql = "SELECT * FROM search_results_data where cid!='0' order by rate asc LIMIT $start, $pagesize";

$sql_count = "SELECT count(*) FROM search_results_data where cid!='0' order by rate asc";

$mapsql =$sql;

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