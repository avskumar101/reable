<?php
	require_once('config.php');

		//mysql_query("update tbl_listings set active=0");
	
		$rets_login_url = "http://capemay.rets.fnismls.com/rets/fnisrets.aspx/CAPEMAY/login?rets-version=rets/1.5";
		$rets_username = "square#";
		$rets_password = "square1";
	
		$rets_status_field = "L_Status";
                //$rets_status_field = "L_StatusCatID";
		$rets_city_field = "L_ListOffice1";
	
	
		$listing_status = "1_0"; // act - active
                //$listing_status = "1"; // act - active
		//$listing_status = "2_0";
		$listing_city = "628";
	
		require_once("phrets.php");
		$rets = new phRETS;
	
		$rets->SetParam("offset_support", true);
		
	
		$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
		$query = "({$rets_status_field}={$listing_status})";



		$classes = $rets->GetMetadataClasses('Property');
		foreach ($classes as $classval) 
		{
			
			$search = $rets->SearchQuery('Property', $classval['ClassName'],$query);
			while ($listing = $rets->FetchRow($search)) 
			{
                            if($listing['L_ListingID'] == '157392'){
                                print($listing);
                                exit;
                            }
			}		
			
			$rets->FreeResult($search);
		}
		
		echo "+ Disconnecting<br>\n";
		$rets->Disconnect();
?>