<?php 

require_once('config_cron.php');
error_reporting(E_ERROR | E_PARSE);
ini_set('max_execution_time', -1);
ini_set("memory_limit",-1);

if(mysql_num_rows(mysql_query("select a.mlsno,b.MLSNo from tbl_listings b, tbl_mlsno_update a WHERE a.mlsno = b.MLSNo"))>50){

mysql_query("UPDATE tbl_listings b, tbl_mlsno_update a SET b.active=1 WHERE a.mlsno = b.MLSNo");

mysql_query("UPDATE tbl_listings SET tbl_listings.active=0 WHERE tbl_listings.MLSNo NOT IN (SELECT tbl_mlsno_update.mlsno FROM tbl_mlsno_update WHERE tbl_mlsno_update.mlsno IS NOT NULL)");

mysql_query("DELETE FROM tbl_listings WHERE active=0");

echo "MLSNo Update successfully1";

}

echo "MLSNo Update successfully2";

exit;

?>