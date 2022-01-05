<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="keywords" content="Sold Properties, Cape May County, Cape May, Diamond Beach, Wildwood Crest, Wildwood, West Wildwood, North Wildwood, Lower Township, Middle Township," />

<meta http-equiv="description" content="Sold properties located in Stone Harbor New Jersey." />

<meta name="robots" content="index, follow" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<title>Stone Harbor Sold Properties</title>

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



<body onload="MM_preloadImages('images/search2.jpg')">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

    <td><?php include("header.php")?></td></tr>

  

  <tr>

    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

      <tr>

        <td><h1>SOLD PROPERTIES IN STONE HARBOR</h1>

          <table width="1121" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td><table width="1121" border="0" cellspacing="1" cellpadding="6">

                <tr>

                  <td width="4"><img src="images/t.gif" width="4" height="10" /></td>

                  <td width="70" align="center" bgcolor="#195CAB"><a href="capemaysold.php" class="whitelink">CAPE MAY</a></td>

                  <td width="4"><img src="images/t.gif" width="4" height="10" /></td>

                  <td width="116" align="center" bgcolor="#195CAB"><a href="diamondbeachsold.php" class="whitelink">DIAMOND BEACH</a></td>

                  <td width="4"><img src="images/t.gif" width="4" height="10" /></td>

                  <td width="118" align="center" bgcolor="#195CAB"><a href="wildwoodcrestsold.php" class="whitelink">WILDWOOD CREST</a></td>

                  <td width="4"><img src="images/t.gif" width="4" height="10" /></td>

                  <td width="78" align="center" bgcolor="#195CAB"><a href="wildwoodsold.php" class="whitelink">WILDWOOD</a></td>

                  <td width="4"><img src="images/t.gif" width="4" height="10" /></td>

                  <td width="116" align="center" bgcolor="#1E8BCC"><a href="westwildwoodsold.php" class="whitelink">WEST WILDWOOD</a></td>

                  <td width="4"><img src="images/t.gif" width="4" height="10" /></td>

                  <td width="121" align="center" bgcolor="#195CAB"><a href="northwildwoodsold.php" class="whitelink">NORTH WILDWOOD</a></td>

                  <td width="4"><img src="images/t.gif" width="4" height="10" /></td>

                  <td width="119" align="center" bgcolor="#195CAB"><a href="lowertownshipsold.php" class="whitelink">LOWER TOWNSHIP</a></td>

                  <td width="4"><img src="images/t.gif" width="4" height="10" /></td>

                  <td width="125" align="center" bgcolor="#195CAB"><a href="middletownshipsold.php" class="whitelink">MIDDLE TOWNSHIP</a></td>

                  <td width="4" align="center"><img src="images/t.gif" width="4" height="10" /></td>

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

					$result=@mysql_query("SELECT * FROM tbl_sold where delete_status!=1 and city_value ='11' order by STR_TO_DATE(date,'%m/%d/%Y') desc");

					

				   $i=1;

                   while($resultarray = @mysql_fetch_array($result))

				   {

					if($i%2==0)

							$bgcolor="#FBFDD5";

						else

							$bgcolor="#E9E9E9";

                 

					?>

                    <tr>

                       <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['date'] ?></td>

                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['market'] ?> Days</td>

                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['address'] ?></td>

                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['city'] ?></td>

                       <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['style'] ?></td>

                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['mls_no'] ?></td>

                        <td bgcolor="<?php echo $bgcolor; ?>">$<?php  echo number_format( $resultarray['asking_price']) ?></td>

                        <td bgcolor="<?php echo $bgcolor; ?>">$<?php  echo number_format( $resultarray['soldprice']) ?></td>

                      </tr>

                      

					  <?php

					 $i=$i+1;

					  }

					  ?>

                  

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

</table>

</body><?php require_once('googletagmanager.php'); ?>

</html>

