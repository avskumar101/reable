<?php
	require_once('../config.php');	
	$filename=$_REQUEST['filename'];
	$customid=$_REQUEST['customid'];

	if($filename!=''){		
		$result=mysql_num_rows(mysql_query("SELECT * FROM tbl_custpages WHERE file_name='$filename' and delete_status!='1'"));
		
		if($result==0){
			
			$filename=$_REQUEST['filename'].".php";					$array1 = array('index.php','listsales.php','resources.php','jointheteam.php','capemayrealestate.php','wildwoodcrestproperties.php','wildwoodrealestate.php','westwildwoodhomes.php','northwildwoodproperties.php','diamondbeachproperties.php','lowertownshiprealestate.php','middletownshiphomes.php','listrental.php','vacationrentalpolicy.php','vacationrentals.php','letushelp.php','propertymanagement.php','homerepair.php','team.php','contact.php','weather.php','events.php','emailalerts.php','testimonials.php');			$array2 = array($filename);			$result = array_intersect($array1, $array2);			echo count($result);					} else {			
			echo $result;		}
	}	?>