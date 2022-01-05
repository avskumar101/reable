<?php
	session_start();
	require_once('config.php');
	require_once('captcha/captcha.php');	

	
	
if($_POST['btn'] == "Submit")
{
	if($_POST['captcha']!='')
	{
	
		if(captcha_validate())
		{			
			
		$F1 = $_POST["name"];
		$F2 = $_POST["email"];
		$F3 = $_POST["phone"];
		$F4 = $_POST["people"];
		$F20 = $_POST["message"];
		$F21 = $_POST["month1"];
		$F22 = $_POST["day1"];
		$F23 = $_POST["year1"];
		$F24 = $_POST["month2"];
		$F25 = $_POST["day2"];
		$F26 = $_POST["year2"];	

	$checkin=$_POST["year1"].'-'.$_POST["month1"].'-'.$_POST["day1"];				
	$checkout=$_POST["year2"].'-'.$_POST["month2"].'-'.$_POST["day2"];				
			
		$k=0;
		for($i=1;$i<=9;$i++)
		{
			$value='town'.$i;
			if($_POST[$value]!='')
			if($k==0){
				$townchckbx.=$_POST[$value];
				$k=1;
			} else {					
				$townchckbx.=",".$_POST[$value]; 
			}
		}		
		
		$kj=0;
		for($if=1;$if<=6;$if++)
		{
			$value='location'.$if;
			if($_POST[$value]!='')
			if($kj==0){
				$lctnchckbx.=$_POST[$value];
				$kj=1;
			} else {					
				$lctnchckbx.=",".$_POST[$value]; 
			}
		}
			

	$body = "Name: $F1\n\nEmail: $F2\n\nPhone: $F3\n\nNumber of People Including Children: $F4\n\nCheck In Date: $F21/$F22/$F23\n\nCheck Out Date: $F24/$F25/$F26\n\nTowns Interested In Vacationing To: $townchckbx\n\nLocation: $lctnchckbx\n\nComments: \n$F20";

	
	mysql_query("insert into tbl_storeddata(name,emailid,homephone,pagename,checkin,checkout,town,city,people,delete_status,createon,comment) values('".$F1."','".$F2."','".$F3."','LOCATE','".$checkin."','".$checkout."','".$townchckbx."','".$lctnchckbx."','".$F4."','0',NOW(),'".$F20."')");	


	
	/******** START OF CONFIG SECTION *******/
	$sendto  = "";		
	$subject = "Cabrera Coastal Team - Vacation Rentals";	
	// Select if you want to check form for standard spam
	$SpamCheck = "Y"; // Y or N
	$SpamReplaceText = "*content removed*";
	// Error message prited if spam form attack found
	$SpamErrorMessage = "<p align=\"center\"><font color=\"red\">Malicious code content detected.
	</font><br><b>Your IP Number of <b>".getenv("REMOTE_ADDR")."</b> has been logged.</b></p>";
	/******** END OF CONFIG SECTION *******/

	if($SpamCheck == "Y") {		   
		// Check for Website URL's in the form input boxes as
		if (preg_match("/http/i", "$content")) {echo "$SpamErrorMessage"; exit();} 

		// Patterm match search to strip out the invalid charcaters, this prevents the mail injection spammer 
		$pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; 
		// This will replace the injection attempt text with the string you have set in the above config section
		$find = array("/bcc\:/i","/Content\-Type\:/i","/cc\:/i","/to\:/i"); 		
		if(stristr($sendto, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 
		if(stristr($subject, $SpamReplaceText) !== FALSE) {echo "$SpamErrorMessage"; exit();} 
	}	
		
	$to = "rentals@cabreracoastalteam.com";
	
	
	$from = $F2;
	$add = "-f ".$F2;	

	if(!empty($to) && !empty($subject) && !empty($from)) 
	{	
		if (mail($to, "$subject", $body, "From:" . $from,$add)) {
			//echo("<p>Message sent!</p>");
		} else {
			// echo("<p>Message delivery failed...</p>");
		}
	}
			
		
	header("Location: vacationrentalssent.php");
	
	
	} else {
				$msg = "You were not successful in typing in the correct image verification, please try again.";
		 }  
		
		}
		
		else
		{
			$msg = "You were not successful in typing in the correct image verification, please try again.";
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="keywords" content="Cabrera Property Management, Pool Services, Bookeeping, Administrative Support, Management, Summer Rental, Locate, " />
<meta http-equiv="description" content="Let Cabrera Coastal Team Locate Your Summer Rental Today!" />
<meta name="robots" content="index, follow" />
<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>
<title>Locate Your Shore Summer Rental With Cabrera Coastal Real Estate</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="images/cabrera.ico">
<script src="js/jquery-1.9.1.js"></script>
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
var x = document.forms["vacationrentalssent"]["name"].value;
    if (x == null || x == "") {
        alert("Please Enter Your Name and Try Again.");
        vacationrentalssent.name.focus();
		return false;
    }
	var x = document.forms["vacationrentalssent"]["email"].value;
    if (x == null || x == "") {
        alert("Please Enter Your Email Address and Try Again.");
		vacationrentalssent.email.focus();
        return false;
    }	
    var x = document.forms["vacationrentalssent"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
     alert("Not a valid e-mail address");
	 vacationrentalssent.email.focus();
     return false;
    }
	
var x = document.forms["vacationrentalssent"]["captcha"].value;
    if (x == null || x == "") {
        alert("Please Enter Your Code and Try Again.");
        vacationrentalssent.captcha.focus();
		return false;
    }
	
$.post("captchavalid.php?"+$("#vacationrentalssent").serialize(), { }, function(response){		

	var nanj=response;	
	if(response=='1'){	
		document.forms["vacationrentalssent"].submit();
		return true;  
	} else {
		 alert("wrong captcha code!");
		 document.getElementById('captcha').value='';
		 vacationrentalssent.captcha.focus();
		 return false;
	} });	

	return false;		
	
}




</script>


</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form  method="post" name="vacationrentalssent" id="vacationrentalssent">

<tr>
    <td><?php include("header.php")?></td></tr>
  
  <tr>
    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">
      <tr>
        <td align="left" valign="top"><table width="1121" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td width="821" valign="top"><h2><strong>LET THE CABRERA COASTAL TEAM LOCATE YOUR SUMMER VACATION RENTAL</strong></h2>
                <p class="spacing">Please fill out the form below and a respresentative will be in touch with you shortly!                </p>
                  <table width="651" border="0" cellpadding="3" cellspacing="0">
                    <tr>
                      <td colspan="2"><span class="size16"><strong><u>PLEASE PROVIDE THE INFORMATION BELOW:</u></strong></span></td>
                    </tr>
                    <tr>
                      <td colspan="2"><img src="images/t.gif" width="15" height="3" /></td>
                    </tr>
                    <tr>
                      <td width="271" align="right" valign="top"><div align="right"><span class="red"><strong>*</strong></span><strong>Full Name:</strong></div></td>
                      <td width="368"><input type="text" name="name" size="40" id="name" value="<?php echo $F1?>" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><span class="red"><strong>*</strong></span><strong>E-Mail Address:</strong></div></td>
                      <td><input name="email" type="text" id="email" size="40" value="<?php echo $F2?>" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>Contact Phone: </strong></div></td>
                      <td><input type="text" name="phone" size="15" id="phone" value="<?php echo $F3?>" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>Number Of People Including Children:</strong></div></td>
                      <td><input name="people" type="text" id="people" size="10" value="<?php echo $F4?>" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>Check In Date:</strong></div></td>
                      <td><select name="month1" id="month1" onchange="" size="1">
    <option value="01" selected="selected">January</option>
    <option value="02">February</option>
    <option value="03">March</option>
    <option value="04">April</option>
    <option value="05">May</option>
    <option value="06">June</option>
    <option value="07">July</option>
    <option value="08">August</option>
    <option value="09">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
</select>

<!-- Day dropdown -->
<select name="day1" id="day1" onchange="" size="1">
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
</select>
<select name="year1" id="year1" onchange="" size="1">
  <option value="2014">2014</option>
  <option value="2015" selected="selected">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
</select></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>Check Out Date:</strong></div></td>
                      <td><select name="month2" id="month2" onchange="" size="1">
                        <option value="01" selected="selected">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                        <!-- Day dropdown -->
                        <select name="day2" id="day2" onchange="" size="1">
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08" selected="selected">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                        <select name="year2" id="day4" onchange="" size="1">
                          <option value="2014">2014</option>
                          <option value="2015" selected="selected">2015</option>
                          <option value="2016">2016</option>
                          <option value="2017">2017</option>
                          <option value="2018">2018</option>
                          <option value="2019">2019</option>
                          <option value="2020">2020</option>
                        </select></td>
                    </tr>
                    <tr>
	  <td align="right" valign="top"><div align="right">
	  
	  <strong>Towns Interested In Vacationing To:</strong></div>
	  
	  </td>
	  <td>
	  
	  <input name="town1" type="checkbox" id="town" value="NORTH WILDWOOD" checked="checked" />
		NORTH WILDWOOD<br />
		
		<input name="town2" type="checkbox" id="town2" value="WILDWOOD" checked="checked" />
		
		WILDWOOD<br />
		
		<input name="town3" type="checkbox" id="town3" value="WILDWOOD CREST" checked="checked" />
		
		WILDWOOD CREST<br />
		
		<input name="town4" type="checkbox" id="town4" value="DIAMOND BEACH" checked="checked" />
		
		DIAMOND BEACH<br />
		
		<input name="town5" type="checkbox" id="town5" value="STONE HARBOR" checked="checked" />
		
		STONE HARBOR<br />
		
		<input name="town6" type="checkbox" id="town6" value="AVALON" checked="checked" />
		
		AVALON<br />
		
		<input name="town7" type="checkbox" id="town7" value="CAPE MAY" checked="checked" />
		
		CAPE MAY<br />
		<input name="town8" type="checkbox" id="town8" value="LOWER TOWNSHIP" checked="checked" />
		
		LOWER TOWNSHIP<br />
		
		<input name="town9" type="checkbox" id="town9" value="OTHER" />
		OTHER</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>Location:</strong></div></td>
                      <td>
					  
					  <input name="location1" type="checkbox" id="location" value="OCEANFRONT" />
					  
                        OCEANFRONT<br />
                        <input name="location2" type="checkbox" id="location2" value="BAYFRONT" />
						
                        BAYFRONT<br />
                        <input name="location3" type="checkbox" id="location3" value="BEACH BLOCK" />
						
                        BEACH BLOCK<br />
                        <input name="location4" type="checkbox" id="location4" value="CLOSE TO THE BEACH AS POSSIBLE" />
                        CLOSE TO THE BEACH AS POSSIBLE<br />
						
                        <input name="location5" type="checkbox" id="location5" value="CLOSE TO THE BAY AS POSSIBLE" />
                        CLOSE TO THE BAY AS POSSIBLE<br />
						
                        <input name="location6" type="checkbox" id="location6" value="CLOSE TO BOARDWALK" />
						
                        CLOSE TO BOARDWALK</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>Questions / Comments:<br />
                      </strong></div></td>
                      <td><textarea name="message" cols="40" rows="5" wrap="virtual" id="message"><?php echo $F20;?></textarea></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>&nbsp;<br />
                      </strong></div></td>
                      <td><strong>Image Verification </strong><span class="graytext">(Type Below)</span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>&nbsp;<br />
                      </strong></div></td>
                      <td><?php print'<img id="mainimage" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>&nbsp;<br />
                      </strong></div></td>
                      <td><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><div align="right"><strong>&nbsp;<br />
                      </strong></div></td>
                      <td><input type="text" name="captcha" id="captcha" /></td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
					  
					  <input name="btn" type="hidden" id="btn"  value="Submit" />
					  
                      <td><input name="locate2" type="submit" id="locate2" onclick="return validateForm()" value="Submit" /></td>
                    </tr>
                  </table>
        </td>
            </tr>
          </tbody>
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
<?php
	if($msg != ''){
  ?>
    <script>
		alert("<? echo $msg?>");
	</script>
  <?php
	}
  ?>
</form>
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>
