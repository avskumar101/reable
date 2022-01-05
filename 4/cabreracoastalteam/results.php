<?php

session_start();

require_once('config.php');	

define('DEF_PAGE_SIZE', 20);

$pagesize=20;

@extract($_POST);

@extract($_GET);

	
require_once("mls_query_res.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="keywords" content="Property Results, Cabrera Coastal Team," />

<meta http-equiv="description" content="Property Results provided by the Cabrera Coastal Team." />
<meta name="robots" content="index, follow" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<title>Cabrera Coastal Real Estate Team - Property Results</title>

<?php

$actuallink=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$pagenamein=str_replace("results.php","mobile/results.php",$actuallink);

?>
<link rel="alternate" href="<?php echo $pagenamein;?>"/>

<link href="styles.css" rel="stylesheet" type="text/css">

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-47104613-18', 'auto');
ga('send', 'pageview');
  
</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '137852190362471'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=137852190362471&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr><td><?php include("header.php");?></td></tr>

  <tr>
    <td>
	
	<table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">
      <tr>
        <td>
		
		<table width="1121" border="0" cellspacing="0" cellpadding="0">
         
		 <tr>
            <td width="986" align="left">
			
			<h1>CABRERA COASTAL REAL ESTATE TEAM - PROPERTY RESULTS</h1></td>
			
            <td width="135" align="right"><strong>
						
			<?php 

			if($_GET['Mls']=='Search') {
				
			$nezlr='mls.php?'.$_SERVER['QUERY_STRING'];
			
			} if($_GET['Mls']=='Home') {
				
			$nezlr='index.php?'.$_SERVER['QUERY_STRING'];
			
			} if($_GET['Address']!='') {
				
			$nezlr='address.php?'.$_SERVER['QUERY_STRING'];
			
			} if($_GET['MLSNO']!='') {
				
			$nezlr='number.php?'.$_SERVER['QUERY_STRING'];
			
			} if($_GET['Mls']=='Cabrera') {
				
			$nezlr='mls.php?'.$_SERVER['QUERY_STRING'];			
			}
			?>
				
			<a href="<?php echo $nezlr;?>">MODIFY SEARCH &gt;</a></strong>
			
			</td>
          </tr>
		  
          <tr>
            <td colspan="2"><img src="images/t.gif" width="10" height="5" /></td>
            </tr>
        </table>
		<table width="1121" border="0" cellspacing="0" cellpadding="0">
		  <tr>
              <td colspan="2" bgcolor="#CCCCCC">
			  <img src="images/t.gif" width="10" height="1" /></td>
            </tr>
            <tr>
              <td colspan="2"><img src="images/t.gif" width="10" height="13" /></td>
            </tr>
            <tr>
               <td width="560" align="left" class="size13">
			   
			<em>Listing <?=$start+1 ?> - 
			<?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize) ?>
			of  <?=$reccnt ?> Properties</em></td>
                 <td  align="right" class="size13">
				 
				 <em><?php include_once("paging.inc.php");?></a></em></td>
            </tr>
            <tr>
              <td colspan="2"><img src="images/t.gif" width="10" height="13" /></td>
            </tr>
			
			
			<?php
			
			
		   while($resultarray=mysql_fetch_array($result)) 
		   {
			   
			   
		   		if ($resultarray['mainimg']!='')
					$image=$resultarray['mainimg'];
				else
					$image="images/nopicture.png";
		   ?>
		   
		   
            <tr>
              <td colspan="2"><table width="1121" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="1121" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="1121" border="0" cellspacing="1" cellpadding="9" bgcolor="#C2E2F8">
                        <tr>
                          <td bgcolor="#EEF7FD"><table width="1101" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="192" valign="top"><table width="192" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#1E8BCC">
                                <tr>
                                  <td bgcolor="#FFFFFF"><a href="property.php?MLSNo=<?php echo $resultarray['MLSNo'];?>">
								<img src="<?php echo $image;?>" width="180" height="135" /></a></td>
                               
                              </tr>
                              </table></td>
							   
                              <td width="15"><img src="images/t.gif" width="15" height="10" /></td>
                              <td width="894" align="left" valign="top"><table width="894" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="664" align="left" valign="middle" class="size16"><table width="664" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td class="size16">
									  
<a href="property.php?MLSNo=<?php echo $resultarray['MLSNo'];?>">

<strong><?php echo $resultarray['Address'].', '. $resultarray['City'].' '.$resultarray['State'];?> STATUS<?php echo "<span style=\"color:black	\">"; ?><strong> -</strong> 
									  
									  
									  <?php   
											if($resultarray['Status']=="ACTIVE")
											{
												echo "<span style=\"color:green\">";
												echo $resultarray['Status'];
												echo "</span>";
											}
											else
											{
												echo "<span style=\"color:red\">";
												echo $resultarray['Status'];
												echo "</span>";
											}
									   ?>  </strong></a></td>
									
                                    </tr>
                                    <tr>
                                      <td><img src="images/t.gif" width="20" height="12" /></td>
                                    </tr>
                                    <tr>
                                      <td class="spacing"><?php echo substr(strip_tags($resultarray['Remarks']),0,350);?> <a href="property.php?MLSNo=<?php echo $resultarray['MLSNo'];?>">More Information&gt;</a></td>
                                    </tr>
                                  </table></td>
                                  <td width="15" class="size16"><img src="images/t.gif" width="15" height="10" /></td>
                                  <td width="215" colspan="2" bgcolor="#EEF7FD"><table width="215" border="0" cellspacing="1" cellpadding="5">
                                    <tr>
                                      <td width="60" align="right" bgcolor="#C2E2F8">PRICE:</td>
                                      <td width="132" align="center" bgcolor="#C2E2F8" class="size15 green"><strong>$<?php echo number_format($resultarray['Asking_Price']);?></strong></td>
                                    </tr>
                                    <tr>
                                      <td align="right" bgcolor="#C2E2F8">MLS:</td>
                                      <td align="center" bgcolor="#C2E2F8"><strong><?php echo $resultarray['MLSNo'] ?></strong></td>
                                    </tr>
                                    <tr>
                                      <td align="right" bgcolor="#C2E2F8">BEDS:</td>
                                      <td align="center" bgcolor="#C2E2F8"><strong><?php echo $resultarray['Bedrooms'] ?></strong></td>
                                    </tr>
                                    <tr>
                                      <td align="right" bgcolor="#C2E2F8">BATHS:</td>
                                      <td align="center" bgcolor="#C2E2F8"><strong><?php echo $resultarray['Full_Baths'] ?></strong></td>
                                    </tr>
                                    <tr>
                                      <td align="right" bgcolor="#C2E2F8">TYPE:</td>
                                      <td align="center" bgcolor="#C2E2F8"><strong><?php echo $resultarray['Type'];?></strong></td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table></td>
                            </tr>
                          </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><img src="images/t.gif" width="10" height="13" /></td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC"><img src="images/t.gif" width="10" height="1" /></td>
                    </tr>
                    <tr>
                      <td><img src="images/t.gif" width="10" height="13" /></td>
                    </tr>
                  </table></td>
                </tr>
                
              </table></td>
            </tr>
			
                  <?php  }  ?>
				  
           <tr>
               <td width="560" align="left" class="size13"><em>Listing <?=$start+1 ?> - <?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize) ?> of  <?=$reccnt ?> Properties</em></td>
                 <td  align="right" class="size13"><em><?php include("paging.inc.php");?></a></em></td>
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
  </form>
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>