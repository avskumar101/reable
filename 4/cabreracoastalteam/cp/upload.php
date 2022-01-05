<?php

include('config.php');
require_once 'Classes/PHPExcel.php';
require_once 'Spreadsheet/Excel/reader.php';

if($_POST['submitbtn'] == 'Submit'){
	echo "sss";
	$csv_fieldname = "uploadfile";
	
	$importmessage = "";
	$norunsql = true;
    $handle = fopen($_FILES[$csv_fieldname]['tmp_name'],'r');
    if(!$handle) die('Cannot open uploaded file.');
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
		echo $worksheetname = $worksheet->getTitle();
		$worksheetnamearray[$worksheetcount] = $worksheetname;
		foreach ($worksheet->getRowIterator() as $row) {
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
echo "nicesss";			
			
			$exceldata = array();
			$i=0;
			foreach ($cellIterator as $cell) {
				//$exceldata[$i] = $cell->getCalculatedValue();
$InvDate= $cell->getValue();
if(PHPExcel_Shared_Date::isDateTime($cell)) {
echo "tt";
     $sold_date = date('m/d/Y', PHPExcel_Shared_Date::ExcelToPHP($InvDate)); 
$exceldata[$i] = date('m/d/Y', strtotime($sold_date . ' + 1 day'));
}else{
$exceldata[$i] = $InvDate;
}

//$exceldata[$i] = $cell->getValue();
				$i++;
			}
			$sheetarray[$rowcount] = $exceldata;
			print_r($exceldata);
		}
	}
}

?>
<script>
var _validFileExtensions = [".pdf",".docx",".txt",".xls",".xlsx",".doc"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }             
            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>
<html>

<form action="upload.php" method="post" enctype="multipart/form-data">
	<input type="file" id="uploadfile" accept=".pdf,.docx,.txt,.xls,.xlsx,.doc" onchange="ValidateSingleInput(this);" name="uploadfile" />
	<input type="submit" name="submitbtn" value="Submit" />

</form>
</html>
