<?php

ob_start();

session_start();

include('config.php'); 

			   
if($_POST['mobile']=='') {

	if($_GET['Mobile']=='') {		

	$url =$_SERVER['HTTP_REFERER'];

	$query = parse_url($url, PHP_URL_QUERY);

	parse_str($query);

	parse_str($query, $arr);

	$request = $_SERVER['HTTP_REFERER'];

	$urlname=explode('?',$request);

	$urlname= $urlname[1];

	if($urlname=='Mobile=Off' || $Mobile=='Off') {

	 echo "<script>window.location='vacationrentals.php?Mobile=Off".$_SERVER['QUERY_STRING']."';</script>";
	 exit;

		}	
	}
}



if($_GET['Mobile']=='') {	

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

	echo "<script>window.location.href='mobile/vacationrentals.php';</script>";
}	



if($_POST['btnsubmit']=='listsubmit') {	
	
	
	mysql_query("TRUNCATE TABLE search_results_data");

	  
	$checkindate=date('Y-m-d', strtotime($_POST['checkin']));	

	$checkoutdate=date('Y-m-d', strtotime($_POST['checkout']));
	
	// Availability
	$dataavl="";			
	$cond=" and (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ";
		
	$STM2 = mysql_query("SELECT * FROM rental_properties_rates_rs where CheckInDate!='' $cond group by referenceid");
	
	$rfid='';
	$i=0;	
	while($avl = mysql_fetch_array($STM2))
	{
		
		if($available=='') {
			
			$rfid.=" and ( referenceid='".$avl['referenceid']."'";
			$available='property';
			
		} else {
			
			$rfid.=" or referenceid='".$avl['referenceid']."'";
		}	

	$i++;
	}	
	
	if($available=='property') {		
		$avble= $rfid.')';		
	}
			
	// Price Range
	
	if($_POST['MiniPrice']!='' || $_POST['MaxPrice']!='') {
	
		$cnd=$avble;
		$minprice= $_POST['MiniPrice'];
		$maxprice= $_POST['MaxPrice'];	
			
		$ratein = " and  Rate >= 1 and Rate BETWEEN '".$minprice."' AND '".$maxprice."' AND (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ".$cnd." group by referenceid";
		
		$ssrt = mysql_num_rows(mysql_query("SELECT * FROM rental_properties_rates_info where referenceid!='0' $ratein"));
		
		if($ssrt>0){

			$rateinf = " and  Rate >= 1 and Rate BETWEEN '".$minprice."' AND '".$maxprice."' AND (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ".$cnd." group by referenceid";


		} else {

			$rateinf = " and  Rate >= 1 and Rate BETWEEN '".$minprice."' AND '".$maxprice."' AND (CheckInDate >= '".$checkindate."' AND CheckOutDate <= '".$checkoutdate."') ".$cnd." group by referenceid";
		}	
							
	$STM1 = mysql_query("SELECT * FROM rental_properties_rates_info where referenceid!='0' $rateinf");
		
		$rts='';
		$p=1;	
		while($avln = mysql_fetch_array($STM1))
		{
								
			if($prc=='') {
				
				$rts.=$avln['referenceid'];
				$prc='available';
				
			} else {
				
				$rts.="','".$avln['referenceid'];
			}	
							
		$p++;		
		}
		
		if($rts!="") {
		
			$rtsn.= " and referenceid in ('".$rts."')";
			
		} else {
			
			$rtsn.= " and referenceid in ()";
		}

		
		if($prc=='available') {	
		
			$avbles= $rtsn;
			$dataavl="available";		
		}
		
				
	} else {
		
		$avbles= $avble;
		$dataavl="available";
	}
			
	
	if($dataavl=='available') {
		
		$mysql= $avbles;
	}		
	
	if($_POST['internet']==1) {

		$amd= " or amenity_label like '%Wifi%' or amenity_label like '%High Speed Internet%' ";
	}
	
	$propertiesarray = $_POST['amm'];
	
	$propcount = count($_POST['amm']);
	
	$amcond='';	
	if($propertiesarray[0] != ""){
		
		$amcond .= " and (";
		
		for($p=0;$p<$propcount; $p++){			

			if($p == $propcount-1){
				
				$property_type = $propertiesarray[$p];								
				$amcond .= " amenity_label like '%$propertiesarray[$p]%' $amd )";
				
			}else{
				
				$property_type = $propertiesarray[$p];								
				$amcond .= " amenity_label like '%$propertiesarray[$p]%' OR ";
							
			}			
		}
		
	} else {
		
		if($_POST['internet']==1) {

		$amcond .= " and (amenity_label like '%Wifi%' or amenity_label like '%High Speed Internet%') ";
		
		}
	}
	
	if($amcond!='') {
					
		$STM3 = mysql_query("SELECT * FROM rentals_properties_amenity where referenceid!='0' $mysql $amcond group by cid");

		$i=0;	
		while($rowq = mysql_fetch_array($STM3))
		{

			if($i==0)	
			{
				$condinsert.=$rowq['cid'];
				
			} else {
				
				$condinsert.="','".$rowq['cid'];
			}			
			
		$i=$i+1;	
		}
		if($condinsert!="") {
		
			$mysql.= " and cid in ('".$condinsert."')";
		} else {
			
			$mysql.= " and cid in ()";
		}
	}

	
	// bedrooms	
	if($_POST['bedrooms']!='') {
		
		$mysql.=" and bedroom >= '".$_POST['bedrooms']."'";		
	}	
	// bathrooms	
	if($_POST['bathrooms']!='') {
		
		$mysql.=" and bathroom+halfbath >= '".$_POST['bathrooms']."'";
	}	
	// sleeps	
	if($_POST['sleeps']!='') {
		
		$mysql.=" and sleepupto >= '".$_POST['sleeps']."'";
		
	}			
	// Pets	
	if($_POST['petsallowed']!='') {		
		
		if($_POST['petsallowed']==0) {
			
			$mysql.=" and pets='No' ";
			
		} else {
			
			$mysql.=" and pets='Yes' ";
		}
	}

	// Location	
	if($_POST['town']!='') {
		
		$lcn=$_POST['town'];

		$mysql.=" and city='".$lcn."'";
	}	
	
	// Single Family	
	if($_POST['SF']!='') {
		
		$SFY=$_POST['SF'];
			
		$mysql.=" and propertytype like '%".$SFY."%'";
	}
	
	
	$stmt5 = mysql_query("SELECT * FROM search_results where HideList='0' $mysql");
	
	
	$l=0;	
	while($avl = mysql_fetch_array($stmt5))
	{
		
		
		$cnd=" and (CheckInDate <= '".$checkindate."' and CheckOutDate >= '".$checkoutdate."') ";

		$cid=$avl['cid'];

		$stmt=mysql_query("SELECT * FROM rental_properties_rates_info WHERE PropertyID='$cid' $cnd");

		$rates = mysql_fetch_array($stmt);

		if($rates['Rate'] > 0){ $rate=$rates['Rate']; } else { $rate=0; }

	
		$referenceid=$avl['referenceid'];
		
		$cid=$avl['cid'];
		
		$imgPreview=$avl['imgPreview'];
				
		if($imgPreview!='') {

			$pgrepimg=$imgPreview;

		} else {
		
			$pgrepimg='images/piccomingsoon.jpg';
		}
	
		$propertyheadline=mysql_real_escape_string($avl['propertyheadline']);	
		//$propertyheadline=mysql_real_escape_string($avl['street'].' - '.$avl['city']);
		
		$cityname=$avl['city'];
		$bedroom=$avl['bedroom'];
		$bathroom=$avl['bathroom'];
		$halfbath=$avl['halfbath'];
		$sleepupto=$avl['sleepupto'];
		$location=$avl['location'];
		$propertytype=$avl['propertytype'];
		$desc=mysql_real_escape_string($avl['propertydesc']);	
				
	$stmt= mysql_query("insert into search_results_data(cid, referenceid, city, propertyheadline, bedroom, bathroom, halfbath, sleepupto, location, rate, propertydesc, imgPreview,propertytype)values('$cid','$referenceid','$cityname','$propertyheadline','$bedroom','$bathroom','$halfbath','$sleepupto','$location','$rate','$desc','$pgrepimg','$propertytype')");
	
	$l=$l+1;
	}
	
	
	if($_POST['sleeps']!=''){

		$cont .="&SLP=".$_POST['sleeps']."";
	}
	if($_POST['bedrooms']!=''){

		$cont .="&BD=".$_POST['bedrooms']."";
	}	
	if($_POST['bathrooms']!=''){

		$cont .="&BTH=".$_POST['bathrooms']."";
	}	
	if($_POST['town']!=''){

		$cont .="&TW=".$_POST['town']."";
	}	
	if($_POST['MiniPrice']!=''){

		$cont .="&MN=".$_POST['MiniPrice']."";
	}	
	if($_POST['MaxPrice']!=''){

		$cont .="&MX=".$_POST['MaxPrice']."";
	}		
	if($_POST['petsallowed']==1){

		$cont .="&PE=".$_POST['petsallowed']."";
	}
	
		// checkbox  start//		
	if($_POST['internet']==1) {

		$amd= ",Internet";
	}
	if($_POST['SF']!='') {
		
		$SFY=",Single Family";
	}
	$properties = $_POST['amm'];
	
	$propcount = count($_POST['amm']);
	
	$amcond='';	
	if($properties[0] != ""){
		
		$amcond .= " and (";
		
		for($p=0;$p<$propcount; $p++){			

			if($p == $propcount-1){
				
				$amcnd .= "$properties[$p]$amd$SFY";
				
			}else{
				
				$amcnd .= "$properties[$p],";							
			}
		}
		
	} else {
		
		if($_POST['internet']==1) {			

			if($_POST['SF']!='') {
			
				$amcnd .="Internet,Single Family";
				
			} else {
				
				$amcnd .= "Internet";				
			}
			
		} else {
			
			if($_POST['SF']!='') {
				
				$amcnd .="Single Family";				
			}
		}
	}	
	if($amcnd!=''){
		
		$amcnd="&Amenities=".$amcnd;
	}
	// checkbox end //	
	
		
	$checkin=date('m/d/Y', strtotime($_POST['checkin']));
	$checkout=date('m/d/Y', strtotime($_POST['checkout']));

header("Location:rentalresults.php?vr=view&checkin=".$checkin."&checkout=".$checkout."$cont$amcnd");

}
	
