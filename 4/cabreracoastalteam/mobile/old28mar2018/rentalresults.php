<?php 



session_start(); 



require_once('../config.php');	

	



	$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	if($_SERVER['QUERY_STRING']=='') {

		$queryString ="&start=0";

	} else {

		$queryString = $_SERVER['QUERY_STRING'];

	}





	require_once("../rental_qry.php");

	

	

$actuallink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];



$queryurl = $_SERVER['QUERY_STRING'];



$_SESSION['link']="$actuallink?$queryurl";		



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Cabrera Coastal Team Rentals Properties- Mobile</title>



<link href="styles.css" rel="stylesheet" type="text/css">



<?php 



$base_url="http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\');



$pagenamein=str_replace("mobile","",$base_url);



?>

<link rel="canonical" href="<?php echo $pagenamein.'rentalresults.php?'.$_SERVER['QUERY_STRING'];?>"/>



<link rel="SHORTCUT ICON" href="images/cabrera.ico">



<script>



  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){



  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),



  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)



  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');



  ga('create', 'UA-47104613-18', 'auto');



  ga('send', 'pageview');



</script>



</head>







<body>



<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">



  <tr>



    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>



        <td width="232">

		<a href="../rentalresults.php?Mobile=Off&<?php echo $_SERVER['QUERY_STRING'];?>">

		

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



    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td width="372"><a href="forsale.php"><img src="images/forsale.png" width="372" height="356" border="0"/></a></td>



        <td width="333"><a href="rentals.php"><img src="images/rentals.png" width="333" height="356" border="0"/></a></td>



        <td width="375"><a href="ourcompany.php"><img src="images/ourcompany.png" width="375" height="356" border="0"/></a></td>



        </tr>



    </table></td>



  </tr>



 <tr>

	<td align="center">				

		

	<table width="980" border="0" cellspacing="0" cellpadding="0">

	  <tr>

		<td align="center" colspan="2">

		

		<?php  $page_informationrepls=str_replace("images","../images",$page_information);



		echo $page_informationrepls; ?>

		

		</td>

	  </tr>

	<tr>

	  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>

	</tr>	

	

	<tr>

	  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>

	</tr>

	<tr>

	  <td colspan="3" align="left" bgcolor="#C2C1BE"><img src="images/t.gif" width="40" height="4" /></td>

	</tr>

	<tr>

	  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>

	</tr>

		  

	<tr><td align="center" colspan="2"><span class="size45">



	<?php $nezlr="vacationrentals.php?".$_SERVER['QUERY_STRING']."";?>



	<a href="<?php echo $nezlr;?>" >MODIFY YOUR SEARCH CRITERIA</a></span><br />



	</td></tr>	

		

	<tr>

	  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>

	</tr>

	<tr>

	  <td colspan="3" align="left" bgcolor="#C2C1BE"><img src="images/t.gif" width="40" height="4" /></td>

	</tr>

	<tr>

	  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>

	</tr>	

	

	<tr><td align="center">

		

		<?php 



		$checkindate=date('m/d/Y', strtotime($_GET['checkin']));



		$checkoutdate=date('m/d/Y', strtotime($_GET['checkout']));



		?>You Have <strong><?=$reccnt?>



		</strong> Vacation Rentals That Meet Your Criteria<br />



		Rental Period: <strong><?php echo $checkindate;?> - <?php echo $checkoutdate;?></strong>

		  

	</td></tr>

	<tr>

	  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>

	</tr>	



	<tr><td colspan="2" align="center">



	<table width="100%" border="0" cellspacing="0" cellpadding="0">



	<tr><td width="100%" align="center" class="size14 spacing gray">

	

	<em>Listing <strong><?= $start+1?></strong><?=$textbox?> -??<strong><?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize)?></strong> of <strong><?=$reccnt?></strong> Listings</em>



	<br/><?php include("paging.inc.php");?>

	

	</td></tr></table></td></tr>



	<tr><td align="center">

	<?php 

	

	$i=0;		



	while($resultarray=mysql_fetch_array($result)) {



		$cnd='';



		if(isset($_GET['checkin'])) { 



			$cnd .="&checkin=".$checkindate."&checkout=".$checkoutdate;

		} 

		if(isset($_GET['pageno'])) { 



			$cnd .= "&pageno=".$_GET['pageno']; 

		}		

		if(isset($resultarray['rate'])) { 



			$cnd .= "&Price=".$resultarray['rate']; 

		}		

		$referenceid=$resultarray['referenceid'];

		

		$cid=$resultarray['cid'];

		

		$imgPreview=$resultarray['imgPreview'];

		

		$pgurl="rentalproperty.php?RefId=".$referenceid."&cid=".$cid.$cnd;

	

	 ?>

	 

	  <table width="100%" border="0" cellspacing="20" cellpadding="0">

			<tr>

			  <td colspan="3" align="left" bgcolor="#C2C1BE" class="size30">

			  <img src="images/t.gif" width="40" height="4" /></td>

			</tr>

			<tr>

			  <td colspan="3" width="100%" align="left">

			  

				<strong><a href="<?php echo $pgurl;?>">

			  

			  <?php echo $resultarray['propertyheadline'];?>

			  

			  </a></strong>

			  

			  </td>

            </tr>

    

            <tr>

              <td width="430" align="center">

			  

			<a href="<?php echo $pgurl;?>">

			  

		<img src="<?php echo $imgPreview;?>" width="430" height="335px" border="0"/>

			  

			  </a>

			  

			  </td>            

              

			  <td width="100%" align="left" valign="middle">

			

			<table width="100%" border="0" cellspacing="0" cellpadding="10">            

			<tr>

              <td colspan="2">  

			  

			Price: <strong><?php if($resultarray['rate'] > 0){ echo '$'.number_format($resultarray['rate']); } else { echo 'N/A';} ?></strong>

			

				</td>

			</tr>

			<tr>

              <td width="150px">

			  

           Beds: <strong><?php if($resultarray['bedroom'] > 0){ echo $resultarray['bedroom']; } else { echo '0';} ?></strong>

			

				</td>

				

				<td>

				

		Baths: <strong><?php if($resultarray['bathroom'] > 0){ echo $resultarray['bathroom']; } else { echo '0';} ?></strong>

		

				</td>

			</tr>



			<tr>

              <td colspan="2">

			

        Location: <strong><?php echo $resultarray['city'];?></strong>

			

				</td>

			</tr>		



			<tr>

               <td colspan="2"> 

            

		Style: <strong><?php echo $resultarray['propertytype'];?></strong>

			

				</td>

			</tr>	



			<tr>

               <td colspan="2"> 

            

		Key: <strong><?php echo $resultarray['cid'];?></strong>

			

				</td>

			</tr>

			

			</table>

			     </td>

				 

            </tr>

			

          <tr>

			<td colspan="3" align="left" class="size30 medspacing">

			

	<?php

	if(trim($resultarray['propertydesc'])!=''){

		

		$disc=$resultarray['propertydesc'];



	echo substr(strip_tags($disc),0,100);?> 



	<?php if (strlen(strip_tags($disc))>100) { ?>



	&nbsp;...<a href="<?php echo $pgurl;?>">More &gt;</a> 



	<?php 

	

	} 

	

	}

	?> 

			

			</td>

		  </tr>		

		  </table>



	 <?php 

		$i++;

		}

		?>					  

		  </td></tr></table>		

		

		</td>

      </tr>

  

  <tr>

		  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>

		</tr>

		<tr>

		  <td colspan="3" align="left" bgcolor="#C2C1BE"><img src="images/t.gif" width="40" height="4" /></td>

		</tr>

		<tr>

		  <td colspan="3" align="left"><img src="images/t.gif" width="40" height="30" /></td>

		</tr>



		<tr><td colspan="2" align="center">



		<table width="100%" border="0" cellspacing="0" cellpadding="0">



		<tr><td width="100%" align="center" class="size14 spacing gray">



		<em>Listing <strong><?=$start+1?></strong><?=$textbox?> -??<strong><?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize)?></strong> of <strong><?=$reccnt?></strong> Listings</em>



		<br/><?php include("paging.inc.php");?>



		</td></tr></table></td></tr>

		

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



</html>



