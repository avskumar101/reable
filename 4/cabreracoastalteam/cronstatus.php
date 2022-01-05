<?php
ob_start();

session_start();

require_once('config.php');
 
$availability = mysql_fetch_array(mysql_query('SELECT * FROM tbl_availability'));

?>
<h1><a href="vacationrentals.php" target="_blank">Rentals</a> Cron</h1>

<table border="1" cellpadding="16" cellspacing="1" width="650px" align="left">
	<tr>
		<td align="right" width="290px"> Main Cron Last Update: </td>

		<td align="left"> <?php 

		echo $availability['lastupdate']; ?></td>

	</tr>	
	<tr>
		<td align="right" width="290px"> Availability Cron Last Update: </td>

		<td align="left"> <?php 

		echo $availability['availability']; ?></td>

	</tr>	
	<tr>
		<td align="right" width="290px"> Rates Cron Last Update: </td>

		<td align="left"> <?php 

		echo $availability['rates']; ?></td>

	</tr>
</table>


<table border="0" cellpadding="0" cellspacing="1" width="100%" align="left"><tr><td><br/>

<h1><a href="mls.php" target="_blank">Sales</a> Cron</h1></td></tr></table>


<table border="1" cellpadding="16" cellspacing="1" width="650px" align="left">
	<tr>
		<td align="right" width="290px"> Idx Cron Last Update: </td>

		<td align="left"><?php 

		$property_dte = mysql_fetch_array(mysql_query('SELECT * FROM tbl_mlsno_update'));
		
		$datels=explode(" ", $property_dte['lastupdate']);

		echo date("m/d/Y", strtotime($datels[0])).' - '.$datels[1]; ?></td>

	</tr>
	<tr>
		<td align="right" width="290px">Idx Sold Cron Last Update: </td>

		<td align="left"><?php 

		$property_sold = mysql_fetch_array(mysql_query('SELECT data_lastupdate FROM tbl_sold order by data_lastupdate desc'));

		$datelsold=explode(" ", $property_sold['data_lastupdate']);

		echo date("m/d/Y", strtotime($datelsold[0])).' - '.$datelsold[1]; ?></td>

	</tr>
</table>
