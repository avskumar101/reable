<?php 

ob_start();

session_start(); 

require_once('../config.php');	

//Sitelock XSS vulnerability filter begins
foreach (array('RefId','checkin','checkout','cid','mobile') as $vuln) //add the parameter in the place of 's'
{
	isset($_REQUEST[$vuln]) and $_REQUEST[$vuln] = htmlentities($_REQUEST[$vuln]);
	isset($_GET[$vuln]) and $_GET[$vuln] = htmlentities($_GET[$vuln]);
	isset($_POST[$vuln]) and $_POST[$vuln] = htmlentities($_POST[$vuln]);
	isset($$vuln) and $$vuln = htmlentities($$vuln);
}
// Filter Ends

if($_GET['RefId']=='') {
	
	echo "<script>window.location.href='vacationrentals.php';</script>";		
	exit;
} 

$property=mysql_fetch_array(mysql_query('SELECT * FROM rental_properties WHERE referenceid="'.$_GET['RefId'].'" and cid="'.$_GET['cid'].'"'));

$datestart=$_GET['startdate'];

$dateend=$_GET['enddate'];
	
	
	
	


// Map start //

$idget=$_GET['cid'];

	
if (mysql_num_rows(mysql_query("SELECT * FROM tbl_maps WHERE propertyno = '$idget' and delete_status='0' and type='RENTALS'"))>0) {

} else {


$lastupade=date('Y').'-'.date('m').'-'.date('d');
	
$resultn=mysql_fetch_array(mysql_query('SELECT * FROM rental_properties WHERE cid="'.$_GET['cid'].'"'));

	$addres=$resultn['propertyheadline'].', '. $resultn['zipcode']; 
	
	$addres_value=trim($addres);

	$PropertyIDmp=$resultn['cid'];

	// Get lat and long by address         
	$prepAddrn = str_replace('#','%23',$addres_value);
	
	 $prepAddr = str_replace(' ','+',$prepAddrn);
	
	//$url = "http://maps.google.com/maps/api/geocode/json?address=".$prepAddr."&sensor=false";
	
	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$prepAddr."&key=AIzaSyBkZH7dvoSlfFxFQf-NNmS1hJCR_OCU6rA";
	
	$ch = curl_init();

		// define options
		$optArray = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true );

		// apply those options
		curl_setopt_array($ch, $optArray);

		// execute request and get response
		$geocode = curl_exec($ch);
		//print_r($geocode);
		$output= json_decode($geocode);
		
		$latitude = $output->results[0]->geometry->location->lat;
		$longitude = $output->results[0]->geometry->location->lng;
	
		
	if($latitude!='') {

	mysql_query("insert into tbl_maps(propertyno,latitude,longitude,last_update,type,delete_status) values ('".$PropertyIDmp."','".$latitude."','".$longitude."','".$lastupade."','RENTALS','0')");
		 
	}
}
// Map End //



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $property['propertyheadline'];?></title>

<link href="styles.css" rel="stylesheet" type="text/css">

<?php 

$base_url="http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$pagenamein=str_replace("mobile","",$base_url);

?>
<link rel="canonical" href="<?php echo $pagenamein.'rentalproperty.php?'.$_SERVER['QUERY_STRING'];?>"/>

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>

<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');

  ga('send', 'pageview');

</script>


<?php 

$idget=$_GET['cid'];

