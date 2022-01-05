<?php

	session_start();

	require_once('../config.php');

	

if($_POST['btnsubmit']=='listsubmit') {	


	$umcnd .="Mls=Search";
	
	// PROPERTIES TOWN 
	
	$propertytown = $_POST['pSearchCities'];
	
	if($propertytown!=''){
		
		$umcnd .="&Town=".$propertytown;
		
	} else {
		
		$umcnd .="&Town=All";
	}
	
	// PROPERTIES TYPE 
	
	$propertytype = $_POST['propertyType'];
	
	if($propertytype!=''){
		
		$umcnd .="&Type=".$propertytype;
	}	
	if($_POST['MinPrice']!=0){
		
		$umcnd .="&MinPrice=".$_POST['MinPrice'];
	}	
	if($_POST['MaxPrice']!=99999999){
		
		$umcnd .="&MaxPrice=".$_POST['MaxPrice'];
	}	
	if($_POST['selbedsmin']!=''){
		
		$umcnd .="&BedsMin=".$_POST['selbedsmin'];
	}	
	if($_POST['selbedsmax']!=''){
		
		$umcnd .="&BedsMax=".$_POST['selbedsmax'];
	}
	if($_POST['foreclosure']!=''){
		
		$umcnd .="&FC=".$_POST['foreclosure'];
	}	
	if($_POST['sortby']!=''){
		
		$umcnd .="&OB=".$_POST['sortby'];
	}
	
	
	header("Location:results.php?$umcnd");
	
}	

    $search_minprice = $_GET['MinPrice'];

    if($search_minprice == null){

		$search_minprice = "0";
	}
    $search_maxprice = $_GET['MaxPrice'];

    if($search_maxprice == null){

		$search_maxprice = "99999999";
	}
    $selbedsmin = $_GET['BedsMin'];

    if($selbedsmin == null){

		$selbedsmin = "";
	}
    $selbedsmax = $_GET['BedsMax'];

    if($selbedsmax == null){

		$selbedsmax = "";
	}
    $search_sortby = $_GET['OB'];

    if($search_sortby == null){

		$search_sortby = "desc";
	}
    $search_properties1 = $_GET['Type'];

    if($search_properties1 == null){

		$search_properties1 = "Single Family";
	}
    $search_towns = $_GET['Town'];

    if($search_towns == null){

		$search_towns = "";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Cabrera Coastal Team - Mobile Search</title>

<link rel="canonical" href="http://cabreracoastalteam.com/mls.php" />

<link href="styles.css" rel="stylesheet" type="text/css">

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');

  ga('send', 'pageview');

function submitform() {
	
	document.forms["mls"].submit();
	
	return true;
}
</script>

</head>


<body>

<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">

<form id="mls" name="mls" method="POST" enctype='multipart/form-data'>

  <tr>

    <td colspan="2"><table width="1080" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="431"><a href="index.php">
		
		<img src="images/logotop.png" width="431" height="248" border="0"/></a></td>

        <td width="232"><a href="../mls.php?<?php echo $_SERVER['QUERY_STRING'];?>">
		
		<img src="images/fullsite.png" width="232" height="248" border="0"/></a></td>

        <td width="201"><a href="https://www.google.com/maps/place/Cabrera+Coastal+Real+Estate/@38.977306,-74.833419,17z/data=!3m1!4b1!4m2!3m1!1s0x89bf562e830dd59d:0x48eca07ed1663b46?hl=en" target="_blank"><img src="images/directions.png" width="201" height="248" border="0"/></a></td>

        <td width="216"><a href="tel:6097290559">
		<img src="images/call.png" width="216" height="248" border="0"/></a></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td colspan="2"><a href="index.php">
	<img src="images/cabreracoastalrealestate.png" width="1080" height="316" border="0"/></a></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="80" /></td>

  </tr>

  <tr>

    <td colspan="2" align="center" class="largefont">SELECT A CITY</td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="20" /></td>

  </tr>

  <tr>

    <td colspan="2" align="center"><span class="spacing">

      <select name="pSearchCities" class="largefont" id="pSearchCities">

        <option value="" selected="selected">All Locations</option>

        <option value="Absecon"  >Absecon</option>

        <option value="Atlantic City"  >Atlantic City</option>

        <option value="Avalon"    >Avalon</option>

        <option value="Avalon Manor"    >Avalon Manor</option>

        <option value="Beesleys Point"    >Beesleys Point</option>

        <option value="Belleplain"   >Belleplain</option>

        <option value="Brigantine"    >Brigantine</option>

        <option value="Burleigh"    >Burleigh</option>

        <option value="Cape May"    >Cape May</option>

        <option value="Cape May Beach"    >Cape May Beach</option>

        <option value="Cape May Court House"    >Cape May Court House</option>

        <option value="Cape May Point"   >Cape May Point</option>

        <option value="Clermont"   >Clermont</option>

        <option value="Cold Spring"    >Cold Spring</option>

        <option value="Del Haven"   >Del Haven</option>

        <option value="Dennis Township"    >Dennis Township</option>

        <option value="Dennisville"   >Dennisville</option>

        <option value="Diamond Beach"   >Diamond Beach</option>

        <option value="Dias Creek"   >Dias Creek</option>

        <option value="Dorchester"   >Dorchester</option>

        <option value="Edgewood"   >Edgewood</option>

        <option value="Egg Harbor Township"   >Egg Harbor Township</option>

        <option value="Eldora"    >Eldora</option>

        <option value="Erma"    >Erma</option>

        <option value="Fishing Creek"  >Fishing Creek</option>

        <option value="Galloway Township"  >Galloway Township</option>

        <option value="Goshen"    >Goshen</option>

        <option value="Grassy Sound"    >Grassy Sound</option>

        <option value="Green Creek"   >Green Creek</option>

        <option value="Hamilton Township"  >Hamilton Township</option>

        <option value="Leesburg"  >Leesburg</option>

        <option value="Linwood"   >Linwood</option>

        <option value="Lower Township"   >Lower Township</option>

        <option value="Margate"   >Margate</option>

        <option value="Marmora"   >Marmora</option>

        <option value="Marshallville"  >Marshallville</option>

        <option value="Mays Landing"  >Mays Landing</option>

        <option value="Mayville"  >Mayville</option>

        <option value="Middle Township"  >Middle Township</option>

        <option value="Millville"  >Millville</option>

        <option value="North Cape May"  >North Cape May</option>

        <option value="North Wildwood"   >North Wildwood</option>

        <option value="Ocean City"   >Ocean City</option>

        <option value="Oceanview"   >Oceanview</option>

        <option value="Out of County"   >Out of County</option>

        <option value="Palermo"   >Palermo</option>

        <option value="Petersburg"   >Petersburg</option>

        <option value="Pleasantville"  >Pleasantville</option>

        <option value="Port Elizabeth"  >Port Elizabeth</option>

        <option value="Port Norris"   >Port Norris</option>

        <option value="Rio Grande"  >Rio Grande</option>

        <option value="Sea Isle City"   >Sea Isle City</option>

		<option value="Seapointe Village"   >Seapointe Village</option>
							  
        <option value="Seaville"   >Seaville</option>

        <option value="Shaw Crest"  >Shaw Crest</option>

        <option value="Somers Point"  >Somers Point</option>

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

        <option value="Wildwood"  >Wildwood</option>

        <option value="Wildwood Crest"   >Wildwood Crest</option>

        <option value="Woodbine"   >Woodbine</option>

      </select>

    </span></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="100" /></td>

  </tr>

  <tr>

    <td colspan="2" align="center"><span class="largefont">PROPERTY TYPE</span></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="20" /></td>

  </tr>

  <tr>

    <td colspan="2" align="center"><span class="spacing">

      <select name="propertyType" class="largefont" id="propertyType">

        <option value="Single Family" selected="selected">Single Family</option>

        <option value="CONDO">Condominium</option>

        <option value="TOWNHOUSE">Townhouse</option>

        <option value="MULTI-FAMILY">Multi Family</option>

        <option value="Modular/Mobile">Modular / Mobile</option>

        <option value="LOTS/LAND">Lot / Land</option>

        <option value="COMMERCIAL/INDUSTRIAL">Commercial</option>

      </select>

    </span></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="100" /></td>

  </tr>

  <tr align="center">

    <td colspan="2"><span class="largefont">MINIMUM PRICE</span></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="20" /></td>

  </tr>

  <tr align="center">

    <td colspan="2">
	
	<select name="MinPrice" size="1" class="largefont" id="MinPrice">

      <option value="0"         >No Minimum</option>

      <option value="100000"    >$100,000 </option>

      <option value="150000"    >$150,000 </option>

      <option value="200000"    >$200,000 </option>

      <option value="250000"    >$250,000 </option>

      <option value="300000"    >$300,000 </option>

      <option value="350000"    >$350,000 </option>

      <option value="400000"    >$400,000 </option>

      <option value="450000"    >$450,000 </option>

      <option value="500000"    >$500,000 </option>

      <option value="750000">$750,000</option>

      <option value="1000000"   >$1,000,000</option>

      <option value="2000000"   >$2,000,000</option>

      <option value="3000000"   >$3,000,000</option>

    </select></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="100" /></td>

  </tr>

  <tr align="center">

    <td colspan="2"><span class="largefont">MAXIMUM PRICE</span></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="20" /></td>

  </tr>

  <tr align="center">

    <td colspan="2">
	
	
	<select name="MaxPrice" size="1" class="largefont" id="MaxPrice">

      <option value="99999999">No Maximum</option>

      <option value="100000"              >$100,000</option>

      <option value="150000"              >$150,000</option>

      <option value="200000"              >$200,000</option>

      <option value="250000"              >$250,000</option>

      <option value="300000"              >$300,000</option>

      <option value="350000"              >$350,000</option>

      <option value="400000"              >$400,000</option>

      <option value="450000"              >$450,000</option>

      <option value="500000"              >$500,000</option>

      <option value="750000">$750,000</option>

      <option value="1000000"             >$1,000,000</option>

      <option value="2000000"             >$2,000,000</option>

      <option value="3000000"             >$3,000,000</option>

    </select></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="100" /></td>

  </tr> <tr align="center">

    <td colspan="2"><span class="largefont">MINIMUM BEDROOMS</span></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="20" /></td>

  </tr>

  <tr align="center">

    <td colspan="2">
	
	<select name="selbedsmin" size="1" class="largefont" id="selbedsmin">

		<option value="" selected="selected">No Preference</option>

		<option value="0">Studio</option>

		<option value="1">1</option>

		<option value="2">2</option>

		<option value="3">3</option>

		<option value="4">4</option>

		<option value="5">5</option>

    </select></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="100" /></td>

  </tr>

  <tr align="center">

    <td colspan="2"><span class="largefont">MAXIMUM BEDROOMS</span></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="20" /></td>

  </tr>

  <tr align="center">

    <td colspan="2">
	
	<select id="selbedsmax" class="largefont" name="selbedsmax">

		<option value="" selected="selected">No Preference</option>

		<option value="0">Studio</option>

		<option value="1">1</option>

		<option value="2">2</option>

		<option value="3">3</option>

		<option value="4">4</option>

		<option value="5">5</option>

		<option value="6">6</option>

		<option value="7">7</option>

    </select></td>

  </tr>

  <!--<tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="100" /></td>

  </tr>

  <tr align="center">
   
    <td width="50%"><span class="largefont">BATHS</span></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="20" /></td>

  </tr>

  <tr align="center">

    <td><span style="width:100%">

      <select name="selbaths" class="largefont" id="selbaths">

        <option value="" selected="selected">All</option>

        <option value="1">1+</option>

        <option value="2">2+</option>

        <option value="3">3+</option>

        <option value="4">4+</option>

        <option value="5">5+</option>

      </select>

    </span></td>

  </tr>-->

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="120" /></td>

  </tr>

  <tr>

  <input type="hidden" id="search_properties" name="search_properties" value="search_mlsadvance" />

    <td colspan="2">
	
	
	<input type="hidden" id="btnsubmit" name="btnsubmit"  value="listsubmit" />

	<a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('search_properties','','images/submitsearch.png',1)">

	<img onclick="return submitform();" src="images/submitsearch.png" width="1080" height="216" alt="Search Properties For Sale" id="search_properties" name="search_properties" border="0" style="cursor:pointer;"/></a>	

	</td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="30" height="120" /></td>

  </tr>

  <tr>

    <td colspan="2"><table width="1080" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="372"><a href="forsale.php"><img src="images/forsale.png" width="372" height="356" border="0"/></a></td>

        <td width="333"><a href="rentals.php"><img src="images/rentals.png" width="333" height="356" border="0"/></a></td>

        <td width="375"><a href="ourcompany.php"><img src="images/ourcompany.png" width="375" height="356" border="0"/></a></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td colspan="2"><img src="images/t.gif" width="20" height="20" /></td>

  </tr>

  <tr>

    <td colspan="2"><table width="1080" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="7"><!--<a href="https://app.helponclick.com/help?c=491ebd7f-aa80-48c9-b9ab-5dbbfd160a8b" target="_blank"><img src="../chatonline.png" alt="Chat Online" width="1080" height="300" border="0" /></a>--></td>
      </tr>
      <tr>
        <td width="163"><a href="https://www.youtube.com/channel/UCAnsRSon87T8_4vhjcOs-eg" target="_blank"><img src="images/youtube.png" width="163" height="204" border="0"/></a></td>
        <td width="152"><a href="https://twitter.com/CabreraTeam" target="_blank"><img src="images/twitter.png" width="152" height="204" border="0"/></a></td>
        <td width="153"><a href="https://plus.google.com/u/0/+Cabreracoastalteam/posts" target="_blank"><img src="images/googleplus.png" width="153" height="204" border="0"/></a></td>
        <td width="152"><a href="https://www.facebook.com/CabreraCoastalTeam" target="_blank"><img src="images/facebook.png" width="152" height="204" border="0"/></a></td>
        <td width="152"><a href="https://www.linkedin.com/company/cabrera-coastal-team" target="_blank"><img src="images/linkedin.png" width="152" height="204" border="0"/></a></td>
        <td width="151"><a href="https://www.pinterest.com/cabreracoastal/" target="_blank"><img src="images/pinterest.png" width="151" height="204" border="0"/></a></td>
        <td width="157"><a href="https://www.instagram.com/Cabreracoastal_realestate/" target="_blank"><img src="images/instagram.png" width="157" height="204" border="0"/></a></td>
      </tr>
    </table></td>

  </tr>

  <tr>

    <td colspan="2"><a href="http://www.designsquare1.com" target="_blank"><img src="images/square1design.png" width="1080" height="102" border="0"/></a></td>

  </tr>

</form>

<script>

  document.getElementById('MinPrice').value = "<?php echo $search_minprice;?>";

  document.getElementById('MaxPrice').value = "<?php echo $search_maxprice;?>";

  document.getElementById('selbedsmin').value = "<?php echo $selbedsmin;?>";

  document.getElementById('selbedsmax').value = "<?php echo $selbedsmax;?>";

  document.getElementById('propertyType').value = "<?php echo $search_properties1;?>";

  document.getElementById('pSearchCities').value = "<?php echo $search_towns;?>";

  </script>

</table>

<script>// <![CDATA[

    (function () {

        var head = document.getElementsByTagName("head").item(0);

        var script = document.createElement("script");

        

        var src = (document.location.protocol == 'https:' 

            ? 'https://www.formilla.com/scripts/feedback.js' 

            : 'http://www.formilla.com/scripts/feedback.js');

        

        script.setAttribute("type", "text/javascript"); 

        script.setAttribute("src", src); script.setAttribute("async", true);        



        var complete = false;

        

        script.onload = script.onreadystatechange = function () {

            if (!complete && (!this.readyState 

                    || this.readyState == 'loaded' 

                    || this.readyState == 'complete')) {

                complete = true;

                Formilla.guid = 'csb8237d-09bc-415e-a126-da2b3f2e2f12';

                Formilla.loadWidgets();                

            }

        };



        head.appendChild(script);

    })();

// ]]></script>

</body>

</html>

