<?php 

session_cache_limiter(false);

ob_start();

session_start();


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
		
	 echo "<script>window.location='rentalresults.php?Mobile=Off&".$_SERVER['QUERY_STRING']."';</script>";
	 exit;
	 
	}
}



if($_GET['Mobile']=='') {
	
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
   
echo "<script>window.location='mobile/rentalresults.php?".$_SERVER['QUERY_STRING']."';</script>";

}


require_once('config.php');	
		
define('DEF_PAGE_SIZE',20);

$pagesize=20;

@extract($_POST);

@extract($_GET);	


$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if($_SERVER['QUERY_STRING']=='') {
	$queryString ="&start=0";
}else {
	$queryString = $_SERVER['QUERY_STRING'];
}

require_once("rental_qry.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<meta http-equiv="keywords" content="<?php echo $metakeyword; ?> " />

<meta http-equiv="description" content="<?php echo $metadescription; ?>" />

<meta name="robots" content="index, follow" />

<title>Cabrera Coastal Team - Properties</title>

<link href="styles.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.9.1.js" type="text/javascript"></script>

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');

  ga('send', 'pageview');

  
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

</script>

</head>

<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr><td><?php include("header.php")?></td></tr>

  <tr>

    <td>

	<form name="rentalsearch1" id="rentalsearch1" method="POST" >	

	<?php $mobile1=$_GET['Mobile'];	?>	

	<input id="mobile" name="mobile" type="hidden" value="<?php echo $mobile1;?>"/>	

	<table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

 <tr>

    <td>	
	
	<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0" class="lrgspacing">
  <tr>

    <td><img src="images/t.gif" width="40" height="25" /></td>

  </tr>
      <tr>

        <td align="center">
		
	<?php 
	
	$checkindate=date('m/d/Y', strtotime($_GET['checkin']));

	$checkoutdate=date('m/d/Y', strtotime($_GET['checkout']));

	 if($_GET['vr']=='view'){
			
		$nezlr="vacationrentals.php?".$_SERVER['QUERY_STRING']."";
		
		}
		if($_GET['uadd']!=''){
			
		$nezlr="rentaladdress.php?".$_SERVER['QUERY_STRING']."";
		
		}	
		if($_GET['key']!=''){
			
		$nezlr="rentalkey.php?".$_SERVER['QUERY_STRING']."";
		
		}		
		if($_GET['page']=='home'){
			
		$nezlr="index.php?".$_SERVER['QUERY_STRING']."";
		
		}
	?>
		
		<table width="613" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td width="171"> <a href="<?php echo $nezlr;?>" >
			
			<img src="images/modifysearch.jpg" width="171" height="30" border="0" /></a></td>

            <td width="25"><img src="images/t.gif" width="25" height="25" /></td>

            <td width="142"><a href="contact.php">
			<img src="images/contact1.jpg" width="142" height="30" border="0" /></a></td>

            <td width="25"><img src="images/t.gif" width="25" height="25" /></td>

            <td width="250"><a href="letushelp.php">
			<img src="images/letushelp.jpg" width="250" height="30" border="0" /></a></td>

          </tr>

          <tr>

            <td colspan="5"><img src="images/t.gif" width="25" height="12" /></td>

            </tr>

        </table>You Have <strong><?=$reccnt?>
		  
		  </strong> Vacation Rentals That Meet Your Criteria<br />
		  
		  
		  <?php if($_GET['key']=='' && $_GET['uadd']==''){ ?>
		  
		  
          Rental Period: <strong>
		  <?php echo $checkindate;?> - <?php echo $checkoutdate;?></strong><br />

          Beds: <strong><?php if($_GET['BD']!=''){ echo $_GET['BD']; } else { echo 'NA';} ?></strong> &nbsp; &nbsp; 
		  
		  Baths: <strong><?php if($_GET['BTH']!=''){ echo $_GET['BTH']; } else { echo 'NA';} ?></strong> &nbsp; &nbsp; 	  
		
		  
		  Sleeps: <strong><?php if($_GET['SLP']!=''){ echo $_GET['SLP']; } else { echo 'NA';} ?></strong> &nbsp; &nbsp; 
		  
		  Pets: <strong><?php if($_GET['PE']!=''){ echo $_GET['PE']; } else { echo 'NA';} ?></strong> &nbsp; &nbsp; 
		  
		  	  
		<?php 
		$amenity = explode(",",$_GET['Amenities']);
		$ii=0;			
		for($kkk=0; $kkk<count($amenity); $kkk++) {

		if($amenity[$kkk]=='Internet') { $intr='Yes'; }	

		}		  
		?>
		  
		  Internet: <strong><?php if($intr!=''){ echo $intr; } else { echo 'NA';} ?></strong><br />

          Additional Amenities: 
		  
		<?php  
		
		
		$amenitArray = explode(",",$_GET['Amenities']);
		
		$ii=0;			
		for($kkk=0; $kkk<count($amenitArray); $kkk++) {
			
	if($amenitArray[$kkk]!='Internet') {
				
		$valuepro = str_replace(",", ", ",$amenitArray[$kkk]);

		if($valuepro != ""){
			
		if($ii!=0){ echo ', '; }
			
		if($amenitArray[$kkk]=='BBQ') { echo '<strong>BBQ Grill</strong>'; }
		else if($amenitArray[$kkk]=='Central A/C') { echo '<strong>Air Conditioning</strong>'; }
		else if($amenitArray[$kkk]=='Outdoor Pool') { echo '<strong>Swimming Pool</strong>'; }
		else if($amenitArray[$kkk]=='Boat') { echo '<strong>Boat Slip</strong>'; }		
		else { echo '<strong>'.$amenitArray[$kkk].'</strong>'; }			

		$ii++; 
		
		} }	if($ii==0) { echo 'NA'; } 
		
		}		
	}		
	?>		  
		  
		<table width="1100" border="0" cellspacing="0" cellpadding="0">

		<tr><td><table width="1100" border="0" cellspacing="0" cellpadding="0">

		<tr><td><img src="images/t.gif" width="25" height="25" /></td></tr>

		<tr><td bgcolor="#DADADA">

		<img src="images/t.gif" width="25" height="1" /></td></tr>

		<tr><td><img src="images/t.gif" width="25" height="12" /></td></tr><tr><td>

	 <table width="1100" border="0" cellspacing="0" cellpadding="0">

		<tr><td width="355" align="left" class="size14 spacing gray">Displaying <strong><?=$start+1 ?></strong> - <strong><?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize) ?></strong> of <strong><?=$reccnt ?></strong> Properties</td>

		<td width="645" align="right" class="size14 spacing">

		<?php include("paging.inc.php"); ?></td></tr></table></td></tr>

        <tr><td><img src="images/t.gif" width="25" height="12" /></td></tr>
		
	<tr><td bgcolor="#DADADA"><img src="images/t.gif" width="25" height="1" /></td></tr>
	
	<tr><td><img src="images/t.gif" width="25" height="25" /></td></tr>

    </table></td></tr><?php 

	$i=0;		

	while($resultarray=mysql_fetch_array($result)) {


		$cnd='';

		if(isset($_GET['checkin'])) { 

			$cnd .="&checkin=".$checkindate."&checkout=".$checkoutdate;
		} 
		if(isset($_GET['pageno'])) { 

			$cnd .= "&pageno=".$_GET['pageno']; 
		}		
		
		 if($_GET['key']=='' && $_GET['uadd']==''){ 
		 
				if(isset($resultarray['rate'])) { 

					$cnd .= "&Price=".$resultarray['rate']; 
				}	
		 }
		 
		$referenceid=$resultarray['referenceid'];
		
		$cid=$resultarray['cid'];
		
		$pgrepimg=$resultarray['imgPreview'];
		
		$pgurl="rentalproperty.php?RefId=".$referenceid."&cid=".$cid.$cnd;
	
	    if($pgrepimg=="../images/piccomingsoon.jpg"){
			 $pgrepimg='images/piccomingsoon.jpg';
		 }
	 
		if($i!=0){ ?>		

            <tr>

              <td><table width="1100" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td><img src="images/t.gif" width="25" height="25" /></td>

                </tr>

                <tr>

                  <td bgcolor="#DADADA"><img src="images/t.gif" width="25" height="1" /></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="25" height="25" /></td>

                </tr>

              </table></td>

            </tr>
			
		   <?php } ?>
	<tr>

	<td><table width="1100" border="0" cellspacing="0" cellpadding="0">

	<tr>

	  <td width="200">

	<table width="192" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#1E8BCC">

	<tr><td bgcolor="#FFFFFF"><a href="<?php echo $pgurl;?>">

	<img src="<?php echo $pgrepimg;?>" width="210px" height="160px" /></a></td></tr>

	</table></td>

	<td width="2"><img src="images/t.gif" width="2" height="25" /></td>

	<td width="775"><strong class="size18">
	
	<a href="<?php echo $pgurl;?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('propertydetails<?php echo $i;?>','','images/propertydetails2.png',1)">
	
	<img src="images/propertydetails1.png" alt="Property Details" width="208" height="37" id="propertydetails<?php echo $i;?>" align="right" border="0" /></a>

	<a href="<?php echo $pgurl;?>">
	
	<?php echo $resultarray['propertyheadline'];?>
	
	</a></strong><br />

	<?php if($_GET['key']=='' && $_GET['uadd']==''){ ?>
	
	Price: <strong><?php if($resultarray['rate'] > 0){ echo '$'.number_format($resultarray['rate']); } else { echo 'N/A';} ?></strong> &nbsp; &nbsp; &nbsp; 
	
	<?php } ?>
	
	Beds: <strong><?php if($resultarray['bedroom'] > 0){ echo $resultarray['bedroom']; } else { echo '0';} ?></strong> &nbsp; &nbsp; &nbsp; 
	
	Baths: <strong><?php if($resultarray['bathroom'] > 0){ echo $resultarray['bathroom']; } else { echo '0';} ?></strong> &nbsp; &nbsp; &nbsp; 
	
	
	Half Baths: <strong><?php

	if($resultarray['halfbath'] > 0){ echo $resultarray['halfbath']; } else { echo '0';} ?></strong> &nbsp; &nbsp; &nbsp; 
	
	<?php if($resultarray['sleepupto']!='0'){ ?> Sleeps: <strong><?php echo $resultarray['sleepupto'];?></strong><br /> <?php } ?>

	Location: <strong><?php echo $resultarray['city'];?></strong> &nbsp; &nbsp; &nbsp; 
	
	Style: <strong><?php echo $resultarray['propertytype'];?></strong> &nbsp; &nbsp; &nbsp; 
	
	Key: <strong><?php echo $resultarray['cid'];?></strong><br />
	
	<?php 
	
	 $desc=$resultarray['propertydesc'];

	$discpn=trim($desc ," ");		

	if($discpn!=''){		

	echo substr(strip_tags($discpn),0,230);

	if(strlen(strip_tags($discpn))>230) { 	   

	?>  .. <a href="<?php echo $pgurl;?>">Read More &gt;</a> <?php } 
	}
	?>	
	
	</td></tr></table></td></tr>		
			
	<?php 
	$i=$i+1;
	} 
	?> 
		<tr>

		  <td><table width="1100" border="0" cellspacing="0" cellpadding="0">

			<tr>

			  <td><img src="images/t.gif" width="25" height="25" /></td>

			</tr>

			<tr>

			  <td bgcolor="#DADADA"><img src="images/t.gif" width="25" height="1" /></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="25" height="25" /></td>

                </tr>

                <tr>

                  <td>
				  
				  
		<table width="1100" border="0" cellspacing="0" cellpadding="0">

		<tr>

		<td width="355" align="left" class="size14 spacing gray">Displaying <strong><?=$start+1 ?></strong> - <strong><?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize) ?></strong> of <strong><?=$reccnt ?></strong> Properties</td>

		<td width="645" align="right" class="size14 spacing">

		<?php include("paging.inc.php"); ?>

		</td>
		</tr></table>
		
		</td> </tr>

              </table></td>

            </tr>

</table></td>

      </tr>

    </table>
	
	

	</td>

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

</table>

</body><?php require_once('googletagmanager.php'); ?>

</html>

