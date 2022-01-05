<?php
	ini_set('memory_limit', '-1');
	set_time_limit(0);
	$dbcon=mysql_connect('localhost','cabrerac_cabrera','zV#?lh;$&M%@');
	$con=mysql_select_db('cabrerac_cabreracoastalte',$dbcon);
foreach($_GET as $key => $val){
	$_GET[$key] = mysql_real_escape_string($val); 
}
?>