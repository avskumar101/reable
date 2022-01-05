<?php
session_start();

require_once('../config.php');

$directoryURI =basename($_SERVER['SCRIPT_NAME']);	
			
$filename=$directoryURI;

 if($filename=='capemayrealestate.php') {
	$citynamecps="CAPE MAY";
	$citynamelw="Cape May";
	$citynamelwa="capemay";
 } 
 if($filename=='diamondbeachproperties.php') {	 
	$citynamecps="DIAMOND BEACH";
	$citynamelw="Diamond Beach";
	$citynamelwa="diamondbeach";
 } 
 if($filename=='wildwoodcrestproperties.php') {	 
	$citynamecps="WILDWOOD CREST";
	$citynamelw="Wildwood Crest";
	$citynamelwa="wildwoodcrest";
 } 
 if($filename=='wildwoodrealestate.php') {	 
	$citynamecps="WILDWOOD";
	$citynamelw="Wildwood";
	$citynamelwa="wildwood";
 } 
 if($filename=='westwildwoodhomes.php') {	 
	$citynamecps="WEST WILDWOOD";
	$citynamelw="West Wildwood";
	$citynamelwa="westwildwood";
 }
 if($filename=='northwildwoodproperties.php') {	 
	$citynamecps="NORTH WILDWOOD";
	$citynamelw="North Wildwood";
	$citynamelwa="northwildwood";
 } 
 if($filename=='lowertownshiprealestate.php') {	 
	$citynamecps="LOWER TOWNSHIP";
	$citynamelw="Lower Township";
	$citynamelwa="lowertownship";
 } 
 if($filename=='middletownshiphomes.php') {	 
	$citynamecps="MIDDLETOWNSHIP";
	$citynamelw="Middle Township";
	$citynamelwa="middletownship";
 }
 if($filename=='avalonrealestate.php') {	 
	$citynamecps="AVALON";
	$citynamelw="Avalon";
	$citynamelwa="avalon";
 } 
 if($filename=='stoneharborhomes.php') {	 
	$citynamecps="STONEHARBOR";
	$citynamelw="Stone Harbor";
	$citynamelwa="avalon";
 }
 

 
if($_POST['buttonevents']=='submitevents')
{
	
	if($_POST['fullname']!='')
	{
		
		 // Variable to check
		$email = $_POST['email'];
		// Validate email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
		{
				
		
		if(isset($_POST['g-recaptcha-response'])) {

		$captcha=$_POST['g-recaptcha-response'];

		}		

		$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfIyCUTAAAAAP-tWl3VMZ98m6ebIhhgpHva_WiW=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
       

	   if($response.success==false)  {

          echo '<h2>You are spammer ! Get the @$%K out</h2>';

        } else {
			
			
			$fullname = $_POST['fullname'];
			$emailadd = $_POST['email'];
			$phone = $_POST['phone'];
			$comments = $_POST['comments'];
			$selectoptn = $_POST['selectoptn'];
			$crton=date(y).'-'.date(m).'-'.date(d);	
		
    $content= "<body style=\"font-family:Calibri, Calibri, Geneva, sans-serif;\">\n";

	$content.= "<table align='left'>
					<tr><td colspan='2'>
					<strong>Contact Cabrera Coastal Team - $citynamelw</strong></td></tr>
					<tr><td>Full Name </td><td>: ".$fullname."</td></tr>
					<tr><td>Email Address </td><td>: ".$emailadd."</td></tr>
					<tr><td>Phone </td><td>: ".$phone."</td></tr>
					<tr><td>Select Option </td><td>: ".$selectoptn."</td></tr>
					<tr><td colspan='2'>Comments :</br> ".$comments."</td></tr>
				</table>";
				
				
				
		mysql_query("insert into tbl_storeddata(name,emailid,pagename,delete_status,createon,comment,mailtext) values ('".mysql_real_escape_string($fullname)."','".$emailadd."','CITY PAGE FORMS','0',NOW(),'".mysql_real_escape_string($comments)."','".mysql_real_escape_string($content)."')");		
		

		/******** START OF CONFIG SECTION *******/
		$sendto  = "";
		$subject = "Contact Cabrera Coastal Team - $citynamelw";
		
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
			
			
			
		$contact_email=mysql_fetch_array(mysql_query("select requesttows,web_email from  tbl_website_email where id=1"));		
			
			
		$fromadd=$contact_email['web_email'];
		
		if($contact_email['requesttows']!=''){
			$to = $contact_email['requesttows'];
		} else {
			$to = "bmatthews13@gmail.com";
		}		 

		 
		$headers = "From: \" $fromadd \" <$fromadd>\r\n" .
									"Content-type:text/html \r\n";	
							 
		$add = "-f ".$fromadd;						 

		if(!empty($to) && !empty($subject) && !empty($headers)) 
		{	
	
			if(mail($to, "$subject", $content, $headers,$add)) {
				//echo("<p>Message sent!</p>");
			} else {
				// echo("<p>Message delivery failed...</p>");
			}
			
		}
	

	echo "<script>alert('Your message has been sent. Please enjoy the rest of the site.'); window.location.assign(document.URL);</script>";

			}
				
		} else {
		
		 echo "<script>alert('$email is not a valid email address');</script>";
		 
		}		
		
	}
	
}

