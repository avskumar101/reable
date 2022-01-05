<?php


if (isset($_GET['start']))
$start=$_GET['start'];
else
$start=0;

$pagesize = intval($pagesize)==0?$pagesize=100:$pagesize;


$columns = "select * ";

$directoryURI =basename($_SERVER['SCRIPT_NAME']);

			$filename=$directoryURI; 
			
			if($filename=='capemaysold.php') 
			{		
			$cityname="Cape May";
			}

			if($filename=='avalonsold.php') 
			{	
			$cityname="Avalon";	
			$citystone="Stone Harbor";
			} 
			
			if($filename=='diamondbeachsold.php') 
			{		
			$cityname="Diamond Beach";
			$citydiamond ="Lower Township/SeapointeVillage";
			}

			if($filename=='wildwoodcrestsold.php') 
			{	
			$cityname="Wildwood Crest";	
			} 
			
			if($filename=='wildwoodsold.php')
			{	
			$cityname="Wildwood";
			$citywild="Wildwood Crest";
			}

			if($filename=='westwildwoodsold.php') 
			{	
			$cityname="West Wildwood";	
			}


			if($filename=='northwildwoodsold.php') 
			{	
			$cityname="North Wildwood";	
			}  
			
			if($filename=='lowertownshipsold.php') 
			{		
			$cityname="Lower Township";	
			$citylwr = " or City like '%Bayside Village%' or City like '%Cape May Beach%' or City like '%Cold Spring%' or City like '%Erma%' or City like '%Fishing Creek%' or City like '%North Cape May%' or City like '%Shaw Crest%' or City like '%Townbank%' or City like '%Villas%'"; 
			} 

			if($filename=='middletownshipsold.php')
			{		
			$cityname="Middle Township";	
			$citybul = " or City like '%Burleigh%' or City like '%Cape May Court House%' or City like '%Del Haven%' or City like '%Dias Creek%' or City like '%Edgewood%' or City like '%Goshen%' or City like '%Grassy Sound%' or City like '%Green Creek%' or City like '%Mayville%' or City like '%Reed Beach%' or City like '%Rio Grande%' or City like '%Rio Grande/Shannon Oaks%' or City like '%Swainton%' or City like '%The Links at Avalon/Swainton%' or City like '%Whitesboro%'";	
			}
			
$sql = "from tbl_sold ";

if($citystone != "")
{
$cond=" where 1=1 and (City like '%$cityname%' or City like '%Stone Harbor%')";
}

elseif($citydiamond != "")
{
$cond=" where 1=1 and (City like '%$cityname%' or City like '%$citydiamond%')";
}
elseif($citybul != "")
{
$cond=" where 1=1 and (City like '%$cityname%'$citybul)";
}
elseif($citywild != "")
{
$cond=" where 1=1 and (City like '%$cityname%' and City Not like '%$citywild%')";
}
elseif($citylwr != "")
{
$cond=" where 1=1 and (City like '%$cityname%' $citylwr)";
}
else
{
$cond=" where 1=1 and City like '%$cityname%'";
}

if($_GET[sl] != "" && $_GET[sl] != "All Features")
{

if($_GET['sl'] == "Multi Family")
{

$cond .= " and (Type like '%Duplex%' or Type like '%Triplex%' )";


}
else{

$cond .= " and Type like '%".$_GET['sl']."%' ";


}

}

$cond .= " and closingdate < CURDATE() order by closingdate desc ";

$mapsql = $sql;
$mapsql .= $cond;

$sql_count = "select count(*) ".$sql.$cond;
$sql .= $cond."  limit $start, $pagesize  ";
$sql = $columns.$sql;

//echo $sql;

$result = mysql_query($sql) or die(db_error($sql));
//$mapresult = mysql_query($mapsql) or die(db_error($mapsql));
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