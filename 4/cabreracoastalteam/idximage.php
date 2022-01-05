<?php

	require_once("config_cron.php");	error_reporting(E_ERROR | E_PARSE);	ini_set('max_execution_time', -1);	ini_set("memory_limit",-1);
	
	$rets_login_url = "http://capemay.rets.fnismls.com/rets/fnisrets.aspx/CAPEMAY/login?rets-version=rets/1.5";
	
	$rets_username = "square#";
	
	$rets_password = "square1";	
	
	require_once("phrets.php");
	
	$rets = new phRETS;
	
	$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
	
	$rowres=mysql_query("select MLSNo from tbl_listings where active='1'");
	
	while ($rowdata = mysql_fetch_array($rowres))
	{
		$photos = $rets->GetObject("Property", "Photo", $rowdata['MLSNo'], "*" , 1);
		$ph=0;	

		$mainimages=$photos[0]['Location'];			

		if($mainimages!='')	{
			
		$photoqry="  update tbl_listings set mainimg='".$photos[0]['Location']."' ,addimg1='".$photos[1]['Location']."'  ,addimg2='".$photos[2]['Location']."' ,addimg3='".$photos[3]['Location']."' ,addimg4='".$photos[4]['Location']."' ,addimg5='".$photos[5]['Location']."'  ,addimg6='".$photos[6]['Location']."' ,addimg7='".$photos[7]['Location']."'  ,addimg8='".$photos[8]['Location']."' ,addimg9='".$photos[9]['Location']."' ,addimg10='".$photos[10]['Location']."' ,addimg11='".$photos[11]['Location']."' ,addimg12='".$photos[12]['Location']."',addimg13='".$photos[13]['Location']."',addimg14='".$photos[14]['Location']."',addimg15='".$photos[15]['Location']."',addimg16='".$photos[16]['Location']."',addimg17='".$photos[17]['Location']."',addimg18='".$photos[18]['Location']."',addimg19='".$photos[19]['Location']."',addimg20='".$photos[20]['Location']."',addimg21='".$photos[21]['Location']."',addimg22='".$photos[22]['Location']."',addimg23='".$photos[23]['Location']."',addimg24='".$photos[24]['Location']."',addimg25='".$photos[25]['Location']."'  where MLSNo='".$rowdata['MLSNo']."'";
		
		mysql_query($photoqry);				
		
		}
		
		$rets->FreeResult($photos);
		
	}
	
	echo "IDX Images";
?>