?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">

function validateForm() {
	
	var x = document.forms["contactpg"]["fullname"].value;
    if (x == null || x == "") {
        alert("Please Enter Your Full Name and Try Again.");
        contactpg.fullname.focus();
		return false;
    }	
	
	var x = document.forms["contactpg"]["email"].value;
    if (x == null || x == "") {
        alert("Please Enter Your Email Address and Try Again.");
		contactpg.email.focus();
        return false;
    }	
    var x = document.forms["contactpg"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
     alert("Not a valid e-mail address");
	 contactpg.email.focus();
     return false;
    }		
	var x = document.forms["contactpg"]["comments"].value;
    if (x == null || x == "") {
        alert("Please Enter Your Comments and Try Again.");
        contactpg.comments.focus();
		return false;
    }		

	var captcha_response = grecaptcha.getResponse();	
	if(captcha_response.length == 0) {
		
		alert('Please Enter reCaptcha');
		return false; 
		
	} else {
	
		document.forms["contactpg"].submit();
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
<style> .padding {padding: 10px;} </style>


<form name="contactpg" id="contactpg" method="POST" enctype='multipart/form-data'>


<table width="75%" border="0" cellspacing="1" cellpadding="45" bgcolor="#E1E1E1">
	  <tr>
		<td width="100%" align="center" bgcolor="#EAEAEA" class="size20">CONTACT CABRERA COASTAL REAL ESTATE</td>
	  </tr>
	  <tr>
		<td bgcolor="#EEF7FD">
		
		<table width="100%" border="0" cellspacing="0" cellpadding="8">
		  <tr>
			<td align="left">
				
<input name="fullname" placeholder="*Full Name" type="text" class="gray padding" id="fullname" style="width: 93%" />
				</td>
              </tr>
              <tr>
                <td align="left"><img src="images/t.gif" width="40" height="20" /></td>
              </tr>
              <tr>
                <td align="left">
				
<input name="email" placeholder="*Email Address" type="text" class="gray padding" id="email" style="width: 93%" />

				</td>
              </tr>
              <tr>
                <td align="left"><img src="images/t.gif" width="40" height="20" /></td>
              </tr>
              <tr>
                <td align="left">
				
<input name="phone" placeholder="Phone Number" type="text" class="gray padding" id="phone" style="width: 93%" onkeypress="return isNumber(event)" />
				
				</td>
              </tr>
              <tr>
                <td align="left"><img src="images/t.gif" width="40" height="20" /></td>
              </tr>
              <tr>
                <td align="left">
				
				<select name="selectoptn" id="selectoptn" class="gray padding" style="width: 96%" >
                  <option value="I Am Interested In">I Am Interested In</option>
                  <option value="Booking A Summer Rental">Booking A Summer Rental</option>
                  <option value="Purchasing A Property">Purchasing A Property</option>
                  <option value="Selling My Property">Selling My Property</option>
                  <option value="None Of The Above">None Of The Above</option>
                </select>
				
				</td>
              </tr>
              <tr>
                <td align="left"><img src="images/t.gif" width="40" height="20" /></td>
              </tr>
              <tr>
                <td align="left">
				
<textarea name="comments" rows="6" class="gray padding" id="comments" style="width: 93%" placeholder="*Please include any comments or questions you have and a representative from Cabrera Coastal Real Estate will be in touch with you shortly!"></textarea>
				
				</td>
              </tr>
			  
		<tr>
			<td><img src="images/t.gif" width="15" height="25" /></td>
		</tr>

		<tr><td align="center" colspan="3">		

<div class="g-recaptcha" data-sitekey="6LfIyCUTAAAAAL5w5jZsbdwZYUxdyb_nb3HSf7ZB"></div>

		</td></tr>

		<tr>
			<td><img src="images/t.gif" width="15" height="17" /></td>
		</tr>  
			  
              <tr>
                <td align="center">
		
<input type="hidden" id="buttonevents" name="buttonevents" value="submitevents">

<img src="../images/submit.jpg" width="205" height="86" onclick="return validateForm();" alt="SUBMIT!" style="cursor: pointer;"/>				
							
				</td>
              </tr>			  
			  
            </table></td>
          </tr>
        </table>
</form>

</td>
	</tr> 
	
	<tr>
		<td><img src="images/t.gif" width="40" height="14" /></td>
	</tr>
	 <tr>
		<td bgcolor="#CCCCCC"><img src="images/t.gif" width="40" height="1" /></td>
	</tr>
	<tr>
		<td><img src="images/t.gif" width="40" height="14" /></td>
	</tr>
	

	<tr>	
		<td>
	
	<table width="98%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="357" align="center" valign="top">
		
		<h3><u>PROPERTIES FOR SALE</u> IN <?php echo $citynamecps;?></h3>

		<p>Recently Listed Properties - <?php echo $citynamelw;?> MLS</p>

		<table width="357" border="0" cellspacing="0" cellpadding="0">

	<?php

	if($filename=='diamondbeachproperties.php') {	 
	 
	 $recentresults=@mysql_query("select * from tbl_listings where active='1' and (Area = 'Diamond Beach') order by Days_On_Market asc limit 5");
	 
	 } elseif($filename=='lowertownshiprealestate.php') {	 
	 
	$recentresults=@mysql_query("select * from tbl_listings where active='1' and (city = 'Lower Township' or city = 'Villas' or city = 'Cold Spring' or city = 'Fishing Creek' or city = 'Townbank' or city = 'Erma') order by Days_On_Market asc limit 5");
	 
	 }elseif($filename=='middletownshiphomes.php') {	 
	 
	$recentresults=@mysql_query("select * from tbl_listings where active='1' and (city = 'Middle Township' or city = 'Burleigh' or city = 'Cape May Court House' or city = 'Rio Grande' or city = 'Whitesboro' or city = 'Dias Creek' or city = 'Green Creek') order by Days_On_Market asc limit 5");
	 
	 } else {
	
	$recentresults=@mysql_query("select * from tbl_listings where active='1' and city='$citynamelw' order by Days_On_Market asc limit 5");

	}
	 
	while($datarcnt=mysql_fetch_array($recentresults)) { 

	if($datarcnt['mainimg']!=''){ $image=$datarcnt['mainimg'];} else { $image="../images/nopicture.png"; }

	?>
	
	<tr>

    <td><table width="100%" border="0" cellspacing="6" cellpadding="0">

      <tr>

        <td width="500"><a href="property.php?MLSNo=<?php echo $datarcnt['MLSNo'];?>">
		
		<img src="<?php echo $image;?>" width="500" height="375" border="0"/></a></td>

        <td width="30"><img src="images/t.gif" width="30" height="30" /></td>

        <td width="540" align="left" valign="top">
		
		<table width="100%" border="0" cellpadding="4" cellspacing="7">
		
		<tr><td colspan="2"><strong>
		
		<a href="property.php?MLSNo=<?php echo $datarcnt['MLSNo'];?>" style="font-size:42px;">
		
		<?php echo $datarcnt['Address'] ?></a></strong></td></tr><tr><td width="20px">CITY</td>
		
		<td>: <strong><?php echo $datarcnt['City'] ?></strong></td></tr><tr><td>PRICE</td>
		
		<td>: <strong>$<?php echo number_format($datarcnt['Asking_Price']);?></strong></td></tr>
		
		<tr><td>MLS</td><td>: <strong><?php echo $datarcnt['MLSNo'];?></strong></td></tr>
		
		<tr><td>BEDS</td><td>: <strong><?php echo $datarcnt['Bedrooms'];?></strong></td></tr>
		
		<tr><td>DOM</td><td>: <strong><?php echo $datarcnt['Days_On_Market'];?></strong></td></tr>
		
		<tr><td>TYPE</td><td>: <strong><?php echo $datarcnt['Type'];?></strong></td></tr>

		</table>
		  
		  </td>
      </tr>
    </table></td>
  </tr>

  <tr>
    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">
      <tr><td><img src="images/t.gif" width="30" height="30" /></td></tr>
      <tr><td bgcolor="#CCCCCC"><img src="images/t.gif" width="30" height="4"/></td></tr>
      <tr><td><img src="images/t.gif" width="30" height="30" /></td></tr>
    </table>
	</td>
  </tr>
  			
	<?php } ?>
			
       </table>
	   
	   <p><a href="search.php">SEARCH ALL PROPERTIES FOR SALE IN <?php echo $citynamecps;?></a></p>
	   
		</td>	
	</tr>	
		</table>	
	</td>
	
</tr>
	<tr>
		<td><img src="images/t.gif" width="40" height="14" /></td>
	</tr>
	 <tr>
		<td bgcolor="#CCCCCC"><img src="images/t.gif" width="40" height="1" /></td>
	</tr>
	<tr>
		<td><img src="images/t.gif" width="40" height="14" /></td>
	</tr>
	
<tr>	
	<td>
	<table width="98%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td align="center" valign="top">
			
	<?php 

	$ddate=date("Y-m-d");		

	$date = new DateTime($ddate);

	$week = date("W", strtotime('+2 days'));

	$wkno = $week + 1;
	
	function week_start_date1($wk_num, $yr, $first = 1, $format = 'F d, Y') {
		
		$wk_ts  = strtotime('+' . $wk_num . ' weeks', strtotime($yr . '0101'));
		$mon_ts = strtotime('-' . date('w', $wk_ts) + $first . ' days', $wk_ts);
		return date($format, $mon_ts);
		
	} 	
          $wkno;  $selnumweeks = 1;
		  $selbegin =$wkno;
		  
			for ($k=1;$k<53;$k++) {
				
				$sStartDate = week_start_date1($k, 2019);
				
				$sEndDate   = date('m/d/y', strtotime('-2 days', strtotime($sStartDate)));
				
				if($selnumweeks != "0") {
					
				$dc = 7*$selnumweeks;
				
				$EndDate   = date('m/d/y', strtotime($dc.' days', strtotime($sEndDate)));
				
				} else {
				
				$EndDate   = date('m/d/y', strtotime('+7 days', strtotime($sEndDate)));
				
				}				
				if($k==$selbegin){	
				
					$datestart=$sEndDate;
					
					$dateEndDate=$EndDate;
				}
			}
		?>	
		
	<h3><?php echo $citynamecps;?> <u>SUMMER VACATION RENTALS</u></h3>

	<p><u>Available</u> Rentals For The Week: <strong><?php echo $datestart;?>

	</strong> - <strong><?php echo $dateEndDate;?></strong></p>

	<table width="357" border="0" cellspacing="0" cellpadding="0">

	<?php 
	
	$checkindate=date('Y-m-d', strtotime($datestart));	

	$checkoutdate=date('Y-m-d', strtotime($dateEndDate));
			
	$cond=" and (CheckInDate <= '".$checkindate."' AND CheckOutDate >= '".$checkoutdate."') ";
		
	$STM2 = mysql_query("SELECT * FROM rental_properties_rates_rs where active='0' $cond group by referenceid");		
	
	$rfid='';
	$i=0;	
	while($avl = mysql_fetch_array($STM2)) {
		
		if($available=='') {
			
			$rfid.=" and ( referenceid='".$avl['referenceid']."'";
			$available='property';
			
		} else {
			
			$rfid.=" or referenceid='".$avl['referenceid']."'";
		}	

	$i++;
	}	
	
	if($available=='property') {		
		$avble= $rfid.')';		
	}
		
	$stmtcount=mysql_num_rows(mysql_query("SELECT * FROM search_results where HideList='0' and city='$citynamelw' $avble"));

	if($stmtcount>3) {
	
		$stmt5 = mysql_query("SELECT * FROM search_results where HideList='0' and city='$citynamelw' $avble limit 5");
	
	} else {
		
		$stmt5 = mysql_query("SELECT * FROM search_results where HideList='0' $avble limit 5");
	}
		
		
	$l=0;	
	while($avl = mysql_fetch_array($stmt5))	{
		
		$imgPreview=$avl['imgPreview'];
				
		if($imgPreview!='') {

			$pgrepimg=$imgPreview;

		} else {
		
			$pgrepimg='../images/nopicture.png';
		}
		
		if(isset($checkindate)) { 

			$cnd .="&checkin=".$checkindate."&checkout=".$checkoutdate;
		}
		$referenceid=$avl['referenceid'];
		
		$cid=$avl['cid'];		

		$pgurl="rentalproperty.php?RefId=".$referenceid."&cid=".$cid.$cnd;
	?>	
	
	<tr>

    <td><table width="100%" border="0" cellspacing="6" cellpadding="0">

      <tr>
        <td width="500"><a href="<?php echo $pgurl;?>">
		
		<img src="<?php echo $pgrepimg;?>" width="500" height="375" border="0"/></a></td>

        <td width="30"><img src="images/t.gif" width="30" height="30" /></td>

        <td width="540" align="left" valign="middle">
		
		<table width="100%" border="0" cellpadding="4" cellspacing="7">
		
		<tr><td colspan="2"><strong><a href="<?php echo $pgurl;?>" style="font-size:42px;">
		
		<?php 
		
		$headline=explode(',', $avl['propertyheadline']);
		  
		  if($headline[0]==$avl['street']){
		  
			echo $avl['street']; 
			
		  } else {
			  
			 echo $headline[0].'<br>'.$avl['street'];
		  }
		  ?>
		  
		 </a></strong></td></tr><tr><td width="20px">CITY</td>
		
		<td>: <strong><?php echo $avl['city'];?></strong></td></tr>
				
		<tr><td>BEDS</td><td>: <strong><?php echo $avl['bedroom'];?></strong></td></tr>
		
		<tr><td>BATHS</td><td>: <strong><?php echo $avl['bathroom'];?></strong></td></tr>
		
		<tr><td>SLEEPS</td><td>: <strong><?php echo $avl['sleepupto'];?></strong></td></tr>
		
		<tr><td colspan="2"><a href="<?php echo $pgurl;?>">View Details</a></td></tr>

		</table>
		  
		  </td>
      </tr>
    </table></td>
  </tr>

  <tr>
    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">
      <tr><td><img src="images/t.gif" width="30" height="30" /></td></tr>
      <tr><td bgcolor="#CCCCCC"><img src="images/t.gif" width="30" height="4"/></td></tr>
      <tr><td><img src="images/t.gif" width="30" height="30" /></td></tr>
    </table>
	</td>
  </tr>
	
	
	<?php } ?>	
	
	</td></tr></table>
	
	  <p><a href="vacationrentals.php">SEARCH FOR <?php echo $citynamecps;?> RENTALS</a></p>
	  
	</td>	
	</tr>	
	</table>	
	</td>
</tr>
	<tr>
		<td><img src="images/t.gif" width="40" height="14" /></td>
	</tr>
	 <tr>
		<td bgcolor="#CCCCCC"><img src="images/t.gif" width="40" height="1" /></td>
	</tr>
	<tr>
		<td><img src="images/t.gif" width="40" height="14" /></td>
	</tr>
	
<tr>	
	<td>
	<table width="98%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td align="center" valign="top">
	
	<h3><?php echo $citynamecps;?> <u>RECENTLY SOLD</u> PROPERTIES</h3>

	<p>Recently Sold Real Estate Properties</p>

	<table width="357" border="0" cellspacing="0" cellpadding="0">

	<?php

	 if($filename=='diamondbeachproperties.php') {	 
	 
	$soldresults=@mysql_query("select * from tbl_sold where closingdate < CURDATE() and (Area = 'Diamond Beach') order by closingdate desc limit 5");

	 } elseif($filename=='lowertownshiprealestate.php') {	 
	 
	$soldresults=@mysql_query("select * from tbl_sold where closingdate < CURDATE() and (city = 'Lower Township' or city = 'Villas' or city = 'Cold Spring' or city = 'Fishing Creek' or city = 'Townbank' or city = 'Erma') order by closingdate desc limit 5");

	 } elseif($filename=='middletownshiphomes.php') {	 
	 
	$soldresults=@mysql_query("select * from tbl_sold where closingdate < CURDATE() and (city = 'Middle Township' or city = 'Burleigh' or city = 'Cape May Court House' or city = 'Rio Grande' or city = 'Whitesboro' or city = 'Dias Creek' or city = 'Green Creek') order by closingdate desc limit 5");

	 } else {
		 
	$soldresults=@mysql_query("select * from tbl_sold where closingdate < CURDATE() and City='$citynamelw' order by closingdate desc limit 5");
	 }
	 
	while($data=mysql_fetch_array($soldresults)) { 
	
	if($data['mainimg']!=''){ $imagesold=$data['mainimg'];} else { $imagesold="../images/nopicture.png"; }
	
	?>
	
	<tr>

    <td><table width="100%" border="0" cellspacing="6" cellpadding="0">

      <tr>

        <td>
		
		<img src="<?php echo $imagesold;?>" width="500" height="375" border="0"/></td>

        <td width="30"><img src="images/t.gif" width="30" height="30" /></td>

        <td width="540" align="left" valign="middle">
		
		<table width="100%" border="0" cellpadding="4" cellspacing="11">
		
		<tr><td colspan="2"><strong style="font-size:42px;">
				
		<?php echo $data['Address'] ?></strong></td></tr><tr><td width="20px">CITY</td>
		
		<td>: <strong><?php echo $data['City'] ?></strong></td></tr><tr><td>SOLD</td>
		
		<td>: <strong><font color="red">
		
		$<?php echo number_format($data['soldprice']);?></font></strong></td></tr>
		
		<tr><td>DATE</td><td>: <strong>
		<?php echo date('m/d/y',strtotime($data['closingdate'])); ?></strong></td></tr>
		
		<tr><td>DOM</td><td>: <strong><?php echo $data['Days_On_Market'];?></strong></td></tr>
		
		<tr><td>TYPE</td><td>: <strong><?php echo $data['Type'];?></strong></td></tr>

		</table>
		  
		  </td>
      </tr>
    </table></td>
  </tr>

  <tr>
    <td><table width="1080" border="0" cellspacing="0" cellpadding="0">
      <tr><td><img src="images/t.gif" width="30" height="30" /></td></tr>
      <tr><td bgcolor="#CCCCCC"><img src="images/t.gif" width="30" height="4"/></td></tr>
      <tr><td><img src="images/t.gif" width="30" height="30" /></td></tr>
    </table>
	</td>
  </tr>

	<?php } ?>
	
	</table>	
       <p><a href="<?php echo $citynamelwa.'sold.php'?>">MORE RECENTLY SOLD PROPERTIES IN <?php echo $citynamecps;?></a></p></td>
	</td>	
	</tr>
</table>