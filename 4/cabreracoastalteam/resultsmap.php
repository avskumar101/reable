<?php
	session_start();
	require_once('config.php');

	define('DEF_PAGE_SIZE', 20);
	$pagesize=20;
	@extract($_POST);
	@extract($_GET);
	ob_start();
$searchtype = $_POST['search_properties'];
if($searchtype == "search_mlsmap"){


	if($_POST['town'] == 'town'){
		$_SESSION['CITY'] = $_POST['pSearch'];
		$_SESSION['ZIPCODE'] = "";
	}else{
		$_SESSION['CITY'] = "";
		$_SESSION['ZIPCODE'] = trim($_POST['zipcode']);
	}
	$_SESSION['PROPERTIES'] = $_POST['propertycheckbox'];
	$_SESSION['MINPRICE'] = $_POST['pSearchMinPrice'];
	$_SESSION['MAXPRICE'] = $_POST['pSearchMaxPrice'];
	$_SESSION['BEDS'] = $_POST['selbeds'];
	$_SESSION['BATHS'] = $_POST['selbaths'];
	$_SESSION['FORECLOSURE'] = $_POST['foreclosure'];
	$_SESSION['SORTBY'] = $_POST['sortby'];


	$_SESSION['modify_link'] = "map.php";
	$_SESSION['searchtype'] = $searchtype;

}
$mod_search_link = $_SESSION['modify_link'];

if($mod_search_link ==""){
	$mod_search_link = "mls.php";
}


	require_once("query_res.php");


	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="keywords" content="Coming Soon," />
<meta http-equiv="description" content="Coming Soon." />
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

</script>

<script src="http://maps.google.com/maps/api/js?key=AIzaSyBkZH7dvoSlfFxFQf-NNmS1hJCR_OCU6rA&v=3&sensor=false" type="text/javascript"></script>
 <script type="text/javascript">
 //Sample code written by August Li
 var icon = new google.maps.MarkerImage("",
 new google.maps.Size(32, 32), new google.maps.Point(0, 0),
 new google.maps.Point(16, 32));
 var center = null;
 var map = null;
 var currentPopup;
 var bounds = new google.maps.LatLngBounds();
 function addMarker(lat, lng, info, pr) {
 var pt = new google.maps.LatLng(lat, lng);
 bounds.extend(pt);
 var marker = new google.maps.Marker({
 position: pt,
 icon: "markblog.php?text="+pr,
 map: map
 });
 var popup = new google.maps.InfoWindow({
 content: info,
 maxWidth: 300
 });
 google.maps.event.addListener(marker, "mouseover", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
 popup.open(map, marker);
 currentPopup = popup;
 });
 google.maps.event.addListener(popup, "close", function() {
 map.panTo(center);
 currentPopup = null;
 });
 }
 function initMap() {
 map = new google.maps.Map(document.getElementById("map"), {
 center: new google.maps.LatLng(0, 0),
 zoom: 2,
 mapTypeId: google.maps.MapTypeId.ROADMAP,
 mapTypeControl: false,
 mapTypeControlOptions: {
 style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
 },
 navigationControl: true,
 navigationControlOptions: {
 style: google.maps.NavigationControlStyle.SMALL
 }
 });

<?php
if($search_city !="" || $search_zip !=""){

		$swl=mysql_query("select * from tbl_listings where City='".$search_city."' or zip='".$search_zip."' and active=1");

		 while ($row = mysql_fetch_array($mapresult)){
 $name=$row['Address'];
 $name =str_replace($name,"'","");
  $lat=$row['lat'];
  $lon=$row['lon'];
  $desc=$row['City'];
 $image=$row['mainimg'];
 $price=number_format($row['Asking_Price']);
 $priceval=$row['Asking_Price'];
 $bed=$row['Bedrooms'];
 $bath=$row['Full_Baths'];
 $class=$row['Class'];
 $lot_size=$row['Lot_Size1'];
 $status=$row['Status'];
 $mlsno=$row['MLSNo'];
 $state=$row['State'];
 $zip=$row['Zip'];
 echo ("addMarker($lat, $lon,'<html><body><form><table width=\"233\" bgcolor=\"#F8F7E0\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\"><tr><td><table width=\"223\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td colspan=\"3\" valign=\"top\" class=\"size13\"><strong ><span class=\"size12\"><a href=\"property.php?MLSNo=$mlsno\">$name</strong></a></span></td></tr><tr><td colspan=\"3\" valign=\"top\"><img src=\"images/t.gif\" width=\"6\" height=\"6\" /></td></tr><tr><td width=\"82\" rowspan=\"5\" valign=\"top\"><a href=\"property.php?MLSNo=$mlsno\"><img src=\'$image\' width=\"82\" height=\"62\"></a></td><td width=\"6\" rowspan=\"5\"><img src=\"images/t.gif\" width=\"6\" height=\"10\" /></td><td width=\"135\" class=\"size12\"><span style=\"\">$desc,&nbsp;$state</span></td></tr><tr><td class=\"size12\"><img src=\"images/t.gif\" width=\"6\" height=\"4\" /></td></tr><tr><td><span class=\"size12\" style=\"\"><strong>$$price</span></strong></td></tr><tr><td><img src=\"images/t.gif\" width=\"6\" height=\"4\" /></td></tr><tr><td class=\"size12\"><span style=\"color:#333333\">$bed Beds $bath Baths</span></td></tr></table></form></body></html>', $priceval);\n");
 }

	}
	?>
	center = bounds.getCenter();
 map.fitBounds(bounds);

 }
 </script>