$pagedata=mysql_fetch_array(mysql_query("select * from  tbl_homepage where id='22'"));
	
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<meta http-equiv="keywords" content="<?php echo $pagedata['meta_key'];?>"/>

<meta http-equiv="description" content="<?php echo $pagedata['meta_desc'];?>"/>

<meta name="robots" content="index, follow" />

<title><?php echo $pagedata['meta_title'];?></title>

<link href="styles.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.9.1.js" type="text/javascript"></script>

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');

  ga('send', 'pageview');

    
function submitform() {

	document.getElementById("load").style.display = "block";
	
	document.forms["rentalsearch1"].submit();
	
	return true;
}

</script>


<style>

.bxclr {
    padding: 10px;
	width:188px;
    box-shadow: inset 0 0 5px rgba(000,000,000, 0.5);
    background-color:#1E8BCC;
    color: #FFF;
}
.optnvl{
	background-color:white;
	color:black;
	font-size:18px;
}
#checkin {
	background-image: url(images/calendar.png);
	background-repeat: no-repeat;
	padding-right: 25px;
	background-position: center right;
}
#checkout {
	background-image: url(images/calendar.png);
	background-repeat: no-repeat;
	padding-right: 25px;
	background-position: center right;
}

#load{ position:absolute;z-index:1;width:150px;height:150px;margin-top:20%;	margin-left:-10px;top:9%;left:45%; }

