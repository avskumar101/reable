<?php 
session_start();

require_once('../config.php');


$filename='Sold Data.xls';
//Manually mention headings of the excel columns

$contents .= "SOLD DATE\t";
$contents .= "DOM\t\t";
$contents .= "ADDRESS\t\t";
$contents .= "CITY\t\t";
$contents .= "STYLE\t\t";
$contents .= "MLS\t\t";
$contents .= "ASKING PRICE\t\t";
$contents .= "SOLD PRICE\n";


$contents .="\n";

//Mysql query to get records from datanbase
$result = mysql_query("select * from tbl_sold where delete_status=0 order by STR_TO_DATE(date,'%m/%d/%Y') desc");

//get particular column data
while($resultarray = mysql_fetch_array($result))
{
    $contents.=$resultarray['date']."\t";
    $contents.=$resultarray['market']."\t\t";
    $contents.=$resultarray['address']."\t\t";
	$contents.=$resultarray['city']."\t\t";
	$contents.=$resultarray['style']."\t\t";
	$contents.=$resultarray['mls_no']."\t\t";
	$contents.=$resultarray['asking_price']."\t\t";
    $contents.=$resultarray['soldprice']."\n";
	
}

// remove html and php tags etc.
$contents = strip_tags($contents); 

//header to make force download the file

header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");
print $contents;
?>