<?php

	session_start();

	require_once('config.php');

	$search_city = $_GET['Town'];

	if($search_city == ""){

		$search_city = "Wildwood";

	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="keywords" content="Cape May County Properties, Address Search, Advanced Search, Search By Address," />

<meta http-equiv="description" content="Seach for a property on the Cape May County MLS by its property address." />

<meta name="robots" content="index, follow" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<title>Property Address Search - Cape May County Properties For Sale</title>

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
		
	wherecond="";	
	var twn=document.getElementById('pSearchCities').value;
	
	var add=document.getElementById('searchaddresstext').value;	

	if(add=='') {
		
		alert("Please Enter Your Street Address and Try Again.");
		address.searchaddresstext.focus();
		return false;
	}
		 
	if(add!=''){
		wherecond=wherecond + "Address="+add;
	}
	if(twn!=''){
		wherecond=wherecond + "&Town="+twn;
	}	
	
	document.address.action="results.php?"+wherecond;
	
	document.forms["address"].submit();
	return true;
}

</script>

</head>



<body onload="MM_preloadImages('images/search2.jpg','images/searchproperties2.png')">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<form id="address" name="address" method="post">

<tr><td><?php include("header.php");?></td></tr>

  <tr>

    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

      <tr>

        <td><h1>CAPE MAY COUNTY PROPERTIES - ADDRESS SEARCH</h1>

          <table width="1121" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td><table width="1121" border="0" cellspacing="1" cellpadding="6">

                <tr>

                  <td width="35">&nbsp;</td>

                  <td width="140" align="center" bgcolor="#195CAB"><a href="mls.php" class="whitelink">ADVANCED SEARCH</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="100" align="center" bgcolor="#195CAB"><a href="map.php" class="whitelink">MAP SEARCH</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="150" align="center" bgcolor="#1E8BCC"><a href="address.php" class="whitelink">SEARCH BY ADDRESS</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="175" align="center" bgcolor="#195CAB"><a href="number.php" class="whitelink">SEARCH BY MLS NUMBER</a></td>

                  <td width="388">&nbsp;</td>

                </tr>

              </table></td>

            </tr>

            <tr>

              <td bgcolor="#1E8BCC"><table width="1121" border="0" cellspacing="7" cellpadding="13">

                <tr>

                  <td bgcolor="#EEF7FD"><table width="1081" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td width="467" valign="top"><table width="467" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td width="247" align="left"><strong><u>STREET ADDRESS</u></strong></td>

                          <td width="220" align="left"><strong><u>SELECT A TOWN</u></strong></td>

                          </tr>

                        <tr>

                          <td colspan="2"><img src="images/t.gif" width="13" height="5" /></td>

                          </tr>

                        <tr>

                          <td align="left">
						  
	<input type="text" value="<?php echo $_GET['Address'];?>" name="searchaddresstext" id="searchaddresstext" style="width: 85%"/>
	
						</td>

                          <td align="left"><span class="spacing">

                            <select name="pSearchCities" size="0" class="form-select" id='pSearchCities'>

                              <option value="Absecon"   >Absecon</option>

                              <option value="Atlantic City"   >Atlantic City</option>

                              <option value="Avalon"   >Avalon</option>

                              <option value="Avalon Manor"   >Avalon Manor</option>

                              <option value="Beesleys Point"   >Beesleys Point</option>

                              <option value="Belleplain"   >Belleplain</option>

                              <option value="Brigantine"   >Brigantine</option>

                              <option value="Burleigh"   >Burleigh</option>

                              <option value="Cape May"   >Cape May</option>

                              <option value="Cape May Beach"   >Cape May Beach</option>

                              <option value="Cape May Court House"   >Cape May Court House</option>

                              <option value="Cape May Point"   >Cape May Point</option>

                              <option value="Clermont"   >Clermont</option>

                              <option value="Cold Spring"   >Cold Spring</option>

                              <option value="Del Haven"   >Del Haven</option>

                              <option value="Dennis Township"   >Dennis Township</option>

                              <option value="Dennisville"   >Dennisville</option>

                              <option value="Diamond Beach"   >Diamond Beach</option>

                              <option value="Dias Creek"   >Dias Creek</option>

                              <option value="Dorchester"   >Dorchester</option>

                              <option value="Edgewood"   >Edgewood</option>

                              <option value="Egg Harbor Township"   >Egg Harbor Township</option>

                              <option value="Eldora"   >Eldora</option>

                              <option value="Erma"   >Erma</option>

                              <option value="Fishing Creek"   >Fishing Creek</option>

                              <option value="Galloway Township"   >Galloway Township</option>

                              <option value="Goshen"   >Goshen</option>

                              <option value="Grassy Sound"   >Grassy Sound</option>

                              <option value="Green Creek"   >Green Creek</option>

                              <option value="Hamilton Township"   >Hamilton Township</option>

                              <option value="Leesburg"   >Leesburg</option>

                              <option value="Linwood"   >Linwood</option>

                              <option value="Lower Township"   >Lower Township</option>

                              <option value="Margate"   >Margate</option>

                              <option value="Marmora"   >Marmora</option>

                              <option value="Marshallville"   >Marshallville</option>

                              <option value="Mays Landing"   >Mays Landing</option>

                              <option value="Mayville"   >Mayville</option>

                              <option value="Middle Township"   >Middle Township</option>

                              <option value="Millville"   >Millville</option>

                              <option value="North Cape May"   >North Cape May</option>

                              <option value="North Wildwood"   >North Wildwood</option>

                              <option value="Ocean City"   >Ocean City</option>

                              <option value="Oceanview"   >Oceanview</option>

                              <option value="Out of County"   >Out of County</option>

                              <option value="Palermo"   >Palermo</option>

                              <option value="Petersburg"   >Petersburg</option>

                              <option value="Pleasantville"   >Pleasantville</option>

                              <option value="Port Elizabeth"   >Port Elizabeth</option>

                              <option value="Port Norris"   >Port Norris</option>

                              <option value="Rio Grande"   >Rio Grande</option>

                              <option value="Sea Isle City"   >Sea Isle City</option>

                              <option value="Seaville"   >Seaville</option>

                              <option value="Shaw Crest"   >Shaw Crest</option>

                              <option value="Somers Point"   >Somers Point</option>

                              <option value="South Dennis"   >South Dennis</option>

                              <option value="South Seaville"   >South Seaville</option>

                              <option value="Stone Harbor"   >Stone Harbor</option>

                              <option value="Stone Harbor Manor"   >Stone Harbor Manor</option>

                              <option value="Strathmere"   >Strathmere</option>

                              <option value="Swainton"   >Swainton</option>

                              <option value="Townbank"   >Townbank</option>

                              <option value="Tuckahoe"   >Tuckahoe</option>

                              <option value="Ventnor"   >Ventnor</option>

                              <option value="Villas"   >Villas</option>

                              <option value="West Cape May"   >West Cape May</option>

                              <option value="West Wildwood"   >West Wildwood</option>

                              <option value="Whitesboro"   >Whitesboro</option>

                              <option value="Wildwood" selected="selected"  >Wildwood</option>

                              <option value="Wildwood Crest"   >Wildwood Crest</option>

                              <option value="Woodbine"   >Woodbine</option>

                            </select>

                          </span></td>

                          </tr>

                      </table>
				  </td>

				  <input type="hidden" id="search_properties" name="search_properties" value="search_mlsaddress"  />

                      <td width="614" valign="top">
					  
					  
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

  <script>

  document.getElementById('pSearchCities').value = "<?php echo $search_city;?>";

  </script>

  </form>

<?php

	$_SESSION['ADDRESS'] = "";

	$_SESSION['CITY'] = "Wildwood";

?>

</table>

</body><?php require_once('googletagmanager.php'); ?>

</html>