</style>


</head>



<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr><td><?php include("header.php")?></td></tr>


  <tr>

    <td>

	<div id="load" style="display:none;">

	<img src="images/loading.gif" width="100%" height="100%" border="0" />

	</div>


	<table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

 <tr>

    <td>
	
<table width="1170" border="0" align="center" cellpadding="0" cellspacing="0" class="lrgspacing">

  <tr>

	<td align="center">		

		<?php echo stripslashes($pagedata['content']);?>

	  <table width="1064" border="0" cellspacing="0" cellpadding="0">

		<tr>

		<td><img src="images/t.gif" width="40" height="25" /></td>

		</tr>

		<tr>

		  <td width="1208" align="left" valign="bottom">
			  
		<form name="rentalsearch1" id="rentalsearch1" method="POST" >	

		<input id="mobile" name="mobile" type="hidden" value="<?php echo $_GET['Mobile'];?>"/>

			  
		  <table width="750" border="0" cellspacing="0" cellpadding="0">

			<tr>

			  <td width="30"><img src="images/t.gif" width="30" height="50" /></td>

			  <td width="230" align="center" valign="middle" bgcolor="#1E8BCC" class="white size15"><strong>WEEKLY RENTAL SEARCH</strong></td>

			  <td width="25"><img src="images/t.gif" width="25" height="50" /></td>

			  <td width="195" align="center" bgcolor="#195CAB"><a href="rentaladdress.php" class="whitelink size15">SEARCH BY ADDRESS</a></td>

			  <td width="25"><img src="images/t.gif" width="25" height="50" /></td>

			  <td width="215" align="center" bgcolor="#195CAB"><a href="rentalkey.php" class="whitelink size15">SEARCH BY RENTAL KEY</a></td>

			  <td width="30"><img src="images/t.gif" width="30" height="50" /></td>

			</tr>

		  </table></td>

		</tr>

	<tr>

	  <td><table width="1064" border="0" cellspacing="3" cellpadding="18" bgcolor="#1E8BCC">

		<tr>

		  <td bgcolor="#E6F5F9">
				  
		<?php
			
			$CheckInDate=$_GET['checkin'];
			
			if($_GET['checkin']!=''){
				
				$CheckInDate=$_GET['checkin'];
				
				$exstart=explode("/",$CheckInDate);
				
				$datetimeft=$exstart[2].'/'.$exstart[0].'/'.$exstart[1];	
				
				$arvl=date('F d Y', strtotime($datetimeft));	
				
			} else {
				$arvl = date('F d Y');	
			}
			
			if($_GET['checkout']!=''){
				
				$checkout=$_GET['checkout'];
				
				$exstart=explode("/",$checkout);
				
				$datetimeft=$exstart[2].'/'.$exstart[0].'/'.$exstart[1];
				
				$depvl=date('F d Y', strtotime($datetimeft));
					
			} else {
				
				$dt = date("Y-m-d");
				
				$depvl = date("F d Y", strtotime( "$dt +7 day" ) ); 
			}
			
			?>			  
				  
	<table width="1022" border="0" cellspacing="0" cellpadding="0">

	<tr>

	  <td width="1022"><table width="1022" border="0" cellspacing="0" cellpadding="0">

		<tr class="medspacing">

		  <td width="255"><span class="red">*</span><u>CHECK IN DATE</u></td>

		  <td width="256"><span class="red">*</span><u>CHECK OUT DATE</u></td>

		  <td width="256"><u>LOCATION</u></td>

		  <td width="255"><u>PETS ALLOWED</u></td>

		</tr>

		<tr>

		  <td colspan="4"><img src="images/t.gif" width="16" height="10" /></td>

		</tr>

		<tr>

		  <td>
						  
					  
  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">
	<tr>									   
	  <td align="center" valign="middle">
	  

	<input id="checkin" onchange="reds(this.value+'&'+this.id);" class="bxclr" type="text" value="<?php echo $arvl;?>" name="checkin" style="width:175px">	
					 
		  
		  </td>
		</tr>
		
		</table> </td>

			  <td>
						  
	  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

		<tr>

		  <td align="center" valign="middle">
		  
	<input name="checkout" onchange="reds(this.value+'&'+this.id);" class="bxclr" id="checkout" type="text" value="<?php echo $depvl;?>" style="width:175px"/>	
		  
		  </td>

		</tr>

	  </table>
				  
				  
	  </td> <td>
						  
  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

	<tr>


	  <td align="center" valign="middle">
	  	  
	  <select name="town" style="width:210px" class="bxclr" id="town" onchange="reds(this.value+'&'+this.id);">
		  <option value="" class="optnvl size14 white"> No Preference </option>	
		  <option value="Wildwood Crest" class="optnvl size14 white"> Wildwood Crest </option>	
		  <option value="Wildwood" class="optnvl size14 white"> Wildwood </option>	
		  <option value="North Wildwood" class="optnvl size14 white"> North Wildwood </option>	
	<?php

	/*$STM2 = mysql_query("SELECT city FROM rental_properties where city!='' group by city order by city desc");

	$i=0;	
	while($citynam=mysql_fetch_array($STM2)) {?>				
	<option value="<?php echo $citynam['city'];?>" class="optnvl size14 white">
	<?php echo $citynam['city'];?></option>
	<?php 
	$i=$i+1;
	} */
	?>
	</select>
	
	<?php 
	if($_GET['TW']!='')
	{
		$townvalw=$_GET['TW'];
	}
	else{
		$townvalw='';
	}
	?>	
	<script> document.getElementById('town').value="<?php echo $townvalw; ?>";</script>
	  
	  
	  </td>

	</tr>

  </table>

	  
	  </td>

	  <td>
	  
	  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

		<tr>

		  <td>
		  
		<select name="petsallowed" style="width:210px" class="bxclr" id="petsallowed" onchange="reds(this.value+'&'+this.id);">
			<option VALUE="" selected="selected" class="optnvl"> No Preference </option>
			<option VALUE="1" class="optnvl">Yes, I Have A Pet</option>
			<option VALUE="0" class="optnvl">No Pets</option>
		</select>
		<?php 
		if($_GET['PE']!='') {
			$cdatevalw=$_GET['PE'];
		} else {
			$cdatevalw='';
		}
		?>	
