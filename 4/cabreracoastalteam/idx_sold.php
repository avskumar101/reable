<?php
		require_once('config_cron.php');
		error_reporting(E_ERROR | E_PARSE);
		ini_set('max_execution_time', -1);
		ini_set("memory_limit",-1);

		$rets_login_url = "http://capemay.rets.fnismls.com/rets/fnisrets.aspx/CAPEMAY/login?rets-version=rets/1.5";
		
		$rets_username = "square#";
		
		$rets_password = "square1";	
		
		//$rets_status_field = "L_Status";
		
        $rets_status_field = "L_StatusCatID";
		
		$rets_city_field = "L_ListOffice1";
	
		//$listing_status = "1_0"; // act - active
        //$listing_status = "1"; // act - active
		$listing_status = "2";
		
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
				$L_ListOffice=$listing['L_ListOffice1'];
				
				if ($listing['L_Class']=='RESIDENTIAL')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
					$Class=$listing['L_Class'];
					$Type=$listing['L_Type_'];
					$Area=$listing['L_Area'];
					$Address=$listing['L_Address'];
					$Address2=$listing['L_Address2'];
					$City=$listing['L_City'];
					$State=$listing['L_State'];
					$Zip=$listing['L_Zip'];
					$Original_Price=$listing['L_OriginalPrice'];
					$Asking_Price=$listing['L_AskingPrice'];
					$Year_Built=$listing['LM_Char10_1'];
					$Bedrooms=$listing['L_Keyword1'];
					$Full_Baths=$listing['L_Keyword2'];
					$Public_Baths='';
					$Lavs=$listing['L_Keyword3'];
					$House_Color=$listing['LM_Char25_4'];
					$Lot_Size1=$listing['L_Keyword4'];
					$Lot_Size2=$listing['LM_Char10_2'];
					$Lot_Number=$listing['LM_Char10_3'];
					$Number_Of_Acres='';
					$New_Construction=$listing['LM_Char10_19'];
					$Possession=$listing['LM_Char25_1'];
					$Appx_Living_Square_Feet=$listing['L_SquareFeet'];
					$Total_Sq_Feet=$listing['LM_Int2_2'];
					$Frontage=$listing['LM_Int2_1'];
					$Total_Rooms=$listing['LM_Char10_16'];
					$Near=$listing['LM_Char25_2'];
					$Days_On_Market=$listing['L_DOM'];
					$Taxes=$listing['LM_Dec_1'];
					$Tax_ID=$listing['T_list_tax_property_id'];
					$Zoned_District_Township=$listing['LM_Char25_12'];
					$Block_Number=$listing['LM_Char10_5'];
					$Sub_Block=$listing['LM_Char10_6'];
					$Sub_Lot=$listing['LM_Char10_4'];
					$LOCATION=$listing['LFD_LOCATION_1'];
					$CONSTRUCTION=$listing['LFD_CONSTRUCTION_2'];
					$EXTERIOR=$listing['LFD_EXTERIOR_3'];
					$EXTERIOR_FEATURES=$listing['LFD_EXTERIOR_3'];
					$INTERIOR_FEATURES=$listing['LFD_INTERIORFEATURES_7'];
					$FINANCING_AVAILABLE=$listing['LFD_FINANCINGAVAILABLE_16'];
					$SHOWING_INFORMATION=$listing['LFD_SHOWINGINFORMATION_17'];
					$OUTSIDE_FEATURES=$listing['LFD_OUTSIDEFEATURES_4'];
					$PARKING_GARAGE=$listing['LFD_PARKINGGARAGE_5'];
					$OTHER_ROOMS=$listing['LFD_OTHERROOMS_6'];
					$APPLIANCES_INCLUDED=$listing['LFD_APPLIANCESINCLUDED_8'];
					$ALSO_INCLUDED=$listing['LFD_ALSOINCLUDED_9'];
					$BASEMENT=$listing['LFD_BASEMENT_10'];
					$HEATING=$listing['LFD_HEATING_11'];
					$COOLING=$listing['LFD_COOLING_12'];
					$HOT_WATER=$listing['LFD_HOTWATER_13'];
					$SEWER=$listing['LFD_SEWER_15'];
					$Remarks=$listing['LR_remarks33'];
					$Last_Updated=date('Y-m-d',mktime($listing['L_LastDocUpdate']));
					$Org_Name=$listing['LO1_OrganizationName'];
					$Org_Address=$listing['LO1_OrgAddressNumber'].' '.$listing['LO1_OrgAddressDirection'].' '.$listing['LO1_OrgAddressStreet'];
					$Org_City=$listing['LO1_OrgCity'];
					$Org_State=$listing['LO1_OrgState'];
					$Org_Zip=$listing['LO1_OrgZip'];
					$Org_PhoneDesc=$listing['LO1_PhoneNumber1Desc'];
					$Org_PhoneArea=$listing['LO1_PhoneNumber1Area'];
					$Org_PhoneNumber=$listing['LO1_PhoneNumber1'];
					$Stories='';
					$listuserfirstname=$listing['LA1_UserFirstName'];
					$listuserlastname=$listing['LA1_UserLastName'];
					$soldprice = $listing['L_SoldPrice'];
					$closingdate = $listing['L_ClosingDate'];
				}
				else if ($listing['L_Class']=='LOTS/LAND')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
					$Class=$listing['L_Class'];
					$Type=$listing['L_Type_'];
					$Area=$listing['L_Area'];
					$Address=$listing['L_Address'];
					$Address2=$listing['L_Address2'];
					$City=$listing['L_City'];
					$State=$listing['L_State'];
					$Zip=$listing['L_Zip'];
					$Original_Price=$listing['L_OriginalPrice'];
					$Asking_Price=$listing['L_AskingPrice'];
					$Year_Built='';
					$Bedrooms=0;
					$Full_Baths=0;
					$Public_Baths=0;
					$Lavs=0;
					$House_Color='';
					$Lot_Size1=$listing['L_Keyword1'];
					$Lot_Size2=$listing['LM_Char10_2'];
					$Lot_Number=$listing['LM_Char10_3'];
					$Number_Of_Acres=$listing['L_NumAcres'];
					$New_Construction='';
					$Possession=$listing['LM_Char25_1'];
					$Appx_Living_Square_Feet='';
					$Total_Sq_Feet=$listing['LM_Int2_2'];
					$Frontage=$listing['LM_Int2_1'];
					$Total_Rooms='';
					$Near=$listing['LM_Char25_2'];
					$Days_On_Market=$listing['L_DOM'];
					$Taxes=$listing['LM_Dec_1'];
					$Tax_ID=$listing['T_list_tax_property_id'];
					$Zoned_District_Township=$listing['LM_Char25_12'];
					$Block_Number=$listing['LM_Char10_5'];
					$Sub_Block=$listing['LM_Char10_6'];
					$Sub_Lot=$listing['LM_Char10_4'];
					$LOCATION=$listing['LFD_LOCATION_18'];
					$CONSTRUCTION='';
					$EXTERIOR='';
					$EXTERIOR_FEATURES='';
					$INTERIOR_FEATURES='';
					$FINANCING_AVAILABLE='';
					$SHOWING_INFORMATION=$listing['LFD_SHOWINFORMATION_23'];
					$OUTSIDE_FEATURES='';
					$PARKING_GARAGE='';
					$OTHER_ROOMS='';
					$APPLIANCES_INCLUDED='';
					$ALSO_INCLUDED='';
					$BASEMENT='';
					$HEATING='';
					$COOLING='';
					$HOT_WATER='';
					$SEWER='';
					$Remarks=$listing['LR_remarks33'];
					$Last_Updated=date('Y-m-d',mktime($listing['L_LastDocUpdate']));
					$Org_Name=$listing['LO1_OrganizationName'];
					$Org_Address=$listing['LO1_OrgAddressNumber'].' '.$listing['LO1_OrgAddressDirection'].' '.$listing['LO1_OrgAddressStreet'];
					$Org_City=$listing['LO1_OrgCity'];
					$Org_State=$listing['LO1_OrgState'];
					$Org_Zip=$listing['LO1_OrgZip'];
					$Org_PhoneDesc=$listing['LO1_PhoneNumber1Desc'];
					$Org_PhoneArea=$listing['LO1_PhoneNumber1Area'];
					$Org_PhoneNumber=$listing['LO1_PhoneNumber1'];
					$Stories='';
					$listuserfirstname=$listing['LA1_UserFirstName'];
					$listuserlastname=$listing['LA1_UserLastName'];
					$soldprice = $listing['L_SoldPrice'];
					$closingdate = $listing['L_ClosingDate'];
				}
				else if ($listing['L_Class']=='COMMERCIAL/INDUSTRIAL')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
					$Class=$listing['L_Class'];
					$Type=$listing['L_Type_'];
					$Area=$listing['L_Area'];
					$Address=$listing['L_Address'];
					$Address2=$listing['L_Address2'];
					$City=$listing['L_City'];
					$State=$listing['L_State'];
					$Zip=$listing['L_Zip'];
					$Original_Price=$listing['L_OriginalPrice'];
					$Asking_Price=$listing['L_AskingPrice'];
					$Year_Built=$listing['LM_Char10_1'];
					$Bedrooms='';
					$Full_Baths=$listing['L_Keyword2'];
					$Public_Baths=$listing['LM_Int2_6'];
					$Lavs=$listing['LM_Int2_7'];
					$House_Color='';
					$Lot_Size1='';
					$Lot_Size2=$listing['LM_Char10_2'];
					$Lot_Number=$listing['LM_Char10_3'];
					$Number_Of_Acres='';
					$New_Construction=$listing['LM_Char10_19'];
					$Possession=$listing['LM_Char25_1'];
					$Appx_Living_Square_Feet=$listing['L_SquareFeet'];
					$Total_Sq_Feet=$listing['LM_Int2_2'];
					$Frontage=$listing['LM_Int2_1'];
					$Total_Rooms=0;
					$Near=$listing['LM_Char25_2'];
					$Days_On_Market=$listing['L_DOM'];
					$Taxes=$listing['LM_Dec_1'];
					$Tax_ID=$listing['T_list_tax_property_id'];
					$Zoned_District_Township=$listing['LM_Char25_12'];
					$Block_Number=$listing['LM_Char10_5'];
					$Sub_Block=$listing['LM_Char10_6'];
					$Sub_Lot=$listing['LM_Char10_4'];
					$LOCATION=$listing['LFD_LOCATION_24'];
					$CONSTRUCTION='';
					$EXTERIOR=$listing['LFD_EXTERIOR_25'];
					$EXTERIOR_FEATURES=$listing['LFD_EXTERIORFEATURES_26'];
					$INTERIOR_FEATURES=$listing['LFD_INTERIORFEATURES_27'];
					$FINANCING_AVAILABLE=$listing['LFD_FINANCINGAVAILABLE_37'];
					$SHOWING_INFORMATION=$listing['LFD_SHOWINFORMATION_38'];
					$OUTSIDE_FEATURES='';
					$PARKING_GARAGE=$listing['LFD_PARKING_31'];
					$OTHER_ROOMS='';
					$APPLIANCES_INCLUDED='';
					$ALSO_INCLUDED='';
					$BASEMENT='';
					$HEATING=$listing['LFD_HEATING_32'];
					$COOLING=$listing['LFD_COOLING_33'];
					$HOT_WATER=$listing['LFD_HOTWATER_36'];
					$SEWER=$listing['LFD_SEWER_35'];
					$Remarks=$listing['LR_remarks33'];
					$Last_Updated=date('Y-m-d',mktime($listing['L_LastDocUpdate']));
					$Org_Name=$listing['LO1_OrganizationName'];
					$Org_Address=$listing['LO1_OrgAddressNumber'].' '.$listing['LO1_OrgAddressDirection'].' '.$listing['LO1_OrgAddressStreet'];
					$Org_City=$listing['LO1_OrgCity'];
					$Org_State=$listing['LO1_OrgState'];
					$Org_Zip=$listing['LO1_OrgZip'];
					$Org_PhoneDesc=$listing['LO1_PhoneNumber1Desc'];
					$Org_PhoneArea=$listing['LO1_PhoneNumber1Area'];
					$Org_PhoneNumber=$listing['LO1_PhoneNumber1'];
					$Stories=$listing['LM_Int2_4'];
					$listuserfirstname=$listing['LA1_UserFirstName'];
					$listuserlastname=$listing['LA1_UserLastName'];
					$soldprice = $listing['L_SoldPrice'];
					$closingdate = $listing['L_ClosingDate'];
				}
				else if ($listing['L_Class']=='MULTI-FAMILY')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
					$Class=$listing['L_Class'];
					$Type=$listing['L_Type_'];
					$Area=$listing['L_Area'];
					$Address=$listing['L_Address'];
					$Address2=$listing['L_Address2'];
					$City=$listing['L_City'];
					$State=$listing['L_State'];
					$Zip=$listing['L_Zip'];
					$Original_Price=$listing['L_OriginalPrice'];
					$Asking_Price=$listing['L_AskingPrice'];
					$Year_Built=$listing['LM_Char10_1'];
					$Bedrooms = $listing['LM_Int4_1']+$listing['LM_Int4_2']+$listing['LM_Int4_3']+$listing['LM_Int4_4']+$listing['LM_Int4_5']+$listing['LM_Int4_6']+$listing['LM_Int4_7']+$listing['LM_Int4_8']+$listing['LM_Int4_9'];
					$Full_Baths= $listing['LM_Int1_1']+$listing['LM_Int1_2']+$listing['LM_Int1_3']+$listing['LM_Int1_4']+$listing['LM_Int1_5']+$listing['LM_Int1_6']+$listing['LM_Int1_7']+$listing['LM_Int1_8']+$listing['LM_Int1_9'];
					$Lavs=$listing['LM_Int1_1']+$listing['LM_Int1_2']+$listing['LM_Int1_3']+$listing['LM_Int1_4']+$listing['LM_Int1_5']+$listing['LM_Int1_6']+$listing['LM_Int1_7']+$listing['LM_Int1_8']+$listing['LM_Int1_9'];;
					$Public_Baths='';
					$House_Color='';
					$Lot_Size1=$listing['L_Keyword1'];
					$Lot_Size2=$listing['LM_Char10_2'];
					$Lot_Number=$listing['LM_Char10_3'];
					$Number_Of_Acres='';
					$New_Construction=$listing['LM_Char10_19'];
					$Possession=$listing['LM_Char25_1'];
					$Appx_Living_Square_Feet='';
					$Total_Sq_Feet=$listing['LM_Int2_2'];
					$Frontage='';
					$Total_Rooms=$listing['LM_Int2_12']+$listing['LM_Int2_13']+$listing['LM_Int2_14']+$listing['LM_Int2_15']+$listing['LM_Int2_16']+$listing['LM_Int2_17']+$listing['LM_Int2_18']+$listing['LM_Int2_19']+$listing['LM_Int2_20'];;
					$Near=$listing['LM_Char25_2'];
					$Days_On_Market=$listing['L_DOM'];
					$Taxes=$listing['LM_Dec_1'];
					$Tax_ID=$listing['T_list_tax_property_id'];
					$Zoned_District_Township=$listing['LM_Char25_12'];
					$Block_Number=$listing['LM_Char10_5'];
					$Sub_Block=$listing['LM_Char10_6'];
					$Sub_Lot=$listing['LM_Char10_4'];
					$LOCATION=$listing['LFD_LOCATION_42'];
					$CONSTRUCTION='';
					$EXTERIOR='';
					$EXTERIOR_FEATURES=$listing['LFD_OUTSIDEFEATURES_44'];
					$INTERIOR_FEATURES='';
					$FINANCING_AVAILABLE=$listing['LFD_FINANCING_53'];
					$SHOWING_INFORMATION=$listing['LFD_SHOWINFORMATION_48'];
					$OUTSIDE_FEATURES=$listing['LFD_OUTSIDEFEATURES_44'];
					$PARKING_GARAGE=$listing['LFD_PARKING_47'];
					$OTHER_ROOMS=$listing['LFD_OTHERROOMS_41'];
					$APPLIANCES_INCLUDED='';
					$ALSO_INCLUDED=$listing['LFD_ALSOINCLUDED_45'];
					$BASEMENT=$listing['LFD_BASEMENT_46'];
					$HEATING=$listing['LFD_HEATING_43'];
					$COOLING=$listing['LFD_COOLING_51'];
					$HOT_WATER=$listing['LFD_HOTWATER_52'];
					$SEWER=$listing['LFD_SEWER_50'];
					$Remarks=$listing['LR_remarks33'];
					$Last_Updated=date('Y-m-d',mktime($listing['L_LastDocUpdate']));
					$Org_Name=$listing['LO1_OrganizationName'];
					$Org_Address=$listing['LO1_OrgAddressNumber'].' '.$listing['LO1_OrgAddressDirection'].' '.$listing['LO1_OrgAddressStreet'];
					$Org_City=$listing['LO1_OrgCity'];
					$Org_State=$listing['LO1_OrgState'];
					$Org_Zip=$listing['LO1_OrgZip'];
					$Org_PhoneDesc=$listing['LO1_PhoneNumber1Desc'];
					$Org_PhoneArea=$listing['LO1_PhoneNumber1Area'];
					$Org_PhoneNumber=$listing['LO1_PhoneNumber1'];
					$Stories='';
					$listuserfirstname=$listing['LA1_UserFirstName'];
					$listuserlastname=$listing['LA1_UserLastName'];
					$soldprice = $listing['L_SoldPrice'];
					$closingdate = $listing['L_ClosingDate'];
				}
				else if ($listing['L_Class']=='CONDO/TOWNHOUSE')
				{
					$MLSNo=$listing['L_ListingID'];
					$Status=$listing['L_Status'];
					$Class=$listing['L_Class'];
					$Type=$listing['L_Type_'];
					$Area=$listing['L_Area'];
					$Address=$listing['L_Address'];
					$Address2=$listing['L_Address2'];
					$City=$listing['L_City'];
					$State=$listing['L_State'];
					$Zip=$listing['L_Zip'];
					$Original_Price=$listing['L_OriginalPrice'];
					$Asking_Price=$listing['L_AskingPrice'];
					$Year_Built=$listing['LM_Char10_1'];
					$Bedrooms=$listing['L_Keyword1'];
					$Full_Baths=$listing['L_Keyword2'];
					$Public_Baths='';
					$Lavs=$listing['L_Keyword3'];
					$House_Color='';
					$Lot_Size1='';
					$Lot_Size2='';
					$Lot_Number=$listing['LM_Char10_3'];
					$Number_Of_Acres='';
					$New_Construction=$listing['LM_Char10_19'];
					$Possession=$listing['LM_Char25_1'];
					$Appx_Living_Square_Feet=$listing['L_SquareFeet'];
					$Total_Sq_Feet=$listing['LM_Int2_2'];
					$Frontage='';
					$Total_Rooms=$listing['LM_Char10_16'];
					$Near=$listing['LM_Char25_2'];
					$Days_On_Market=$listing['L_DOM'];
					$Taxes=$listing['LM_Dec_1'];
					$Tax_ID=$listing['T_list_tax_property_id'];
					$Zoned_District_Township=$listing['LM_Char25_12'];
					$Block_Number=$listing['LM_Char10_5'];
					$Sub_Block=$listing['LM_Char10_6'];
					$Sub_Lot=$listing['LM_Char10_4'];
					$LOCATION=$listing['LFD_LOCATION_56'];
					$CONSTRUCTION='';
					$EXTERIOR='';
					$EXTERIOR_FEATURES='';
					$INTERIOR_FEATURES='';
					$FINANCING_AVAILABLE=$listing['LM_Char50_4'];
					$SHOWING_INFORMATION=$listing['LFD_SHOWINFORMATION_64'];
					$OUTSIDE_FEATURES='';
					$PARKING_GARAGE=$listing['LFD_PARKING_69'];
					$OTHER_ROOMS=$listing['LFD_OTHERROOMS_58'];
					$APPLIANCES_INCLUDED=$listing['LFD_APPLIANCESINCLUDED_61'];
					$ALSO_INCLUDED=$listing['LFD_ALSOINCLUDED_62'];
					$BASEMENT=''; 
					$HEATING=$listing['LFD_HEATING_63'];
					$COOLING=$listing['LFD_COOLING_67'];
					$HOT_WATER=$listing['LFD_HOTWATER_68'];
					$SEWER=$listing['LFD_SEWER_66'];
					$Remarks=$listing['LR_remarks33'];
					$Last_Updated=date('Y-m-d',mktime($listing['L_LastDocUpdate']));
					$Org_Name=$listing['LO1_OrganizationName'];
					$Org_Address=$listing['LO1_OrgAddressNumber'].' '.$listing['LO1_OrgAddressDirection'].' '.$listing['LO1_OrgAddressStreet'];
					$Org_City=$listing['LO1_OrgCity'];
					$Org_State=$listing['LO1_OrgState'];
					$Org_Zip=$listing['LO1_OrgZip'];
					$Org_PhoneDesc=$listing['LO1_PhoneNumber1Desc'];
					$Org_PhoneArea=$listing['LO1_PhoneNumber1Area'];
					$Org_PhoneNumber=$listing['LO1_PhoneNumber1'];
					$Stories=$listing['L_Keyword4'];
					$listuserfirstname=$listing['LA1_UserFirstName'];
					$listuserlastname=$listing['LA1_UserLastName'];
					$soldprice = $listing['L_SoldPrice'];
					$closingdate = $listing['L_ClosingDate'];
				}
				$NumUnits=$listing['L_NumUnits'];
				
				if($NumUnits=='')
				{
					$NumUnits=0;
				}
				
				$ExpDate=date('Y-m-d',mktime($listing['L_ExpirationDate']));
				
				$PhotoCount=$listing['L_PictureCount'];
				
				$OffMktDate=date('Y-m-d',mktime($listing['L_OffMarketDate)']));
				
				$Tax_Year=$listing['LM_Char10_10'];				
				
				if (mysql_num_rows(mysql_query("select * from tbl_sold where MLSNo='".$MLSNo."'"))>0)
				{
					$insqry="update tbl_sold set 
					Status='".mysql_real_escape_string($Status)."',
					Class='".mysql_real_escape_string($Class)."',
					Type='".mysql_real_escape_string($Type)."',
					Area='".mysql_real_escape_string($Area)."',
					Address='".mysql_real_escape_string($Address)."',
					Address2='".mysql_real_escape_string($Address2)."',
					City='".mysql_real_escape_string($City)."',
					State='".mysql_real_escape_string($State)."',
					Zip='".mysql_real_escape_string($Zip)."',
					Original_Price='".mysql_real_escape_string($Original_Price)."',
					Asking_Price='".mysql_real_escape_string($Asking_Price)."',
					Year_Built='".mysql_real_escape_string($Year_Built)."',
					Bedrooms='".mysql_real_escape_string($Bedrooms)."',
					Full_Baths='".mysql_real_escape_string($Full_Baths)."',
					Public_Baths='".mysql_real_escape_string($Public_Baths)."',
					Lavs='".mysql_real_escape_string($Lavs)."',
					House_Color='".mysql_real_escape_string($House_Color)."',
					Lot_Size1='".mysql_real_escape_string($Lot_Size1)."',
					Lot_Size2='".mysql_real_escape_string($Lot_Size2)."',
					Lot_Number='".mysql_real_escape_string($Lot_Number)."',
					Number_Of_Acres='".mysql_real_escape_string($Number_Of_Acres)."',
					New_Construction='".mysql_real_escape_string($New_Construction)."',
					Possession='".mysql_real_escape_string($Possession)."',
					Appx_Living_Square_Feet='".mysql_real_escape_string($Appx_Living_Square_Feet)."',
					Total_Sq_Feet='".mysql_real_escape_string($Total_Sq_Feet)."',
					Frontage='".mysql_real_escape_string($Frontage)."',
					Total_Rooms='".mysql_real_escape_string($Total_Rooms)."',
					Near='".mysql_real_escape_string($Near)."',
					Days_On_Market='".mysql_real_escape_string($Days_On_Market)."',
					Taxes='".mysql_real_escape_string($Taxes)."',
					Tax_ID='".mysql_real_escape_string($Tax_ID)."',
					Zoned_District_Township='".mysql_real_escape_string($Zoned_District_Township)."',
					Block_Number='".mysql_real_escape_string($Block_Number)."',
					Sub_Block='".mysql_real_escape_string($Sub_Block)."',
					Sub_Lot='".mysql_real_escape_string($Sub_Lot)."',
					LOCATION='".mysql_real_escape_string($LOCATION)."',
					CONSTRUCTION='".mysql_real_escape_string($CONSTRUCTION)."',
					EXTERIOR='".mysql_real_escape_string($EXTERIOR)."',
					EXTERIOR_FEATURES='".mysql_real_escape_string($EXTERIOR_FEATURES)."',
					INTERIOR_FEATURES='".mysql_real_escape_string($INTERIOR_FEATURES)."',
					FINANCING_AVAILABLE='".mysql_real_escape_string($FINANCING_AVAILABLE)."',
					SHOWING_INFORMATION='".mysql_real_escape_string($SHOWING_INFORMATION)."',
					OUTSIDE_FEATURES='".mysql_real_escape_string($OUTSIDE_FEATURES)."',
					PARKING_GARAGE='".mysql_real_escape_string($PARKING_GARAGE)."',
					OTHER_ROOMS='".mysql_real_escape_string($OTHER_ROOMS)."',
					APPLIANCES_INCLUDED='".mysql_real_escape_string($APPLIANCES_INCLUDED)."',
					ALSO_INCLUDED='".mysql_real_escape_string($ALSO_INCLUDED)."',
					BASEMENT='".mysql_real_escape_string($BASEMENT)."',
					HEATING='".mysql_real_escape_string($HEATING)."',
					COOLING='".mysql_real_escape_string($COOLING)."',
					HOT_WATER='".mysql_real_escape_string($HOT_WATER)."',
					SEWER='".mysql_real_escape_string($SEWER)."',
					Remarks='".mysql_real_escape_string($Remarks)."',
					Last_Updated='".mysql_real_escape_string($Last_Updated)."',
					Org_Name='".mysql_real_escape_string($Org_Name)."',
					Org_Address='".mysql_real_escape_string($Org_Address)."',
					Org_City='".mysql_real_escape_string($Org_City)."',
					Org_State='".mysql_real_escape_string($Org_State)."',
					Org_Zip='".mysql_real_escape_string($Org_Zip)."',
					Org_PhoneDesc='".mysql_real_escape_string($Org_PhoneDesc)."',
					Org_PhoneArea='".mysql_real_escape_string($Org_PhoneArea)."',
					Org_PhoneNumber='".mysql_real_escape_string($Org_PhoneNumber)."',
					NumUnits='".mysql_real_escape_string($NumUnits)."',
					ExpDate='".mysql_real_escape_string($ExpDate)."',
					PhotoCount='".mysql_real_escape_string($PhotoCount)."',
					OffMktDate='".mysql_real_escape_string($OffMktDate)."',
					Stories='".mysql_real_escape_string($Stories)."',
					Tax_Year='".mysql_real_escape_string($Tax_Year)."',active=1,
					Listing_Office='".mysql_real_escape_string($L_ListOffice)."',
					agent_firstname='".mysql_real_escape_string($listuserfirstname)."',
					agent_lastname='".mysql_real_escape_string($listuserlastname)."',soldprice='".mysql_real_escape_string($soldprice)."',closingdate='".mysql_real_escape_string($closingdate)."'			
					where MLSNo='".$MLSNo."'";
				}
				else
				{
				$insqry="insert into tbl_sold (MLSNo, Status, Class, Type, Area, Address, Address2,
				City, State, Zip,  Original_Price, Asking_Price, Year_Built, Bedrooms, Full_Baths, Public_Baths, Lavs, House_Color, Lot_Size1, Lot_Size2, Lot_Number, Number_Of_Acres, New_Construction, Possession, Appx_Living_Square_Feet, Total_Sq_Feet, Frontage, Total_Rooms, Near, Days_On_Market, Taxes, Tax_ID, Zoned_District_Township, Block_Number, Sub_Block, Sub_Lot, LOCATION, CONSTRUCTION, EXTERIOR, EXTERIOR_FEATURES, INTERIOR_FEATURES, FINANCING_AVAILABLE, SHOWING_INFORMATION, OUTSIDE_FEATURES, PARKING_GARAGE, OTHER_ROOMS, APPLIANCES_INCLUDED, ALSO_INCLUDED, BASEMENT, HEATING, COOLING, HOT_WATER, SEWER, Remarks, Last_Updated, Org_Name, Org_Address, Org_City, Org_State, Org_Zip, Org_PhoneDesc, Org_PhoneArea, Org_PhoneNumber, NumUnits, ExpDate, PhotoCount, OffMktDate, Stories, Tax_Year, active,Listing_Office,agent_firstname,agent_lastname,soldprice,closingdate) values
					(
					'".mysql_real_escape_string($MLSNo)."',
					'".mysql_real_escape_string($Status)."',
					'".mysql_real_escape_string($Class)."',
					'".mysql_real_escape_string($Type)."',
					'".mysql_real_escape_string($Area)."',
					'".mysql_real_escape_string($Address)."',
					'".mysql_real_escape_string($Address2)."',
					'".mysql_real_escape_string($City)."',
					'".mysql_real_escape_string($State)."',
					'".mysql_real_escape_string($Zip)."',
					'".mysql_real_escape_string($Original_Price)."',
					'".mysql_real_escape_string($Asking_Price)."',
					'".mysql_real_escape_string($Year_Built)."',
					'".mysql_real_escape_string($Bedrooms)."',
					'".mysql_real_escape_string($Full_Baths)."',
					'".mysql_real_escape_string($Public_Baths)."',
					'".mysql_real_escape_string($Lavs)."',
					'".mysql_real_escape_string($House_Color)."',
					'".mysql_real_escape_string($Lot_Size1)."',
					'".mysql_real_escape_string($Lot_Size2)."',
					'".mysql_real_escape_string($Lot_Number)."',
					'".mysql_real_escape_string($Number_Of_Acres)."',
					'".mysql_real_escape_string($New_Construction)."',
					'".mysql_real_escape_string($Possession)."',
					'".mysql_real_escape_string($Appx_Living_Square_Feet)."',
					'".mysql_real_escape_string($Total_Sq_Feet)."',
					'".mysql_real_escape_string($Frontage)."',
					'".mysql_real_escape_string($Total_Rooms)."',
					'".mysql_real_escape_string($Near)."',
					'".mysql_real_escape_string($Days_On_Market)."',
					'".mysql_real_escape_string($Taxes)."',
					'".mysql_real_escape_string($Tax_ID)."',
					'".mysql_real_escape_string($Zoned_District_Township)."',
					'".mysql_real_escape_string($Block_Number)."',
					'".mysql_real_escape_string($Sub_Block)."',
					'".mysql_real_escape_string($Sub_Lot)."',
					'".mysql_real_escape_string($LOCATION)."',
					'".mysql_real_escape_string($CONSTRUCTION)."',
					'".mysql_real_escape_string($EXTERIOR)."',
					'".mysql_real_escape_string($EXTERIOR_FEATURES)."',
					'".mysql_real_escape_string($INTERIOR_FEATURES)."',
					'".mysql_real_escape_string($FINANCING_AVAILABLE)."',
					'".mysql_real_escape_string($SHOWING_INFORMATION)."',
					'".mysql_real_escape_string($OUTSIDE_FEATURES)."',
					'".mysql_real_escape_string($PARKING_GARAGE)."',
					'".mysql_real_escape_string($OTHER_ROOMS)."',
					'".mysql_real_escape_string($APPLIANCES_INCLUDED)."',
					'".mysql_real_escape_string($ALSO_INCLUDED)."',
					'".mysql_real_escape_string($BASEMENT)."',
					'".mysql_real_escape_string($HEATING)."',
					'".mysql_real_escape_string($COOLING)."',
					'".mysql_real_escape_string($HOT_WATER)."',
					'".mysql_real_escape_string($SEWER)."',
					'".mysql_real_escape_string($Remarks)."',
					'".mysql_real_escape_string($Last_Updated)."',
					'".mysql_real_escape_string($Org_Name)."',
					'".mysql_real_escape_string($Org_Address)."',
					'".mysql_real_escape_string($Org_City)."',
					'".mysql_real_escape_string($Org_State)."',
					'".mysql_real_escape_string($Org_Zip)."',
					'".mysql_real_escape_string($Org_PhoneDesc)."',
					'".mysql_real_escape_string($Org_PhoneArea)."',
					'".mysql_real_escape_string($Org_PhoneNumber)."',
					'".mysql_real_escape_string($NumUnits)."',
					'".mysql_real_escape_string($ExpDate)."',
					'".mysql_real_escape_string($PhotoCount)."',
					'".mysql_real_escape_string($OffMktDate)."',
					'".mysql_real_escape_string($Stories)."',
					'".mysql_real_escape_string($Tax_Year)."',1,'".mysql_real_escape_string($L_ListOffice)."','".mysql_real_escape_string($listuserfirstname)."','".mysql_real_escape_string($listuserlastname)."','".mysql_real_escape_string($soldprice)."','".mysql_real_escape_string($closingdate)."')";
				}				mysql_query($insqry);
			}		
			$rets->FreeResult($search);
		}

		date_default_timezone_set("UTC");
		
		$lastupdate=date("Y-m-d H:i:s", time());
		
		mysql_query("UPDATE tbl_sold SET data_lastupdate='".mysql_real_escape_string($lastupdate)."'");
		
		echo "+ Disconnecting<br>\n";
		$rets->Disconnect();
?>