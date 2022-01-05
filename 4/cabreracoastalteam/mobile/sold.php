<?php

	session_start();

	require_once('../config.php');
	
include('../city-query.php');


define('DEF_PAGE_SIZE', 100);

$pagesize=100;

@extract($_POST);

@extract($_GET);



	if($_POST['sort_data']=='Sort Data'){		

	$selct='';
		if($_POST['select_feature']!=''){
			$selct .=$_POST['select_feature'];
		}	
		if($_POST['startdate']!=''){
			$selct .='&sd='.$_POST['startdate'];
		}	
		if($_POST['enddate']!=''){
			$selct .='&ed='.$_POST['enddate'];
		}	

	echo "<script>window.location.href='sold.php?sl=".$selct."';</script>";
		
	}	


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Cabrera Team - Sold Properties</title>

<link rel="canonical" href="http://cabreracoastalteam.com/sold.php" />

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
<style>
body,td,th {font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; font-size: 14px; color: #333; -webkit-text-size-adjust:none;}
</style>
</head>


<body>

<form enctype="multipart/form-data" name="sold" id="sold" method="POST">

<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="100%"><table width="1080" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>

        <td width="232"><a href="../sold.php?Mobile=Off"><img src="images/fullsite.png" width="232" height="248" border="0"/></a></td>

        <td width="201"><a href="https://www.google.com/maps/place/Cabrera+Coastal+Real+Estate/@38.977306,-74.833419,17z/data=!3m1!4b1!4m2!3m1!1s0x89bf562e830dd59d:0x48eca07ed1663b46?hl=en" target="_blank"><img src="images/directions.png" width="201" height="248" border="0"/></a></td>

        <td width="216"><a href="tel:6097290559"><img src="images/call.png" width="216" height="248" border="0"/></a></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td><a href="index.php"><img src="images/cabreracoastalrealestate.png" width="1080" height="316" border="0"/></a></td>

  </tr>

  <tr>

    <td><img src="images/t.gif" width="30" height="80" /></td>

  </tr>

   <tr>

    <td>
	
	<h1>SOLD PROPERTIES IN CAPE MAY COUNTY</h1>

	<b style="font-size:20px">TYPE: </b>
		
		<select name="select_feature" id="select_feature" style="font-size: 18px;">

                <option selected="selected">All Features</option>

                <option value="Single Family" >Single Family</option>

                <option value="Condo" >Condominium</option>

                <option value="Townhouse" >Townhouse</option>

                <option value="Multi Family" >Multi Family</option>

                <option value="Vacant Lot" >Lot / Land</option>
				
				</select>

                <input type="submit" name="sort_data" id="sort_data" value="Sort Data" /></td>

		  </td>		
	</tr>
		
  <tr>

    <td><img src="images/t.gif" width="30" height="40" /></td>

  </tr>
	  <tr>
        <td>
          <table width="1080" border="0" cellspacing="0" cellpadding="0">

            <tr>
              <td><table width="1050" border="0" cellspacing="1" cellpadding="6">
                <tr>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="160" align="center" bgcolor="#195CAB"><a style="font-size: 12px;" href="avalonsold.php" class="whitelink">AVALON / STONEHARBOR</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="70" align="center" bgcolor="#195CAB"><a style="font-size: 12px;" href="capemaysold.php" class="whitelink">CAPE MAY</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="118" align="center" bgcolor="#195CAB"><a style="font-size: 12px;" href="wildwoodcrestsold.php" class="whitelink">WILDWOOD CREST</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="78" align="center" bgcolor="#195CAB"><a style="font-size: 12px;" href="wildwoodsold.php" class="whitelink">WILDWOOD</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="116" align="center" bgcolor="#195CAB"><a style="font-size: 12px;" href="westwildwoodsold.php" class="whitelink">WEST WILDWOOD</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="121" align="center" bgcolor="#195CAB"><a style="font-size: 12px;" href="northwildwoodsold.php" class="whitelink">NORTH WILDWOOD</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="119" align="center" bgcolor="#195CAB"><a style="font-size: 12px;" href="lowertownshipsold.php" class="whitelink">LOWER TOWNSHIP</a></td>
                  <td width="2"><img src="images/t.gif" width="2" height="10" /></td>
                  <td width="125" align="center" bgcolor="#195CAB"><a style="font-size: 12px;" href="middletownshipsold.php" class="whitelink">MIDDLE TOWNSHIP</a></td>
                  <td width="2" align="center"><img src="images/t.gif" width="2" height="10" /></td>
                </tr>
              </table></td>
            </tr>


            <tr>

              <td bgcolor="#1E8BCC" align="center">
			  <table width="1050" align="center" border="0" cellspacing="4" cellpadding="9">

                <tr>

                  <td bgcolor="#EEF7FD"><p>Select a location above for sold properties by that specific location. Below is a list of the most recently sold properties in Cape May County!</p>

                    <table width="1050" border="0" cellspacing="1" cellpadding="6">

                      <tr>

                        <td width="80" bgcolor="#CCCCCC"><strong>SOLD DATE</strong></td>

                        <td width="60" bgcolor="#CCCCCC"><strong>DAYS ON MARKET</strong></td>

                        <td width="170" bgcolor="#CCCCCC"><strong>ADDRESS</strong></td>

                        <td width="166" bgcolor="#CCCCCC"><strong>CITY</strong></td>

                        <td width="160" bgcolor="#CCCCCC"><strong>STYLE</strong></td>

                        <td width="55" bgcolor="#CCCCCC"><strong>MLS</strong></td>

                        <td width="50" bgcolor="#CCCCCC"><strong>ASKING PRICE</strong></td>

                        <td width="80" bgcolor="#CCCCCC"><strong>SOLD PRICE</strong></td>

                      </tr>

					   <?php

				
				   $i=1;

                   while($resultarray = @mysql_fetch_array($result))

				   {

					if($i%2==0)

							$bgcolor="#FBFDD5";

						else

							$bgcolor="#E9E9E9";

                 

					?>

                      <tr>
                       <td bgcolor="<?php echo $bgcolor; ?>"><?php echo date('m/d/Y',strtotime($resultarray['closingdate'])); ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['Days_On_Market'] ?> Days</td>
                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['Address'] ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['City'] ?></td>
                       <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['Type'] ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $resultarray['MLSNo'] ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>">$<?php  echo number_format( $resultarray['Asking_Price']) ?></td>
                        <td bgcolor="<?php echo $bgcolor; ?>">$<?php  echo number_format( $resultarray['soldprice']) ?></td>
                      </tr>

                      

					  <?php

					 $i=$i+1;

					  }

					  ?>

                     <tr><td colspan="2">

<em>Listing <?=$start+1 ?> - <?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize) ?> of  <?=$reccnt ?> Properties</em></td>

<td colspan="8" align="right"><em><?php include("../paging.inc1.php");?></a></em>

                     </td></tr>	

                    </table></td>

                </tr>

              </table></td>

            </tr>

          </table>
	
	
	</td>

  </tr>

  <tr>

    <td><img src="images/t.gif" width="30" height="80" /></td>

  </tr>

  <tr>

    <td>
	
	<table width="1080" border="0" cellspacing="0" cellpadding="0">

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

</form>

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

</body><?php require_once('googletagmanager.php'); ?>

</html>

