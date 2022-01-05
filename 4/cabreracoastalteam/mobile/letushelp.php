<?php



session_start();



include('../config.php');



	

if(isset($_POST['btn_submit'])) {

	



  if($_POST['firstname']!='') {

		

				

	if($_POST['lastname']!='') {

		

							 

		 // Variable to check

		$email = $_POST['emailid'];

		// Validate email

		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

		

							

			if(isset($_POST['g-recaptcha-response']))

			{

				$captcha=$_POST['g-recaptcha-response'];

			}

				

		

		$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfIyCUTAAAAAP-tWl3VMZ98m6ebIhhgpHva_WiW=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);

		

       

	   if($response.success==false)

        {

          echo '<h2>You are spammer ! Get the @$%K out</h2>';

        }

		else

        {	

				

				

		$firstname = $_POST["firstname"];

		$lastname = $_POST["lastname"];

		$emailid = $_POST["emailid"];

		$phone = $_POST["phone"];

		$bedrooms = $_POST["bedrooms"];

		$bathrooms = $_POST["bathrooms"];

		$checkindate = $_POST["checkindate"];

		$checkoutdate = $_POST["checkoutdate"];

		$pet = $_POST["pet"];

		$pricerange = $_POST["pricerange"];

		$comments = $_POST["comments"];

		$lastdate=date(Y).'-'.date(m).'-'.date(d);	

		



    $content= "<body style=\"font-family:Calibri, Calibri, Geneva, sans-serif;\">\n";

	

	$content.= "<table align='left'>

					<tr><td colspan='2'>

					<strong>The Cabrera Coastal Team - Let Us Help You Find Your Rental</strong></td></tr>

					<tr><td>First Name  </td><td> : ".$firstname."</td></tr>

					<tr><td>Last Name  </td><td> : ".$lastname."</td></tr>

					<tr><td>Email Address </td><td> : ".$emailid."</td></tr>

					<tr><td>Phone </td><td> : ".$phone."</td></tr>

					<tr><td>Bedrooms </td><td> : ".$bedrooms."</td></tr>

					<tr><td>Bathrooms </td><td> : ".$bathrooms."</td></tr>

					<tr><td>Check In Day </td><td> : ".$checkindate."</td></tr>

					<tr><td>Check Out Day </td><td> : ".$checkoutdate."</td></tr>

					<tr><td>Do You Have Pet </td><td> : ".$pet."</td></tr>

					<tr><td>Price Range / Budget </td><td> : ".$pricerange."</td></tr>

					<tr><td colspan='2'>Additional Requests :<br> ".$comments."</td></tr>

				</table>";		



	$fullname=$firstname.' '.$lastname;

	

	mysql_query("insert into tbl_storeddata(name,emailid,pagename,delete_status,createon,comment,mailtext) values('".mysql_real_escape_string($fullname)."','".$emailid."','LET US HELP','0',NOW(),'".mysql_real_escape_string($comments)."','".mysql_real_escape_string($content)."')");

	



		/******** START OF CONFIG SECTION *******/

		$sendto  = "";

		$subject = "The Cabrera Coastal Team - Let Us Help You Find Your Rental";	



		// Select if you want to check form for standard spam text

		$SpamCheck = "Y"; // Y or N

		$SpamReplaceText = "*content removed*";

		// Error message prited if spam form attack found

		$SpamErrorMessage = "<p align=\"center\"><font color=\"red\">Malicious code content detected.

		</font><br><b>Your IP Number of <b>".getenv("REMOTE_ADDR")."</b> has been logged.</b></p>";

		/******** END OF CONFIG SECTION *******/

		

						

		if($SpamCheck == "Y") {		   

			// Check for Website URL's in the form input boxes as if we block website URLs from the form,

			// then this will stop the spammers wastignt ime sending emails

			if (preg_match("/http/i", "$email")) {echo "$SpamErrorMessage"; exit();} 



			// Patterm match search to strip out the invalid charcaters, this prevents the mail injection spammer 

			$pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; // build the pattern match string 



			$contentget = preg_replace($pattern, "", $contentget); 

			

			// Check for the injected headers from the spammer attempt 

			// This will replace the injection attempt text with the string you have set in the above config section

			$find = array("/bcc\:/i","/Content\-Type\:/i","/cc\:/i","/to\:/i"); 

			$email = preg_replace($find, "$SpamReplaceText", $email); 

			

			// Check to see if the fields contain any content we want to ban

			if(stristr($contentget, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();}

			// Do a check on the send email and subject text

			if(stristr($sendto, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 

			if(stristr($subject, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 

		}	

		

		

	$websiteemails = mysql_fetch_array(mysql_query("select * from tbl_website_email where id='1'"));



	$fromaddress = $websiteemails['web_email'];



	if($fromaddress ==""){



		$fromaddress = "info@cabreracoastalteam.com";

	}

		



	if ($websiteemails['request_letushelp']!='')

	{

		$to = $websiteemails['request_letushelp'];

		

	} else {

		

		$to = "info@cabreracoastalteam.com";

	}

		

			 

		$headers = "From: \" $fromaddress \" <$fromaddress>\r\n" .

									"Content-type:text/html \r\n";	

			

			



		if(!empty($to) && !empty($subject) && !empty($headers)) 

		{	

	

			if(mail($to, $subject, $content, $headers)) {

				//echo("<p>Message sent!</p>");

			} else {

				// echo("<p>Message delivery failed...</p>");

			}

			

		}





		$_SESSION['firstname']=$_POST['firstname'];

		$_SESSION['lastname']=$_POST['lastname'];			

		$_SESSION['emailid']=$_POST['emailid'];

		$_SESSION['phone']=$_POST['phone'];	

		



		echo "<script>alert('Your message has been sent. Please enjoy the rest of the site.'); window.location.assign(document.URL);</script>";

			 

		     }

		

		

			} else {

			

			 echo "<script>alert('$email is not a valid email address');</script>";

			 

			}

		

		}

	}

}



$pagedata=mysql_fetch_array(mysql_query("select * from  tbl_homepage where id='23'"));



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



<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>



<script src='https://www.google.com/recaptcha/api.js'></script>



<link rel="SHORTCUT ICON" href="images/cabrera.ico">



<script>



  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){



  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),



  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)



  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');







  ga('create', 'UA-47104613-18', 'auto');



  ga('send', 'pageview');







</script>





<script>



function validateForm() {

	

	var x = document.forms["letushelp"]["firstname"].value;

    if (x == null || x == "") {

        alert("Please Enter Your First Name and Try Again.");

        letushelp.firstname.focus();

		return false;

    }		

	var x = document.forms["letushelp"]["lastname"].value;

    if (x == null || x == "") {

        alert("Please Enter Your Last Name and Try Again.");

        letushelp.lastname.focus();

		return false;

    }	

	var x = document.forms["letushelp"]["emailid"].value;

    if (x == null || x == "") {

        alert("Please Enter Your Email Address and Try Again.");

		letushelp.emailid.focus();

        return false;

    }	

    var x = document.forms["letushelp"]["emailid"].value;

    var atpos = x.indexOf("@");

    var dotpos = x.lastIndexOf(".");

    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {

     alert("Not a valid e-mail address");

	 letushelp.emailid.focus();

     return false;

    }		

	var x = document.forms["letushelp"]["phone"].value;

    if (x == null || x == "") {

        alert("Please Enter Your Phone Number and Try Again.");

        letushelp.phone.focus();

		return false;

    }		

	

	var captcha_response = grecaptcha.getResponse();

	if(captcha_response.length == 0) 

	{

		alert('Please Enter reCaptcha');

		return false; 

	}

	else 

	{ 

		document.forms["letushelp"].submit();

		return true; 

	}



    return false;

}



function isNumber(evt) {

    evt = (evt) ? evt : window.event;

    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

        return false;

    }

    return true;

}



