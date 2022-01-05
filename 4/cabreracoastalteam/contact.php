<?php
/********* BEGIN SITELOCK XSS FILTERING CODE ADDED 2017-02-01 *********/
if (isset($_REQUEST)) { foreach ($_REQUEST as $key => $vuln) { $_REQUEST[$key] = htmlentities($vuln); } }
if (isset($_GET)) { foreach ($_GET as $key => $vuln) { $_GET[$key] = htmlentities($vuln); } }
if (isset($_POST)) { foreach ($_POST as $key => $vuln) { $_POST[$key] = htmlentities($vuln); } }
/********* END SITELOCK XSS FILTERING CODE ADDED 2017-02-01 *********/
if($_GET['Mobile']=='') {

 if($_POST['Mobile']=='') 

   {

	$url =$_SERVER['HTTP_REFERER'];

	$query = parse_url($url, PHP_URL_QUERY);

	parse_str($query);

	parse_str($query, $arr);

	$request = $_SERVER['HTTP_REFERER'];

	$urlname=explode('?',$request);

	$urlname= $urlname[1];

	if($urlname=='Mobile=Off' || $Mobile=='Off')

	{

	 echo "<script>window.location='http://www.cabreracoastalteam.com/contact.php?Mobile=Off';</script>";

	 exit;

	}

	}

}

?>





<?php



if($_GET['Mobile']=='') {

	

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

 echo "<script>window.location='mobile/index.php';</script>"; 



}

?>



<?php

	session_start();

	require_once('config.php');

	

	

if($_POST['button2']!='')

{

		$contact_fullname=$_POST['Name'];

		$contact_email=$_POST['Email'];

		$contact_phone=$_POST['Phone'];

		$contact_comments=$_POST['Question'];

		

		

		

		

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

	

	    

			

	mysql_query("insert into  tbl_contactus(contact_fullname,contact_email,contact_phone, contact_comments,contact_createdon,pagename,delete_status) values ('".$contact_fullname."','".$contact_email."','".$contact_phone."','".$contact_comments."',now(),'CONTACTUS',0)");

		$table_id = mysql_insert_id();

	

	mysql_query("insert into tbl_storeddata(name,emailid,table_id,pagename,delete_status,createon,comment) values('".$contact_fullname."','".$contact_email."','".$table_id."','CONTACTUS','0',NOW(),'".$contact_comments."')");

	

	

	

	$sendto  = "";	

	$subject = "The Cabrera Team - Contact Form";





	$SpamCheck = "Y"; 

	

	$SpamReplaceText = "*content removed*";	

	

	$SpamErrorMessage = "<p align=\"center\"><font color=\"red\">Malicious code content detected.	</font><br><b>Your IP Number of <b>".getenv("REMOTE_ADDR")."</b> has been logged.</b></p>";	

	

	if ($SpamCheck == "Y") 

	{		   	

	

	if (preg_match("/http/i", "$contentget")) 

	{

	echo "$SpamErrorMessage";

	exit();

	} 		

		

	$pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; 

	

	$email = preg_replace($pattern, "", $email); 	

	$contentget = preg_replace($pattern, "", $contentget); 	

	

	$contentget = preg_replace($find, "$SpamReplaceText", $contentget); 

	

	

	if(stristr($contentget, $SpamReplaceText) !== FALSE)

	{

	echo "$SpamErrorMessage";

	exit();

	} 		

	



	if(stristr($sendto, $SpamReplaceText) !== FALSE)

	{

	echo "$SpamErrorMessage"; 

	exit();

	} 		

	

	if(stristr($subject, $SpamReplaceText) !== FALSE)

	{

	echo "$SpamErrorMessage"; 

	exit();

	} 	

	}		



	

	$F1 = $_POST["Name"];

	$F2 = $_POST["Phone"];

	$F3 = $_POST["Email"];

	$F4 = $_POST["Question"];



	$body = "Name: $F1\n\nEmail: $F3\n\nPhone: $F2\n\nComments: \n$F4";



	$websiteemails = mysql_fetch_array(mysql_query("select * from tbl_website_email where id=1"));

	

	$fromaddress = $websiteemails['web_email'];	

	

	if($fromaddress =="")

	{	

	$fromaddress = "info@cabrerateam.com";	

	}	

	

	$to = $websiteemails['contact_email'];	

	

	if($to =="")

	{	

	$to = "info@cabrerateam.com";

	}		





	$from = $fromaddress;	



	$add = "-f ".$fromaddress;	



if(!empty($to) && !empty($subject) && !empty($from))



{			

	

	if(mail($to, "$subject", $body, "From:" . $from,$add))

	{		



	} 

	

	else 

	{		

	

	}	

	

}		 		 



			 echo "<script>window.location.href='contactsent.php'</script>";

	

  }

	

}



	?>		

		

