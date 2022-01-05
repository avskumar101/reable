
<?php
if($_GET['Mobile']=='') {
	$url =$_SERVER['HTTP_REFERER'];
	$query = parse_url($url, PHP_URL_QUERY);
	parse_str($query);
	parse_str($query, $arr);
	$request = $_SERVER['HTTP_REFERER'];
	$urlname=explode('?',$request);
	$urlname= $urlname[1];
	if($urlname=='Mobile=Off' || $Mobile=='Off')
	{
	 echo "<script>window.location='http://www.cabreracoastalteam.com/listrental.php?Mobile=Off';</script>";
	 exit;
	}
}
?>


<?php

if($_GET['Mobile']=='') {
	
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
 echo "<script>window.location='mobile/listrental.php';</script>"; 

}
?>

<?php
	session_start();
	require_once('config.php');
	require_once('captcha/captcha.php');
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



				header("Location: listrentalsent.php");
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
	
	?>			<?php    $result_query=mysql_fetch_array(mysql_query("select * from tbl_homepage where id=13"));  ?>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form method="post">
<tr>
    <td><?php include("header.php")?></td></tr>
  
  <tr>
    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">
                
   <tr>
    <td>
				<?php echo $result_query['content']; ?>
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
  </form>
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>
