<?php 
session_start();

require_once('../config.php');


$filename='Stored Data.xls';
//Manually mention headings of the excel columns

$contents .= "Name\t";
$contents .= "Email\t";
$contents .= "Friend_Name\t";
$contents .= "Friend_Email\t";
$contents .= "Feature\t";
$contents .= "Date\t";
$contents .= "Address\t";
$contents .= "Address1\t";
$contents .= "Home Phone\t";
$contents .= "Business Phone\t";
$contents .= "Business Phone\t";
$contents .= "Address\t";
$contents .= "City\t";
$contents .= "State\t";
$contents .= "ZIP\t";

$contents .= "Comments\t";



$contents .="\n";

//Mysql query to get records from datanbase
$result = mysql_query('select * from tbl_storeddata where delete_status=0 order by id desc');

//get particular column data
while($resultarray = mysql_fetch_array($result))
{
    $contents.=$resultarray['name']."\t";
    $contents.=$resultarray['frd_name']."\t";
	 $contents.=$resultarray['frd_email']."\t";
	  $contents.=$resultarray['emailid']."\t";
    $contents.=$resultarray['pagename']."\t";
    $contents.=$resultarray['createon']."\t";
	  $contents.=$resultarray['adderss1']."\t";
	    $contents.=$resultarray['adderss2']."\t";
		  $contents.=$resultarray['homephone']."\t";
		    $contents.=$resultarray['busphone']."\t";
			  $contents.=$resultarray['busphone1']."\t";
			    $contents.=$resultarray['adderss3']."\t";
				  $contents.=$resultarray['city']."\t";
				    $contents.=$resultarray['state']."\t";
					   $contents.=$resultarray['zip']."\t";
	 $contents.=$resultarray['comment']."\n";
	
}

// remove html and php tags etc.
$contents = strip_tags($contents); 

//header to make force download the file

header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");
print $contents;
?>