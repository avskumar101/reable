<?php



include('../config.php');





if($_POST['btnsubmit']=='listsubmit') {	

	

	

	mysql_query("TRUNCATE TABLE  `search_results_data`");

	 

	$checkindate=date('Y-m-d', strtotime($_POST['checkin']));	



	$checkoutdate=date('Y-m-d', strtotime($_POST['checkout']));

	

	$wherecond="";

	// bedrooms	

	if($_POST['bedrooms']!='') {			

		$wherecond.=" and bedroom >= '".$_POST['bedrooms']."'";		

	}	

	// bathrooms	

	if($_POST['sleeps']!='') {

		$wherecond.=" and sleepupto >= '".$_POST['sleeps']."'";

	}



	

	// Availability

	$dataavl="";		

			

	$cond=" and (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ";

		

	$STM2 = mysql_query("SELECT * FROM rental_properties_rates_rs where active='0' $cond group by referenceid");

		

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

	$minprice= 0;

	$maxprice= 999000;	

	if($minprice!='' || $maxprice!='') {

	

		$cnd=$avble;

	

		$rateinf = " and Rate BETWEEN '".$minprice."' AND '".$maxprice."' AND (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ".$cnd." group by referenceid";

							

$STM1 = mysql_query("SELECT * FROM rental_properties_rates_info where referenceid!='0' $rateinf");

				

		$rts='';

		$p=1;	

		while($avln = mysql_fetch_array($STM1))

		{

								

			if($prc=='') {

				

				$rts.=" and ( referenceid='".$avln['referenceid']."'";

				$prc='available';

				

			} else {

				

				$rts.=" or referenceid='".$avln['referenceid']."'";

			}	

							

		$p++;		

		}

		

		if($prc=='available') {	

		

			$able=$rts.')';	



			$avbles= $able;

			$dataavl="available";		

		}		

				

	} else {

		

		$avbles= $avble;

		$dataavl="available";

	}



	$wherecond.= $avbles;	

	

	if($dataavl=='available') {

		

		$mysql= $wherecond;

	}		

	

	$amne="";

	if($_POST['internet']==1) {



		$amne.= " and amenity_label like '%Wifi%' or amenity_label like '%High Speed Internet%'";

	}	

		

	if($amne!='') {

					

		$STM3 = mysql_query("SELECT * FROM rentals_properties_amenity where referenceid!='0' $mysql $amne group by cid");



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



		// 	Selected Ucode Only //	

		if($condinsert!="") {

		

			$mysql.= " and cid in ('".$condinsert."')";

		}

		

	}

	

		// Location	

	if($_POST['town']!='') {

		

		$lcn=$_POST['town'];

		

		$mysql.=" and city='".$lcn."'";

	}	

	



	$stmt5 = mysql_query("SELECT * FROM search_results where HideList='0' $mysql order by propertyheadline asc");

				

	$i=0;	

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

		

			$pgrepimg='../images/piccomingsoon.jpg';

		}

	

		$propertyheadline=mysql_real_escape_string($avl['propertyheadline']);	

		//$propertyheadline=mysql_real_escape_string($avl['street'].' - '.$avl['city']);	

		

		$cityname=$avl['city'];

		$bedroom=$avl['bedroom'];

		$bathroom=$avl['bathroom'];

		$sleepupto=$avl['sleepupto'];

		$location=$avl['location'];

		$propertytype=$avl['propertytype'];

		$disc=mysql_real_escape_string($avl['propertydesc']);

	

	

	

	

	$stmt= mysql_query("insert into search_results_data(cid, referenceid, city, propertyheadline, bedroom, bathroom, sleepupto, location, rate, propertydesc, imgPreview,propertytype)values('$cid','$referenceid','$cityname','$propertyheadline','$bedroom','$bathroom','$sleepupto','$location','$rate','$disc','$pgrepimg','$propertytype')");

	

	}





	$_SESSION['searchby']="detailed";



	$_SESSION['selbegin']=$_POST['selbegin'];



	$_SESSION['selnumweeks']=$_POST['selnumweeks'];



	$_SESSION['streets']=$_POST['streets'];



	$_SESSION['sleeps']=$_POST['sleeps'];



	$_SESSION['unitkey']=$_POST['unitkey'];



	$_SESSION['uad']=$_POST['uad'];

	



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

	if($_POST['internet']==1){



		$cont .="&INT=".$_POST['internet']."";

	}	

	

		// checkbox  start//

	

	if($_POST['air']=="1")

	{

		$cont.= "&AI=1";

	}

	if($_POST['bbq']=="1")

	{

		$cont.= "&BB=1";

	}	

	if($_POST['swim']=="1")

	{

		$cont.= "&SW=1";

	}		

	if($_POST['boat']=="1")

	{

		$cont.= "&BT=1";

	}	

	if($_POST['sfmly']=="1")

	{

		$cont.= "&SF=1";

	}	

	if($_POST['outside']=="1")

	{

		$cont.= "&OS=1";

	}	

	

		// checkbox end //	

		

	$checkin=date('m/d/Y', strtotime($_POST['checkin']));

	$checkout=date('m/d/Y', strtotime($_POST['checkout']));



	header("Location:rentalresults.php?vr=view&checkin=".$checkin."&checkout=".$checkout."$cont");

	

}

	

$pagedata=mysql_fetch_array(mysql_query("select * from  tbl_homepage where id='22'"));

	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title><?php echo $pagedata['meta_title'];?></title>



<?php 



$directoryURI =basename($_SERVER['SCRIPT_NAME']);



$filename=$directoryURI;   



$base_url="http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\');



$pagenamein=str_replace("mobile","",$base_url);



?>

<link rel="canonical" href="<?php echo $pagenamein.$filename;?>"/>