</head>

<body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><?php include("header.php");?></td></tr>
  <tr>
    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">
      <tr>
        <td><table width="1121" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="986" align="left"><h1>MAP PROPERTY RESULTS - USE THE MAP TO UPDATE THE PROPERTIES</h1></td>
            <td width="135" align="right"><strong><a href="<?php echo $mod_search_link; ?>">MODIFY SEARCH &gt;</a></strong></td>
          </tr>
          <tr>
            <td colspan="2"><img src="images/t.gif" width="10" height="5" /></td>
            </tr>
          <tr>
            <td colspan="2"><table width="1121" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="3" bgcolor="#CCCCCC"><img src="images/t.gif" width="10" height="1" /></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/t.gif" width="10" height="13" /></td>
              </tr>
              <tr>
                <td width="258"><table width="258" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="233" rowspan="3" valign="top"><div class="clientArea" style="border:0px solid red;height:655px;overflow-y:scroll;"><table width="233" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="233" border="0" cellspacing="0" cellpadding="0">
                          <tr>
			   <td nowrap> <div style="height:40px;width:230px;border:0px solid red;overflow-x:scroll;overflow-y:hidden;" ><?php	include_once("paging.inc.php");	?></div></td></tr>
                        </table></td>
                      </tr>
					  <?php
					  $i=0;
		   while($resultarray=mysql_fetch_array($result))
		   {
		   		if($i%2==0)
							$bgcolor="#CAE1F7";
						else
							$bgcolor="#F8F7E0";

		   ?>
  <tr>

                      <tr>
                        <td><table width="233" border="0" cellspacing="1" cellpadding="4" bgcolor="<?php echo $bgcolor; ?>">
                          <tr>
                             <td bgcolor="<?php echo $bgcolor; ?>"><table width="223" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td colspan="3" valign="top" class="size13"><span class="size12"><a href="property.php?MLSNo=<?php echo $resultarray['MLSNo'];?>"><strong><?php echo$resultarray['Address']?></strong></a></span></td>
                              </tr>
                              <tr>
                                <td colspan="3" valign="top"><img src="images/t.gif" width="6" height="6" /></td>
                              </tr>
                              <tr>
                                <td width="82" rowspan="5" valign="top"><a href="property.php?MLSNo=<?php echo $resultarray['MLSNo'];?>"><img src="<?php echo $resultarray['mainimg'];?>" width="82" height="62" /></a></td>
                                <td width="6" rowspan="5"><img src="images/t.gif" width="6" height="10" /></td>
                                <td width="135" class="size12">
								<?php echo $resultarray['City'];?>, <?php echo $resultarray['State'];?></td>
                              </tr>
                              <tr>
                                <td class="size12"><img src="images/t.gif" width="6" height="4" /></td>
                              </tr>
                              <tr>
                                <td><strong><span class="size12"><?php echo number_format($resultarray['Asking_Price']);?></span></strong></td>
                              </tr>
                              <tr>
                                <td><img src="images/t.gif" width="6" height="4" /></td>
                              </tr>
                              <tr>
                                <td class="size12"><?php echo $resultarray['Bedrooms'] ?> Beds <?php echo $resultarray['Full_Baths'] ?> Baths</td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>


                      <tr>
                        <td><img src="images/t.gif" width="10" height="6" /></td>
                      </tr>
					  <?php
					  $i++;
					  }

					  ?>
                      <tr>
                        <td><table width="233" border="0" cellspacing="0" cellpadding="0">
                          <tr>
			   <td nowrap> <div style="height:40px;width:230px;border:0px solid red;overflow-x:scroll;overflow-y:hidden;" ><?php	include("paging.inc.php");	?></div></td></tr>
                          </table></td>
                      </tr>
                    </table></td>

                </table></td>
                <td width="13" valign="top"><img src="images/t.gif" width="13" height="13" /></td>

					<?php
					if($rows > 0)
					{
					?>
					 <td width="850" valign="top">
					<div id='map' style="position:relative; width:850; height:654px;"></div></td>
                	<?php
                	}else{

									  	echo '<td style="color:red;vertical-align:top;"><h1>No Properties Match for Your Search.  Please Edit Your Search Criteria & Try Again.</h1></td>';
					  }
					  ?>
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
            <td align="center" class="size12 lightblue"><em>?? The Cabrera Team at Long and Foster Real Estate - 6201 New Jersey Avenue Wildwood Crest, NJ - Phone: (609) 729-8840 - All Rights Reserved. Web Site Designed By: <a href="http://www.designsquare1.com" target="_blank" class="lightbluelink">Square 1 Design</a></em></td>
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
