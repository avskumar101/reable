<?php

	if (isset($_GET['start']))

	$start=$_GET['start'];

	else

	$start=0;

	$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;

	$columns = "select * ";

		

	$where=" where 1=1 ";

	$sql = " from tbl_storeddata ". $where. " and delete_status!='1' ";

	

	$order="order by id desc ";

	$cond = "";

	if($_POST['sort_data']=="Sort Data")

	{

		$start = 0;

		//$order = "order by id desc ";

		$select_data=$_POST['select_feature'];

		if($select_data=="01")

		{

			$cond = "";

		}

		else if($select_data=="02")

		{

			$cond = "and pagename='SALES > MLS SEARCH' ";

			$selectfeature2 = "selected";

		}

		else if($select_data=="03")

		{

			$cond = "and pagename='SALES > MAP SEARCH' ";

			$selectfeature3 = "selected";

		}

		else if($select_data=="04")

		{

			$cond = "and pagename='SEND PROPERTY TO A FRIEND' ";

			$selectfeature4 = "selected";

		}

		else if($select_data=="05")

		{

			$cond = "and pagename='LIST RENTAL' ";

			$selectfeature5 = "selected";

		}

		else if($select_data=="06")

		{

			$cond = "and pagename='LIST SALES' ";

			$selectfeature6 = "selected";

		}

		else if($select_data=="07")

		{

			$cond = "and pagename='FIND RENTAL' ";

			$selectfeature7 = "selected";

		}
		else if($select_data=="08")

		{

			$cond = "and pagename='LOCATE' ";

			$selectfeature8 = "selected";

		}
		else if($select_data=="09")

		{

			$cond = "and pagename='REQUEST RENTALS' ";

			$selectfeature9 = "selected";

		}
		else if($select_data=="10")

		{

			$cond = "and pagename='LET US HELP' ";

			$selectfeature10 = "selected";

		}	
		
		else if($select_data=="11")

		{

			$cond = "and pagename='CITY PAGE FORMS' ";

			$selectfeature11 = "selected";

		}
	    else

		{

			$cond = "";

		}

	}		

	$sql_count = "select count(*) ".$sql.$cond;

	

	$reccnt = db_scalar($sql_count);

	$sql = $columns.$sql.$cond;



	

	if($_POST['list_all']=="List All" || $_POST['sort_data']=="Sort Data")

	{

		$start = 0;

		$pagesize=$reccnt;

	}

	

	

	

	$sql .= $order."limit $start, $pagesize ";

	$result = mysql_query($sql);

	$rows = mysql_num_rows($result);

	$reccnt = db_scalar($sql_count);

	

	function db_scalar($sql, $dbcon2 = null)

	{

			$result	= mysql_query($sql) or	die(db_error($sql));

			if ($line =	mysql_fetch_array($result))	{

				$response =	$line[0];

			}

			return $response;

	}

	function qry_str($arr, $skip = '')

	{

		$s = "?";

		$i = 0;

		foreach($arr as	$key =>	$value)	{

			if ($key !=	$skip) {

				if (is_array($value)) {

					foreach($value as $value2) {

						if ($i == 0) {

							$s .= $key . '[]=' . $value2;

							$i = 1;

						} else {

							$s .= '&' .	$key . '[]=' . $value2;

						}

					}

				} else {

					if ($i == 0) {

						$s .= "$key=$value";

						$i = 1;

					} else {

						$s .= "&$key=$value";

					}

				}

			}

		}

	return $s; 

	}

	

?>