<?php 
	session_start(); 
	require_once('../config.php');
	$id="";
	 $id=$_GET['id'];
	 $info = mysql_fetch_array(mysql_query("SELECT * FROM tbl_upload where id='$id'"));
	?>
	<html>
	<body style="background:#CAE1F7;color:#000;">
	<form name="path" method="GET">
<table>
  <tr>
  <td>http://<? echo $_SERVER['SERVER_NAME']?>/uploaded_files/<?php echo $info['original_file_name'];?></td>
  </tr>
  </table>
  </form>
  </body><?php require_once('googletagmanager.php'); ?>
  </html>