<link href="styles.css" rel="stylesheet" type="text/css">



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





<script>



function submitform() {



	document.getElementById("load").style.display = "none";

	

	document.forms["rentalsearch1"].submit();

	

	return true;

}



</script>

<style>

.size40 {font-size: 40px;}

</style>

</head>







<body>



<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">



  <tr>



    <td width="100%">

	

		<form name="rentalsearch1" id="rentalsearch1" method="POST" >

	

	<table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>



        <td width="232">

		<a href="../vacationrentals.php?Mobile=Off&<?php echo $_SERVER['QUERY_STRING'];?>">

		

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



    <td><img src="images/t.gif" width="30" height="100" /></td>



  </tr> 



  

  <tr><td align="center">

  

		<?php echo stripslashes($pagedata['content']);?>

	

	<table width="970" border="0" cellspacing="8" cellpadding="0">

         

	<tr>

	<td align="center" width="200px"><span class="red">*</span>

	<u><strong>CHECK IN DATE</strong></u>

	</td>

	<td align="center" width="400px">

	<strong><span class="red">*</span><u>CHECK OUT DATE</u></strong>

	</td>

	</tr>

	

	  <tr>

        <td colspan="2" align="left"><img src="images/t.gif" alt="" width="30" height="20" /></td>

      </tr>

	

      <tr>

        <td width="400px" align="center">

		

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

	<input id="checkin" class="size40" type="text" value="<?php echo $arvl;?>" name="checkin" />

	

			

	</td>

	

	<td width="400px" align="center">

          

		  

	<input name="checkout" class="size40" id="checkout" type="text" value="<?php echo $depvl;?>" />

		  

	</td>

	

	</tr>

	

	    <tr>

        <td colspan="2" align="left"><span class="size60">

		<img src="images/t.gif" alt="" width="30" height="30px" /></span></td>

      </tr>

	  

	  

     <tr><td align="center"><strong>

	

	<u>BEDROOMS</u></strong><br />

           

		

	<select id="bedrooms" name="bedrooms" class="size40">

	

		<option VALUE="" selected="selected"> No Preference </option>		

			

		<option VALUE="1" class="optnvl"> 1+ </option>

		

		<option VALUE="2" class="optnvl"> 2+ </option>

		

		<option VALUE="3" class="optnvl"> 3+ </option>

		

		<option VALUE="4" class="optnvl"> 4+ </option>

		

		<option VALUE="5" class="optnvl"> 5+ </option>

		

		<option VALUE="6" class="optnvl"> 6+ </option>

		

		<option VALUE="7" class="optnvl"> 7+ </option>

		

				

		

	</select>



	<?php 

	if($_GET['BD']!='')

	{

		$bedroomsvalw=$_GET['BD'];

	}

	else{

		$bedroomsvalw='';

	}

	?>	

	<script> document.getElementById('bedrooms').value="<?php echo $bedroomsvalw; ?>";</script>

		

			

	</td>

	

	

	<td align="center">

		

		<u><strong>SLEEPS</u></strong><br />

           



	<select id='sleeps' name="sleeps" class="size40">



	  <option value="" selected="selected">No Preference</option>



	  <option value="2">2+</option>



	  <option value="4">4+</option>



	  <option value="6">6+</option>



	  <option value="8">8+</option>



	  <option value="10">10+</option>



	  <option value="12">12+</option>



	  <option value="14">14+</option>



	  <option value="16">16+</option>



	  <option value="18">18+</option>



	</select>



	<?php 

	if($_GET['SLP']!='')

	{

		$sleepsvalw=$_GET['SLP'];

	}

	else{

		$sleepsvalw='';

	}

	?>	

	<script> document.getElementById('sleeps').value="<?php echo $sleepsvalw; ?>";</script>		

		

	</td>

	

	

      </tr>

	  

      <tr>

        <td colspan="2" align="left"><span class="size60">

		<img src="images/t.gif" alt="" width="30" height="30" /></span></td>

      </tr>

    



	<tr>

        <td colspan="2" align="center"><strong class="size30">

		

		<u>LOCATION</u></strong><br />

		

		

		<select name="town" id="town" class="size40">



			<option value=""> No Preference </option>

			

			<option value="Wildwood Crest"> Wildwood Crest </option>	

			

			<option value="Wildwood"> Wildwood </option>	

			

			<option value="North Wildwood"> North Wildwood </option>	

			

			<option value="Stone Harbor"> Stone Harbor </option>	

			

			<option value="Avalon"> Avalon </option>	



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

	  

      <tr>

        <td colspan="2" align="left"><span class="size60"><img src="images/t.gif" alt="" width="30" height="30" /></span></td>

      </tr>

	  

      <tr>

        <td colspan="2" align="center">

		

	<input type="hidden" id="btnsubmit" name="btnsubmit"  value="listsubmit" />



	<img src="../images/rentalsearch.jpg"  style="display:black;" id="load" onclick="return submitform();" width="490" height="100" border="0"/>

	

			

		</td>

      </tr>

	  	

	    <tr>

        <td colspan="2" align="left"><span class="size60"><img src="images/t.gif" alt="" width="30" height="30px" /></span></td>

      </tr>

    </table>

		

		

		</td>

      </tr>

	  

	  



  <tr>



    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td><img src="images/t.gif" width="30" height="40" /></td>



      </tr>



      <tr>



        <td bgcolor="#CCCCCC"><img src="images/t.gif" width="30" height="4" /></td>



      </tr>



      <tr>



        <td><img src="images/t.gif" width="30" height="40" /></td>



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

minDate : 1,



});



$(function() {

	

    $("#checkout").datepicker("setDate", "<?php echo $depvl;?>");

	

	});

});



</script>



</html>



