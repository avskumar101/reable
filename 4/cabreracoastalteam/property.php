<?php

session_start();

require_once('config.php');		

$ID=$_GET['MLSNo'];	


$resultarray=mysql_fetch_array(mysql_query("SELECT * FROM  tbl_listings where MLSNo='$ID'"));	

		// Map start //
		
if (mysql_num_rows(mysql_query("SELECT * FROM tbl_maps WHERE propertyno = '$ID' and delete_status='0' and type='SALES'"))>0) {

} else {
	
	
	$lastupade=date('Y').'-'.date('m').'-'.date('d');

	if($_GET['Sold'] == "Property") {

		$resultslat=mysql_query("SELECT * FROM tbl_sold WHERE MLSNo = '$ID'");

	} else {
		
		$resultslat=mysql_query("SELECT * FROM tbl_listings WHERE MLSNo = '$ID'");
	}
	

	$i=1;
	while($resultn = mysql_fetch_array($resultslat)) {
	
		$addres=$resultn['Address'].', '. $resultn['City'].' '.$resultn['State'].' '.$resultn['Zip']; 
		
		$addres_value=trim($addres);

		$PropertyIDmp=$resultn['MLSNo'];

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

		mysql_query("insert into tbl_maps(propertyno,latitude,longitude,last_update,type,delete_status) values ('".$PropertyIDmp."','".$latitude."','".$longitude."','".$lastupade."','SALES','0')");
			 
		}	

		
	  $i=$i+1;
	 } 
	 
 }
	// Map End //

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<meta http-equiv="keywords" content="Cabrera Coastal Team, Wildwood Crest, Wildwood, North Wildwood, West Wildwood, Cape May, Diamond Beach, Lower Township, Middle Township," />

<meta http-equiv="description" content="<?php echo substr(strip_tags($resultarray['Remarks']),0,1500);?>" />

<meta name="robots" content="index, follow" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<meta property="og:image" content="<?php echo $resultarray['mainimg']; ?>"/>



<meta property="og:image:width" content="200" />



<meta property="og:image:height" content="200" />



<title><?php echo $resultarray['Address'].', '. $resultarray['City'].' '.$resultarray['State'];?></title>



<?php



$actuallink=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



$pagenamein=str_replace("property.php","mobile/property.php",$actuallink);



?>

<link rel="alternate" href="<?php echo $pagenamein;?>"/>



<link href="styles.css" rel="stylesheet" type="text/css">



<link rel="SHORTCUT ICON" href="images/cabrera.ico">



<script type="text/javascript" src="scripts/jquery2.2.2.js"></script>



<link rel="stylesheet" href="css/lightbox.css" media="screen"/>



<link type="text/css" rel="stylesheet" href="css/rhinoslider-1.05.css" />



<script type="text/javascript">

	$(function(){

		$('#slider').rhinoslider({autoPlay:'true',showCaptions:'never',controlsPlayPause:'never'});

	});

</script>

<style type="text/css">

	#slider {

		width:100%;

		height:450px;

		/*IE bugfix*/

		padding:0;

		margin:0;
	}

	#slider li { list-style:none; }

	#pageslide {

		width:460px;
	}

</style>

<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');

  ga('send', 'pageview');
  
</script>


<?php 

if (mysql_num_rows(mysql_query("SELECT * FROM tbl_maps WHERE propertyno='$ID' and type='SALES'"))>0) {

$propertymap=mysql_fetch_array(mysql_query("SELECT * FROM  tbl_maps where propertyno='$ID' and type='SALES'"));	

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

<?php } ?>



<script>


jQuery(window).load(function () {	



    setTimeout(function () {	



	document.getElementById('imageslider').style.display = "block";	

	document.getElementById('imagenone').style.display = "none";	

	}, 10);	

});



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

            <td colspan="3" align="left">

			

