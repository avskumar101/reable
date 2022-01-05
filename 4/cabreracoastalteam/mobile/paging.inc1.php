<?
if (isset($_GET['start']))
$start=$_GET['start'];
else
$start=0;

if($_POST){
	$start=0;
}
	
	
if($reccnt>$pagesize){
$num_pages=$reccnt/$pagesize;
$PHP_SELF=$_SERVER['PHP_SELF'];
$qry_str=$_SERVER['argv'][0];
$m=$_GET;
unset($m['start']);
$qry_str=qry_str($m);
//echo "$qry_str : $p<br>";
//$j=abs($num_pages/10)-1;
$j=$start/$pagesize-49;
//echo("<br>$j");
if($j<0) {
	$j=0;
}
$k=$j+50;
if($k>$num_pages)	{
	$k=$num_pages;
}
$j=intval($j);

?>
	<? 
	if($start!=0) 
	{
	?>
		<a  href="<?=$PHP_SELF?><?=$qry_str?>&start=0">&lt;&lt;</a>&nbsp;&nbsp;
		<a  href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start-$pagesize?>">&lt;</a>&nbsp;&nbsp;
    <? 
	}
	else
	{
	?>
		&lt;&lt;&nbsp;&nbsp;
		&lt;&nbsp;&nbsp;
	<?	
	 } 
	
	for($i=$j;$i<$k;$i++)
	{
		if(($pagesize*($i))!=$start)
		{
	?>
		<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$pagesize*($i)?>"><?=$i+1?></a>&nbsp;&nbsp;
	<? }
		else
		{ 
	?>
    <?=$i+1?>&nbsp;&nbsp;
 	<? }	
	} 
	?> 
    <? 
	if($start+$pagesize < $reccnt)
	{
	?> 
		<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start+$pagesize?>">&gt;</a>&nbsp;&nbsp;
		<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=round(($reccnt/$pagesize)-1)*50?>">&gt;&gt;</a>&nbsp;&nbsp;
	<? 
	}
	else
		{
		?>
		&gt;&nbsp;&nbsp;
		&gt;&gt;&nbsp;&nbsp;
		<? 
		}
		?>
   
<? }?>