</script> 

<style>

.padding {

    padding: 10px;

}

</style>



</head>





<body>



<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">



  <tr>



    <td width="100%"><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>



        <td width="232"><a href="../letushelp.php?Mobile=Off">

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



    <td><img src="images/t.gif" width="30" height="80" /></td>



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

    <td align="center">

	

	  <?php echo stripslashes($pagedata['content']);?>

	

	<form name="letushelp" id="letushelp" method="POST" enctype='multipart/form-data'>

	

	

	<table width="660" border="0" cellspacing="0" cellpadding="0">

		<tr><td align="left">

				

				  

<input name="firstname" placeholder="*First Name" type="text" class="gray padding" id="firstname" style="width: 90%" value="<?php $_SESSION['firstname'];?>"/>

				  

				  

			</td><td align="right">

				  

				  

<input name="lastname" placeholder="*Last Name" type="text" class="gray padding" id="lastname" style="width: 90%"  value="<?php $_SESSION['lastname'];?>"/>





				</td>



                </tr>



                <tr>



                  <td colspan="2" align="left"><img src="images/t.gif" width="40" height="25" /></td>



                </tr>



                <tr>



                  <td align="left">

				  

<input name="emailid" placeholder="*Email Address" type="text" class="gray padding" id="emailid" style="width: 90%" value="<?php $_SESSION['emailid'];?>"/>





			</td><td align="right">

				  

				  