<script> document.getElementById('petsallowed').value="<?php echo $cdatevalw;?>";</script>
		  
		  </td>

		</tr></table></td>
		
	</tr>
		<tr>

		  <td colspan="4"><img src="images/t.gif" width="16" height="25" /></td>

		</tr>

		<tr class="medspacing">

		  <td><u>BEDROOMS</u></td>

		  <td><u>BATHROOMS</u></td>

		  <td><u>SLEEPS UP TO</u></td>

		  <td><u>INTERNET ACCESS</u></td>

		</tr>

	<tr>

	  <td colspan="4"><img src="images/t.gif" width="16" height="10" /></td>

	</tr>

	<tr>

	  <td>
		  
						  
	<table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

	<tr>

	  <td>	  
	  
	  <select class="bxclr" style="width:210px" id="bedrooms" name="bedrooms" onchange="reds(this.value+'&'+this.id);">

		<option VALUE="" selected="selected" class="optnvl"> No Preference </option>

		<option VALUE="1" class="optnvl"> 1+ </option>

		<option VALUE="2" class="optnvl"> 2+ </option>

		<option VALUE="3" class="optnvl"> 3+ </option>

		<option VALUE="4" class="optnvl"> 4+ </option>

		<option VALUE="5" class="optnvl"> 5+ </option>

		<option VALUE="6" class="optnvl"> 6+ </option>

		<option VALUE="7" class="optnvl"> 7+ </option>

	</select>

	<?php 
	if($_GET['BD']!='') {
		$bdr=$_GET['BD'];
	} else {
		$bdr='';
	}
	?>	
	<script> document.getElementById('bedrooms').value="<?php echo $bdr;?>";</script>
	  
	  </td>

	</tr>

	</table>
	  
	  
	  </td>

	  <td>
	  
	  
	  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

		<tr>

		  <td>
							  
							  
	<select class="bxclr" style="width:210px" id="bathrooms" name="bathrooms" onchange="reds(this.value+'&'+this.id);">
		
		<option value="" selected="selected" class="optnvl"> No Preference </option>
	
		<option VALUE="1" class="optnvl"> 1+ </option>
		
		<option VALUE="2" class="optnvl"> 2+ </option>
		
		<option VALUE="3" class="optnvl"> 3+ </option>
		
		<option VALUE="4" class="optnvl"> 4+ </option>
		
		<option VALUE="5" class="optnvl"> 5+ </option>
		
		<option VALUE="6" class="optnvl"> 6+ </option>
		
		<option VALUE="7" class="optnvl"> 7+ </option>
		
	</select>
	
	<?php 
	if($_GET['BTH']!='') {
		$bhr=$_GET['BTH'];
	} else {
		$bhr='';
	}
	?>	
	<script> document.getElementById('bathrooms').value="<?php echo $bhr; ?>";</script>		

	
		  </td>

		</tr>

	  </table>
	  
	  </td>

	  <td>
	  
	  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

		<tr>

		  <td>
							  
							  
	<select class="bxclr" style="width:210px" id='sleeps' name="sleeps" onchange="reds(this.value+'&'+this.id);">

	  <option value="" class="optnvl" selected="selected">No Preference</option>

	  <option value="2" class="optnvl">2+</option>

	  <option value="4" class="optnvl">4+</option>

	  <option value="6" class="optnvl">6+</option>

	  <option value="8" class="optnvl">8+</option>

	  <option value="10" class="optnvl">10+</option>

	  <option value="12" class="optnvl">12+</option>

	  <option value="14" class="optnvl">14+</option>

	  <option value="16" class="optnvl">16+</option>

	  <option value="18" class="optnvl">18+</option>

	</select>

	<?php 
	if($_GET['SLP']!='') {
		$slp=$_GET['SLP'];
	} else {
		$slp='';
	}
	?>	
	<script> document.getElementById('sleeps').value="<?php echo $slp; ?>";</script>
							  
							  
		  </td>

		</tr>

	  </table>
	  
	  
	  </td>

	  <td>
	  
	<?php	  
	$amenitArray = explode(",",$_GET['Amenities']);
	$ii=0;	
	for($kkk=0;$kkk<count($amenitArray); $kkk++) {

	if($amenitArray[$kkk]=='BBQ') { $checkboxckd1='checked="checked"'; }
	if($amenitArray[$kkk]=='Single Family') { $checkboxckd2='checked="checked"'; }
	if($amenitArray[$kkk]=='Central A/C') { $checkboxckd3='checked="checked"'; }
	if($amenitArray[$kkk]=='Boat') { $checkboxckd4='checked="checked"'; }
	if($amenitArray[$kkk]=='Outdoor Pool') { $checkboxckd5='checked="checked"'; }
	if($amenitArray[$kkk]=='Outside Shower') { $checkboxckd6='checked="checked"'; }
	if($amenitArray[$kkk]=='Internet') { $checkboxckd7=$amenitArray[$kkk]; }

		$ii=$ii+1;
	}
	?>
	
	  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

		<tr>

		  <td>
							  
							  
	<select class="bxclr" style="width:210px" name="internet" id="internet" onchange="reds(this.value+'&'+this.id);">

		<option value="0" selected="selected" class="optnvl"> No Preference </option>

		<option value="1" class="optnvl">Internet Access Required</option>

	</select>

	<?php 
	if($checkboxckd7!='') {
		$intr=1;
	} else {
		$intr='0';
	}
	?>	
	<script>document.getElementById('internet').value="<?php echo $intr;?>";</script>
							  
		  
		  </td>

		</tr>

	  </table>
	  
	  </td>

	</tr>

	<tr>

	  <td colspan="4"><img src="images/t.gif" width="16" height="25" /></td>

	</tr>

	<tr class="medspacing">

	  <td><u>MINIMUM PRICE RANGE</u></td>

	  <td><u>MAXIMUM PRICE RANGE</u></td>

	  <td colspan="2"><u>REQUIRED AMENITIES</u></td>

	</tr>

	<tr>

	  <td colspan="4"><img src="images/t.gif" width="16" height="10" /></td>

	</tr>

	<tr>

	  <td valign="top">
	  
	  
	  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

		<tr>

		  <td class="size14 white">
		  
	<select id="MiniPrice" name="MiniPrice" class="bxclr" style="width:210px" onchange="reds(this.value+'&'+this.id);">
		<option value="0">No Preference</option>
		<option value="0">$0</option>
		<option value="500">$500</option>
		<option value="1000">$1,000</option>
		<option value="1500">$1,500</option>
		<option value="2000">$2,000</option>
		<option value="2500">$2,500</option>
		<option value="3000">$3,000</option>
		<option value="3500">$3,500</option>
		<option value="4000">$4,000</option>
		<option value="4500">$4,500</option>
		<option value="5000">$5,000</option>
		<option value="5500">$5,500</option>
		<option value="6000">$6,000</option>
		<option value="6500">$6,500</option>
		<option value="7000">$7,000</option>
		<option value="7500">$7,500</option>
		<option value="8000">$8,000</option>
		<option value="8500">$8,500</option>
		<option value="9000">$9,000</option>
		<option value="10000">$10,000</option>
		<option value="10500">$10,500</option>
		<option value="11000">$11,000</option>
		<option value="11500">$11,500</option>
		<option value="12000">$12,000</option>
		<option value="12500">$12,500</option>
		<option value="13000">$13,000</option>
		<option value="14000">$14,000</option>
		<option value="14500">$14,500</option>
		<option value="15000">$15,000</option>
		<option value="15500">$15,500</option>
		<option value="16000">$16,000</option>
		<option value="16500">$16,500</option>
		<option value="17000">$17,000</option>
		<option value="17500">$17,500</option>
		<option value="18000">$18,000</option>
		<option value="18500">$18,500</option>
		<option value="19000">$19,000</option>
		<option value="19500">$19,500</option>
		<option value="20000">$20,000</option>
	</select>
		  