<h1><?php echo $resultarray['Address'].', '. $resultarray['City'].' '.$resultarray['State'];?></h1>



			</td>

          </tr>

			

			

          <tr>

            <td colspan="3" align="left"><img src="images/t.gif" width="10" height="5" /></td>

            </tr>

          <tr>

            <td width="875" align="left" valign="top"><table width="875" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td width="612" valign="top"><table width="612" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td valign="top">												



					<table width="612" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#1E8BCC">

					

					

                      <tr>

					  

                        <td bgcolor="#FFFFFF">	<div id="imagenone" align="center">		



						<img src="images/t.gif" height="20px" width="10px" />	</div>																

		<div style="border:0px solid red;display:none;" id="imageslider">



		<ul id="slider">

			

			<?php

			

			for($kk =1; $kk<=26;$kk++){			 

				

				if($kk==1){

					

					$imageval = $resultarray['mainimg'];

				  

				  if($imageval == ""){

						continue;

					}						



				list($width, $height, $attr) = getimagesize($resultarray['mainimg']);

				

				$newWidth = 460;$percentChange = $newWidth / $width;$newHeight = round( ( $percentChange *$height ) );	



				?>

<img src="<?php echo $imageval; ?>" width="<?php echo $newWidth; ?>" height="<?php echo $newHeight; ?>" />



	  <?php }else{

		  

			$setval = $kk-1;

			

			$imageval = $resultarray['addimg'.$setval];

			

			if($imageval == ""){

				continue;

			}					



			list($width, $height, $attr) = getimagesize($resultarray['mainimg']);$newWidth = 460;

			

			$percentChange = $newWidth / $width;$newHeight = round( ( $percentChange *$height ) );																

			?>

								

<img src="<?php echo $imageval; ?>"  width="<?php echo $newWidth; ?>" height="<?php echo $newHeight; ?>" />

		<?php

				}

			 }

			 ?>

						</ul>

	    				</div>

                        

                        </td>

                      </tr>

                    </table></td>

                  </tr>

				  

                  <tr>

                    <td><img src="images/t.gif" width="13" height="13" /></td>

                  </tr>



                  <tr>

                    <td valign="middle">

					

					<table width="612" border="0" cellspacing="0" cellpadding="0">

                    

                      <tr>

                      <?php

                      

                      for($kk =1; $kk<=26;$kk++){

                      	

                      	if($kk==1){

                      		$imageval = $resultarray['mainimg'];

	                      	if($imageval == ""){

	                      		continue;

	                      	}

	                      	$cc = $cc+1;

                      	?>

                        <td width="112">

						

						<table width="112" border="0" cellpadding="5" cellspacing="1" bgcolor="#1E8BCC">

                          <tr>

                          	<td bgcolor="#FFFFFF"><a href="<?php echo $imageval;?>" data-lightbox="example-1"><img src="<?php echo $imageval;?>" width="100" height="75" /></a></td>

                          </tr>

                        </table>

						

						</td>

                        

						<?php                      	

                      		//$kk=1;

                      	}else{

                      		$setval = $kk-1;

                      		$imageval = $resultarray['addimg'.$setval];

                      	if($imageval == ""){

                      		continue;

                      	}

                      	$cc = $cc+1;

                      	?>

                        <td width="112">

						

						<table width="112" border="0" cellpadding="5" cellspacing="1" bgcolor="#1E8BCC">

                          <tr>

                          	<td bgcolor="#FFFFFF"><a href="<?php echo $imageval;?>" data-lightbox="example-1"><img src="<?php echo $imageval;?>" width="100" height="75" /></a></td>

                          </tr>

                        </table>

						

						</td>

                      	<?php

                      	}

                      	

                      	

                      ?>



                      <?php

	                      if($kk%5==0){

	                      ?>

		                     </tr>

		                      <tr>

		                        <td colspan="9"><img src="images/t.gif" width="13" height="13" /></td>

		                      </tr>

		                      <tr>

	                      	

	                      <?php

	                      $cc =0;

	                      }else{

	                      ?>

	                      	<td width="13"><img src="images/t.gif" width="13" height="13" /></td>

	                      <?php

	                      }

	                      

                      }

                      

							if ($cc!=0){

								for($imgt=$cc;$imgt<5;$imgt++)

							 	{

							 ?>

							 <td width="112">

							 

		<table width="112" border="0" cellpadding="5" cellspacing="1">

			<tr>

				<td bgcolor="#FFFFFF" width="100" height="75" />&nbsp;</td>

			</tr>

		</table>

						

						</td>

                        <?php

                        if($imgt != 4){

                        ?>

                        	<td width="13"><img src="images/t.gif" width="13" height="13" /></td>

                        <?php

                        }

                        

							 }

							 }                      

                      

                      ?>

                     </tr>

                      <tr>

                        <td colspan="9"><img src="images/t.gif" width="13" height="13" /></td>

                      </tr>









                    </table></td>

                  </tr>

                </table></td>

                <td width="13"><img src="images/t.gif" width="13" height="13" /></td>

                <td width="250" valign="top">

				

				<table width="250" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><!-- AddThis Button BEGIN -->