<input name="phone" value="<?php $_SESSION['phone'];?>" onkeypress="return isNumber(event)" placeholder="Phone Number" type="text" class="gray padding" id="phone" style="width: 90%" />



				  

				  </td>



                </tr>



                <tr>



                  <td colspan="2" align="left"><img src="images/t.gif" width="40" height="25" /></td>



                </tr>



                <tr>



                  <td align="left">

				  

				  

				  

<input name="bedrooms" placeholder="Property Bedrooms" type="text" class="gray padding" id="bedrooms" style="width: 90%" />





						</td><td align="right">





<input name="bathrooms" placeholder="Property Bathrooms" type="text" class="gray padding" id="bathrooms" style="width: 90%" />

		

		

		

				</td></tr>



                <tr>



                  <td colspan="2" align="left"><img src="images/t.gif" width="40" height="25" /></td>



                </tr>



                <tr>



                  <td align="left">

				  

				  

				  

<input name="checkindate" placeholder="Rental Check In Date" type="text" class="gray padding" id="checkindate" style="width: 90%" />





					</td><td align="right">





<input name="checkoutdate" placeholder="Rental Check Out Date" type="text" class="gray padding" id="checkoutdate" style="width: 90%" /></td>



                  </tr>



                <tr>



                  <td colspan="2" align="left">&nbsp;</td>



                </tr>



                <tr>



                  <td align="left">

				  



				  

<input name="pet" placeholder="Do You Have A Pet" type="text" class="gray padding" id="pet" style="width: 90%" />





		</td><td align="right">





<input name="pricerange" placeholder="Price Range / Budget" type="text" class="gray padding" id="pricerange" style="width: 90%" />





				</td>



                  </tr>



                <tr>



                  <td colspan="2" align="left">&nbsp;</td>



                </tr>



                <tr>



                  <td colspan="2" align="center">

				  

				  				  

<textarea name="comments" rows="8" class="gray padding" id="comments" style="width: 96%" placeholder="Please include any requests you may have.  This may include features such as elevators, walking distance to the beach, wireless internet, etc."></textarea>

				  				  

				  

				  </td>



                </tr>

				

				<tr>

					<td><img src="images/t.gif" width="15" height="25" /></td>

				</tr>



				<tr><td align="center" colspan="2">		



<div class="g-recaptcha" data-sitekey="6LfIyCUTAAAAAL5w5jZsbdwZYUxdyb_nb3HSf7ZB"></div>



				</td></tr>

				

				<tr>

					<td><img src="images/t.gif" width="15" height="20" /></td>

				</tr>

				

	            <tr>



              <td align="center" colspan="2">

			  

	<input type="hidden" id="btn_submit" name="btn_submit" value="submitvalues"/>

	

	<input name="request" type="button" onclick="return validateForm();" class="style18" id="request" value="Submit Form" style="padding: 11px;" />		  

			  

			  

			  </td>



            </tr>			



              </table>

	

	</td>

  </tr>  

  

  

  <tr>

    <td>&nbsp;</td>

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





<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">



<script src="//code.jquery.com/jquery-1.10.2.js"></script>



<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>	



<script>



$(function() {



	$("#checkindate").datepicker();

	

	$("#checkoutdate").datepicker();

});



</script>



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



