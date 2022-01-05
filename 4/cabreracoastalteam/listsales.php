
<?php
if($_GET['Mobile']=='') {

if($_POST['Mobile']=='') {
	$url =$_SERVER['HTTP_REFERER'];
	$query = parse_url($url, PHP_URL_QUERY);
	parse_str($query);
	parse_str($query, $arr);
	$request = $_SERVER['HTTP_REFERER'];
	$urlname=explode('?',$request);
	$urlname= $urlname[1];
	if($urlname=='Mobile=Off' || $Mobile=='Off')
	{
	 echo "<script>window.location='http://www.cabreracoastalteam.com/listsales.php?Mobile=Off';</script>";
	 exit;
	}
	}
}
?>


<?php

if($_GET['Mobile']=='') {
	
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
 echo "<script>window.location='mobile/listsales.php';</script>"; 

}
?>

<?php
	session_start();
	require_once('config.php');

	
	if($_POST['submit']=="Submit")	
	{
		
		
		
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
			
	mysql_query("insert into tbl_listsales(name,address,address2,email,homephone,businessphone,bussinessphoneext,address3,city,state,zip,comments,contact_createdon,pagename,delete_status)values('".$name."','".$address1."','".$address2."','".$email."','".$homephone."','".$businessphone."','".$businessphoneext."','".$address3."','".$city."','".$state."','".$zip."','".$comments."', NOW(),'LIST SALES','0')");
	$table_id = mysql_insert_id();
	
	mysql_query("insert into tbl_storeddata(name,emailid,table_id,pagename,delete_status,createon,comment,adderss1,adderss2,homephone,busphone,busphone1,adderss3,city,state,zip) values('".$name."','".$email."','".$table_id."','LIST SALES','0',NOW(),'".$comments."','".$address1."','".$address2."','".$homephone."','".$businessphone."','".$businessphoneext."','".$address3."','".$city."','".$state."','".$zip."')");	
	
	$F1 = $_POST["Name"];
	$F3 = $_POST["PropertyAddress1"];
	$F4 = $_POST["PropertyAddress2"];
	$F5 = $_POST["Email"];
	$F6 = $_POST["HomePhone"];
	$F7 = $_POST["BusinessPhone"];
	$F8 = $_POST["BusinessPhoneExt"];
	$F9 = $_POST["Address"];
	$F10 = $_POST["City"];
	$F11 = $_POST["State"];
	$F12 = $_POST["ZipCode"];
	$F13 = $_POST["Message"];
	$websiteemails = mysql_fetch_array(mysql_query("select * from tbl_website_email where id=1"));
	$fromaddress = $websiteemails['web_email'];
	
	
	if($fromaddress =="")
	{
	
	$fromaddress = "info@cabrerateam.com";
	
	}
	
	$to = $websiteemails['listsales_email'];
	
	if($to =="")
	{
	
	$to = "info@cabrerateam.com";
	
	}
	
	
	$body = "Full Name: $F1\n\nProperty Address Line 1: $F3\nProperty Address Line 2: $F4\n\nEmail: $F5\nHome Phone: $F6\nBusiness Phone: $F7 Ext: $F8\nAddress: $F9\nCity: $F10\nState: $F11\nZip: $F12\n\n$F13";
	
		$sendto  = "";	
		
		$subject = "The Cabrera Team - Sales Listing";


		$SpamCheck = "Y"; 
		
		
		
		$SpamReplaceText = "*content removed*";

	

		$SpamErrorMessage = "<p align=\"center\"><font color=\"red\">Malicious code content detected. </font><br><b>Your IP Number of <b>".getenv("REMOTE_ADDR")."</b> has been logged.</b></p>";	
		
		

		if ($SpamCheck == "Y") 
		
		{		   		
	
		if (preg_match("/http/i", "$contentget"))
		{ 
		echo "$SpamErrorMessage";
		exit(); 
		} 	
		
		$pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i';

		$email = preg_replace($pattern, "", $email); 		$contentget = preg_replace($pattern, "", $contentget); 	

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
		
 echo "<script>window.location.href='listsalessent.php'</script>";
		
	}
	

  $result_query=mysql_fetch_array(mysql_query("select * from tbl_homepage where id=2"));
 
} 
  
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



