<?php
require_once('config.php');
$search_cityind = $_SESSION['SEARCHCITY'];

?>
<html>
 <head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
 <title>Google Map API V3 with markers</title>
 <style type="text/css">
 body { font: normal 10pt Helvetica, Arial; }
 #map { width:1050px; height: 600px; border: 0px; padding: 0px; }
 </style>
 <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
 <script type="text/javascript">
 //Sample code written by August Li
 var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
 new google.maps.Size(32, 32), new google.maps.Point(0, 0),
 new google.maps.Point(16, 32));
 var center = null;
 var map = null;
 var currentPopup;
 var bounds = new google.maps.LatLngBounds();
 function addMarker(lat, lng, info) {
 var pt = new google.maps.LatLng(lat, lng);
 bounds.extend(pt);
 var marker = new google.maps.Marker({
 position: pt,
 icon: icon,
 map: map
 });
 var popup = new google.maps.InfoWindow({
 content: info,
 maxWidth: 300
 });
 google.maps.event.addListener(marker, "click", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
 popup.open(map, marker);
 currentPopup = popup;
 });
 google.maps.event.addListener(popup, "closeclick", function() {
 map.panTo(center);
 currentPopup = null;
 });
 }
 function initMap() {
 map = new google.maps.Map(document.getElementById("map"), {
 center: new google.maps.LatLng(0, 0),
 zoom: 14,
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
if($search_cityind == "West wildwood")
{


$query = mysql_query("SELECT Address,City,State,Zip FROM tbl_listings  where City ='West wildwood'");
}
else if($search_cityind == "wildwood")
{
$query = mysql_query("SELECT Address,City,State,Zip FROM tbl_listings  where City ='wildwood'");
}
else if($search_cityind == "wildwood crest")
{

$query = mysql_query("SELECT Address,City,State,Zip FROM tbl_listings  where City ='wildwood crest'");
}
else if($search_cityind == "Diamond Beach")
{

$query = mysql_query("SELECT Address,City,State,Zip FROM tbl_listings  where City ='Diamond Beach' or City ='Lower Township' ");
}
else if($search_cityind == "Middle Township")
{

$query = mysql_query("SELECT Address,City,State,Zip FROM tbl_listings  where city = 'Middle Township' or city = 'Burleigh' or city = 'Cape May Court House' or city = 'Rio Grande' or city = 'Whitesboro' or city = 'Dias Creek' or city = 'Green Creek'");
}
else if($search_cityind == "Lower Township")
{

$query = mysql_query("SELECT Address,City,State,Zip FROM tbl_listings  where city = 'Lower Township' or city = 'Villas' or city = 'Cold Spring' or city = 'Fishing Creek' or city = 'Townbank' or city = 'Erma' or city = 'Diamond Beach' or city = 'North Cape May'");
}
else if($search_cityind == "North Wildwood")
{

$query = mysql_query("SELECT Address,City,State,Zip FROM tbl_listings  where City ='North Wildwood'");
}
else if($search_cityind == "Cape May")
{

$query = mysql_query("SELECT Address,City,State,Zip FROM tbl_listings  where City ='Cape May'");
}

$num = mysql_num_rows($query);
while($resultarray = mysql_fetch_array($query))
{
	$address =  $resultarray['State'].",".$resultarray['City'].",".$resultarray['Address'].",".$resultarray['Zip'];
	$address =  rawurlencode($address);
	$coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&sensor=true');

	
	$coordinates = json_decode($coordinates);
	$lat = $coordinates->results[0]->geometry->location->lat;
	$lon = $coordinates->results[0]->geometry->location->lng;
	echo ("addMarker($lat, $lon,'<b>$address</b><br/>$address');\n");
}
 ?>
 center = bounds.getCenter();
 map.fitBounds(bounds);
 
 }
 </script>
 </head>
 <body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
 <div id="map"></div>
</body><?php require_once('googletagmanager.php'); ?></html>   
