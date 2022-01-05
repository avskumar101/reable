<?php

session_start();


$db = new PDO('mysql:host=localhost;dbname=cabrerac_cabreracoastalte;charset=utf8mb4', 'cabrerac_cabrera', 'zV#?lh;$&M%@');

require_once('captcha/captcha.php');	

$ID=$_GET['MLSNo'];



$stmcot=$db->prepare('SELECT * FROM  tbl_listings where MLSNo= ? ');
$stmcot->execute(array($ID)); 
$affected_rows = $stmcot->rowCount();
while($resultarray = $stmcot->fetch(PDO::FETCH_ASSOC))
{
	
$addresss= $resultarray['Address'];

$city = $resultarray['City'];

$state = $resultarray['State'];

$bed = $resultarray['Bedrooms'];

$bath = $resultarray['Full_Baths'];

$price = number_format($resultarray['Asking_Price']);

$type = $resultarray['Type'];


		   
}


$propertyinfo = "Property Information\n";

$propertyinfo .= "$addresss , $city ,  $state \n";

$propertyinfo .= "$bed Bedrooms | $bath  Bathrooms | $ $price\n";

$propertyinfo .= "MLS Number: $ID | Property Type: $type\n";

$propertyinfo .= "Provided by: The Cabrera Coastal Team - www.cabreracoastalteam.com\n";

$fullname="";

$email="";

$phoneno="";

$comments="";


