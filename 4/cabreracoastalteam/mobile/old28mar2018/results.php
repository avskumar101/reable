<?php



	session_start();



	require_once('../config.php');



define('DEF_PAGE_SIZE', 10);



$pagesize=10;



@extract($_POST);



@extract($_GET);





require_once("../mls_query_res.php");



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Cabrera Coastal Team - Mobile For Sale Results</title>



<?php



$actuallink=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



$pagenamein=str_replace("/mobile","",$actuallink);



?>



<link rel="canonical" href="<?php echo $pagenamein;?>"/>



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



</head>







<body>



<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">



  <tr>



    <td width="100%"><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>



        <td width="232"><a href="../results.php?<?php echo $_SERVER['QUERY_STRING'];?>">

		

		<img src="images/fullsite.png" width="232" height="248" border="0"/></a></td>



        <td width="201"><a href="https://www.google.com/maps/place/Cabrera+Coastal+Real+Estate/@38.977306,-74.833419,17z/data=!3m1!4b1!4m2!3m1!1s0x89bf562e830dd59d:0x48eca07ed1663b46?hl=en" target="_blank"><img src="images/directions.png" width="201" height="248" border="0"/></a></td>



        <td width="216"><a href="tel:6097290559"><img src="images/call.png" width="216" height="248" border="0"/></a></td>



      </tr>



    </table></td>



  </tr>



  <tr>



    <td><a href="index.php">

	<img src="images/cabreracoastalrealestate.png" width="1080" height="316" border="0"/></a></td>



  </tr>



  <tr>



    <td>&nbsp;</td>



  </tr>



  <tr>



    <td align="center">LISTING <?= $start+1?> - <?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize)?> of <?=$reccnt?> PROPERTIES</td>



  </tr>



  <tr>



    <td>&nbsp;</td>



  </tr>



  <tr>



    <td align="center"><span class="largefont3">

	

	<a href="search.php?<?php echo $_SERVER['QUERY_STRING'];?>">

	

	<strong>MODIFY SEARCH CRITERIA</strong></a></span></td>



  </tr>



  <tr>



    <td>&nbsp;</td>



  </tr>

  

  <tr><td>

	

	<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td width="200">

			<?php

				if (isset($_GET['start']))

                $start=$_GET['start'];

                else

                $start=0;

                if($reccnt>$pagesize){

                $num_pages=$reccnt/$pagesize;

                $PHP_SELF=$_SERVER['PHP_SELF'];

                $qry_str=$_SERVER['argv'][0];

                $m=$_GET;

                unset($m['start']);

                $qry_str=qry_str($m);

                $j=$start/$pagesize-9;

                if($j<0) {

                    $j=0;

                }

                $k=$j+10;

                if($k>$num_pages)	{

                    $k=$num_pages;

                }

                $j=intval($j);

                

                ?>

					<?php

					if($start!=0) 

					{

					?>

					<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start-$pagesize?>">

					

                   <img src="images/arrowleft.png" width="236" height="236" /></a>

					

					<?php

					}

					?>

				</td><td width="250">

				<img src="images/t.gif" width="250" height="30" /></td><td width="200">

					 <? 

					if($start+$pagesize < $reccnt)

					{

					?> 

					<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start+$pagesize?>">

                   <img src="images/arrowright.png" width="236" height="236" /></a>

					<?php

					}					

				}

				?>	

		</td>

      </tr>

    </table>

	</td>

  </tr>

  

  



  <tr>



    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td><img src="images/t.gif" width="30" height="60" /></td>



      </tr>



      <tr>



        <td bgcolor="#CCCCCC"><img src="images/t.gif" width="30" height="4" /></td>



      </tr>



      <tr>



        <td><img src="images/t.gif" width="30" height="60" /></td>



      </tr>



    </table></td>



  </tr>



	<?php

	while($resultarray=mysql_fetch_array($result)) {



		if ($resultarray['mainimg']!='')

			$image=$resultarray['mainimg'];

		else



			$image="../images/nopicture.png";

	?>



  <tr>



    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td width="500"><a href="property.php?MLSNo=<?php echo $resultarray['MLSNo'];?>"><img src="<?php echo $image;?>" width="500" height="375" border="0"/></a></td>



        <td width="40"><img src="images/t.gif" width="40" height="30" /></td>



        <td width="540" align="left" valign="middle"><p><strong><a href="property.php?MLSNo=<?php echo $resultarray['MLSNo'];?>" class="largefont2"><?php echo $resultarray['Address'] ?></a></strong></p>



          <p class="spacing">CITY: <strong><?php echo $resultarray['City'] ?></strong><br />



            ACTIVE: <strong>$<?php echo number_format($resultarray['Asking_Price']);?></strong><br />



            MLS: <strong><?php echo $resultarray['MLSNo'] ?></strong><br />



            BEDS: <strong><?php echo $resultarray['Bedrooms'] ?></strong> &nbsp; &nbsp; &nbsp; BATHS: <strong><?php echo $resultarray['Full_Baths'] ?></strong><br />



          TYPE: <strong><span style="text-transform: uppercase;"><?php echo $resultarray['Type'];?></span></strong></p></td>



      </tr>



      <tr>



        <td colspan="3"><table width="1080" border="0" cellspacing="0" cellpadding="15">



          <tr>



            <td class="spacing"><?php echo substr(strip_tags($resultarray['Remarks']),0,180);?>...</td>



            </tr>



          </table></td>



      </tr>



    </table></td>



  </tr>



  <tr>



    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td><img src="images/t.gif" width="30" height="30" /></td>



      </tr>



      <tr>



        <td bgcolor="#CCCCCC"><img src="images/t.gif" width="30" height="4" /></td>



      </tr>



      <tr>



        <td><img src="images/t.gif" width="30" height="45" /></td>



      </tr>



    </table></td>



  </tr>



	<?php



	  }



	  ?>



	  

	  <tr><td>

	

	<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td width="200">

			<?php

				if (isset($_GET['start']))

                $start=$_GET['start'];

                else

                $start=0;

                if($reccnt>$pagesize){

                $num_pages=$reccnt/$pagesize;

                $PHP_SELF=$_SERVER['PHP_SELF'];

                $qry_str=$_SERVER['argv'][0];

                $m=$_GET;

                unset($m['start']);

                $qry_str=qry_str($m);

                $j=$start/$pagesize-9;

                if($j<0) {

                    $j=0;

                }

                $k=$j+10;

                if($k>$num_pages)	{

                    $k=$num_pages;

                }

                $j=intval($j);

                

                ?>

					<?php

					if($start!=0) 

					{

					?>

					<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start-$pagesize?>">

					

                   <img src="images/arrowleft.png" width="236" height="236" /></a>

					

					<?php

					}

					?>

				</td><td width="250">

				<img src="images/t.gif" width="250" height="30" /></td><td width="200">

					 <? 

					if($start+$pagesize < $reccnt)

					{

					?> 

					<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start+$pagesize?>">

                   <img src="images/arrowright.png" width="236" height="236" /></a>

					<?php

					}					

				}

				?>	

		</td>

      </tr>

    </table>

	</td>

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



</html>