<div class="addthis_toolbox addthis_default_style addthis_32x32_style">

<a class="addthis_button_preferred_1"></a>

<a class="addthis_button_preferred_2"></a>

<a class="addthis_button_preferred_3"></a>

<a class="addthis_button_preferred_4"></a>

<a class="addthis_button_compact"></a>

<a class="addthis_counter addthis_bubble_style"></a>

</div>

<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-537419095d8b1353"></script>

<!-- AddThis Button END --></td>

                  </tr>

                  <tr>

                    <td><img src="images/t.gif" width="13" height="13" /></td>

                  </tr>

                  <tr>

                    <td><table width="250" border="0" cellspacing="2" cellpadding="6" bgcolor="#195CAB">

                      <tr>

                        <td bgcolor="#195CAB" class="white"><strong><u class="size16">Call Or Email Us Today</u><br />

                        </strong></td>

                      </tr>

                      <tr>

                        <td bgcolor="#1E8BCC" class="medspacing white"><strong class="size16">609-729-0559</strong><br />
<a href="mailto:sales@cabreracompanies.com" class="size16 whitelink">sales@cabreracompanies.com</a></td>

                      </tr>

                    </table></td>

                  </tr>
				 

                  <tr>

                    <td><img src="images/t.gif" width="13" height="13" /></td>

                  </tr>

                  <tr>

                    <td><a href="request.php?MLSNo=<?php echo $resultarray['MLSNo'];?>"><img src="images/requestinformation.png" alt="Request Information" width="250" height="78" /></a></td>

                  </tr>

                  <tr>

                    <td><img src="images/t.gif" width="13" height="13" /></td>

                  </tr>

                  <tr>

                    <td><a href="friend.php?MLSNo=<?php echo $resultarray['MLSNo'];?>"><img src="images/sendtofriend.png" alt="Send Property Information To A Friend" width="250" height="78" /></a></td>

                  </tr>

                  <tr>

                    <td><img src="images/t.gif" width="13" height="13" /></td>

                  </tr>

				   <?php if($resultarray['cust_url']!="") { ?>

					<tr>

                    <td>
					<a href="<?php echo $resultarray['cust_url'];?>" target="_blank" >	<img src="images/virtual_tour.png" alt="virtualtour" width="250" height="auto" />			
				   </span>   
				   </a>   
                  </tr>
				  				  <tr>

                    <td><img src="images/t.gif" width="13" height="13" /></td>

                  </tr>
				  			   <?php } 
							   else if($resultarray['tour_url']!=""){ ?>
							   
							   <tr>

                    <td>
					<a href="<?php echo $resultarray['tour_url'];?>" target="_blank" >	<img src="images/virtual_tour.png" alt="virtualtour" width="250" height="auto" />			
				   </span>   
				   </a>   
                  </tr>
				  				  <tr>

                    <td><img src="images/t.gif" width="13" height="13" /></td>

                  </tr>


							   <?php } ?>
                  <tr>

                    <td class="medspacing"><strong><u>GENERAL INFORMATION</u></strong><br />

                        Status: <strong class="green"><?php echo $resultarray['Status']?></strong><br />

                        Price: <strong class="size18">$<?php echo number_format($resultarray['Asking_Price']);?></strong><br />

                        Address: <strong><?php echo $resultarray['Address']?></strong><br />

                        City: <strong><? echo $resultarray['City'].' '.$resultarray['State'];?></strong><br />

                        MLS: <strong><?php echo $resultarray['MLSNo'] ?></strong><br />

                        Bedrooms: <strong><?php echo $resultarray['Bedrooms'] ?></strong><br />

                        Bathrooms: <strong><?php echo $resultarray['Full_Baths'] ?></strong><br />

                        Property Type: <strong><?php echo $resultarray['Type'];?></strong><br />

                        Sq Ft: <strong><?php echo $resultarray['Total_Sq_Feet']?> 	</strong><br />

                        Dimensions: <strong><?php echo $resultarray['Lot_Size2'];?></strong><br />

                        Total Rooms: <strong><?php echo $resultarray['Total_Rooms'];?>	</strong><br />

                        Stories: <strong><?php echo $resultarray['Stories'];?></strong><br />

                        Days On Market: <strong><?php echo $resultarray['Days_On_Market'];?></strong><br />

                        New Construction: <strong><?php echo $resultarray['New_Construction'];?></strong><br />

                        Foreclosure: <strong>No</strong><br />

                        Taxes: <strong>$<?php echo $resultarray['Taxes'];?></strong><br />

                        Parking: <strong><?php echo $resultarray['PARKING_GARAGE'];?></strong><br />

                        Heating: <strong><?php echo $resultarray['HEATING'];?></strong><br />

                        Basement: <strong><?php echo $resultarray['BASEMENT'];?>  	</strong><br />

                        Sewer: <strong><?php echo $resultarray['SEWER'];?> </strong><br />

                        Water: <strong>Gas-Natural </strong><br />

						

			<?php 		



			$listresagents=mysql_num_rows(mysql_query("select * from tbl_listingsagent where agent_firstname='".$resultarray['agent_firstname']."' and agent_lastname='".$resultarray['agent_lastname']."' and delete_status!=1"));



			if($listresagents>0){ ?>



			Listing Agent: <strong> <?php echo $resultarray['agent_firstname'].' '.$resultarray['agent_lastname'];?> </strong>



			<?php } ?>

			

						</td>

                  </tr>

                </table></td>

              </tr>

              <tr>

                <td colspan="3"><img src="images/t.gif" width="13" height="20" /></td>

                </tr>

              <tr>

                <td colspan="3" bgcolor="#CCCCCC"><img src="images/t.gif" width="13" height="1" /></td>

              </tr>

              <tr>

                <td colspan="3"><img src="images/t.gif" width="13" height="20" /></td>

              </tr>

              <tr>

                <td colspan="3" class="spacing"><?php echo substr(strip_tags($resultarray['Remarks']),0,1500);?>.</td>

                </tr>

              <tr>

                <td colspan="3"><img src="images/t.gif" width="13" height="20" /></td>

              </tr>

              <tr>

                <td colspan="3" class="size16"><strong><u>ADDITIONAL PROPERTY FEATURES</u></strong></td>

              </tr>

              <tr>

                <td colspan="3"><img src="images/t.gif" width="13" height="13" /></td>

              </tr>



              <tr>

                <td colspan="3"><table width="875" border="0" cellspacing="0" cellpadding="0">

                  <tr>

				  <td width="340" align="left" valign="top" class="spacing"><?php

				  $Foreclosure = "";

				  if($Foreclosure!="")

				  {

				  echo $Foreclosure;

				  ?><strong>Bank Owned/Foreclosure</strong>: <? echo $Foreclosure;?><br />

				  <?php

				  }

				  ?>

                     <?php

				  $Age = "";

				  if($Age!="")

				  {

				  echo $Age;

				  ?>

                    <strong>Age</strong>: <? echo $Age;?><br />

					<?php

					}

					?>

                    <?php

					if($resultarray['COOLING']!="")

					{

					$feature3 = $resultarray['COOLING'];

					

					?>

                    <strong>Cooling</strong>:<?php echo $feature3;?> <br />

					<?php

					}

					?>

                    <?php

					if($resultarray['ALSO_INCLUDED']!="")

					{

					$feature4 = $resultarray['ALSO_INCLUDED'];

					

					?>

					

                    <strong>Sale Includes</strong>: <?php echo $feature4;?> 	<br />

					<?php

					}

					?>

                    <?php

					if($resultarray['APPLIANCES_INCLUDED']!="")

					{

					$feature5 = $resultarray['APPLIANCES_INCLUDED'];

					

					?>

                    <strong>Appliances </strong>: <?php echo $feature5;?><br />

					<?php

					}

					?>

                    <?php

					$Fireplace = "";

				  if($Fireplace!="")

				  {

				    $dump = $Fireplace;

				  ?>

                    <strong>Fireplace </strong>: <?php echo $dump; ?><br /><?php }

					?>

					<?php

					if($Flooring!="")

				  {

				  $dump1 = $Fireplace;

				  ?>

                    <strong>Flooring </strong>: <?php 	echo $dump1 ?><br />

					<?php

					}

					?>

					<?php

					if($resultarray['HEATING']!="")

					{

					$feature6 = $resultarray['HEATING'];

					

					?>

                    <strong>Heating </strong>: <?php echo $feature6;?></td>

					<?php

				     }

					 ?>

                 </td>

				      <td width="35">&nbsp;</td>

                  <td width="340" align="left" valign="top" class="spacing">

				  <?php

				  if($resultarray['INTERIOR_FEATURES']!="")

					{

					$feature7 = $resultarray['INTERIOR_FEATURES'];

					

					?>

				  <strong>Interior Features </strong>: <?php echo $feature7;?>   <br />

				  <?php

				  }

				  ?>

				   <?php

				  if($resultarray['LOCATION']!="")

					{

					$feature8 = $resultarray['LOCATION'];

					

					?>

                    <strong>Location </strong>: <?php echo $feature8;?> <br />

					<?php

					}

					?>

					 <?php

				  if($resultarray['OTHER_ROOMS']!="")

					{

					$feature9 = $resultarray['OTHER_ROOMS'];

					

					?>

                    <strong>Other Rooms </strong>: <?php echo $feature9;?> 	 <br />

					<?php

					}

					?>

					<?php

					 if($resultarray['EXTERIOR_FEATURES']!="")

					{

					$feature10 = $resultarray['EXTERIOR_FEATURES'];

					

					?>

                    <strong>Exterior Features </strong>: <?php echo $feature10;?> <br />

					<?php

					}

					?>

					<?php

					

					 if($resultarray['PARKING_GARAGE']!="")

					{

					$feature10 = $resultarray['PARKING_GARAGE'];

					

					?>

                    <strong>Parking/Garage </strong>: <?php echo $feature10;?> <br />

					<?php

					}

					?>

					<?php

					 if($resultarray['SEWER']!="")

					{

					$feature11 = $resultarray['SEWER'];

					

					?>

                    <strong>Sewer </strong>: <?php echo $feature11;?><?php

					}

					?></td>

                 

                  <td width="35">&nbsp;</td>

                  <td width="340" align="left" valign="top" class="spacing"> <?php if($resultarray['Siding']!="")

					{

					$dump35 = $resultarray['Siding'];

					

					?><strong>Siding/Exterior</strong>: <?php echo $dump35;?><br /><?php

					}

					?>

				  <?php

					 if($resultarray['HOT_WATER']!="")

					{

					$feature12 = $resultarray['HOT_WATER'];

					

					?>

                      <strong>Water Heater</strong>: <?php echo $feature12;?>  <br />

					  <?php

					  }

					  ?>

					  <?php

					 if($resultarray['Water']!="")

					{

					$dump40 = $resultarray['Water'];

					

					?>

                    <strong>Water</strong>: <?php echo $dump40;?><br />

					<?php

					}

					?>

					<?php

					 if($resultarray['CONSTRUCTION']!="")

					{

					$feature13 = $resultarray['CONSTRUCTION'];

					

					?>

                    <strong>Residential Style</strong>: <?php echo $feature13;?>   <br />

					<?php

					}

					?>

					<?php

					 if($resultarray['Lot_Size2']!="")

					{

					$feature14 = $resultarray['Lot_Size2'];

					

					?>

                    <strong>Lot Dimensions</strong>

					: <?php echo $feature14;?> <br /><?php } ?>

					<?php

					 if($resultarray['Lot_Size1']!="")

					{

					$feature50 = $resultarray['Lot_Size1'];

					

					?>

                    <strong>Lot Size</strong>: <?php echo $feature50;?><br />

					<?php

					}

					?>

					<?php

					 if($resultarray['Rent']!="")

					{

					$dump25 = $resultarray['Rent'];

					

					?>

                    <strong>Sale/Rent</strong>: <?php echo $dump25; ?> <br />

					<?php

					}

					?>

					<?php

					if($resultarray['Status']!="")

					{

					$feature15 = $resultarray['Status'];

					

					?>

                    <strong>Status</strong>: <?php echo $feature15?><br />

					<?php

					}

					?>

					<?php

					if($resultarray['Family']!="")

					{

					$dump30 = $resultarray['Family'];

					

					?>

                    <strong>Single Family Type</strong>: <?php echo $dump30;?><br />

					<?php

					}

					?>

					<?php

					if($resultarray['Total_Rooms']!="")

					{

					$feature15 = $resultarray['Total_Rooms'];

					

					?>

                    <strong>Rooms</strong>: <?php echo $resultarray['Total_Rooms'];?><br /><?php } ?>

					<?php

					 if($resultarray['Approved']!="")

					{

					$dump21 = $resultarray['Approved'];

					

					?>

                    <strong>Approved Short Sale</strong><?php echo $dump21;?><br /><?php } ?>

					<?php

					 if($resultarray['Short']!="")

					{

					$dump22 = $resultarray['Short'];

					

					?>

                    <strong>Short Sale</strong><?php echo $dump22; ?>  <?php } ?></td>



                  </tr>

                </table></td>

              </tr>



              <tr>

                <td colspan="3"><img src="images/t.gif" width="13" height="13" /></td>

              </tr>

              <tr>

                <td colspan="3">

                <div id='myMap' style="position:relative; width:875; height:440px;"></div>

                </td>

              </tr>

              <tr>

                <td colspan="3"><img src="images/t.gif" width="13" height="20" /></td>

              </tr>

              <tr>

                <td colspan="3" bgcolor="#CCCCCC"><img src="images/t.gif" width="13" height="1" /></td>

              </tr>

              <tr>

                <td colspan="3"><img src="images/t.gif" width="13" height="20" /></td>

              </tr>

              <tr>

                <td colspan="3"><span class="size12">Let <strong>THE CABRERA TEAM</strong> be your buyer's agent for this listing. <?php echo $resultarray['Org_Name'];?>. The data relating to real estate for sale on this web page appears in part through the Cape May County MLS program, a voluntary cooperative exchange of property listing data between licensed real estate brokerage firms in which we participate, and is provided by Cape May County MLS through a licensing agreement. </span></td>

              </tr>

              <tr>

                <td colspan="3"><img src="images/t.gif" width="13" height="8" /></td>

              </tr>

              <tr>

                <td colspan="3"><span class="size12">Disclaimer: All information deemed reliable but not guaranteed and should be independently verified. All properties are subject to change, withdrawal, or prior sale.</span></td>

              </tr>

            </table></td>

            <td width="13" align="left" valign="top"><img src="images/t.gif" width="13" height="15" /></td>

            <td width="233" align="left" valign="top"><table width="233" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><table width="233" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td width="18"><a href="#"><img src="images/arrowleftsmall.png" width="18" height="18" /></a></td>

                    <td width="197" align="center" class="size13"><strong><u>CURRENT SEARCH RESULTS</u></strong></td>

                    <td width="18"><a href="#"><img src="images/arrowrightsmall.png" width="18" height="18" /></a></td>

                  </tr>

                </table></td>

              </tr>

              <tr>

                <td><img src="images/t.gif" width="10" height="6" /></td>

              </tr>

			  			  <tr>

			  <td nowrap> <div style="height:40px;width:230px;border:0px solid red;overflow-x:scroll;overflow-y:hidden;" >

			  

			  <?php	include_once("paging.inc.php");	?></div></td></tr>

              <tr>



		 <?php

			  

		   while($results=mysql_fetch_array($result)) 

		   {

		   if($_GET['MLSNo'] != $results['MLSNo'])

		   {

		   	if ($results['mainimg']!='')

					$image=$results['mainimg'];

				else

					$image="images/nopicture.png";

		   ?>

			  <tr>

                <td>

				

				<table width="233" border="0" cellspacing="1" cellpadding="4" bgcolor="#C2E2F8">

                  <tr>

                    <td bgcolor="#EEF7FD">

					

					<table width="223" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td colspan="3" valign="top" class="size13"><span class="size12">

						

						<a href="property.php?MLSNo=<?php echo $results['MLSNo'];?>"><strong>

						

						<?php echo $results['Address']?></strong></a></span></td>

                      </tr>

                      <tr>

                        <td colspan="3" valign="top"><img src="images/t.gif" width="6" height="6" /></td>

                      </tr>

                      <tr>

                        <td width="82" rowspan="5" valign="top"><a href="property.php?MLSNo=<?php echo $results['MLSNo'];?>"><img src="<?php echo $image;?>" width="82" height="62" /></a></td>

                        <td width="6" rowspan="5"><img src="images/t.gif" width="6" height="10" /></td>

                        <td width="135" class="size12"><? echo $results['City'].' '.$results['State'];?></td>

                      </tr>

                      <tr>

                        <td class="size12"><img src="images/t.gif" width="6" height="4" /></td>

                      </tr>

                      <tr>

                        <td><strong><span class="size12">$<?php echo number_format($results['Asking_Price']);?></span></strong></td>

                      </tr>

                      <tr>

                        <td><img src="images/t.gif" width="6" height="4" /></td>

                      </tr>

                      <tr>

                        <td class="size12"><?php echo $resultarray['Bedrooms'] ?> Beds <?php echo $resultarray['full_baths'] ?> Baths</td>

                      </tr>

                    </table></td>

                  </tr>

                </table></td>

              </tr>

			<?php

			}}

			?>



              <tr>

                <td><img src="images/t.gif" width="10" height="6" /></td>

              </tr>

              <tr>

                <td><table width="233" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td width="18"><a href="#"><img src="images/arrowleftsmall.png" width="18" height="18" /></a></td>

                    <td width="197" align="center" class="size13"><a href="results.php"><strong>BACK TO SEARCH RESULTS</strong></a></td>

                    <td width="18"><a href="#"><img src="images/arrowrightsmall.png" width="18" height="18" /></a></td>

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

</table>

<script src="js/jquery-1.10.2.min.js"></script>

<script>

$("iframe").each(function(){

      var ifr_source = $(this).attr('src');

      var wmode = "wmode=opaque";

      if(ifr_source.indexOf('?') != -1) $(this).attr('src',ifr_source+'&'+wmode);

      else $(this).attr('src',ifr_source+'?'+wmode);

});



</script>

<script src="js/lightbox-2.6.min.js"></script>



		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

		<script type="text/javascript" src="js/rhinoslider-1.05.min.js"></script>

		<script type="text/javascript" src="js/mousewheel.js"></script>

		<script type="text/javascript" src="js/easing.js"></script>



</body>
<?php require_once('googletagmanager.php'); ?>
</html>

