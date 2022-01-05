<?php

session_start();
require_once('config.php');

include('city-query.php');

define('DEF_PAGE_SIZE', 100);
$pagesize=100;
@extract($_POST);
@extract($_GET);



	if($_POST['sort_data']=='Sort Data'){	
	$selct='';	
	if($_POST['select_feature']!=''){	
	$selct .=$_POST['select_feature'];	
	}			
	if($_POST['startdate']!=''){	
	$selct .='&sd='.$_POST['startdate'];
	}		
	if($_POST['enddate']!='')
	{	
	$selct .='&ed='.$_POST['enddate'];	
	}		
	
	echo "<script>window.location.href='capemaysold.php?sl=".$selct."';</script>";	
	}	

	
	

if($_GET['Mobile']=='') {

	$url =$_SERVER['HTTP_REFERER'];

	$query = parse_url($url, PHP_URL_QUERY);

	parse_str($query);

	parse_str($query, $arr);

	$request = $_SERVER['HTTP_REFERER'];

	$urlname=explode('?',$request);

	$urlname= $urlname[1];

	if($urlname=='Mobile=Off' || $Mobile=='Off')

	{

	 echo "<script>window.location='capemaysold.php?Mobile=Off';</script>";

	 exit;

	}

}





if($_GET['Mobile']=='') {

	

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

 echo "<script>window.location='mobile/capemaysold.php';</script>"; 



}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="keywords" content="Sold Properties, Cape May County, Cape May, Diamond Beach, Wildwood Crest, Wildwood, West Wildwood, North Wildwood, Lower Township, Middle Township," />
<meta http-equiv="description" content="Sold properties located in Cape May County New Jersey." />
<meta name="robots" content="index, follow" />
<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>
<title>Cabrera Team - Sold Properties</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="images/cabrera.ico">
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');
  ga('send', 'pageview');

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
</head>

<body onload="MM_preloadImages('images/search2.jpg')"><form enctype="multipart/form-data" name="sold" id="sold" method="POST">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?php include("header.php")?></td></tr>
  
  <tr>
    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">
      <tr>
        <td><h1>SOLD PROPERTIES IN CAPE MAY COUNTRY</h1>		<b style="font-size:20px">TYPE: </b>				<select name="select_feature" id="select_feature" style="font-size: 18px;">                <option selected="selected">All Features</option>                <option value="Single Family" >Single Family</option>                <option value="Condo" >Condominium</option>                <option value="Townhouse" >Townhouse</option>                <option value="Multi Family" >Multi Family</option>                <option value="Vacant Lot" >Lot / Land</option>								</select>                <input type="submit" name="sort_data" id="sort_data" value="Sort Data" /></td>		  </td>			</tr>			  <tr>        <td>
          <table width="1121" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="1121" border="0" cellspacing="1" cellpadding="6">
                <tr>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="160" align="center" bgcolor="#195CAB"><a style="font-size: 13px;" href="avalonsold.php" class="whitelink">AVALON / STONEHARBOR</a></td>
				  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="70" align="center" bgcolor="#195CAB"><a style="font-size: 13px;" href="capemaysold.php" class="whitelink">CAPE MAY</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="118" align="center" bgcolor="#195CAB"><a style="font-size: 13px;" href="wildwoodcrestsold.php" class="whitelink">WILDWOOD CREST</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="78" align="center" bgcolor="#195CAB"><a style="font-size: 13px;" href="wildwoodsold.php" class="whitelink">WILDWOOD</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="116" align="center" bgcolor="#195CAB"><a style="font-size: 13px;" href="westwildwoodsold.php" class="whitelink">WEST WILDWOOD</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="121" align="center" bgcolor="#195CAB"><a style="font-size: 13px;" href="northwildwoodsold.php" class="whitelink">NORTH WILDWOOD</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="119" align="center" bgcolor="#195CAB"><a style="font-size: 13px;" href="lowertownshipsold.php" class="whitelink">LOWER TOWNSHIP</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="125" align="center" bgcolor="#195CAB"><a style="font-size: 13px;" href="middletownshipsold.php" class="whitelink">MIDDLE TOWNSHIP</a></td>
				 
                  <td width="2" align="center"><img src="images/t.gif" width="2" height="10" /></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td bgcolor="#1E8BCC"><table width="1121" border="0" cellspacing="7" cellpadding="13">
                <tr>
                  <td bgcolor="#EEF7FD"><table width="1081" border="0" cellspacing="1" cellpadding="6">
				   <tr>
                      <td width="80" bgcolor="#CCCCCC"><strong>SOLD DATE</strong></td>
                      <td width="120" bgcolor="#CCCCCC"><strong>DAYS ON MARKET</strong></td>
                      <td width="215" bgcolor="#CCCCCC"><strong>ADDRESS</strong></td>
                      <td width="166" bgcolor="#CCCCCC"><strong>CITY</strong></td>
                      <td width="160" bgcolor="#CCCCCC"><strong>STYLE</strong></td>
                      <td width="55" bgcolor="#CCCCCC"><strong>MLS</strong></td>
                      <td width="100" bgcolor="#CCCCCC"><strong>ASKING PRICE</strong></td>
                      <td width="125" bgcolor="#CCCCCC"><strong>SOLD PRICE</strong></td>
                    </tr>
                    <?php
				
					
				   $i=1;
                   while($resultarray = @mysql_fetch_array($result))
				   {
					if($i%2==0)
							$bgcolor="#FBFDD5";
						else
							$bgcolor="#E9E9E9";
                 
					?>
                   <tr>
                       <td bgcolor="<?php echo $bgcolor; ?>"><?php echo date('m/d/Y',strtotime($resultarray['closingdate'])); ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['Days_On_Market'] ?> Days</td>
                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['Address'] ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['City'] ?></td>
                       <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['Type'] ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['MLSNo'] ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>">$<?php  echo number_format( $resultarray['Asking_Price']) ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>">$<?php  echo number_format( $resultarray['soldprice']) ?></td>
                      </tr>
                      
					  <?php
					 $i=$i+1;
					  }
					  ?>
                    <tr><td colspan="2">

<em>Listing <?=$start+1 ?> - <?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize) ?> of  <?=$reccnt ?> Properties</em></td>

<td colspan="8" align="right"><em><?php include("paging.inc1.php");?></a></em>

                     </td></tr>	
					
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1147" border="0" align="center" cellpadding="8" cellspacing="0">
          <tr>
            <td align="center" class="size12 lightblue"><em><?php include("footer.php")?></em></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td><img src="images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td><table width="258" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="30"><a href="https://www.youtube.com/channel/UCAnsRSon87T8_4vhjcOs-eg" target="_blank"><img src="images/youtube-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://twitter.com/CabreraTeam" target="_blank"><img src="images/twitter-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://plus.google.com/u/0/117240634238969765951/posts" target="_blank"><img src="images/googleplus-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.facebook.com/CabreraCoastalTeam" target="_blank"><img src="images/facebook-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.linkedin.com/company/cabrera-coastal-team" target="_blank"><img src="images/linkedin-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="http://www.pinterest.com/cabrerateam/" target="_blank"><img src="images/pinterest-bottom.jpg" width="30" height="30" border="0" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://instagram.com/cabrera_coastal_real_estate/" target="_blank"><img src="images/instagram-bottom.jpg" width="30" height="30" border="0" /></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/t.gif" width="10" height="8" /></td>
      </tr>
    </table></td>
  </tr>
</table></form>
</body><?php require_once('googletagmanager.php'); ?>
</html>