<?php

  

  $result_query=mysql_fetch_array(mysql_query("select * from tbl_homepage where id=17"));

  

?>	

		

		



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="keywords" content="<?php echo $result_query['meta_key'];?>" />

<meta http-equiv="description" content="<?php echo $result_query['meta_desc'];?>" />

<meta name="robots" content="index, follow" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<title><?php echo $result_query['meta_title'];?></title>

<link href="styles.css" rel="stylesheet" type="text/css">

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



function validateForm()



{



	var x = document.forms["sell"]["Name"].value;

    if (x == null || x == "") {

        alert("Name should not be blank");

        sell.Name.focus();

		return false;

    }

	

	

	var y = document.forms["sell"]["Email"].value;

    if (y == null || y == "") {

        alert("Please Enter Your Email Address and Try Again.");

		sell.Email.focus();

        return false;

    }	

	

    var x = document.forms["sell"]["Email"].value;

    var atpos = x.indexOf("@");

    var dotpos = x.lastIndexOf(".");

    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {

     alert("Not a valid e-mail address");

	 sell.Email.focus();

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







<script>



function numericFilter(txb) {txb.value = txb.value.replace(/[^\0-9]/ig, "");}



</script>



</head>

<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<form action="#" method="post" name="sell" id="sell">



<tr>

    <td><?php include("header.php")?></td></tr>

  <input type="hidden" name="Mobile" id="Mobile" value="<?php echo $_GET['Mobile']; ?>">

  <tr>

    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

      <tr>

        <td width="695" align="left" valign="top"> 

      

       <?php echo $result_query['content']; ?>

		  

        <td width="413" valign="top"><table width="413" border="0" cellpadding="8" cellspacing="1" bgcolor="#C2E2F8">

          <tr>

            <td width="395" bgcolor="#EEF7FD">

              <table width="395" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td><span class="red"><strong>*</strong></span><strong>Full Name:</strong></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="12" height="3" /></td>

                </tr>

                <tr>

                  <td><input name="Name" type="text" id="Name" style="width: 98%" value="<?php echo $contact_fullname?>"/></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="12" height="15" /></td>

                </tr>

                <tr>

                  <td><span class="red"><strong>*</strong></span><strong>Email:</strong></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="12" height="3" /></td>

                </tr>

                <tr>

                  <td><input name="Email" type="text" id="Email" style="width: 98%"value="<?php echo $contact_email?>" /></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="12" height="15" /></td>

                </tr>

                <tr>

                  <td><strong>Phone:</strong></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="12" height="3" /></td>

                </tr>

                <tr>

                  <td><input name="Phone" type="text" id="Phone" style="width: 98%" onKeyUp="numericFilter(this);" value="<?php echo $contact_phone?>" /></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="12" height="15" /></td>

                </tr>

                <tr>

                  <td><strong>How Can We Help You?</strong></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="12" height="5" /></td>

                </tr>

                <tr>

                  <td><textarea name="Question" rows="19" id="Comments" style="width: 98%"><?php echo $contact_comments?></textarea></td>

                </tr>

                <tr>

                  <td><img src="images/t.gif" width="12" height="15" /></td>

                </tr>

				

				



	    <tr><td>		

<div class="g-recaptcha" data-sitekey="6LfIyCUTAAAAAL5w5jZsbdwZYUxdyb_nb3HSf7ZB"></div>

        </td></tr>



		        <tr>

                  <td><img src="images/t.gif" width="12" height="10" /></td>

                </tr>

                <tr>

                  <td><label>

                    <input name="button2" type="submit" id="button2" onclick="return validateForm()" value="Submit Form" />

                  </label></td>

                </tr>

              </table>

            </form></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td colspan="2" align="left" valign="top">&nbsp;</td>

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

</body><?php require_once('googletagmanager.php'); ?>

</html>

