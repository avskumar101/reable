<?php 

ob_start();


session_start();

require_once('config.php');	

//Sitelock XSS vulnerability filter begins
foreach (array('RefId','checkin','checkout','cid','mobile') as $vuln) //add the parameter in the place of 's'
{
	isset($_REQUEST[$vuln]) and $_REQUEST[$vuln] = htmlentities($_REQUEST[$vuln]);
	isset($_GET[$vuln]) and $_GET[$vuln] = htmlentities($_GET[$vuln]);
	isset($_POST[$vuln]) and $_POST[$vuln] = htmlentities($_POST[$vuln]);
	isset($$vuln) and $$vuln = htmlentities($$vuln);
}
// Filter Ends

if($_GET['Mobile']=='') {

	$url =$_SERVER['HTTP_REFERER'];

	$query = parse_url($url, PHP_URL_QUERY);

	parse_str($query);

	parse_str($query, $arr);

	$request = $_SERVER['HTTP_REFERER'];

	$urlname=explode('?',$request);

	$urlname= $urlname[1];

	if($urlname=='Mobile=Off' || $Mobile=='Off') {

	 echo "<script>window.location='rentalproperty.php?Mobile=Off&".$_SERVER['QUERY_STRING']."';</script>";

	 exit;

	}
}


if($_GET['Mobile']=='') { 

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

	echo "<script>window.location='mobile/rentalproperty.php?".$_SERVER['QUERY_STRING']."';</script>"; 

 }



if($_GET['RefId']=='') {
	
	echo "<script>window.location.href='vacationrentals.php';</script>";		
	exit;
	
} else {

	$property=mysql_fetch_array(mysql_query('SELECT * FROM rental_properties WHERE referenceid ="'.$_GET['RefId'].'" and cid="'.$_GET['cid'].'"'));
}


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

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<meta http-equiv="keywords" content="" />

<meta http-equiv="description" content="<?php echo htmlentities($property['propertydesc'], ENT_COMPAT,'ISO-8859-1', true);?>
" />

<meta name="robots" content="index, follow" />

<title><?php echo $property['street'].', '.$property['city']; ?> - NJ </title>

<?php

$actuallink=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$pagenamein=str_replace("rentalproperty.php","mobile/rentalproperty.php",$actuallink);

$pagenamn=str_replace("Mobile=Off","",$pagenamein);

?>
<link rel="alternate" href="<?php echo $pagenamn;?>"/>


<link href="styles.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="css/lightbox.css" media="screen"/>

<script src="js/jquery-1.9.1.js" type="text/javascript"></script>

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

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

<script language="JavaScript" type="text/javascript" src="js/eventdate.js"></script>

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
 
<script>

function newfun(membership) {

if($('#lesscontent').is(":hidden")) {

	document.getElementById('lesscontent').style.display="block";

	document.getElementById('morecontent').style.display="none";

} else {

   document.getElementById('morecontent').style.display="block";

   document.getElementById('lesscontent').style.display="none";

  }

} 
</script>
 
</head>

