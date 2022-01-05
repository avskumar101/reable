<?php
include('../config.php');
require_once 'Spreadsheet/Excel/reader.php';
require_once 'Classes/PHPExcel.php';


if($_POST['submitbtn'] == 'Upload'){
	$csv_fieldname = "uploadfile";
	$citytypeval = $_POST['citytype'];
	$importmessage = "";
	$norunsql = true;
    $handle = fopen($_FILES[$csv_fieldname]['tmp_name'],'r');
    //if(!$handle) die('Cannot open uploaded file.');
	$filename = $_FILES[$csv_fieldname]['tmp_name'];

	
	$returnarray = array();
	$toberunsql = array(); // all sql will be here
		
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load($filename);
	$worksheetcount = 0;
	$rowone = 0;
	$worksheetnamearray =  array();
	$sqlcount = "0"; // all sheet's row count will be here

	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$sheetarray = array();	
		$worksheetname = $worksheet->getTitle();
		$worksheetnamearray[$worksheetcount] = $worksheetname;
		$rowcount=0;
		foreach ($worksheet->getRowIterator() as $row) {
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			$exceldata = array();
			$i=0;
			foreach ($cellIterator as $cell) {
				//$exceldata[$i] = $cell->getCalculatedValue();

				$InvDate= $cell->getValue();
				if(PHPExcel_Shared_Date::isDateTime($cell)) {
					 $sold_date = date('m/d/Y', PHPExcel_Shared_Date::ExcelToPHP($InvDate)); 
				$exceldata[$i] = date('m/d/Y', strtotime($sold_date . ' + 1 day'));
				}else{
				$exceldata[$i] = $InvDate;
				}                                

				$i++;
			}
			$sheetarray[$rowcount] = $exceldata;
		//print_r($sheetarray[$rowcount]);
			$rowcount++;
		}
		
		for($ij=1;$ij<$rowcount;$ij++) {
				$excelrow=$sheetarray[$ij];
				  $SoldDate=$excelrow[0];
				 $DaysOnMarket=$excelrow[1];
				 $Address=$excelrow[2];
			     $City=$excelrow[3];
			     $Type=$excelrow[4];
				 $MLS=$excelrow[5];
				 $AskingPrice=$excelrow[6];
				 $SoldPrice=$excelrow[7];
                                if($Address != ""){
				$saql = "insert into tbl_sold(date,market,address,city,style,mls_no,asking_price,soldprice,city_value) values('".$SoldDate."','".$DaysOnMarket."',\"$Address\",'".$City."','".$Type."','".$MLS."','".$AskingPrice."','".$SoldPrice."','".$citytypeval."')";
				mysql_query($saql);
}
			}
	//$sheetarray[$rowcount] = $exceldata;
			//print_r($sheetarray[$rowcount]);
			
	}

	echo "<script>window.opener.location.href='soldproperties.php';window.close();</script>";
	}
?>
<script>
function message()
{
var x=document.getElementById('uploadfile').value;
if (x==null || x=="")
	{
		alert('Please select the file and then proceed.');
		return false;
	}
	
}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<title>Cabrerateam</title>
	<link href="../styles.css" rel="stylesheet" type="text/css">
	<link rel="SHORTCUT ICON" href="../images/lsa.ico">
</head>
<body style="background:#FFF;color:#FFF;">
	<form action="uploadexcel.php" method="post" enctype="multipart/form-data">
		<table width="300" border="0" cellspacing="1" cellpadding="3" style="padding-top:15px" align="center">
			
			<tr>
				<td>
					<table width="270" border="0" cellspacing="2" cellpadding="1">
						
						<tr>
							<td><strong>File</strong></td>
							<td align="left"><input type="file" id="uploadfile" name="uploadfile" /></td>
						</tr>
						
						<tr>
							<td><strong>City</strong></td>
							<td align="left"><select name="citytype" id="citytype">
							<option value="02">Cape May</option>
							<option value="03">Diamond Beach</option>
							<option value="04">Wildwood Crest</option>
							 <option value="05">Wildwood</option>
							<option value="06">West Wildwood</option>
							<option value="07">North Wildwood</option>
							<option value="08">Lower Township</option>
							<option value="09">Middle Township</option>
							<option value="10">Avalon</option>
							<option value="11">Stone Harbor</option>
							</select></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
			
				<td align='left'>
					<input type="submit" name="submitbtn" value="Upload" onclick="return message()"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>