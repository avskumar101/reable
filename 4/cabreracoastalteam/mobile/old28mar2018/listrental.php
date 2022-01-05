<?php

	session_start();

	require_once('../config.php');

	require_once('../captcha/captcha.php');

	if($_POST['submit']=="Submit")	

	{

		if($_POST['captcha']!='')

		{

			if(captcha_validate())

			{

		$name =$_POST['Name'];

		$address1 =$_POST['PropertyAddress1'];

		$address2 =$_POST['PropertyAddress2'];

		$email =$_POST['Email'];

		$homephone =$_POST['HomePhone'];

		$businessphone =$_POST['BusinessPhone'];

		$businessphoneext =$_POST['BusinessPhoneExt'];

		$address3 =$_POST['Address'];

		$city =$_POST['City'];

		$state =$_POST['State'];

		$zip =$_POST['ZipCode'];

		$comments =$_POST['Message'];

		mysql_query("insert into  tbl_listrental(name,address,address2,email,homephone,businessphone,bussinessphoneext,address3,city,state,zip,comments,contact_createdon,pagename,delete_status)values('".$name."','".$address1."','".$address2."','".$email."','".$homephone."','".$businessphone."','".$businessphoneext."','".$address3."','".$city."','".$state."','".$zip."','".$comments."', NOW(),'LIST RENTAL','0')");

				

		$table_id = mysql_insert_id();

		
		mysql_query("insert into tbl_storeddata(name,emailid,table_id,pagename,delete_status,createon,comment,adderss1,adderss2,homephone,busphone,busphone1,adderss3,city,state,zip) values('".$name."','".$email."','".$table_id."','LIST RENTAL','0',NOW(),'".$comments."','".$address1."','".$address2."','".$homephone."','".$businessphone."','".$businessphoneext."','".$address3."','".$city."','".$state."','".$zip."')");


		$F1 = $_REQUEST["Name"];

		$F3 = $_REQUEST["PropertyAddress1"];

		$F4 = $_REQUEST["PropertyAddress2"];

		$F5 = $_REQUEST["Email"];

		$F6 = $_REQUEST["HomePhone"];

		$F7 = $_REQUEST["BusinessPhone"];

		$F8 = $_REQUEST["BusinessPhoneExt"];

		$F9 = $_REQUEST["Address"];

		$F10 = $_REQUEST["City"];

		$F11 = $_REQUEST["State"];

		$F12 = $_REQUEST["ZipCode"];

		$F13 = $_REQUEST["Message"];

		$websiteemails = mysql_fetch_array(mysql_query("select * from tbl_website_email where id=1"));

		$fromaddress = $websiteemails['web_email'];

		if($fromaddress ==""){

		$fromaddress = "info@cabrerateam.com";

		}

		$toaddress = $websiteemails['listrental_email'];

		if($toaddress ==""){

		$toaddress = "info@cabrerateam.com";

		}



		$subject = "The Cabrera Team - Rental Listing";

		$body = "Full Name: $F1\n\nProperty Address Line 1: $F3\nProperty Address Line 2: $F4\n\nEmail: $F5\nHome Phone: $F6\nBusiness Phone: $F7 Ext: $F8\nAddress: $F9\nCity: $F10\nState: $F11\nZip: $F12\n\n$F13";

		$headers = "From: $fromaddress\r\n" .

			"X-Mailer: php";

		if (mail($toaddress, $subject, $body, $headers)) {

		  //("<p>Message sent!</p>");

		 } else {

		  //("<p>Message delivery failed...</p>");

		 }

		echo "<script>alert('Your message has been sent. Please enjoy the rest of the site.');window.location.href='listrental.php';</script>";

			}

			else

			{

				echo "<script>alert('You were not successful in typing in the correct image verification, please try again.')</script>";

				$msg='<p style="color:red">Failure! You entered the wrong code!</p>';

			

			} 

		}	

		else

		{

			echo "<script>alert('You were not successful in typing in the correct image verification, please try again.')</script>";

			$msg='<p style="color:red">Failure! Please Enter the code</p>';


		}

			
	}
?>
		
<?php
  
  $result_query=mysql_fetch_array(mysql_query("select * from tbl_homepage where id=13"));
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<title><?php echo $result_query['meta_title'];?></title>

<link rel="canonical" href="http://cabreracoastalteam.com/listrental.php" />

<link href="styles.css" rel="stylesheet" type="text/css">

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');


  ga('create', 'UA-47104613-18', 'auto');

  ga('send', 'pageview');

  
  function MM_validateForm() { //v4.0

  if (document.getElementById){

    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;

    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);

      if (val) { nm=val.name; if ((val=val.value)!="") {

        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');

          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';

        } else if (test!='R') { num = parseFloat(val);

          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';

          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');

            min=test.substring(8,p); max=test.substring(p+1);

            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';

      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }

    } if (errors) alert('The following error(s) occurred:\n'+errors);

    document.MM_returnValue = (errors == '');

} }
</script>

</head>


<body>

<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="100%"><table width="1080" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>

        <td width="232"><a href="../listrental.php?Mobile=Off"><img src="images/fullsite.png" width="232" height="248" border="0"/></a></td>

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
	
          <table width="1080" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td>
			  
			   <?php echo stripslashes($result_query['content']); ?>
			  
			  
			  </td>

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

