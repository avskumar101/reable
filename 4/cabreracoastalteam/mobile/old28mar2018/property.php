<?php



	session_start();

	

	require_once('../config.php');	

	

	$ID=$_GET['MLSNo'];

	

 $resultarray=mysql_fetch_array(mysql_query("SELECT * FROM  tbl_listings where MLSNo='$ID' "));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<meta property="og:image" content="<?php echo $resultarray['mainimg']; ?>"/>



<meta property="og:image:width" content="200" />



<meta property="og:image:height" content="200" />





<title>Cabrera Coastal Team - For Sale Property</title>



<?php

$actuallink=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$pagenamein=str_replace("/mobile","",$actuallink);

?>

<link rel="canonical" href="<?php echo $pagenamein;?>"/>

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


<script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>

<script type='text/javascript'>

var map = null;

var searchManager = null;

function GetMap() {
	
	map = new Microsoft.Maps.Map('#myMap', {

	credentials: 'AjcLqAx_LZh2KbTTLp-4zAQQ7t3Us1zYB87cpT1Y9-ovcZ90WuKUm_g3yN38TOeR'
	
	});
	
	//Make a request to geocode.
	geocodeQuery("<?php echo $resultarray['Address'];?>, <?php echo $resultarray['City'];?>, <?php echo $resultarray['State'];?>");
	
	}
	
	function geocodeQuery(query) {
		
	//If search manager is not defined, load the search module.
	
	if (!searchManager) {
		
	Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
		
	searchManager = new Microsoft.Maps.Search.SearchManager(map);
	
	geocodeQuery(query);
	
	});

	} else {

	var searchRequest = {
		
	where: query,
	
	callback: function (r) {
		
		if (r && r.results && r.results.length > 0) {
			
			var pin = new Microsoft.Maps.Pushpin(r.results[0].location,{ icon: 'https://bingmapsisdk.blob.core.windows.net/isdksamples/defaultPushpin.png',
			anchor: new Microsoft.Maps.Point(12, 39) });
			
			map.entities.push(pin);
			
			map.setView({ bounds: r.results[0].bestView, zoom: 20 });
		}
	},
	errorCallback: function (e) {
		
		alert("Geocode failed.");
		
	}
	
	};
	
	searchManager.geocode(searchRequest);
	
	}
}

</script>


</head>



<body>

