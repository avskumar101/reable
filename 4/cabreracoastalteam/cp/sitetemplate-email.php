<?php

session_start();

require_once('../config.php');

require_once('captcha/captcha.php');

if(isset($_SESSION['uid'])=="" )

header("Location: ../index.php");

$userid=$_SESSION['uid'];



$ID = $_GET['id'];	

if($_POST['email']!='')	{

	$contact_mail=$_POST['contact'];

	$listrental_mail=$_POST['listrental'];

	$listsales_mail=$_POST['listsales'];

	$request_mail=$_POST['request'];

	$requestrental=$_POST['requestrental'];

	$requestletushelp=$_POST['requestletushelp'];

	$web_email=$_POST['webmail'];

	$find_rentail=$_POST['findrental'];
	
	$requesttows=$_POST['requesttows'];

	$send_friend=$_POST['friend'];

if($_POST['captcha']!='') {

	if(captcha_validate()) {
		

	 if (mysql_num_rows(mysql_query("select * from tbl_website_email"))<=0)  {

		mysql_query("insert into  tbl_website_email(contact_email, 	listrental_email,listsales_email,request_email,web_email,find_rentail,send_friend,request_rental,request_letushelp,requesttows) values ('".$contact_mail."','".$listrental_mail."','".$listsales_mail."','".$request_mail."','".$web_email."','".$find_rentail."','".$send_friend."','".$requestrental."','".$requestletushelp."','".$requesttows."')");

	} else {

		mysql_query("update  tbl_website_email set  contact_email='".($contact_mail)."',listrental_email='".mysql_real_escape_string($listrental_mail)."',listsales_email='".mysql_real_escape_string($listsales_mail)."',request_email='".mysql_real_escape_string($request_mail)."',web_email='".mysql_real_escape_string($web_email)."',find_rentail='".mysql_real_escape_string($find_rentail)."', send_friend='".mysql_real_escape_string($send_friend)."', request_rental='".mysql_real_escape_string($requestrental)."', request_letushelp='".mysql_real_escape_string($requestletushelp)."', requesttows='".mysql_real_escape_string($requesttows)."'");

	}

	

		echo "<script>alert('Your updates have been saved.');window.location.assign(document.URL);</script>";
		
		
	} else {

		echo "<script>alert('You were not successful in typing in the correct image verification, please try again.')</script>";

		$msg='<p style="color:red">Failure! You entered the wrong code!</p>';

		}  

	} else {

		echo "<script>alert('You were not successful in typing in the correct image verification, please try again.')</script>";

		$msg='<p style="color:red">Failure! Please Enter the code</p>';

		}

	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

<title>Cabrera Team Control Panel</title>

<link href="../styles.css" rel="stylesheet" type="text/css">

<link rel="SHORTCUT ICON" href="../images/cabrera.ico">

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

<form enctype="multipart/form-data" name="email" id="email" method="POST">

  <tr>

    <td><?php include("header.php"); ?>

	</td>

	</tr>

  <tr>

    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td><img src="../images/t.gif" width="10" height="12" /></td>

      </tr>

      <tr>

      <?php 

      	$resultarray = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id ='".$userid."'")); 

	  ?>

        <td><div align="center"><em>You Are Currently Logged In As: <strong>

		<?php echo $resultarray['name']; ?></strong> (<a href="../logout.php">Log Out</a>)</em></div></td>

      </tr>

      <tr>

        <td><img src="../images/t.gif" width="10" height="12" /></td>

      </tr>

      <tr>

        <td bgcolor="#1E8BCC"><table width="1122" border="0" cellspacing="12" cellpadding="0">

          <tr>

            <td><div align="center" class="white"><a href="index.php" class="whitelink">USER ACCOUNTS</a> &nbsp; | &nbsp; <a href="soldproperties.php" class="whitelink">SOLD PROPERTIES</a> &nbsp; | &nbsp; <a href="updatepages.php" class="whitelink">UPDATE PAGES</a> &nbsp; | &nbsp; <a href="uploadfiles.php" class="whitelink">UPLOAD FILES</a> &nbsp; | &nbsp; <a href="sitetemplate.php" class="whitelink">SITE TEMPLATE</a> &nbsp; | &nbsp; <a href="storeddata.php" class="whitelink">STORED DATA</a></div></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td><img src="../images/t.gif" width="10" height="12" /></td>

      </tr>

      <tr>

        <td><h2>SITE TEMPLATE &gt; EMAIL ADDRESSES FOR FORMS</h2>

          <table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">

            <tr>

              <td width="338" bgcolor="#CCCCCC"><strong>Page Name</strong></td>

              <td width="650" bgcolor="#CCCCCC"><strong>Email Address </strong><span class="gray size10">(Multiple Emails? Sepearte With A Coma - example@cabrerateam.com, example2@cabrerateam.com)</span></td>

              <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>View Page</strong></div></td>

            </tr>

			<?php

			$teamownerobj = mysql_fetch_array(mysql_query("select * from tbl_website_email"));

			?>			 

            <tr>

			

              <td bgcolor="#CAE1F7">CONTACT</td>

              <td bgcolor="#CAE1F7"><input type="text" id="contact" name="contact" style="width: 95%" value="<?php echo $teamownerobj['contact_email']; ?>"></td>

              <td bgcolor="#CAE1F7"><div align="center"><a href="../contact.php" target="_blank">View</a></div></td>

            </tr>

            <tr bgcolor="#F8F7E0">

              <td>FIND RENTAL</td>

              <td><input type="text" id="findrental" name="findrental"style="width: 95%" value="<?php echo $teamownerobj['find_rentail']; ?>" /></td>

              <td><div align="center"><a href="../findrental.php" target="_blank">View</a></div></td>

            </tr>

            <tr bgcolor="#E9E9E9">

              <td bgcolor="#CAE1F7">LIST RENTAL</td>

              <td bgcolor="#CAE1F7"><input type="text" id="listrental" name="listrental" style="width: 95%" value="<?php echo $teamownerobj['listrental_email']; ?>" /></td>

              <td bgcolor="#CAE1F7"><div align="center"><a href="../listrental.php" target="_blank">View</a></div></td>

            </tr>

            <tr bgcolor="#F8F7E0">

              <td>LIST SALES</td>

              <td><input type="text" id="listsales" name="listsales" style="width: 95%" 

			  value="<?php echo $teamownerobj['listsales_email']; ?>"></td>

              <td><div align="center"><a href="../listsales.php" target="_blank">View</a></div></td>

            </tr>

            <tr bgcolor="#CAE1F7">

              <td>SEND PROPERTY TO A FRIEND</td>

              <td><input type="text" id="friend" name="friend" style="width: 95%" 

			  value="<?php echo $teamownerobj['send_friend']; ?>"/></td>

              <td><div align="center"><a href="../friend.php" target="_blank">View</a></div></td>

            </tr>

            <tr bgcolor="#CAE1F7">

              <td bgcolor="#F8F7E0">REQUEST INFORMATION</td>

              <td bgcolor="#F8F7E0"><input type="text" id="request"name="request"style="width: 95%"  value="<?php echo $teamownerobj['request_email']; ?>" /></td>

              <td bgcolor="#F8F7E0"><div align="center"><a href="../request.php" target="_blank">View</a></div></td>

            </tr>        
			<tr bgcolor="#CAE1F7">

              <td bgcolor="#CAE1F7">REQUEST RENTAL</td>

              <td bgcolor="#CAE1F7"><input type="text" id="requestrental"name="requestrental"style="width: 95%"  value="<?php echo $teamownerobj['request_rental']; ?>" /></td>

              <td bgcolor="#CAE1F7"><div align="center">
			  <a href="../requestrental.php" target="_blank">View</a></div></td>

            </tr>		

			<tr bgcolor="#F8F7E0">

              <td bgcolor="#F8F7E0">LET US HELP</td>

              <td bgcolor="#F8F7E0"><input type="text" id="requestletushelp"name="requestletushelp"style="width: 95%"  value="<?php echo $teamownerobj['request_letushelp']; ?>" /></td>

              <td bgcolor="#F8F7E0"><div align="center">
			  <a href="../letushelp.php" target="_blank">View</a></div></td>

            </tr>		

			<tr bgcolor="#CAE1F7">

              <td bgcolor="#CAE1F7">CITY PAGE FORMS</td>

              <td bgcolor="#CAE1F7"><input type="text" id="requesttows"name="requesttows"style="width: 95%"  value="<?php echo $teamownerobj['requesttows']; ?>" /></td>

              <td bgcolor="#CAE1F7"><div align="center">
			  <a href="../capemayrealestate.php" target="_blank">View</a></div></td>

            </tr>

            <tr bgcolor="#F8F7E0">

              <td bgcolor="#F8F7E0">EMAILS SENT FROM WEB SITE</td>

              <td bgcolor="#F8F7E0"><input type="text" id="webmail" name="webmail" style="width:95%" value="<?php echo $teamownerobj['web_email']; ?>"/></td>

              <td bgcolor="#F8F7E0">&nbsp;</td>

            </tr>

          </table></td>

      </tr>

	   <tr>

                  <td><img src="../images/t.gif" width="10" height="8" /></td>

                </tr>

				<tr>

              <td colspan="3"><table width="246" border="0" cellspacing="0" cellpadding="0">

               <tr>

              <td class="style23"><strong>Image Verification</strong> (Type Below)</td>

            </tr>

            <tr>

              <td><img src="../images/t.gif" width="10" height="4" /></td>

            </tr>

            <tr>

              <td><table width="150" border="0" cellpadding="10" cellspacing="0" bgcolor="#CCCCCC">

                <tr>

                  <td><div align="center" class="style8"><?php print'<img id="mainimage" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></div></td>

                </tr>

              </table></td>

            </tr>

            <tr>

              <td><img src="../images/t.gif" width="10" height="4" /></td>

            </tr>

            <tr>

              <td class="style23"><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>

            </tr>

            <tr>

              <td><img src="../images/t.gif" width="10" height="8" /></td>

            </tr>

            <tr>

              <td><input type="text" name="captcha" id="captcha" style="width: 60%" /></td>

            </tr>

                <tr>

                  <td><img src="../images/t.gif" width="10" height="8" /></td>

                </tr>

                

	<tr>

	<td><input type="submit" name="email" id="email" value="Save Email Addresses" />

	<input type="button" name="button2" id="button2" onclick="window.location.href='sitetemplate.php';"value="Cancel" /></td></td>

	</tr>

      <tr>

        <td><img src="../images/t.gif" width="10" height="12" /></td>

      </tr>

    </table></td>

  </tr>

 
 <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td><img src="../images/t.gif" width="10" height="8" /></td>

      </tr>

      <tr>

        <td bgcolor="#195CAB"><img src="../images/t.gif" width="10" height="2" /></td>

      </tr>

      <tr>

        <td bgcolor="#1E8BCC"><table width="1147" border="0" align="center" cellpadding="8" cellspacing="0">

          <tr>

            <td align="center" class="size12 lightblue"><em><?php include("../footer.php"); ?></em></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td bgcolor="#195CAB"><img src="../images/t.gif" width="10" height="2" /></td>

      </tr>

      <tr>

        <td><img src="../images/t.gif" width="10" height="8" /></td>

      </tr>

      <tr>

        <td><table width="182" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td width="30"><a href="https://www.youtube.com/channel/UCAnsRSon87T8_4vhjcOs-eg" target="_blank"><img src="../images/youtube-bottom.jpg" width="30" height="30" /></a></td>

            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>

            <td width="30"><a href="https://twitter.com/CabreraTeam" target="_blank"><img src="../images/twitter-bottom.jpg" width="30" height="30" /></a></td>

            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>

            <td width="30"><a href="https://plus.google.com/u/0/117240634238969765951/posts" target="_blank"><img src="../images/googleplus-bottom.jpg" width="30" height="30" /></a></td>

            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>

            <td width="30"><a href="https://www.facebook.com/CabreraCoastalTeam" target="_blank"><img src="../images/facebook-bottom.jpg" width="30" height="30" /></a></td>

            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>

            <td width="30"><a href="https://www.linkedin.com/company/cabrera-coastal-team" target="_blank"><img src="../images/linkedin-bottom.jpg" width="30" height="30" /></a></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td><img src="../images/t.gif" width="10" height="8" /></td>

      </tr>

    </table></td>

  </tr>

</table>

</body><?php require_once('googletagmanager.php'); ?>

</html>

