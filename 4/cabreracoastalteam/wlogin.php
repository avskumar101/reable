<?php 
	session_start(); 
	require_once('config.php');
	require_once('../encypted.php');
	
	if($_POST['btnsubmit']=="SIGN IN")		
	{
	    $pass = encryptIt($_POST['txtpassword']);
		
				$loginquery=mysql_query("select * from tbl_user where email='".$_POST['txtemail']."' and password='".$pass."' and del_status=0");
				
				$logincount=mysql_num_rows($loginquery);
				$logindata=mysql_fetch_array($loginquery);
				
				
				if($logincount>0)
				{
					
					$_SESSION['uid']=$logindata['id'];							
					$_SESSION['name']=$logindata['name'];
				 	$_SESSION['email']=$logindata['email'];
				
						echo "<script>this.window.close();window.opener.location.href='cp/index.php';</script>";
				}
				else
				{
					$loginerror="Invalid Login";
				}
				
			
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="keywords" content="Coming Soon, " />
<meta http-equiv="description" content="Coming Soon." />
<title>Login</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="images/cmfc.ico">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42527008-1', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script type="text/javascript">
	function trim(stringToTrim)
	{
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
		
	function validate() 
	{
		if(trim(document.frmlogin.txtemail.value)=='')
		{
			alert("Enter the Email Address")
			document.frmlogin.txtemail.focus();
			return false;
		}
		if (document.frmlogin.txtemail.value.length > 0)
		{
			i=document.frmlogin.txtemail.value.indexOf("@")
			j=document.frmlogin.txtemail.value.indexOf(".",i)
			k=document.frmlogin.txtemail.value.indexOf(",")
			kk=document.frmlogin.txtemail.value.indexOf(" ")
			jj=document.frmlogin.txtemail.value.lastIndexOf(".")+1
			len=document.frmlogin.txtemail.value.length
			
			if ((i>0) && (j>(1+1)) && (k==-1) && (kk==-1) && (len-jj >=2) && (len-jj<=3)) {}
			else 
			{
				alert("Please enter an exact Email Address! \n" + document.frmlogin.txtemail.value + " is invalid.");
				document.frmlogin.txtemail.focus();
				return false;
			}
		}
		if(trim(document.frmlogin.txtpassword.value)=='')
		{
			alert('Enter the Password');
			document.frmlogin.txtpassword.focus();
			return false;
		}
		else	
		{	
			
			this.form.submit();
			return true;
		}
	}
</script>
</head>

<body style="background:#436BCA;color:#FFF;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <? //include_once("header.php"); ?>
  <tr>
    <td><img src="images/t.gif" width="25" height="28" /></td>
  </tr>
  <tr>
  <? // 1195 ?>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><h1>WELCOME BACK</h1>
         <form action="#" method="post" id="frmlogin" name="frmlogin">
          <table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="320">
			  <table width="320" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2"><strong>EMAIL ADDRESS</strong></td>
                </tr>
                <tr>
                  <td colspan="2"><img src="images/t.gif" width="25" height="3" /></td>
                </tr>
                <tr>
                  <td colspan="2"><input name="txtemail" type="text" id="txtemail" style="width: 98%" /></td>
                </tr>
                <tr>
                  <td colspan="2"><img src="images/t.gif" width="25" height="13" /></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>PASSWORD</strong></td>
                </tr>
                <tr>
                  <td colspan="2"><img src="images/t.gif" width="25" height="3" /></td>
                </tr>
                <tr>
                  <td colspan="2"><input name="txtpassword" type="password" id="txtpassword" style="width: 98%" /></td>
                </tr>
                <tr>
                  <td colspan="2"><img src="images/t.gif" width="25" height="13" /></td>
                </tr>
			<!--	
                <tr><td colspan="2"><? //echo $msg; ?></td></tr>
			<tr>
				<td colspan="2">
					<table width="270" border="0" cellspacing="2" cellpadding="1">
						<tr>
							<td width="231" align="left"><strong>Image Verification </strong><span class="graytext">(Type Below)</span></td>
						</tr>
						<tr>
							<td align="left"><? //print'<img id="mainimage" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></td>
						</tr>
						<tr>
							<td align="left"><span><? //print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
						</tr>
						<tr>
							<td align="left"><input type="text" name="captcha" id="captcha" /></td>
						</tr>
					</table>
				</td>
			</tr>  -->
			<tr>
                  <td colspan="2"><img src="images/t.gif" width="25" height="13" /></td>
                </tr>
                <tr>
                  <td width="120"><input type="submit" name="btnsubmit" id="btnsubmit" value="SIGN IN" onclick="return validate();"/></td>
                 
                </tr>
              </table></form></td>
              <td width="75">&nbsp;</td>
              
            </tr>
          </table>
          </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="images/t.gif" width="38" height="38" /></td>
  </tr>
  <? //include_once("footer.php"); ?>
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>