if (mysql_num_rows(mysql_query("SELECT * FROM tbl_maps WHERE propertyno='$idget' and type='RENTALS'"))>0) {

$propertymap=mysql_fetch_array(mysql_query("SELECT * FROM  tbl_maps where propertyno='$idget' and type='RENTALS'"));	

$latitudedb=$propertymap['latitude'];

$longitudedb=$propertymap['longitude'];

?>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBkZH7dvoSlfFxFQf-NNmS1hJCR_OCU6rA"></script>

<script>
  // In the following example, markers appear when the user clicks on the map.
  // Each marker is labeled with a single alphabetical character.
  var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  var labelIndex = 0;

  function initialize() {
	var dist = { lat: <?php echo $latitudedb;?>, lng: <?php echo $longitudedb;?> };
	var map = new google.maps.Map(document.getElementById('myMap'), {
	  zoom: 16,
	  center: dist
	});

	// This event listener calls addMarker() when the map is clicked.
	google.maps.event.addListener(map, 'click', function(event) {
	 // addMarker(event.latLng, map);
	});

	// Add a marker at the center of the map.
	addMarker(dist, map);
  }
  // Adds a marker to the map.
  function addMarker(location, map) {
	// Add the marker at the clicked location, and add the next-available label
	// from the array of alphabetical characters.
	var marker = new google.maps.Marker({
	  position: location,
	  label: labels[labelIndex++ % labels.length],
	  map: map
	});
  }
 google.maps.event.addDomListener(window, 'load', initialize);
  
</script>	


<?php } else { ?>

<script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>

<script type='text/javascript'>

var map = null;
var searchManager = null;
function GetMap() {
	map = new Microsoft.Maps.Map('#myMap', {
	credentials: 'EPBxsvxsjL6uKNzPiPUW~ImSwhs_xYH096KU2Pu8zyw~AvhlW0ZCrmcbFY4_Pq7MAMxWRwXOrzEbgofN2CtTptbiKXCL5eUB_phwUue1aSID'
	});
	//Make a request to geocode.
	geocodeQuery("<?php echo $property['street'];?>, <?php echo $property['city']; ?> NJ");
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

<?php } ?>


<!-- calender function -->

<style>
#fondcolr
{ color:#FFF;font-size:18px;}
#monthfont
{color:#FFF;font-size:18px; line-height:17px; padding:}
#monthsnd
{color:#FFF;font-size:18px; line-height:17px;}
.evtname
{ margin-bottom:35px; margin-top:35px; text-align:center; }
</style>

<script language="JavaScript" type="text/javascript" src="../js/eventdate.js"></script>

<script type="text/JavaScript" language="JavaScript">

golden = new Array(
		
<?php	
		
	$stm=mysql_query('SELECT * FROM rental_properties_rates_rs1 WHERE PropertyID="'.$_GET['cid'].'"');	
	
	$totalcount = mysql_num_rows($stm);
		
		$i=1;		
		while($fetch_events = mysql_fetch_array($stm))
		{
			if($i<$totalcount) 
			{
	?>	
	["","<?php echo date('m',strtotime($fetch_events['CheckInDate']));?>","<?php echo date('d',strtotime($fetch_events['CheckInDate'])); ?>","<?php echo  date('Y',strtotime($fetch_events['CheckInDate']));?>","<?php echo date('m',strtotime($fetch_events['CheckOutDate']));?>","<?php echo date('d',strtotime($fetch_events['CheckOutDate']));?>","<?php echo  date('Y',strtotime($fetch_events['CheckOutDate']));?>","<?php echo $fetch_events['PropertyID'];?>","<?php echo $fetch_events['id'];?>"], 
	
	<?php } else { ?>
	
	["","<?php echo date('m',strtotime($fetch_events['CheckInDate'])); ?>","<?php echo date('d',strtotime($fetch_events['CheckInDate'])); ?>","<?php echo date('Y',strtotime($fetch_events['CheckInDate']));?>","<?php echo date('m',strtotime($fetch_events['CheckOutDate'])); ?>","<?php echo date('d',strtotime($fetch_events['CheckOutDate']));?>","<?php echo  date('Y',strtotime($fetch_events['CheckOutDate'])); ?>","<?php echo $fetch_events['PropertyID']; ?>","<?php echo $fetch_events['id'];?>"]		
	
	<?php 
	}  		
		$i++;
		}
	?>
	);
</script>

<!-- calender function end-->
</head>


<body onload="LoadMap();">

<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>

        <td width="232">
		<a href="../rentalproperty.php?Mobile=Off&<?php echo $_SERVER['QUERY_STRING'];?>">
		<img src="images/fullsite.png" width="232" height="248" border="0"/></a></td>

        <td width="201"><a href="https://www.google.com/maps/place/Cabrera+Coastal+Real+Estate/@38.977306,-74.833419,17z/data=!3m1!4b1!4m2!3m1!1s0x89bf562e830dd59d:0x48eca07ed1663b46?hl=en" target="_blank">
		<img src="images/directions.png" width="201" height="248" border="0"/></a></td>

        <td width="216"><a href="tel:6097290559">
		<img src="images/call.png" width="216" height="248" border="0"/></a></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td><a href="index.php">
	<img src="images/cabreracoastalrealestate.png" width="1080" height="316" border="0"/></a></td>

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

 <tr><td align="center">				


 <table width="980" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td align="center">

	<table width="970" border="0" cellpadding="0" cellspacing="0" class="medspacing">
      <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 

	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 	  
      <tr>
        <td align="center" bgcolor="#C2C1BE"><img src="images/t.gif" width="40" height="4" /></td>
      </tr>
	  	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 
	  
	  <tr>
        <td align="center" class="size40">
		
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="size45">
	
		<strong>BACK TO SEARCH RESULTS</strong>
		
		</a></td>
      </tr>
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 	  
      <tr>
        <td align="center" bgcolor="#C2C1BE"><img src="images/t.gif" width="40" height="4" /></td>
      </tr>
	  	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 
      <tr>
        <td align="center" class="size40">
		
		<strong><?php echo $property['propertyheadline'];?></strong>
		<!--<strong><?php //echo $property['street'].', '.$property['city']; ?> NJ </strong>-->
		
		</td>
      </tr>
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 
      <tr>
        <td align="center">
		
		<!-- Main Image -->

	<?php

	$propertyimg=mysql_fetch_array(mysql_query('SELECT * FROM rentals_pictures WHERE referenceid="'.$_GET['RefId'].'" and cid="'.$_GET['cid'].'"'));

	$url = $propertyimg['imageurl'];

	function isValidURL($url) {
	  $file_headers = @get_headers($url);
	  if (strpos($file_headers[0], "200 OK") > 0) {
		 return true;
	  } else {
		return false;
	  }
	}
		

	if (isValidURL($url)) {	

	$this_image = $propertyimg['imageurl'];

	list($width, $height, $attr) = getimagesize($this_image);
	$newWidth = 900;
	$percentChange = $newWidth / $width;
	$newHeight = round( ( $percentChange *$height ) );

	?>
	
	<img src="<?php echo $propertyimg['imageurl'];?>" width="<?php echo $newWidth; ?>" height="<?php echo $newHeight; ?>" border="0" />
		
	<?php } else { ?>

	<img src="../images/piccomingsoon.jpg" width="900" height="675" border="0" />
	
	<?php }	?>
		
	<!-- Main Image -->			
		
		
		</td>
      </tr>
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 
      <tr>
        <td align="center" class="size45">Stay:??<strong>
		
	<?php if($_GET['checkin']=="" || $_GET['checkin']=="") { echo "No dates selected"; } else { echo $_GET['checkin']; ?>
	
	</strong> - <strong><?php echo $_GET['checkout']; } ?>
		
		</strong></td>
      </tr>
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 	  
      <tr>
        <td align="center" class="size45">
		
		Bedrooms:??<strong><?php if($property['bedroom'] > 0){ echo $property['bedroom']; } else { echo '0'; } ?></strong> &nbsp; | &nbsp; 
		
		Baths:??<strong><?php if($property['bathroom'] > 0){ echo $property['bathroom']; } else { echo '0'; } ?></strong> &nbsp; | &nbsp; 
		
		Half Bath: <strong><?php echo $property['halfbath'];?></strong> &nbsp; &nbsp; 
		
		Sleeps:??<strong><?php if($property['sleepupto'] > 0){ echo $property['sleepupto']; } else { echo '0'; } ?></strong>
		
		</td>
      </tr>
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 	  
      <tr>
        <td align="center" class="size45">		
		Style: <strong><?php  echo $property['propertytype'];?>	</strong></td>
      </tr>
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 	  
      <tr>
        <td align="center" class="size45">
		
		Key: <strong><?php echo $property['cid'];?>
		
		</strong></td>
      </tr>

  	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr>    
	 <?php if(trim($property['propertydesc'])!=''){ ?>

	 <tr>
        <td align="center" class="size45">
		
		<strong><u>PROPERTY DESCRIPTION</u></strong>
		
		</td>
      </tr>
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 	  
	  <!-- Comments -->
	  
      <tr>
        <td align="left" class="size30 medspacing">
		
		<?php echo htmlentities($property['propertydesc'], ENT_COMPAT,'ISO-8859-1', true);?>
		
		</td>
      </tr>
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr> 	  
	  <!-- Comments -->
	  
	 <?php } ?>
	  
      <tr>
        <td align="center"><span class="size45">
		
		<strong><u>PROPERTY FEATURES</u></strong></span>
		
		</td>
      </tr>
	  
  	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr>    
	 
	 <tr><td colspan="3">	

		<!-- PROPERTY AMENITIES START -->		
		
	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#EEEEEE">

	<?php 

	$stmt3=mysql_query('SELECT * FROM rentals_properties_amenity WHERE referenceid="'.$_GET['RefId'].'" and cid="'.$_GET['cid'].'" group by amenity_label order by amenity_label asc');

	$k=0;$i=0;		
	while($amenitis = mysql_fetch_array($stmt3))
	{	
	
		if($amenitis['amenity_label']!=''){

		$k=$k+1;
		$i=$i+1;
		if ($k==4)			
		echo '<tr>';

		if($i%2==0) {
			$bgcolor="#F8F5ED";
		} else {
			$bgcolor="#E8E7E6";
		}
	?>	
	
	<td align="center" bgcolor="<?php echo $bgcolor;?>">
	
	<table width="300" border="0" cellspacing="8" cellpadding="5">
		  
	<tr>
		<td bgcolor="<?php echo $bgcolor;?>" class="size30">
		<?php echo $amenitis['amenity_label'];?></td>

		<td align="right" bgcolor="<?php echo $bgcolor;?>" class="size30">
		<?php echo $amenitis['amenity_value'];?></td>
	</tr>
	 
	</table></td>	
			
	<?php if($k==3) { ?>	

	<tr><td width="1" colspan="3"></td></tr>	
		
	<?php 
	
	$k=0; 
	} 
		}	
	} 
	?>	
    </table>
	
		<!-- PROPERTY AMENITIES END -->			
		
		</td></tr>		
	   <tr>

		<td align="center"><img src="images/t.gif" width="25" height="25" /></td>

	  </tr>
	 <tr>

		<td align="center"><span class="size24">AVAILABILITY</span></td>

	  </tr>

	  <tr>

		<td align="center"><img src="images/t.gif" width="25" height="8" /></td>

	  </tr>
	  
	  <tr><td colspan="3" align="left"><div id="calendar"></div></td></tr>	 
	  
	  <tr>

		<td align="center"><img src="images/t.gif" width="25" height="25" /></td>

	  </tr>
	  
	  <tr>
		<td align="center">
						
	<h2><u> RATES INFORMATION</u></h2>
				
	<table width="100%" style="border:1px solid #C0C0C0" border="1" cellspacing="0" cellpadding="13">
		
		<tr><td><div align="center"><b>Rate Type</b></div></td>
		
		<td><div align="center"><b>Rate</b></div></td>
		
		<td><div align="center">
		
		<b>Valid Rate Periods <br/> Check-In to Check-Out </b></div></td></tr>
	
		<?php
		
		$stmt4=mysql_query('SELECT * FROM rental_properties_rates_info WHERE referenceid ="'.$_GET['RefId'].'" order by id');

		$i=0;		
		while($rates_row = mysql_fetch_array($stmt4)) {	

		$CheckInDate = date('M d, Y', strtotime($rates_row['CheckInDate']));

		$CheckOutDate = date('M d, Y', strtotime($rates_row['CheckOutDate']));

		?><tr><td><div align="center" class="size30">
		
		<?php echo $rates_row['Description'];?></div></td>
		  
		<td align="center" class="size30"><?php echo '$'.$rates_row['Rate']; ?></td>
		  
		<td><div align="center" class="size30">
		
		<?php echo $CheckInDate; ?>&nbsp; To&nbsp; <?php echo $CheckOutDate; ?>
		
		</div></td></tr>

	<?php } ?>
			  
			</table>
		
		</td>
	  </tr>	
	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="40" /></td>
      </tr>    
      <tr>
        <td align="center">
		
	<!-- MAP / AERIAL VIEW -->		
	
		<div id='myMap' style="position:relative; width:940px; height:650px;"></div>

						
	<!-- MAP / AERIAL VIEW -->			
		
		</td>
      </tr>
  	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="30" /></td>
      </tr>  	  
	  <tr><td align="right">

	<i><font color="grey" style="font-size: 29px;">
	
	Last DB Update: <?php 
	
		$stmtstn=mysql_fetch_array(mysql_query("SELECT lastupdate FROM tbl_availability"));

		echo $stmtstn['lastupdate'];
	
	?></font></i> 
	
	</td></tr> 
	
  	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr>  
	  
      <tr>
        <td align="center"><span class="size45">
		<strong><u>ADDITIONAL PROPERTY PICTURES</u></strong>
		
		</span></td>
      </tr>
	  
	  
	  <!-- Add Images Start-->
	  
	<?php
	
	$stmt2=mysql_query('SELECT * FROM rentals_pictures WHERE referenceid="'.$_GET['RefId'].'" and cid="'.$_GET['cid'].'" order by id asc');

	$p=0; $k=0;		
	while($addnimgs = mysql_fetch_array($stmt2))
	{	
		
		if(($p!=0)) {
		
		$url = $addnimgs['imageurl'];

		if (isValidURL($url)) {	
						
		$this_image = $url;

		list($width, $height, $attr) = getimagesize($this_image);
		$newWidth = 940;
		$percentChange = $newWidth / $width;
		$newHeight = round( ( $percentChange *$height ) );
	 
	 ?>
	 
    <tr>
        <td align="center"><img src='<?php echo $url;?>' width="<?php echo $newWidth;?>" height="<?php echo $newHeight;?>" /></td>
      </tr>
	<tr>
		<td><img src="images/t.gif" width="1" height="6" /></td>
	</tr>
 
	<?php 
		}	
	
	$k=0; 
	} 
	
	$p=$p+1;
	} 
		
	?>
  	  <tr>
        <td colspan="2"><img src="images/t.gif" width="40" height="20" /></td>
      </tr>  
	  
	<tr>
        <td align="left" class="size26 medspacing gray"><em>The information contained in this website does not serve as a substitute for an on-site visit to the vacation rental unit and should not be relied upon solely in the decision to rent the vacation unit. Cabrera Coastal Team Properties makes no warranty of the accuracy of the information on this site or any site to which we link.</em></td>
      </tr>
    </table>
		
		</td>
	</tr>
	<tr>
	<td colspan="3"><img src="images/t.gif" width="50" height="10" /></td>
	</tr>
    </table>


</td></tr>
		
		<tr>
		  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>
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

<script>
$(window).load(function() {
	
	changedate('return');
	
});	
</script>
<?php require_once('googletagmanager.php'); ?>
</html>
