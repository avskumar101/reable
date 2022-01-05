<?php
	session_start();
	require_once('../config.php');

	if (isset($_POST['btnsubmit']))
	{
		mysql_query("update tbl_listings1 set active=0");
	
		$rets_login_url = "http://capemay.rets.fnismls.com/rets/fnisrets.aspx/CAPEMAY/login?rets-version=rets/1.5";
		$rets_username = "square#";
		$rets_password = "square1";
	
		$rets_status_field = "L_Status";
		$rets_city_field = "L_ListOffice1";
	
	
		$listing_status = "1_0"; // act - active
		//$listing_status = "2_0";
		$listing_city = "628";
	
		require_once("../phrets.php");
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
				//if($listing['LO1_OrganizationName'] == 'LONG & FOSTER REAL ESTATE INC - wc'){
				
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
				}
				$NumUnits=$listing['L_NumUnits'];
				$ExpDate=date('Y-m-d',mktime($listing['L_ExpirationDate']));
				$PhotoCount=$listing['L_PictureCount'];
				$OffMktDate=date('Y-m-d',mktime($listing['L_OffMarketDate)']));
				$Tax_Year=$listing['LM_Char10_10'];
				
				if (mysql_num_rows(mysql_query("select * from tbl_listings1 where MLSNo='".$MLSNo."'"))>0)
				{
					$insqry="update tbl_listings1 set 
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
					Tax_Year='".mysql_real_escape_string($Tax_Year)."',
					active=1,
					Listing_Office='".mysql_real_escape_string($L_ListOffice)."',
					agent_firstname='".mysql_real_escape_string($listuserfirstname)."',
					agent_lastname='".mysql_real_escape_string($listuserlastname)."'
					
					where MLSNo='".$MLSNo."'";
				}
				else
				{
					$insqry="insert into tbl_listings1 (MLSNo, Status, Class, Type, Area, Address, Address2,
					City, State, Zip,  Original_Price, Asking_Price, Year_Built, Bedrooms, Full_Baths, Public_Baths, Lavs, House_Color, Lot_Size1, Lot_Size2, Lot_Number, Number_Of_Acres, New_Construction, Possession, Appx_Living_Square_Feet, Total_Sq_Feet, Frontage, Total_Rooms, Near, Days_On_Market, Taxes, Tax_ID, Zoned_District_Township, Block_Number, Sub_Block, Sub_Lot, LOCATION, CONSTRUCTION, EXTERIOR, EXTERIOR_FEATURES, INTERIOR_FEATURES, FINANCING_AVAILABLE, SHOWING_INFORMATION, OUTSIDE_FEATURES, PARKING_GARAGE, OTHER_ROOMS, APPLIANCES_INCLUDED, ALSO_INCLUDED, BASEMENT, HEATING, COOLING, HOT_WATER, SEWER, Remarks, Last_Updated, Org_Name, Org_Address, Org_City, Org_State, Org_Zip, Org_PhoneDesc, Org_PhoneArea, Org_PhoneNumber, NumUnits, ExpDate, PhotoCount, OffMktDate, Stories, Tax_Year, active,Listing_Office,agent_firstname,agent_lastname) values
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
					'".mysql_real_escape_string($Tax_Year)."',1,'".mysql_real_escape_string($L_ListOffice)."','".mysql_real_escape_string($listuserfirstname)."','".mysql_real_escape_string($listuserlastname)."')";
				}
				//echo $insqry;
				//echo "<br /><br />";
				mysql_query($insqry);
				/*
				$ph=0;
				$flag=0;
				$photos = $rets->GetObject("Property", "Photo", $MLSNo);
				$photoqry=" update tbl_listings1 set ";
				foreach ($photos as $photo) 
				{
					$ph=$ph+1;
					if ($photo['Success'] == true && $ph<=13) 
					{
						$flag=1;
						  
						 switch($ph)
						 {
							case 1: $photoqry.= " mainimg='".$photo['Location']."'";
								break;
						case 2: $photoqry .=" ,addimg1='".$photo['Location']."'";
								break;
						case 3: $photoqry .=" ,addimg2='".$photo['Location']."'";
								break;
						case 4: $photoqry .=" ,addimg3='".$photo['Location']."'";
								break;
						case 5: $photoqry .=" ,addimg4='".$photo['Location']."'";
								break;
						case 6: $photoqry .=" ,addimg5='".$photo['Location']."'";
								break;
						case 7: $photoqry .=" ,addimg6='".$photo['Location']."'";
								break;
						case 8: $photoqry .=" ,addimg7='".$photo['Location']."'";
								break;
						case 9: $photoqry .=" ,addimg8='".$photo['Location']."'";
								break;
						case 10: $photoqry .=" ,addimg9='".$photo['Location']."'";
								break;
						case 11: $photoqry .=" ,addimg10='".$photo['Location']."'";
								break;
						case 12: $photoqry .=" ,addimg11='".$photo['Location']."'";
								break;
						case 13: $photoqry .=" ,addimg12='".$photo['Location']."'";
								break;
						
						 }
					}
					else
					break;
					
				}
				if ($flag>0)
				$photoqry .=" where MLSNo='".$MLSNo."'";
				else
				$photoqry .=" mainimg='no-preview.jpg' where MLSNo='".$MLSNo."'";			
				echo $photoqry;
				echo "<br />";
				mysql_query($photoqry);
				$rets->FreeResult($photos); 
				*/
			//}		
			}
			$rets->FreeResult($search);
		}
		
		$rowres=mysql_query("select MLSNo from tbl_listings1 order by MLSNo");
	
		while ($rowdata = mysql_fetch_array($rowres)) 
		{
			$photos = $rets->GetObject("Property", "Photo", $rowdata['MLSNo'], "*" , 1);
			$ph=0;
			$photoqry="  update tbl_listings1 set mainimg='".$photos[0]['Location']."' ,addimg1='".$photos[1]['Location']."'  ,addimg2='".$photos[2]['Location']."' ,addimg3='".$photos[3]['Location']."' ,addimg4='".$photos[4]['Location']."' ,addimg5='".$photos[5]['Location']."'  ,addimg6='".$photos[6]['Location']."' ,addimg7='".$photos[7]['Location']."'  ,addimg8='".$photos[8]['Location']."' ,addimg9='".$photos[9]['Location']."' ,addimg10='".$photos[10]['Location']."' ,addimg11='".$photos[11]['Location']."' ,addimg12='".$photos[12]['Location']."',addimg13='".$photos[13]['Location']."',addimg14='".$photos[14]['Location']."',addimg15='".$photos[15]['Location']."',addimg16='".$photos[16]['Location']."',addimg17='".$photos[17]['Location']."',addimg18='".$photos[18]['Location']."',addimg19='".$photos[19]['Location']."',addimg20='".$photos[20]['Location']."',addimg21='".$photos[21]['Location']."',addimg22='".$photos[22]['Location']."',addimg23='".$photos[23]['Location']."',addimg24='".$photos[24]['Location']."',addimg25='".$photos[25]['Location']."'  where MLSNo='".$rowdata['MLSNo']."'";
			
			mysql_query($photoqry);
			$rets->FreeResult($photos);
		}

		
									  
		echo "+ Disconnecting<br>\n";
		$rets->Disconnect();
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title>Cabrera Team Control Panel</title>
<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="../images/cabrera.ico">
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');
  ga('send', 'pageview');
  
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?php include_once("header.php");?></td></tr>
  
  <tr>
    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
      <?php 
      	$resultarray = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id ='".$userid."'")); 
	  ?>
        <td><div align="center"><em>You Are Currently Logged In As: <strong>
		<?php echo $resultarray['name']; ?></strong> (<a href="../logout.php">Log Out</a>)</em></div></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1122" border="0" cellspacing="12" cellpadding="0">
          <tr>
            <td><div align="center" class="white"><a href="index.php" class="whitelink">USER ACCOUNTS</a> &nbsp; | &nbsp; <a href="soldproperties.php" class="whitelink">SOLD PROPERTIES</a> &nbsp; | &nbsp; <a href="updatepages.php" class="whitelink">UPDATE PAGES</a> &nbsp; | &nbsp; <a href="uploadfiles.php" class="whitelink">UPLOAD FILES</a> &nbsp; | &nbsp; <a href="sitetemplate.php" class="whitelink">SITE TEMPLATE</a> &nbsp; | &nbsp; <a href="idxdata.php" class="whitelink">IDX DATA</a> &nbsp; | &nbsp; <a href="storeddata.php" class="whitelink">STORED DATA</a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td><h2>IDX DATA</h2>
          <p>Your IDX Feed is scheduled to update every night at 3:00 am EST.</p>
          <p>
			<form id="frmidx" name="frmidx" method="post">
            <input name="btnsubmit" type="submit" class="size20" id="btnsubmit" value="Update Your Properties From The MLS Manually" />
			</form>
          </p>
          <p class="size13 gray"><em>*Note, updating manually will update all the properties in your system real time.<br />
          Due to the amount of data being processed, your site may slow down briefly until this feed has been completely updated.</em></p></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="../images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1147" border="0" align="center" cellpadding="8" cellspacing="0">
          <tr>
            <td align="center" class="size12 lightblue"><em><?php include("../footer.php"); ?></em></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="../images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td><table width="182" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="30"><a href="https://www.youtube.com/channel/UCAnsRSon87T8_4vhjcOs-eg" target="_blank"><img src="../images/youtube-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://twitter.com/CabreraTeam" target="_blank"><img src="../images/twitter-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://plus.google.com/u/0/117240634238969765951/posts" target="_blank"><img src="../images/googleplus-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.facebook.com/CabreraCoastalTeam" target="_blank"><img src="../images/facebook-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.linkedin.com/company/cabrera-coastal-team" target="_blank"><img src="../images/linkedin-bottom.jpg" width="30" height="30" /></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