</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <form id="sell" name="sell" method="post" onsubmit="return validateForm();">
  <tr>
    <td><?php include("header.php")?></td></tr>
 <input type="hidden" name="Mobile" id="Mobile" value="<?php echo $_GET['Mobile']; ?>">
  <tr>
    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">
      <tr>
        <td><?php echo $result_query['content']; ?>
         
            <table width="450" border="0" cellpadding="3" cellspacing="0">
              <tr>
                <td colspan="2" class="size16"><strong><u>PLEASE PROVIDE YOUR FULL NAME</u></strong></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/t.gif" width="15" height="3" /></td>
              </tr>
              <tr>
                <td width="167"><div align="right"><span class="red"><strong>*</strong></span><strong>Full Name:</strong></div></td>
                <td width="271"><input type="text" name="Name" size="40" id="Name" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/t.gif" width="15" height="12" /></td>
              </tr>
              <tr>
                <td colspan="2" class="size16"><strong><u>PLEASE PROVIDE THE PROPERTIES LOCATION</u></strong></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/t.gif" width="15" height="3" /></td>
              </tr>
              <tr>
                <td><div align="right"><strong>Address:</strong></div></td>
                <td><input name="PropertyAddress1" type="text" id="PropertyAddress1" size="40" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input name="PropertyAddress2" type="text" id="PropertyAddress2" size="40" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/t.gif" width="15" height="12" /></td>
              </tr>
              <tr>
                <td colspan="2" class="size16"><strong><u>PLEASE FILL OUT AT LEAST ONE OPTION BELOW</u></strong></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/t.gif" width="15" height="3" /></td>
              </tr>
              <tr>
                <td><div align="right"><span class="red"><strong>*</strong></span><strong>E-Mail:</strong></div></td>
                <td><input name="Email" type="text" id="Email" size="14" /></td>
              </tr>
              <tr>
                <td><div align="right"><strong>Home Phone: </strong></div></td>
                <td><input type="text" name="HomePhone" size="14" /></td>
              </tr>
              <tr>
                <td><div align="right"><strong>Business Phone:</strong></div></td>
                <td><input type="text" name="BusinessPhone" size="14" />
                  x
                  <input type="text" name="BusinessPhoneExt" size="4" /></td>
              </tr>
              <tr>
                <td><div align="right"><strong>Address: </strong></div></td>
                <td><input type="text" name="Address" size="40" /></td>
              </tr>
              <tr>
                <td><div align="right"><strong>City:</strong></div></td>
                <td><input type="text" name="City" size="20" /></td>
              </tr>
              <tr>
                <td><div align="right"><strong>State: </strong></div></td>
                <td><select name="State">
                  <option value="" selected="selected">(select a state below)</option>
                  <option value="AL">Alabama</option>
                  <option value="AK">Alaska</option>
                  <option value="AZ">Arizona</option>
                  <option value="AR">Arkansas</option>
                  <option value="CA">California</option>
                  <option value="CO">Colorado</option>
                  <option value="CT">Connecticut</option>
                  <option value="DC">D.C.</option>
                  <option value="DE">Delaware</option>
                  <option value="FL">Florida</option>
                  <option value="GA">Georgia</option>
                  <option value="HI">Hawaii</option>
                  <option value="ID">Idaho</option>
                  <option value="IL">Illinois</option>
                  <option value="IN">Indiana</option>
                  <option value="IA">Iowa</option>
                  <option value="KS">Kansas</option>
                  <option value="KY">Kentucky</option>
                  <option value="LA">Louisiana</option>
                  <option value="ME">Maine</option>
                  <option value="MD">Maryland</option>
                  <option value="MA">Massachusetts</option>
                  <option value="MI">Michigan</option>
                  <option value="MN">Minnesota</option>
                  <option value="MS">Mississippi</option>
                  <option value="MO">Missouri</option>
                  <option value="MT">Montana</option>
                  <option value="NE">Nebraska</option>
                  <option value="NV">Nevada</option>
                  <option value="NH">New Hampshire</option>
                  <option value="NJ">New Jersey</option>
                  <option value="NM">New Mexico</option>
                  <option value="NY">New York</option>
                  <option value="NC">North Carolina</option>
                  <option value="ND">North Dakota</option>
                  <option value="OH">Ohio</option>
                  <option value="OK">Oklahoma</option>
                  <option value="OR">Oregon</option>
                  <option value="PA">Pennsylvania</option>
                  <option value="PR">Puerto Rico</option>
                  <option value="RI">Rhode Island</option>
                  <option value="SC">South Carolina</option>
                  <option value="SD">South Dakota</option>
                  <option value="TN">Tennessee</option>
                  <option value="TX">Texas</option>
                  <option value="UT">Utah</option>
                  <option value="VT">Vermont</option>
                  <option value="VI">Virgin Islands</option>
                  <option value="VA">Virginia</option>
                  <option value="WA">Washington</option>
                  <option value="WV">West Virginia</option>
                  <option value="WI">Wisconsin</option>
                  <option value="WY">Wyoming</option>
                  <option value="AB">Alberta</option>
                  <option value="BC">British Columbia</option>
                  <option value="MB">Manitoba</option>
                  <option value="NB">New Brunswick</option>
                  <option value="NF">Newfoundland</option>
                  <option value="NT">Northwest Territories/Nunavut</option>
                  <option value="NS">Nova Scotia</option>
                  <option value="ON">Ontario</option>
                  <option value="PE">Prince Edward Island</option>
                  <option value="QC">Quebec</option>
                  <option value="SK">Saskatchewan</option>
                  <option value="YT">Yukon</option>
                </select></td>
              </tr>
              <tr>
                <td><div align="right"><strong>Zip/Postal Code: </strong></div></td>
                <td><input type="text" name="ZipCode" size="9" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/t.gif" width="15" height="7" /></td>
              </tr>
              <tr>
                <td valign="top"><div align="right"><strong>Questions / Comments:<br />
                </strong></div></td>
                <td><textarea name="Message" id="Message" rows="5" cols="40" wrap="virtual"></textarea></td>
				<td valign="top">&nbsp;</td>
              </tr>
			  
			  		

	    <tr><td valign="top">&nbsp;</td>
		<td>		
<div class="g-recaptcha" data-sitekey="6LfIyCUTAAAAAL5w5jZsbdwZYUxdyb_nb3HSf7ZB"></div>
        </td></tr>

              <tr>
                <td valign="top">&nbsp;</td>
                <td><input name="submit" type="submit" id="submit" onclick="return validateForm()" value="Submit" /></td>
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
</form>
</body><?php require_once('googletagmanager.php'); ?>
</html>
