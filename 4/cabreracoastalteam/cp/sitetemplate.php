<?php
	session_start();
	require_once('../config.php');	
	
	require_once('captcha/captcha.php');
	require_once('simpleimage.php');
	 if(isset($_SESSION['uid'])=="" )
	  header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	 

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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?php include_once("header.php");?></td></tr>
  
  <tr>
    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
      <?php 
      	$resultarray = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id ='".$userid."'")); 
	  ?>
        <td><div align="center"><em>You Are Currently Logged In As: <strong>
		<?php echo $resultarray['name']; ?></strong> (<a href="../logout.php">Log Out</a>)</em></div></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1122" border="0" cellspacing="12" cellpadding="0">
          <tr>
            <td><div align="center" class="white"><a href="index.php" class="whitelink">USER ACCOUNTS</a> &nbsp; | &nbsp; <a href="soldproperties.php" class="whitelink">SOLD PROPERTIES</a> &nbsp; | &nbsp; <a href="updatepages.php" class="whitelink">UPDATE PAGES</a> &nbsp; | &nbsp; <a href="uploadfiles.php" class="whitelink">UPLOAD FILES</a> &nbsp; | &nbsp; <a href="sitetemplate.php" class="whitelink">SITE TEMPLATE</a> &nbsp; | &nbsp; <a href="storeddata.php" class="whitelink">STORED DATA</a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td><h2>SITE TEMPLATE</h2>
          <table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
            <tr>
              <td width="275" bgcolor="#CCCCCC"><strong>Page Name</strong></td>
              <td width="713" bgcolor="#CCCCCC"><strong>Description</strong></td>
              <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Action</strong></div></td>
            </tr>
            <tr>
              <td bgcolor="#CAE1F7">Home Page Slide Show</td>
              <td bgcolor="#CAE1F7">Allows you to add / delete / sort pictures to the home page slide show.</td>
              <td bgcolor="#CAE1F7"><div align="center"><a href="sitetemplate-home.php">Modify</a></div></td>
            </tr>
            <tr bgcolor="#F8F7E0">
              <td>Drop Down Navigation</td>
              <td>Allows you to add / delete / sort links in the drop down navigation.</td>
              <td><div align="center"><a href="sitetemplate-dropdown.php">Modify</a></div></td>
            </tr>
            <tr bgcolor="#E9E9E9">
              <td bgcolor="#CAE1F7">Header</td>
              <td bgcolor="#CAE1F7">Allows you to update the html in the header on every page.</td>
              <td bgcolor="#CAE1F7"><div align="center"><a href="sitetemplate-header.php">Modify</a></div></td>
            </tr>
            <tr bgcolor="#E9E9E9">
              <td bgcolor="#F8F7E0">Footer</td>
              <td bgcolor="#F8F7E0">Allows you to update the html in the footer on every page.</td>
              <td bgcolor="#F8F7E0"><div align="center"><a href="sitetemplate-footer.php">Modify</a></div></td>
            </tr>
            <tr bgcolor="#F8F7E0">
              <td bgcolor="#CAE1F7">Email Addresses For Forms</td>
              <td bgcolor="#CAE1F7">Allows you to customize each form with specific email addresses to send to.</td>
              <td bgcolor="#CAE1F7"><div align="center"><a href="sitetemplate-email.php">Modify</a></div></td>
            </tr>
            <tr bgcolor="#F8F7E0">
              <td bgcolor="#F8F7E0">Agents For Cabrera Listings</td>
              <td bgcolor="#F8F7E0">Allows you to select agents in the MLS to display their properties in this section.</td>
              <td bgcolor="#F8F7E0"><div align="center"><a href="sitetemplate-cabrera.php">Modify</a></div></td>
            </tr>
            <tr bgcolor="#F8F7E0">
              <td bgcolor="#CAE1F7">Add Virtual Tour Link</td>
              <td bgcolor="#CAE1F7">Allows you to select the MLSNO to Add Virtual Tour Link for this properties </td>
              <td bgcolor="#CAE1F7"><div align="center"><a href="tourlink.php">Modify</a></div></td>
            </tr>
          </table></td>
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
