<?php

	session_start();

	require_once('config.php');

	$mlsno = $_GET['MLSNO'];

	if($mlsno == null){
		$mlsno = "";

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="keywords" content="Cape May County Properties, MLS Number, Search By MLS Number," />

<meta http-equiv="description" content="Search Cape May County Properties Using The Unique MLS Number." />

<meta name="robots" content="index, follow" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<title>Cabrera Team</title>

<link href="styles.css" rel="stylesheet" type="text/css">

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

function submitform(){
		
	var add=document.getElementById('mlsnumbersearch').value;	

	if(add=='') {
		
		alert("Please Enter Your MLS Number and Try Again.");
		number.mlsnumbersearch.focus();
		return false;
	}
		 
	if(add!=''){
		wherecond="MLSNO="+add;
	}
	
	document.number.action="results.php?"+wherecond;
	
	document.forms["number"].submit();
	return true;
}

</script>

</script>

</head>



<body onload="MM_preloadImages('images/search2.jpg','images/searchproperties2.png')">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<form id="number" name="number" method="post" >

<tr><td><?php include("header.php");?></td></tr>

  <tr>

    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

      <tr>

        <td><h1>CAPE MAY COUNTY PROPERTIES - SEARCH BY MLS NUMBER</h1>

          <table width="1121" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td><table width="1121" border="0" cellspacing="1" cellpadding="6">

                <tr>

                  <td width="35">&nbsp;</td>

                  <td width="140" align="center" bgcolor="#195CAB"><a href="mls.php" class="whitelink">ADVANCED SEARCH</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="100" align="center" bgcolor="#195CAB"><a href="map.php" class="whitelink">MAP SEARCH</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="150" align="center" bgcolor="#195CAB"><a href="address.php" class="whitelink">SEARCH BY ADDRESS</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="175" align="center" bgcolor="#1E8BCC"><a href="number.php" class="whitelink">SEARCH BY MLS NUMBER</a></td>

                  <td width="388">&nbsp;</td>

                </tr>

              </table></td>

            </tr>

            <tr>

              <td bgcolor="#1E8BCC"><table width="1121" border="0" cellspacing="7" cellpadding="13">

                <tr>

                  <td bgcolor="#EEF7FD"><table width="1081" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td width="250" valign="top"><table width="250" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td width="430" align="left"><strong><u>MLS NUMBER</u></strong></td>

                          </tr>

                        <tr>

                          <td><img src="images/t.gif" width="13" height="5" /></td>

                          </tr>

                        <tr>

                          <td align="left">
						  
		<input type="text" name="mlsnumbersearch" id="mlsnumbersearch" value="<?php echo $mlsno; ?>" style="width: 85%"/>
		
		
						</td>

                          </tr>

                          <input type="hidden" id="search_properties" name="search_properties" value="search_mlsnumber" />

                      </table></td>

                      <td width="831" valign="top">
					  
					  
	 <a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('search_properties','','images/searchproperties2.png',1)">
	 
	<img onclick="return submitform();" src="images/searchproperties.png" width="400" height="43" alt="Search Properties For Sale" id="search_properties" name="search_properties" border="0" style="cursor:pointer;"/></a>	
					  
					  
					  </td>

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

<?php

$_SESSION['MLSNO'] = "";

?>

</table>

</body><?php require_once('googletagmanager.php'); ?>

</html>

