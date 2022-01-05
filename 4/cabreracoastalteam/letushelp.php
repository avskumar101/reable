<?php

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

	 echo "<script>window.location='letushelp.php?Mobile=Off';</script>";

	 exit;

		}
	}
}


if($_GET['Mobile']=='') {	

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

	echo "<script>window.location.href='mobile/letushelp.php';</script>";

  }
  
  
	
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

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<meta http-equiv="keywords" content="<?php echo $pagedata['meta_key'];?>"/>

<meta http-equiv="description" content="<?php echo $pagedata['meta_desc'];?>"/>

<meta name="robots" content="index, follow" />

<title><?php echo $pagedata['meta_title'];?></title>

<link href="styles.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.9.1.js" type="text/javascript"></script>

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

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr><td><?php include("header.php")?></td></tr>


  <tr>

    <td>
	<table width="1100" border="0" align="center" cellpadding="0" cellspacing="13">

	<tr>
    <td>
		
	
	<table width="1100" border="0" cellspacing="1" cellpadding="19">

		<tr>

		  <td>
		  
		  <?php echo stripslashes($pagedata['content']);?>

	
	<form name="letushelp" id="letushelp" method="POST" enctype='multipart/form-data'>

	<?php $mobile1=$_GET['Mobile'];	?>

	<input id="mobile" name="mobile" type="hidden" value="<?php echo $mobile1 ?>"/>

			  
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

				<tr><td align="left" colspan="3">		

<div class="g-recaptcha" data-sitekey="6LfIyCUTAAAAAL5w5jZsbdwZYUxdyb_nb3HSf7ZB"></div>

				</td></tr>
				
				<tr>
					<td><img src="images/t.gif" width="15" height="20" /></td>
				</tr>
				
	            <tr>

              <td align="left">
			  
	<input type="hidden" id="btn_submit" name="btn_submit" value="submitvalues"/>
	
	<input name="request" type="button" onclick="return validateForm();" class="style18" id="request" value="Submit Form" />		  
			  
			  
			  </td>

            </tr>			

              </table>
			  
			  </td>

            </tr>

          </table>

	</td>

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

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>	

<script>

$(function() {

	$("#checkindate").datepicker();
	
	$("#checkoutdate").datepicker();
});

</script>
</body><?php require_once('googletagmanager.php'); ?>

</html>