<?php if($_GET['MN']=="") { $pm='0'; } else { $pm=$_GET['MN']; } ?>

<script>document.getElementById('MiniPrice').value="<?php echo $pm; ?>";</script>

	</td>

		</tr>

	  </table>
	  
	  </td>

	  <td valign="top">
	  
	  
	  <table width="210" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D92A4">

		<tr>

		  <td>
	<select id="MaxPrice" name="MaxPrice" class="bxclr" style="width:210px" onchange="reds(this.value+'&'+this.id);">	  
		<option value="999000">No Preference</option>
		<option value="500">$500</option>
		<option value="1000">$1,000</option>
		<option value="1500">$1,500</option>
		<option value="2000">$2,000</option>
		<option value="2500">$2,500</option>
		<option value="3000">$3,000</option>
		<option value="3500">$3,500</option>
		<option value="4000">$4,000</option>
		<option value="4500">$4,500</option>
		<option value="5000">$5,000</option>
		<option value="5500">$5,500</option>
		<option value="6000">$6,000</option>
		<option value="6500">$6,500</option>
		<option value="7000">$7,000</option>
		<option value="7500">$7,500</option>
		<option value="8000">$8,000</option>
		<option value="8500">$8,500</option>
		<option value="9000">$9,000</option>
		<option value="10000">$10,000</option>
		<option value="10500">$10,500</option>
		<option value="11000">$11,000</option>
		<option value="11500">$11,500</option>
		<option value="12000">$12,000</option>
		<option value="12500">$12,500</option>
		<option value="13000">$13,000</option>
		<option value="14000">$14,000</option>
		<option value="14500">$14,500</option>
		<option value="15000">$15,000</option>
		<option value="15500">$15,500</option>
		<option value="16000">$16,000</option>
		<option value="16500">$16,500</option>
		<option value="17000">$17,000</option>
		<option value="17500">$17,500</option>
		<option value="18000">$18,000</option>
		<option value="18500">$18,500</option>
		<option value="19000">$19,000</option>
		<option value="19500">$19,500</option>
		<option value="999000">$20,000 or more</option>
	</select>
	
	<?php if($_GET['MX']=="") { $mpm='999000'; } else { $mpm=$_GET['MX']; } ?>

	<script>document.getElementById('MaxPrice').value="<?php echo $mpm;?>";</script>
		
		  </td>

		</tr>

	  </table>
	  
	  
	  </td>

	  <td colspan="2" rowspan="2" align="left" valign="top">
						  