if($_POST['request']!='')
	{

		$fullname=$_POST['yourname'];

		$email=$_POST['youremail'];

		$phoneno=$_POST['yourphone'];

		$comments=$_POST['comments'];

		
		
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

	
	$result=$db->prepare('select * from tbl_website_email where id = ?');
	$result->execute(array('1'));
	$websiteemails=$result->fetch(PDO::FETCH_ASSOC);
	

	$fromaddress = $websiteemails['web_email'];

	if($fromaddress ==""){

	$fromaddress = "info@cabreracoastalteam.com";

	}

	$toaddress = $websiteemails['request_email'];

	if($toaddress ==""){

	$toaddress = "info@cabreracoastalteam.com";

	}	


	$F1 = $_POST["yourname"];

	$F2 = $_POST["youremail"];

	$F3 = $_POST["yourphone"];

	$F4 = $_POST["comments"];

	$to = $toaddress;

	
	$sendto  = "";
	$subject = "The Cabrera Coastal Team - Sales Listing Request";


	$SpamCheck = "Y";
	$SpamReplaceText = "*content removed*";
	
	$SpamErrorMessage = "<p align=\"center\"><font color=\"red\">Malicious code content detected.
	</font><br><b>Your IP Number of <b>".getenv("REMOTE_ADDR")."</b> has been logged.</b></p>";
	
	if ($SpamCheck == "Y") {		   
		
		if (preg_match("/http/i", "$contentget")) {echo "$SpamErrorMessage"; exit();} 

		
		$pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; 
		
		$email = preg_replace($pattern, "", $email); 
		$contentget = preg_replace($pattern, "", $contentget); 

		$contentget = preg_replace($find, "$SpamReplaceText", $contentget); 

	
		if(stristr($contentget, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 

		
		if(stristr($sendto, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 
		if(stristr($subject, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 
	}


	$requestinfo = "Full Name: $F1\n\nEmail: $F2\nPhone: $F3\nComments: $F4\n";

	$body = "$propertyinfo \n\n $requestinfo";
	
	$from = $fromaddress;
	
	$add = "-f ".$fromaddress;
	
	
if($affected_rows == 1)
{


	$nowdate=date(Y).'-'.date(m).'-'.date(d);
	$fzero=0;
	$pgnm="REQUEST_INFORMATION";
		

	
	$stmtsdss= $db->prepare("insert into tbl_request(name,email,phoneno,comments,contact_createdon,pagename,delete_status)values(:field1,:field2,:field3,:field4,:field5,:field6,:field7)");
	$stmtsdss->execute(array(':field1' => $fullname,':field2' => $email,':field3' => $phoneno,':field4' => $comments,':field5' => $nowdate,':field6' => $pgnm,':field7' => $fzero));
	$affected_rowss = $stmtsdss->rowCount();

	$table_id = $db->lastInsertId();

	

	$stmtss= $db->prepare("insert into tbl_storeddata(name,emailid,table_id,pagename,delete_status,createon,comment)values(:field1,:field2,:field3,:field4,:field5,:field6,:field7)");
	$stmtss->execute(array(':field1' => $fullname,':field2' => $email,':field3' => $table_id,':field4' => $pgnm,':field5' => $fzero,':field6' => $nowdate,':field7' => $comments));
	$affected_rowsd = $stmtss->rowCount();



	if(!empty($to) && !empty($subject) && !empty($from)) 
	{	
		if(mail($to, "$subject", $body, "From:" . $from,$add)) {
			
		} else {
			
		}
	}
 
 
	echo "<script>alert('Your message has been sent! Thank you and enjoy the rest of the site.');window.location.href='property.php?MLSNo=".$ID."';</script>";

 
 
} 

else
{

	echo "<script>window.location.href='request.php?MLSNo=".$ID."';</script>";

 
}



	}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<title>Cabrera Coastal Team - Request Property Information</title>

<link href="styles.css" rel="stylesheet" type="text/css">

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

<script src='https://www.google.com/recaptcha/api.js'></script>

<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');



  ga('create', 'UA-47104613-18', 'auto');

  ga('send', 'pageview');

 

</script>


<script>

function validateForm()

{

	var x = document.forms["myForm"]["yourname"].value;
    if (x == null || x == "") {
        alert("Name should not be blank");
        myForm.yourname.focus();
		return false;
    }
	
	
	var y = document.forms["myForm"]["youremail"].value;
    if (y == null || y == "") {
        alert("Please Enter Your Email Address and Try Again.");
		myForm.youremail.focus();
        return false;
    }	
	
    var x = document.forms["myForm"]["youremail"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
     alert("Not a valid e-mail address");
	 myForm.youremail.focus();
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
	return true; 
	}

}



</script>




</head>



<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

 <form method="post" name="myForm" onsubmit="return validateForm()">

<tr>

    <td><?php include("header.php")?></td></tr>

  

  <tr>

    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

	<?php
	
	

$stmcdot=$db->prepare('SELECT * FROM  tbl_listings where MLSNo= ? ');
$stmcdot->execute(array($ID)); 
$affected_rows = $stmcdot->rowCount();
$resultarray = $stmcdot->fetch(PDO::FETCH_ASSOC);
	
	
	?>

      <tr>

        <td><h1>REQUEST PROPERTY INFORMATION</h1>

          <blockquote>

            <p class="spacing"><a href="property.php?MLSNo=<?php echo $resultarray['MLSNo'];?>"><strong><?php echo $resultarray['Address'].', '. $resultarray['City'].' '.$resultarray['State'];?></strong></a><br />

              <?php echo $resultarray['Bedrooms'] ?> Bedrooms | <?php echo $resultarray['Full_Baths'] ?> Bathrooms | $<?php echo number_format($resultarray['Asking_Price']);?><br />

              MLS Number: <?php echo $resultarray['MLSNo'] ?> | Property Type: <?php echo $resultarray['Type'];?><br />

              <em>Provided by: The Cabrera Coastal Team - <a href="http://www.cabreracoastalteam.com"> www.cabreracoastalteam.com<br />

              </a></em><span class="gray">(Information Above Will Appear At The Top Of The Email)</span></p>

          </blockquote>

          <table width="1121" border="0" cellspacing="0" cellpadding="0">

            <tr>

              <td width="1036"><table width="1121" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td width="354"><span class="red"><strong>*</strong></span><strong>Your Name</strong>:</td>

                  <td width="30" rowspan="3"><img src="images/t.gif" width="26" height="10" /></td>

                  <td width="354"><span class="red"><strong>*</strong></span><strong>Your Email</strong>:</td>

                  <td width="30" rowspan="3"><img src="images/t.gif" width="26" height="10" /></td>

                  <td width="353"><strong>Phone Number</strong>:</td>

                  </tr>

                <tr>

                  <td><img src="images/t.gif" width="26" height="4" /></td>

                  <td><img src="images/t.gif" width="26" height="4" /></td>

                  <td><img src="images/t.gif" width="26" height="4" /></td>

                  </tr>

                <tr>

                  <td><input name="yourname" type="text" id="yourname" style="width: 98%" value="<?php echo $fullname ?>"/></td>

                  <td><input name="youremail" type="text" id="youremail" style="width: 98%" value="<?php echo $email ?>" /></td>

                  <td><input name="yourphone" type="text" id="yourphone" style="width: 98%" value="<?php echo $phoneno?>"   /></td>

                  </tr>

              </table></td>

            </tr>

            <tr>

              <td><img src="images/t.gif" width="15" height="15" /></td>

            </tr>

            <tr>

              <td><strong>Comments:</strong></td>

            </tr>

            <tr>

              <td><img src="images/t.gif" width="15" height="4" /></td>

            </tr>

            <tr>

              <td><textarea name="comments" rows="6" class="style18" id="comments" style="width: 99%"><?php echo $comments ?></textarea></td>

            </tr>

              <tr>

              <td><img src="images/t.gif" width="15" height="15" /></td>

            </tr>

			 	

	    <tr><td>		
<div class="g-recaptcha" data-sitekey="6LfIyCUTAAAAAL5w5jZsbdwZYUxdyb_nb3HSf7ZB"></div>
        </td></tr>

			
              <tr>

              <td><img src="images/t.gif" width="15" height="15" /></td>

            </tr>   

            <tr>

              <td><input name="request" type="submit" class="style18" id="request" value="Request Information" /></td>

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

</form>

</table>

</body><?php require_once('googletagmanager.php'); ?>

</html>

