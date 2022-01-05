<?php 
	session_start();
 	require_once('../config.php');
	require_once('captcha/captcha.php');
	
		
	if ($_POST['btnsubmit']=="Submit")
	{
		if($_POST['captcha']!='')
		{
			if(captcha_validate())
			{
			
				if ($_GET['pageflag'] == "adduser")
				{
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
						$sql="UPDATE tbl_user SET del_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='index.php';window.close();</script>";
				}
				if ($_GET['pageflag'] == "upload")
				{
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
					$sql="UPDATE tbl_upload SET del_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='uploadfiles.php';window.close();</script>";
				}
				if ($_GET['pageflag'] == "uploadhomeimage")
				{
				
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
						$sql="UPDATE tbl_homepageupload_images SET del_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='sitetemplate-home.php';window.close();</script>";
				}
				if ($_GET['pageflag'] == "dropdowntemplate")
				{
				
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
						$sql="UPDATE tbl_web_subpage SET delete_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='sitetemplate-dropdown.php';window.close();</script>";
				}
				if ($_GET['pageflag'] == "delete_page")
				{
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
					$sql="UPDATE tbl_custpages SET delete_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='updatepages.php';window.close();</script>";
				}		
                if ($_GET['pageflag'] == "team_person")
				{
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
					$sql="UPDATE  tbl_team_person SET delete_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='updatepages-ourteam.php';window.close();</script>";
				}							
				
				if ($_GET['pageflag'] == "delete_event")
				{
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
					$sql="UPDATE  tbl_events SET deletestatus=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='updatepages-events.php';window.close();</script>";
				}	
                if ($_GET['pageflag'] == "storeddata")
				{
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
					$sql="UPDATE  tbl_storeddata SET delete_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='storeddata.php';window.close();</script>";
				}		
                  if ($_GET['pageflag'] == "solddata")
				{
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
					$sql="UPDATE  tbl_sold SET delete_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='soldproperties.php';window.close();</script>";
				}		
               if ($_GET['pageflag'] == "delete_agent")
				{
					$alldeleteids = explode("~",$_GET['deleteids']);
					for($x=0; $x<count($alldeleteids); $x++)
					{
					$sql="UPDATE  tbl_listingsagent SET delete_status=1 WHERE id=".$alldeleteids[$x];
						$r=mysql_query($sql);
					}
					echo "<script>window.opener.location.href='sitetemplate-cabrera.php';window.close();</script>";
				}								
						
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
	<title>ISLAND</title>
	<link href="../styles.css" rel="stylesheet" type="text/css">
	<link rel="SHORTCUT ICON" href="../images/lsa.ico">
</head>
<body style="background:#FFF;color:#FFF;">
	<form name="frmdeleteoption" action="#" method="post" enctype='multipart/form-data'>
		<table width="300" border="0" cellspacing="1" cellpadding="3" style="padding-top:15px" align="center">
			<tr><td><?php echo $msg; ?></td></tr>
			<tr>
				<td>
					<table width="270" border="0" cellspacing="2" cellpadding="1">
						<tr>
							<td width="231" align="left" style="color:#000;"><strong>Image Verification </strong><span class="graytext">(Type Below)</span></td>
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
				</td>
			</tr>
			<tr>
				<td align='left'>
					<input type="submit" name="btnsubmit" id="btnsubmit" value="Submit">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>