<table width="511" border="0" cellpadding="0" cellspacing="0" class="lrgspacing">
	
	<tr class="size15"><td align="left" valign="top" class="size15">	
  
		<input type="checkbox" name="amm[]" id="amm[]" onclick="reds(this.value+'&'+this.id);" value='BBQ' <?php echo $checkboxckd1;?>/>BBQ Grill<br />
		
		<input type="checkbox" name="SF" id="SF" onclick="reds(this.value+'&'+this.id);" value='House' <?php echo $checkboxckd2;?>/>Single Family
		
	</td><td align="left" valign="top" class="size15">
		
		<input type="checkbox" name="amm[]" id="amm[]" onclick="reds(this.value+'&'+this.id);" value='Central A/C' <?php echo $checkboxckd3;?>/>Air Conditioning<br />
		
		<input type="checkbox" name="amm[]" id="amm[]" onclick="reds(this.value+'&'+this.id);" value='Boat' <?php echo $checkboxckd4;?>/>Boat Slip	
		
	</td><td align="left" valign="top" class="size15">
		
		<input type="checkbox" name="amm[]" id="amm[]" onclick="reds(this.value+'&'+this.id);" value='Outdoor Pool' <?php echo $checkboxckd5;?>/>Swimming Pool<br />
		
		<input type="checkbox" name="amm[]" id="amm[]" onclick="reds(this.value+'&'+this.id);" value='Outside Shower' <?php echo $checkboxckd6;?>/>Outside Shower
	
	</td></tr><tr class="size15"><td colspan="3" align="left" valign="top" class="size15">		
		
		<img src="images/t.gif" width="16" height="36" /></td>
		
		</tr><tr class="size15"><td colspan="3" align="left" valign="top" class="size15 gray">		
		
	<strong><span id="response"></span> </strong> <em>PROPERTIES THAT MATCH THIS CRITERIA</em>
	
	</td></tr>
	
