<?php
	session_start();
	require_once('config.php');
	$result=mysql_fetch_array(mysql_query("SELECT * FROM tbl_footer_text where id=1 "));
	$replace_footer=str_replace("<p>","",$result['footer_text']);
	$replace_footer=str_replace("</p>","",$replace_footer);
?>
<a href="https://www.nellaiseo.com/">Nellaiseo</a>
<?php echo $replace_footer; ?>
