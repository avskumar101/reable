<?php

	session_start();

	require_once('../config.php');

	require_once('../captcha/captcha.php');

	

	

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

			

			} else {		

			

			}	

		} 	 

		

	echo "<script>alert('Your message has been sent. Please enjoy the rest of the site.');window.location.href='listsales.php';</script>";

		

	

		}

		

	}

	?>

	

<?php

  

  $result_query=mysql_fetch_array(mysql_query("select * from tbl_homepage where id=2"));

  

  

  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title><?php echo $result_query['meta_title'];?></title>



<link rel="canonical" href="http://cabreracoastalteam.com/listsales.php" />



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



<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">



  <tr>



    <td width="100%"><table width="1080" border="0" cellspacing="0" cellpadding="0">



      <tr>



        <td width="431"><a href="index.php"><img src="images/logotop.png" width="431" height="248" border="0"/></a></td>



        <td width="232"><a href="../listsales.php?Mobile=Off"><img src="images/fullsite.png" width="232" height="248" border="0"/></a></td>



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

	<?php echo $result_query['content']; ?>

	

	<table width="980" align="center" border="0" cellspacing="18" cellpadding="0">

   



	 <tr>

        <td align="left" class="verylrgspacing">

    

	<form method="post" name="sell" id="sell">

		 

	<table width="940" align="center" border="0" cellspacing="4" cellpadding="4">

		<tr>

		<td colspan="2"><img src="images/t.gif" width="15" height="22" /></td>

	  </tr>		

	

	<tr>

	

		<td align="center" colspan="2" class="size32">

		<strong><u>PLEASE PROVIDE YOUR FULL NAME</u></strong></td>

		</tr>

              <tr>

                <td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

              </tr>		

		

		<tr><td align="right" >



		<span class="red">

		<strong class="size32">*</strong></span>

		<strong class="size32">Full Name : </strong></td>



		<td>



		<input id="Name" style="width: 90%;" name="Name" type="text" value="<?php echo $_POST['Name'] ?>" class="size32"/>



		</td></tr>		

	  <tr>

		<td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

	  </tr>				 

		<tr>

		<td colspan="2" class="size32" align="center"><strong>

		<u>PLEASE PROVIDE THE PROPERTIES LOCATION</u></strong></td>

		</tr>		 

		 

		  <tr>

		<td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

	  </tr>	 

		<tr><td align="right" >



		<strong><span class="size32">Address : </span></strong>



		</td><td>

      

		<input id="PropertyAddress1" style="width: 90%;" name="PropertyAddress1" type="text" value="<?php echo $_POST['PropertyAddress1'] ?>" class="size32"/>



		</td></tr>	

              <tr>

                <td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

              </tr>

		<tr><td align="right" >	</td><td>

      

		<input id="PropertyAddress2" style="width: 90%;" name="PropertyAddress2" type="text" value="<?php echo $_POST['PropertyAddress2'] ?>" class="size32"/>



		</td></tr>

		

		

	  <tr>

	<td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

	</tr>

	<tr>

	<td colspan="2" class="size32" align="center">

	<strong><u>PLEASE FILL OUT AT LEAST ONE OPTION BELOW</u></strong></td>

	</tr>

	  <tr>

		<td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

	  </tr>		 

		<tr><td align="right" >



		<span class="red">

		<strong class="size32">* </span></strong><strong>E-Mail: </strong>



		</td><td>



		<input id="Email" style="width:90%;" name="Email" type="text" value="<?php echo $_POST['Email'] ?>" class="size32"/>



		</td></tr>	

	  <tr>

		<td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

	  </tr>

		

		<tr>

		<td><div align="right" class="size32"><strong>Home Phone: </strong></div></td>

		<td><input type="text" name="HomePhone" class="size32" size="14" /></td>

		</tr>

	  <tr>

	<td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

  </tr>	

		

		<tr>

		<td><div align="right" class="size32"><strong>Business Phone:</strong></div></td>

		<td><input type="text" class="size32" name="BusinessPhone" size="14" />

		  x

		  <input type="text" class="size32" name="BusinessPhoneExt" size="4" /></td>

		</tr>

		

	  <tr>

		<td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

	  </tr>		

		<tr>

		<td><div align="right" class="size32"><strong>Address: </strong></div></td>

		<td><input type="text" class="size32" name="Address" size="40" /></td>

		</tr>

	  <tr>

		<td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

	  </tr>		

		

		<tr>

		<td><div align="right" class="size32"><strong>City:</strong></div></td>

		<td><input type="text" class="size32" name="City" size="20" /></td>

		</tr>

		

	              <tr>

                <td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

              </tr>	

		

              <tr>

                <td><div align="right" class="size32"><strong>State: </strong></div></td>

                <td class="size32"><select name="State" class="size32">

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

                <td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

              </tr>			  

              <tr>

                <td><div align="right" class="size32"><strong>Zip/Postal Code: </strong></div></td>

                <td><input type="text" class="size32" name="ZipCode" size="9" /></td>

              </tr>

              <tr>

                <td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

              </tr>

              <tr>

                <td align="right" class="size32">

				<strong>Questions / Comments: </strong>

				</td>

				

                <td><textarea name="Message" id="Message" rows="9" cols="60" wrap="virtual"></textarea></td>

              </tr>

              <tr>

                <td colspan="2"><img src="images/t.gif" width="15" height="9" /></td>

              </tr>			  

			  

  

	    <tr><td valign="top">&nbsp;</td>

		<td>		

<div class="g-recaptcha" data-sitekey="6LfIyCUTAAAAAL5w5jZsbdwZYUxdyb_nb3HSf7ZB"></div>

        </td></tr>

  

    </table>

	  

	</td>

  </tr>

 



	</td>

  </tr>



  <tr>

    <td><table width="980" border="0" cellspacing="25" cellpadding="0">

     

	 <tr>

        <td colspan="2" align="center">

	

		<input name="submit" type="submit" id="submit" onclick="return validateForm()" value="Submit" />

		

		</td>

		

		</form>

		

      </tr>

    </table>

	

	

	

	</td>



  </tr>



  <tr>



    <td><img src="images/t.gif" width="30" height="20" /></td>



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

</body><?php require_once('googletagmanager.php'); ?>



</html>