<body onload="LoadMap();">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr><td><?php include("header.php")?></td></tr>

  <tr>

    <td>


	<form name="frmLead" id="frmLead" method="post" action="#" enctype='multipart/form-data'>

	<?php $mobile1=$_GET['Mobile']; ?>

	<input id="mobile" name="mobile" type="hidden" value="<?php echo $mobile1 ?>"/>


	<table width="1170" border="0" align="center" cellpadding="0" cellspacing="0" class="lrgspacing">

	<tr>

	<td><img src="images/t.gif" width="25" height="35" /></td>

	</tr>

      <tr>

	<td align="center"><table width="1000px" border="0" cellspacing="0" cellpadding="0">

	<tr>

	<td align="center">
	
	<table width="1040px" border="0" cellspacing="0" cellpadding="0">

  <tr>

	<td width="488" align="left" valign="top">
	
	<table width="488" border="0" cellspacing="0" cellpadding="0">

	  <tr>

		<td width="9"><img src="images/topleft.png" width="7" height="7" /></td>

		<td background="images/top.png"><img src="images/t.gif" width="7" height="7" /></td>

		<td width="10"><img src="images/topright.png" width="7" height="7" /></td>

	  </tr>

	  <tr>

		<td width="7" background="images/left.png"><img src="images/t.gif" width="7" height="7" /></td>

		<td width="474">
							
					
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
	$newWidth = 474;
	$percentChange = $newWidth / $width;
	$newHeight = round( ( $percentChange *$height ) );

	?><a href="<?php echo $propertyimg['imageurl'];?>" data-lightbox="example-1">

	<img src="<?php echo $propertyimg['imageurl'];?>"  width="<?php echo $newWidth; ?>" height="<?php echo $newHeight; ?>"  border="0" />

	</a>	
	
	<?php } else { ?>
	
	<a href="javascript:void(0);" data-lightbox="example-1">

	<img src="images/piccomingsoon.jpg"  width="474" height="340" border="0" />

	</a>	

	<?php } ?>	

	<!-- Main Image -->	
	
					
		</td><td width="7" background="images/right.png">

		<img src="images/t.gif" width="7" height="7" /></td>

		</tr>

		  <tr>

			<td><img src="images/bottomleft.png" width="7" height="7" /></td>

			<td  background="images/bottom.png"><img src="images/t.gif" width="7" height="7" /></td>

			<td><img src="images/bottomright.png" width="7" height="7" /></td>

		  </tr>

		</table></td>

	<td width="17"><img src="images/t.gif" width="17" height="25" /></td>

	<td width="540px" align="left" valign="top">

	<div class="size20" style="width:540px;"><?php echo $property['propertyheadline'];?></div>

	<blockquote><p><?php if($_GET['checkin']!='') { ?>

	Range: <strong><?php echo  str_replace('-','/',$_GET['checkin']);?> - <?php echo  str_replace('-','/',$_GET['checkout']);?></strong> &nbsp; &nbsp; 
	
	<?php if($_GET['Price']!='') { ?>
	
	<?php if($_GET['Price'] > 0){ echo '<strong> Price: $'.number_format($_GET['Price']); 
	
	} else { echo 'N/A';} ?>
	
	</strong><br />	<?php } } ?>

	Bedrooms: <strong><?php if($property['bedroom'] > 0){ echo $property['bedroom']; 
	
	} else { echo '0'; } ?></strong> &nbsp; &nbsp; 
	
	Bathrooms: <strong><?php echo $property['bathroom'];?></strong> &nbsp; &nbsp; 
	
	Half Bath: <strong><?php echo $property['halfbath'];?></strong> &nbsp; &nbsp; 
	
	Sleeps: <strong><?php echo $property['sleepupto'];?></strong><br />

	Style: <strong><?php echo $property['propertytype'];?></strong> &nbsp; &nbsp; 
	
	Key: <strong><?php echo $property['cid'];?></strong></p>
	
	</blockquote><p class="size15 medspacing">
				  
	<div id="lesscontent" class="medspacing size14 grcfnd">

	<?php 
	
	if(trim($property['propertydesc'])!=''){
		
		$disc=$property['propertydesc'];
	}
	
	
	echo substr(strip_tags($disc),0,374);

	if($disc!=''){

	if(strlen(strip_tags($disc))>374) { 

	echo '.. <a style="color:'.$lnkclr.'" href="javascript:void(0)" onclick="newfun(1);">Read More &gt;</a>'; 

	} } 
	
	?></div><div style="display:none;" id="morecontent" class="medspacing size14 grcfnd">

	<?php echo $property['propertydesc']; ?> <a style="color: <?php echo $lnkclr; ?>;" href="javascript:void(0)" onclick="newfun(1);" ><<</a></div></p>

	<p><a href="requestrental.php?<?php echo $_SERVER['QUERY_STRING'];?>">	

	<img name="" src="images/requestinformation.jpg" width="225" height="40" border="0" />
	
	</a>
	
	<?php $virtualtoururl = $propertyimg['virtualtoururl'];

	if($virtualtoururl!='') { ?>
	
	&nbsp; &nbsp;<a href="<?php echo $virtualtoururl;?>" target="_blank"><img name="" src="images/virtualtour.jpg" width="175" height="40" border="0" /></a><?php } ?>
	
	</p></td></tr></table></td></tr>
    
	<tr><td><img src="images/t.gif" width="25" height="10" /></td></tr>

	<tr><td colspan="3" align="center">					

		<!-- Add Images Start-->
			
	<table width="1050" align="center" border="0" cellspacing="0" cellpadding="0"> 

	<?php 

	$stmt2=mysql_query('SELECT * FROM rentals_pictures WHERE referenceid="'.$_GET['RefId'].'" and cid="'.$_GET['cid'].'" order by id asc');

	$p=0; $k=0;		
	while($addnimgs = mysql_fetch_array($stmt2))
	{	
		
		if(($p!=0)) {

		$url = $addnimgs['imageurl'];

		if (isValidURL($url)) {	

		$k=$k+1;

		if($k==6)
		echo '<tr >';	

		?>	
	<td style="width:304px;height:170px" >

	<table width="180" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="9"><img src="images/topleft.png" width="7" height="7" /></td>
		<td background="images/top.png"><img src="images/t.gif" width="7" height="7" /></td>
		<td width="10"><img src="images/topright.png" width="7" height="7" /></td>
	  </tr>
	  <tr>
		<td width="7" background="images/left.png"><img src="images/t.gif" width="7" height="7" /></td>
		<td width="166"><a class="example-image-link" href="<?php echo $url;?>" data-lightbox="example-1"><img src="<?php echo $url;?>" width="166" height="125" border="0"/></a></td>
		<td width="7" background="images/right.png"><img src="images/t.gif" width="7" height="7" /></td>
	  </tr>
	  <tr>
		<td><img src="images/bottomleft.png" width="7" height="7" /></td>
		<td  background="images/bottom.png"><img src="images/t.gif" width="7" height="7" /></td>
		<td><img src="images/bottomright.png" width="7" height="7" /></td>
	  </tr>
	</table>

		<?php if($k==5) { ?>

		<tr><td width="28" colspan="9">
		<img src="images/t.gif" width="28" height="5" />
		</td></tr>	

		<?php 

		$k=0; 
		} 

		}	
		}

		$p=$p+1;
		} 

		?>
		</td></tr></table>	

		<!-- Add Images End-->

		</td></tr>
		
       	<!-- Comments -->			
					  
	<tr>
		<td colspan="3"><img src="images/t.gif" width="20" height="10" /></td>
	</tr>
	<tr>
		<td colspan="3" align="center" class="size22"><u>PROPERTY AMENITIES</u></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/t.gif" width="25" height="10" /></td>
	</tr>
	
	<tr><td colspan="3" align="center">	

		<!-- PROPERTY AMENITIES START -->		
		
	<table width="1050" align="center" border="0" cellpadding="1" cellspacing="1" bgcolor="#EEEEEE">

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
		<td bgcolor="<?php echo $bgcolor;?>">
		<?php echo $amenitis['amenity_label'];?></td>

		<td align="right" bgcolor="<?php echo $bgcolor;?>">
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
		  </table>	
		  
		  		  
		  <table align="center" width="1050" border="0" cellspacing="0" cellpadding="3">

          <tr>

            <td align="center"><img src="images/t.gif" width="25" height="25" /></td>

          </tr>

		 <tr>

            <td align="center"><span class="size24">AVAILABILITY</span></td>

          </tr>

          <tr>

            <td align="center"><img src="images/t.gif" width="25" height="8" /></td>

          </tr>

          <tr>

            <td colspan="3" align="left"><div id="calendar"> </div></td>

          </tr>

          <tr>

            <td><img src="images/t.gif" width="25" height="25" /></td>

          </tr>

          <tr>

            <td align="center"><span class="size24">RATE INFORMATION</span></td>

          </tr>

          <tr>

            <td align="center"><img src="images/t.gif" width="25" height="8" /></td>

          </tr>

          <tr>

            <td align="center">
			
		<table width="1050" style="border:1px solid #C0C0C0" border="1" cellspacing="0" cellpadding="3">
		
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

		?><tr><td><div align="center">
		
		<?php echo $rates_row['Description'];?></div></td>
		  
		<td align="center"><?php echo '$'.$rates_row['Rate']; ?></td>
		  
		<td><div align="center">
		
		<?php echo $CheckInDate; ?>&nbsp; To&nbsp; <?php echo $CheckOutDate; ?>
		
		</div></td></tr>

	<?php } ?>
			  
			</table>
			
			</td>

          </tr>

          <tr>

            <td><img src="images/t.gif" width="25" height="25" /></td>

          </tr>

          <tr>

            <td align="center"><span class="size24">MAP / AERIAL VIEW</span></td>

          </tr>

          <tr>

            <td align="center"><img src="images/t.gif" width="25" height="8" /></td>

          </tr>

          <tr>

            <td>
			
			<!-- MAP / AERIAL VIEW -->	

			<div id='myMap' style="position:relative; width:1050px; height:564px;"></div>

			<!-- MAP / AERIAL VIEW -->	
			
			</td>

          </tr>

          <tr>

            <td><img src="images/t.gif" width="25" height="7" /></td>

          </tr>

          <tr>

            <td align="right" class="size13 gray spacing">
									
			<em>Last Database Update: <?php 
			
				$stmtstn=mysql_fetch_array(mysql_query("SELECT lastupdate FROM tbl_availability"));

				echo $stmtstn['lastupdate'];
			
			?></em> &nbsp;
			
			</td>

          </tr>

          <tr>

            <td><img src="images/t.gif" width="25" height="4" /></td>

          </tr>

          <tr>

            <td bgcolor="#DFDFDF"><img src="images/t.gif" width="25" height="1" /></td>

          </tr>

          <tr>

            <td><img src="images/t.gif" width="25" height="4" /></td>

          </tr>

          <tr>

            <td class="size13 gray spacing"><em>The information contained in this website does not serve as a substitute for an on-site visit to the vacation rental unit and should not be relied upon solely in the decision to rent the vacation unit. Cabrera Coastal Team Properties makes no warranty of the accuracy of the information on this site or any site to which we link.</em></td>

          </tr>

        </table></td>

      </tr>

    </table>	
	
	</td>

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

</body>
<script src="js/jquery-1.10.2.min.js"></script>

<script src="js/lightbox-2.6.min.js"></script>	  

<script>
$(window).load(function() {
	
	changedate('return');
	
});	
</script>
</html>

