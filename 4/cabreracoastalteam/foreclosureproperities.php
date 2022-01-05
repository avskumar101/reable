<?php
	session_start();
	require_once('config.php');

	$_SESSION['ORGNAME'] = "s";//for forecolsure make it as dummy hardcorded;
	$_SESSION['AGENTFIRSTNAME'] = "";
	$_SESSION['AGENTLASTNAME'] = "";
	$_SESSION['ADDRESS'] = "";
	$_SESSION['CITY'] = "";
	$_SESSION['modify_link'] = "index.php";
	$_SESSION['searchtype'] = "";
	$_SESSION['MLSNO'] = "";
	$_SESSION['TOWNS'] = "";
	$_SESSION['PROPERTIES'] = "";
	$_SESSION['MINPRICE'] = "";
	$_SESSION['MAXPRICE'] = "";
	$_SESSION['BEDS'] = "";
	$_SESSION['BATHS'] = "";
	$_SESSION['FORECLOSURE'] = "";
	$_SESSION['SORTBY'] = "";
	$_SESSION['SOLD'] = "";
	$_SESSION['HOMESEARCHTEXT'] = "";
	$_SESSION['HOMESEARCHACTIVESOLDTEXT'] = "";

	header("Location:results.php");
	
?>		
		
		
		
		