</table>
	
		</td></tr>

			<tr>

			  <td colspan="2" valign="bottom">
			  
			  
	<input type="hidden" id="btnsubmit" name="btnsubmit"  value="listsubmit" />

	<img onclick="return submitform();" src="images/rentalsearch.jpg" width="465" height="80" alt="Search Vacation Rentals" border="0" style="cursor:pointer;"/>
			  
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

</body><?php require_once('googletagmanager.php'); ?>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>

$(function() {

$("#checkin").datepicker({

dateFormat: "MM dd yy", 
changeMonth: true,
changeYear: true,
numberOfMonths: 1,
minDate: "dateToday",

onClose: function( selectedDate ) {
	
	var instance = $( this ).data( "datepicker" ),
	date = $.datepicker.parseDate(
	instance.settings.dateFormat ||
	$.datepicker._defaults.dateFormat,
	selectedDate, instance.settings );	
	date.setDate(date.getDate()+7);		 
	$("#checkout").datepicker("setDate", date);
 
 },
 onSelect: function(selectedDate) {
	 
		var instance = $( this ).data( "datepicker" ),
		date = $.datepicker.parseDate(
		instance.settings.dateFormat ||
		$.datepicker._defaults.dateFormat,
		selectedDate, instance.settings );
		date.setDate(date.getDate()+7);
		$('#checkout').datepicker('option', 'minDate', date);
		reds(this.value+'&'+this.id);
	}
});

$(function() {
	
    $("#checkin").datepicker("setDate", "<?php echo $arvl;?>");
	
});

$("#checkout").datepicker({

dateFormat: "MM dd yy", 
changeMonth: true,
changeYear: true,
numberOfMonths: 1,
minDate : 7,

});

$(function() {
	
    $("#checkout").datepicker("setDate", "<?php echo $depvl;?>");
	
	});
});

