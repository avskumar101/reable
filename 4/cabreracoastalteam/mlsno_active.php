<?php
		require_once('config_cron.php');
		error_reporting(E_ERROR | E_PARSE);
		ini_set('max_execution_time', -1);
		ini_set("memory_limit",-1);
		
		mysql_query("TRUNCATE TABLE tbl_mlsno_update");	

		$rets_login_url = "http://capemay.rets.fnismls.com/rets/fnisrets.aspx/CAPEMAY/login?rets-version=rets/1.5";

		$rets_username = "square#";

		$rets_password = "square1";	

        $rets_status_field = "L_StatusCatID";

		$rets_city_field = "L_ListOffice1";

        $listing_status = "1"; // act - active

		$listing_city = "628";	

		require_once("phrets.php");
		
		$rets = new phRETS;

		$rets->SetParam("offset_support", true);

		$connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);
		$query = "({$rets_status_field}={$listing_status})";

		$classes = $rets->GetMetadataClasses('Property');
		$south=array();
		$southcount=0;
		
		foreach ($classes as $classval)
		{
			$search = $rets->SearchQuery('Property', $classval['ClassName'],$query);
			
			while ($listing = $rets->FetchRow($search))
			{
				
				if ($listing['L_Class']=='RESIDENTIAL')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
				}
				else if ($listing['L_Class']=='LOTS/LAND')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
				}
				else if ($listing['L_Class']=='MODULAR'  || $listing['L_Class']=='MOBILE')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
				}
				else if ($listing['L_Class']=='COMMERCIAL/INDUSTRIAL')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
				}
				else if ($listing['L_Class']=='MULTI-FAMILY')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
				}
				else if ($listing['L_Class']=='CONDOMINIUM' || $listing['L_Class']=='CONDO/TOWNHOUSE' || $listing['L_Class']=='CONDO' || $listing['L_Class']=='TOWNHOUSE')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
				}
				else if ($listing['L_Type_']=='CONDO/TOWNHOUSE' || $listing['L_Type_']=='CONDO' || $listing['L_Type_']=='TOWNHOUSE')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
				}

					$south_listing[0]=$MLSNo;
					$south_listing[1]=$Status;
					$south[$southcount] = $south_listing;
					$southcount++;
					
			}//while
			$rets->FreeResult($search);			
		}
		
		

	for($iii=0; $iii<count($south);$iii++)
	{
		$southarr = $south[$iii];
		$MLSNo=$southarr[0];
		$Status=$southarr[1];
		
		date_default_timezone_set("UTC");
		$lastupdate=date("Y-m-d H:i:s", time());
				
		if(mysql_num_rows(mysql_query("select * from tbl_mlsno_update where mlsno='".$MLSNo."'"))>0)
		{
			$insqry="update tbl_mlsno_update set lastupdate='".mysql_real_escape_string($lastupdate)."',status='".mysql_real_escape_string($Status)."' where mlsno='".$MLSNo."'";
		}
		else
		{
			$insqry="insert into tbl_mlsno_update (mlsno,status,lastupdate) values	('".mysql_real_escape_string($MLSNo)."','".mysql_real_escape_string($Status)."','".$lastupdate."')";					
		}

		mysql_query($insqry);
		
   }
						
		
	
echo "+ Disconnecting<br>\n";
$rets->Disconnect();


?>