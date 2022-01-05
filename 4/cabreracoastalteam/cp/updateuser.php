<?php

	session_start();
	require_once('../config.php');	
	require_once('../../encypted.php');
	require_once('captcha/captcha.php');
	 if(isset($_SESSION['uid'])=="" )
	  header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	


		
	
	
		
	$ID = "";
	if(isset($_GET['ID'])!=""){
    $ID = $_GET['ID'];
	$info= mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id ='".$ID."'"));
    }
	
			else
			{
			
			}
	
		
	if($_POST['button']=="Update")		
	{
	if($_POST['captcha']!='')
		{
		
			if(captcha_validate())
			{
	        $name = $_POST['txt_fullname'];
            $email = $_POST['txt_email'];
            $password = encryptIt($_POST['txt_password']);
			
			
			
             mysql_query("UPDATE tbl_user SET name='".$name."', email='".$email."', password='".$password."'WHERE id ='".$ID."'");
			 echo  "UPDATE tbl_user SET name='".$name."', email='".$email."', password='".$password."'WHERE id ='".$ID."'";
			
		header("Location:index.php");
	
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title>Cabrera Team Control Panel</title>
<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="../images/cabrera.ico">
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');
  ga('send', 'pageview');
  
</script>
</head>

<body>
<form name="adduserform" id="adduserform" method="POST" enctype='multipart/form-data'>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?php include_once("header.php");?></td></tr>
  
  <tr>
    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
        <?php $resultarray = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user 
	   WHERE id ='".$userid."'")); 
		 
		  ?>
      <tr>
        <td><div align="center"><em>You Are Currently Logged In As: <strong>
		<?php echo $resultarray['name']; ?></strong> (<a href="../logout.php">Log Out</a>)</em></div></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1122" border="0" cellspacing="12" cellpadding="0">
          <tr>
            <td><div align="center" class="white"><a href="index.php" class="whitelink">USER ACCOUNTS</a> &nbsp; | &nbsp; <a href="soldproperties.php" class="whitelink">SOLD PROPERTIES</a> &nbsp; | &nbsp; <a href="updatepages.php" class="whitelink">UPDATE PAGES</a> &nbsp; | &nbsp; <a href="uploadfiles.php" class="whitelink">UPLOAD FILES</a> &nbsp; | &nbsp; <a href="sitetemplate.php" class="whitelink">SITE TEMPLATE</a>  &nbsp; | &nbsp; <a href="storeddata.php" class="whitelink">STORED DATA</a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
	  <?php
			$ID = "";
	       if(isset($_GET['ID'])!=""){
           $ID = $_GET['ID'];
	       $info= mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id ='".$ID."'"));
             }
	
			else
			{
			
			}
	?>
      <tr>
        <td><h2>USER ACCOUNTS</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="220"><strong>Full Name:</strong></td>
              <td width="19"><img src="../images/t.gif" width="19" height="10" /></td>
              <td width="220"><strong>Email Address:</strong></td>
              <td width="19"><img src="../images/t.gif" width="19" height="10" /></td>
              <td width="220"><strong>Password: </strong>(<a href="#" onclick="alert(document.getElementById('txt_password').value);">View</a>)</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="6"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td><input name="txt_fullname" type="text" id="txt_fullname" style="width: 98%" value="<?php echo $info['name']; ?>" /></td>
              <td>&nbsp;</td>
              <td><input name="txt_email" type="text" id="txt_email" style="width: 98%" value="<?php echo $info['email']; ?>" /></td>
              <td>&nbsp;</td>
              <td><input name="txt_password" type="password" id="txt_password" style="width: 98%" value="<?php echo decryptIt($info['password']); ?>" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="6">&nbsp;</td>
            </tr>
        <table width="270" border="0" cellspacing="2" cellpadding="1">
						<tr>
							<td width="231" align="left"><strong>Image Verification </strong><span class="graytext">(Type Below)</span></td>
						</tr>
						<tr>
							<td align="left"><?php print'<img id="mainimage" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></td>
						</tr>
						<tr>
							<td align="left"><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'../captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
						</tr>
						<tr>
							<td align="left"><input type="text" name="captcha" id="captcha" /></td>
						</tr>
					</table>
				
			          <tr>
                  <td><img src="../images/t.gif" width="10" height="4" /></td>
                </tr>
               
                </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="8" /></td>
                </tr>
              
                <tr>
                  <td><img src="../images/t.gif" width="10" height="8" /></td>
                </tr>
                <tr>
                  <td><input type="submit" name="button" id="button" value="Update" />
                    <input type="button" name="button2" id="button2" onclick="window.location.href='index.php';"value="Cancel" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="../images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1147" border="0" align="center" cellpadding="8" cellspacing="0">
          <tr>
            <td align="center" class="size12 lightblue"><em><?php include("../footer.php"); ?></em></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="../images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td><table width="182" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="30"><a href="https://www.youtube.com/channel/UCAnsRSon87T8_4vhjcOs-eg" target="_blank"><img src="../images/youtube-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://twitter.com/CabreraTeam" target="_blank"><img src="../images/twitter-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://plus.google.com/u/0/117240634238969765951/posts" target="_blank"><img src="../images/googleplus-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.facebook.com/CabreraCoastalTeam" target="_blank"><img src="../images/facebook-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.linkedin.com/company/cabrera-coastal-team" target="_blank"><img src="../images/linkedin-bottom.jpg" width="30" height="30" /></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>
