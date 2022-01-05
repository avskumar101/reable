<?php

session_start();

require_once('config.php');	

define('DEF_PAGE_SIZE', 20);

$pagesize=20;

@extract($_POST);

@extract($_GET);

	
require_once("mls_wldwd_ucontract.php");





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

	 echo "<script>window.location='wildwoodundercontract.php?Mobile=Off';</script>";

	 exit;

	}

}





if($_GET['Mobile']=='') {

	

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

 echo "<script>window.location='mobile/wildwoodundercontract.php';</script>"; 



}


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
			
			<h1>THE WILDWOODS - PROPERTIES UNDER CONTRACT</h1></td>
			
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
			
			
			//$result = mysql_query("select * from tbl_listings where 1=1 and active='1' and ( city = 'Wildwood') and Status like'%UNDER CONTRACT%' order by Asking_Price desc");
			
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