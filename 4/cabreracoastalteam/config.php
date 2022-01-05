<?php
ob_start();
echo "GCP";
	ini_set('memory_limit', '-1');
	set_time_limit(0);
 	 if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
		$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $redirect);
		exit();
	}  
	$dbcon=mysql_connect('localhost','cabrerac_cabrera','zV#?lh;$&M%@');
	$con=mysql_select_db('cabrerac_cabreracoastalte',$dbcon);
foreach($_GET as $key => $val){
	$_GET[$key] = mysql_real_escape_string($val); 
}
?>