<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="100%"><table width="1080" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>

        <td width="232"><a href="../property.php?<?php echo $_SERVER['QUERY_STRING'];?>">

		

		<img src="images/fullsite.png" width="232" height="248" border="0"/></a></td>

        <td width="201"><a href="https://www.google.com/maps/place/Cabrera+Coastal+Real+Estate/@38.977306,-74.833419,17z/data=!3m1!4b1!4m2!3m1!1s0x89bf562e830dd59d:0x48eca07ed1663b46?hl=en" target="_blank"><img src="images/directions.png" width="201" height="248" border="0"/></a></td>

        <td width="216"><a href="tel:6097290559"><img src="images/call.png" width="216" height="248" border="0"/></a></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td><a href="index.php"><img src="images/cabreracoastalrealestate.png" width="1080" height="316" border="0"/></a></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td align="center"><span class="largefont3">

	

	<a href="<?php echo $_SERVER['HTTP_REFERER'];?>">

	

	<strong>BACK TO SEARCH RESULTS</strong></a></span>

	

	</td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont"><?php echo $resultarray['Address'];?></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <?php

  

  $resultimage=mysql_query("SELECT * FROM  tbl_listings where MLSNo='$ID' ");

  

    while($imagearray = mysql_fetch_array($resultimage)){

		

	$imageval = $imagearray['mainimg'];



	list($imgwidth, $imgheight, $type, $attr) = getimagesize($imageval);



	$ratio = 1080 / $imgwidth;



	$height = $imgheight * $ratio;

	                      	

    ?>

  <tr>

    <td><img src="<?php echo $imageval;?>" width="1080" height="<?php echo $height; ?>" /></td>

  </tr>

  <?php

  }

  ?>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont3">ACTIVE: <strong>$<?php echo number_format($resultarray['Asking_Price']);?></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">CITY: <strong>

	<span style="text-transform: uppercase;">

	<? echo $resultarray['City']; ?></span></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">MLS: <strong>

	<?php echo $resultarray['MLSNo']; ?></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">BEDROOMS: <strong>

	<?php echo $resultarray['Bedrooms'];?></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">BATHROOMS: <strong>

	<?php echo $resultarray['Full_Baths'];?></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">PROPERTY TYPE: <strong>

	<span style="text-transform: uppercase;">

	<?php echo $resultarray['Type'];?></span></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">TOTAL ROOMS: <strong>

	<?php echo $resultarray['Total_Rooms'];?></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">DIMENSIONS: <strong>

	<?php echo $resultarray['Lot_Size2'];?></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">DAYS ON MARKET: <strong>

	<?php echo $resultarray['Days_On_Market'];?></strong></td>

  </tr>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center" class="largefont2">TAXES: <strong>$<?php echo $resultarray['Taxes'];?></strong></td>

  </tr>

  <tr>

    <td align="center" class="largefont2">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" class="spacing">

	

	<table width="1080" border="0" cellspacing="15" cellpadding="0">

      <tr>

        <td><?php echo substr(strip_tags($resultarray['Remarks']),0,1500);?>.</td>

      </tr>

    </table>

	

	</td>

  </tr>

  <tr>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td align="center"><strong>

	<span class="largefont2"><u>ADDITIONAL PROPERTY PICTURES</u></span></strong></td>

  </tr>

  <?php       



	for($kk =1; $kk<=26;$kk++){

	

	if($kk!=1){	

	$setval = $kk-1;



	$resultaddimage=mysql_query("SELECT * FROM  tbl_listings where MLSNo='$ID' "); 

 

    while($imageaddarray = mysql_fetch_array($resultaddimage)){

		



		$addimageval = $imageaddarray['addimg'.$setval];



		if($addimageval != '') {



		list($imgwidth, $imgheight, $type, $attr) = getimagesize($addimageval);



		$ratio = 1080 / $imgwidth;



		$height = $imgheight * $ratio;

	  

     ?>

  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="center">

	<img src="<?php echo $addimageval;?>" width="1080" height="<?php echo $height; ?>" /></td>

  </tr>

 <?php

 }

 }

 }

 }

  ?>
	<tr>
	  <td align="center"><img src="images/t.gif" width="25" height="35" /></td>
	</tr>
	<tr>
	  <td align="center"><span class="size24">MAP / AERIAL VIEW</span></td>
	</tr>
	<tr>
	  <td align="center"><img src="images/t.gif" width="25" height="8" /></td>
	</tr>
	<tr>
	  <td><div id='myMap' style="position:relative; width:1080px; height:564px;"></div></td>
	</tr>
	<tr>
	  <td><img src="images/t.gif" width="25" height="7" /></td>
	</tr>
  <tr>

    <td align="center">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" class="smallfont">
	
	<table width="1080" border="0" cellspacing="15" cellpadding="0">

      <tr>
        <td class="smallfont smallspacing">Let <strong>THE CABRERA TEAM</strong> be your buyer's agent for this listing. H N HAND REALTORS. The data relating to real estate for sale on this web page appears in part through the Cape May County MLS program, a voluntary cooperative exchange of property listing data between licensed real estate brokerage firms in which we participate, and is provided by Cape May County MLS through a licensing agreement. Disclaimer: All information deemed reliable but not guaranteed and should be independently verified. All properties are subject to change, withdrawal, or prior sale.</td>

      </tr>

    </table>	

	</td>

  </tr>

  <tr>

    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td><img src="images/t.gif" width="30" height="60" /></td>

      </tr>

      <tr>

        <td bgcolor="#CCCCCC"><img src="images/t.gif" width="30" height="4" /></td>

      </tr>

      <tr>

        <td><img src="images/t.gif" width="30" height="60" /></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="372"><a href="forsale.php"><img src="images/forsale.png" width="372" height="356" border="0"/></a></td>

        <td width="333"><a href="rentals.php"><img src="images/rentals.png" width="333" height="356" border="0"/></a></td>

        <td width="375"><a href="ourcompany.php"><img src="images/ourcompany.png" width="375" height="356" border="0"/></a></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td><img src="images/t.gif" width="20" height="20" /></td>

  </tr>

  <tr>

    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">
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

    <td><a href="http://www.designsquare1.com" target="_blank"><img src="images/square1design.png" width="1080" height="102" border="0"/></a></td>

  </tr>

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

