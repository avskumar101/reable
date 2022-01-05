<?php
	session_start();
	require_once('config.php');
	/*
	if($_POST['btn_submit']=="Search Properties")
	{

		$sales_map_location= $_POST['town'];
		$sales_map_town = $_POST['pSearch'];

		$sales_map_price_min = $_POST['pSearchMinPrice'];
		$sales_map_price_max = $_POST['pSearchMaxPrice'];
		$sales_map_beds = $_POST['selbeds'];

		$sales_map_bath = $_POST['selbaths'];

		$sales_map_force = $_POST['selbeds2'];
		$sales_map_list = $_POST['sortby'];
		$sales_property = $_POST['checkbox']."-".$_POST['checkbox2'].	"-".$_POST['checkbox3']."-".$_POST['checkbox4']."-".$_POST['checkbox5']."-".$_POST['checkbox6']."-".$_POST['checkbox7'];
		$_SESSION['pSearch']=$_POST['pSearch'];

	    mysql_query("insert into tbl_mapsearch(sales_map_location,sales_map_town,sales_map_price_min,sales_map_price_max,sales_map_beds,sales_map_bath,sales_map_force,sales_map_list,sales_map_createdon,pagename,sales_property,delete_status) values ('".$sales_map_location."','".$sales_map_town."','".$sales_map_price_min."','".$sales_map_price_max."','".$sales_map_beds."','".$sales_map_bath."','".$sales_map_force."','".$sales_map_list."',NOW(),'SALES > MAP SEARCH','".$sales_property."','0')");


		 header("Location: resultsmap.php");


			$table_id = mysql_insert_id();

	   mysql_query("insert into tbl_storeddata(name,emailid,table_id,pagename,delete_status,createon) values('','".$sales_mls_emailid."','".$table_id."','SALES > MAP SEARCH','0',now())");

	}
	*/
	 $search_minprice = $_SESSION['MINPRICE'];
    if($search_minprice == null){
		$search_minprice = "0";
	}
    $search_maxprice = $_SESSION['MAXPRICE'];
    if($search_maxprice == null){
		$search_maxprice = "99999999";
	}
    $search_beds = $_SESSION['BEDS'];
    if($search_beds == null){
		$search_beds = "";
	}
    $search_baths = $_SESSION['BATHS'];
    if($search_baths == null){
		$search_baths = "";
	}
    $search_foreclosure = $_SESSION['FORECLOSURE'];
    if($search_foreclosure == null){
		$search_foreclosure = "No Preference";
	}
    $search_sortby = $_SESSION['SORTBY'];
    if($search_sortby == null){
		$search_sortby = "Original_Price asc";
	}
    $search_properties1 = $_SESSION['PROPERTIES'];
    if($search_properties1 == null){
		$search_properties1 = "0";
	}

	$search_sold = $_SESSION['SOLD'];
    if($search_sold == null){
		$search_sold = "No";
	}
   $search_city = $_SESSION['CITY'];

	if($search_city == null){
		$search_city = "";
	}

	if($search_city == ""){
		$search_city = "Wildwood";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="keywords" content="Map Search, Properties For Sale, Single Family, Condominium, Townhouse," />
<meta http-equiv="description" content="Cape May County MLS Map Search provided by the Cabrera Coastal Team." />
<meta name="robots" content="index, follow" />
<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>
<title>Cape May County MLS - Map Search</title>
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
</script>
<script>
function submitform(){
document.map.btn_submit.click();
return true;
}
function changesearch(a){
	if(a == "city"){
		document.getElementById('citydropdowndiv').style.display="block";
		document.getElementById('zipcodediv').style.display="none";
	}else{
		document.getElementById('zipcodediv').style.display="block";
		document.getElementById('citydropdowndiv').style.display="none";
	}

}
</script>

</head>

<body onload="MM_preloadImages('images/search2.jpg','images/searchproperties2.png')">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form id="map" name="map" method="post" action="resultsmap.php">
<tr><td><?php include("header.php");?></td></tr>
  <tr>
    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">
      <tr>
        <td><h1>MAP SEARCH - PROPERTIES FOR SALE</h1>
          <table width="1121" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="1121" border="0" cellspacing="1" cellpadding="6">
                <tr>
                  <td width="35">&nbsp;</td>
                  <td width="140" align="center" bgcolor="#195CAB"><a href="mls.php" class="whitelink">ADVANCED SEARCH</a></td>
                  <td width="5">&nbsp;</td>
                  <td width="100" align="center" bgcolor="#1E8BCC"><a href="map.php" class="whitelink">MAP SEARCH</a></td>
                  <td width="5">&nbsp;</td>
                  <td width="150" align="center" bgcolor="#195CAB"><a href="address.php" class="whitelink">SEARCH BY ADDRESS</a></td>
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
                      <td width="431" valign="top"><table width="400" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="left"><strong><u>CHOOSE LOCATION</u></strong></td>
                          <td width="200">&nbsp;</td>
                          </tr>
                        <tr>
                          <td colspan="2"><img src="images/t.gif" width="13" height="13" /></td>
                          </tr>
                        <tr>
                          <td width="200" align="left" valign="top" class="spacing"> <input name="town" type="radio" id="town" value="town" checked="checked" onclick="return changesearch('city');" />
                            Select A Town<br />
                            <input type="radio" name="town" id="town" value="zip" onclick="return changesearch('zip');"/>
                            Search By Zip Code
							</td>
                          <td align="left" valign="top">
                          <div id="citydropdowndiv" name="citydropdowndiv">
                          <table width="200" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="200"><strong>Select A Town:</strong></td>
                              </tr>
                            <tr>
                              <td><img src="images/t.gif" width="13" height="3" /></td>
                            </tr>
                            <tr>
                              <td><span class="spacing">

                                <select name="pSearch" size="0" class="form-select" id='pSearch'>
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
                              </span>
                              </td>
                              </tr>
                          </table>
                              </div>
                              <div id="zipcodediv" name="zipcodediv" style="display:none;">
	                          <table width="200" border="0" cellspacing="0" cellpadding="0">
	                            <tr>
	                              <td width="200"><strong>Enter Zip Code:</strong></td>
	                              </tr>
	                            <tr>
	                              <td><img src="images/t.gif" width="13" height="3" /></td>
	                            </tr>
	                            <tr>
	                              <td><span class="spacing">
                              <input type ="text" id="zipcode" name="zipcode" value="<?php echo $zipcodesearch; ?>" />
                              </td>
                              </tr>
                          </table>

                              </div>
                          </td>
                          </tr>
                        <tr>
                          <td colspan="2" align="left" valign="top" class="spacing"><img src="images/t.gif" width="13" height="80" /></td>
                          </tr>
                        <tr>
                          <input type="hidden" id="search_properties" name="search_properties" value="search_mlsmap" />
                      <td colspan="3" valign="top"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('search','','images/searchproperties2.png',1)"><input type="image" src="images/searchproperties.png" alt="Search Properties For Sale" width="400" height="43" id="search_properties" name="search_properties" value="search_mlsmap" /></a></td>
                          </tr>
                      </table></td>
                      <td width="275" valign="top"><table width="246" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="246"><u><strong>PROPERTY TYPE:</strong></u></td>
                          </tr>
                        <tr>
                          <td><img src="images/t.gif" width="13" height="13" /></td>
                          </tr>
                        <tr>
                          <td class="spacing"><input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="Single Family" />
                            Single Family<br />
                            <input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="CONDO" />
                            Condominium<br />
							<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="TOWNHOUSE"  />
							Townhouse
							<br />
							<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="MULTI-FAMILY" />
							Multi Family
							<br />
							<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="Modular/Mobile" />
							Modular / Mobile
							<br />
							<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="LOTS/LAND" />
							Lot / Land
							<br />
							<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="COMMERCIAL/INDUSTRIAL"   />
							Commercial / Industrial
							</td>
                          </tr>
                      </table></td>
                      <td width="375" valign="top"><table width="350" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td colspan="2"><u><strong>PROPERTY FEATURES</strong></u></td>
                          </tr>
                        <tr>
                          <td colspan="2"><img src="images/t.gif" width="13" height="13" /></td>
                          </tr>
                        <tr>
                          <td width="150"><strong>Minimum Price</strong></td>
                          <td width="200"><strong>Maximum  Price</strong></td>
                          </tr>
                        <tr>
                          <td colspan="2"><img src="images/t.gif" width="13" height="3" /></td>
                        </tr>
                        <tr>
                          <td><select size="1" name="pSearchMinPrice" id="pSearchMinPrice" class="form-select">
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
                          <td><select size="1" name="pSearchMaxPrice" id="pSearchMaxPrice" class="form-select">
                            <option value="99999999"            >No Maximum</option>
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
                          <td colspan="2"><img src="images/t.gif" width="13" height="20" /></td>
                        </tr>
                        <tr>
                          <td><strong>Bedrooms</strong></td>
                          <td><strong>Bathrooms</strong></td>
                        </tr>
                        <tr>
                          <td colspan="2"><img src="images/t.gif" width="13" height="3" /></td>
                        </tr>
                        <tr>
                          <td><span style="width:50%">
                            <select id="selbeds" name="selbeds">
                              <option selected="selected" value="">All</option>
                              <option value="1">1+</option>
                              <option value="2">2+</option>
                              <option value="3">3+</option>
                              <option value="4">4+</option>
                              <option value="5">5+</option>
                            </select>
                          </span></td>
                          <td><span style="width:50%">
                            <select id="selbaths" name="selbaths">
                              <option selected="selected" value="">All</option>
                              <option value="1">1+</option>
                              <option value="2">2+</option>
                              <option value="3">3+</option>
                              <option value="4">4+</option>
                              <option value="5">5+</option>
                            </select>
                          </span></td>
                        </tr>
                        <tr>
                          <td colspan="2"><img src="images/t.gif" width="13" height="20" /></td>
                        </tr>
                        <tr>
                          <td><strong>Foreclosure</strong></td>

                        </tr>
                        <tr>
                          <td colspan="2"><img src="images/t.gif" width="13" height="3" /></td>
                        </tr>
                        <tr>
                          <td><span style="width:50%">
                            <select id="foreclosure" name="foreclosure">
                              <option value="No Preference">No Preference</option>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                            </select>
                          </span></td>

                        </tr>
                      </table></td>
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
 <?php
    $_SESSION['ADDRESS'] = "";
	$_SESSION['CITY'] = "Wildwood";
	$_SESSION['TOWNS'] = "";
	$_SESSION['PROPERTIES'] = "";
	$_SESSION['MINPRICE'] = "";
	$_SESSION['MAXPRICE'] = "";
	$_SESSION['BEDS'] = "";
	$_SESSION['BATHS'] = "";
	$_SESSION['FORECLOSURE'] = "";
	$_SESSION['SORTBY'] = "";
	$_SESSION['SOLD'] = "";
?>
  <script>
   document.getElementById('pSearch').value = "<?php echo $search_city;?>";
  document.getElementById('pSearchMinPrice').value = "<?php echo $search_minprice;?>";
  document.getElementById('pSearchMaxPrice').value = "<?php echo $search_maxprice;?>";
  document.getElementById('selbeds').value = "<?php echo $search_beds;?>";
  document.getElementById('selbaths').value = "<?php echo $search_baths;?>";
  document.getElementById('foreclosure').value = "<?php echo $search_foreclosure;?>";
  document.getElementById('sortby').value = "<?php echo $search_sortby;?>";



   ff = document.getElementsByName('propertycheckbox[]');
  var ln = ff.length;
  sellengh = <?php echo count($search_properties1);?>;
  <?php $kk =0; ?>;
  for(h=0;h<ln;h++){

  	<?php
  	for($k=1;$k<=count($search_properties1);$k++){
  	?>
  		gg = '<?php echo $search_properties1[$k-1];?>';
  		if(ff[h].value == gg){
  			ff[h].checked = true;
  		}

  	<?
  	}
  	?>

  }


	if('<?php echo $search_properties1[0];?>' == 0){
		for(h=0;h<1;h++){
			ff[h].checked = true;
		}
	}





	</script>




</form>

</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>