</script>

<script>

function reds(ids){			

	var str = ids;
	var res = str.split("&");
	var val = res[0];
	var valid = res[1];
	
	var checkin = document.getElementById('checkin').value;
	var checkout = document.getElementById('checkout').value;
	var town = document.getElementById('town').value;
	var pets = document.getElementById('petsallowed').value;
	var sleeps = document.getElementById('sleeps').value;
	var bedrooms = document.getElementById('bedrooms').value;
	var bathrooms = document.getElementById('bathrooms').value;
	var internet = document.getElementById('internet').value;
	var Miniprice = document.getElementById('MiniPrice').value;
	var Maxprice = document.getElementById('MaxPrice').value;
	var singlefmly = document.getElementById("SF").checked;
	if(singlefmly==true) {		
		var SF = document.getElementById('SF').value;
	}
		var propertyvalues = new Array();

		ff = document.getElementsByName('amm[]');

  		var ln = ff.length;

  		s=0

  		for(h=0;h<ln;h++){

	  		if(ff[h].checked == true){

	  			propertyvalues[s] = ff[h].value;

	  			s++;

	  		}
		}		
	
	if(Date.parse(checkin) > Date.parse(checkout)){
		
		alert("Invalid Date Range");
		
	} else{
		
		var enddt=checkout;
	}
	
	$.ajax({  
		type: "POST",  
		url: "rental_qrycount.php",  
		data: "checkin="+checkin+"&checkout="+enddt+"&town="+town+"&pet="+pets+"&internet="+internet+"&sleeps="+sleeps+"&bdrm="+bedrooms+"&bthrm="+bathrooms+"&SF="+SF+"&amm="+propertyvalues+"&mpr="+Miniprice+"&mxp="+Maxprice,
		beforeSend: function()
		{
			$('html, body').animate({scrollBottom:0}, 'slow');
			$("#response").html('<img src="images/ajax-loader.gif" alt="Loading..." align="absmiddle"> Loading...');
		},  
		success: function(response)
		{			
		
		$("#response").html(response); 
		
		}
	});	
	
 }
 
$(window).load(function(){
	reds('36');
});

</script>


</html>

