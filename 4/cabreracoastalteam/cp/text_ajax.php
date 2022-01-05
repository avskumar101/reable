<?php 


	session_start();

	require_once('../config.php');	

$mlsno=$_POST['mlsno'];


$lststmt = mysql_fetch_array(mysql_query("SELECT tour_url FROM tbl_listings where MLSNo='".$mlsno."'")); 

if($lststmt!=''){
	
$link=$lststmt['tour_url'];

}else{
	
	$link="";

}

echo $link;
?>
 