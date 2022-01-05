<?php

	session_start();

	require_once('config.php');

	$months = array("January","February","March","April","May","June","July","August","September","October","November","December");

	

	$qry=mysql_query("update  tbl_events set deletestatus=1 WHERE DATE_FORMAT(NOW(),'%m/%d/%Y') > DATE_FORMAT(FROM_UNIXTIME(eventdate),'%m/%d/%Y') and eventdate != ''");

	$qry=mysql_query("update  tbl_events set deletestatus=1 WHERE DATE_FORMAT(NOW(),'%m/%d/%Y') > DATE_FORMAT(FROM_UNIXTIME(customdate),'%m/%d/%Y') and customdate != ''");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="keywords" content="Cabrera, Real Estate, Events, Cape May, Wildwood, " />

<meta http-equiv="description" content="Local family events in Cape May and Wildwood New Jersey." />

<meta name="robots" content="index, follow" />

<title>Cape May and Wildwood Events</title>

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

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

    <td><?php include("header.php")?></td></tr>

  

  <tr>

    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

      <tr>

        <td><h1><pre>EVENTS IN CAPE MAY, WILDWOOD &amp; THE SURROUNDING AREAS</pre></h1>
<p><a href="http://www.wildwoodsnj.com/calendar.cfm" target="_blank"><img src="localevents.jpg" width="791" height="132" border="0" /></a></p>
		  <?php

						for ($k=0;$k<=11;$k++)

						{

							$month=$months[$k];

							$mon=$k+1;

							$eventres=mysql_query("SELECT * FROM tbl_events where MONTH(FROM_UNIXTIME(eventdate ))=".$mon." and YEAR(FROM_UNIXTIME(eventdate))=YEAR(NOW()) and deletestatus != 1 order by eventdate");

							$i=0;

							while ($eventrow=mysql_fetch_array($eventres))

							{

							$eventdatevalue=date('F jS Y',$eventrow['eventdate']);

							$i=$i+1;

							if ($i<=1)

							echo "<h3><u>".strtoupper($month)." EVENTS</u></h3>";

					?>

					<table width="1122" border="0" cellspacing="0" cellpadding="0">

		<tr>		

        <td width="975"><span class="spacing"><span class="style8"><strong><?php echo stripslashes($eventrow['eventname']);?></strong></span><br />



		<?php echo $eventdatevalue;?> - <?php echo $eventrow['city'];?><br />

		<?php echo stripslashes($eventrow['event_desc']);?></span></td>

						  </tr>

						</table>

						<br />

					 

					<?php

							}

						}

					?>

				</td>

            </tr> </span></p></td>

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

        <td><table width="220" border="0" align="center" cellpadding="0" cellspacing="0">

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

